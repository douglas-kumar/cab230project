<?php require './includes/partials/header.inc' ?>
<?php require './includes/scripts/results.inc' ?>
<?php
	if (empty($results)) {
		$results = 0;
	} else {

		global $database;
		global $errors;

		$rats = array("itemId" => "rating");
		//print_r($rats);
		//echo "<br/>";

		try {
			foreach ($results as $result) {
				$query = "SELECT AVG(rating) AS rat FROM reviews GROUP BY itemID Having itemId = :id";
				$stmt = $database->prepare($query);
				$stmt->bindParam("id", $result['id']);
				$stmt->execute();

				if ($stmt->rowCount() > 0) {
					$avg = $stmt->fetch();
					$rats[$result['id']] = $avg['rat'];
				} else {
					$rats[$result['id']] = "No ratings";
				}
				// print_r($rats);
				// echo "<br />";
				// print_r($results);
			}
		} catch (PDOException $e) {
			die($e.getMessage());
		}
	}
?>

<h2>Search Results</h2>

<iframe id="resultsmap" src="https://www.google.com/maps/embed/v1/place?q=-27.3800614,153.0387005&amp;key=AIzaSyCem3N60YuFpGNNvVAtZ7Ha_TftWl6EdbE"></iframe>

<br>
<p>
	<table>
		<tr>
			<th>Rating</th>
			<th>Code</th>
			<th>Name</th>
			<th>Street</th>
			<th>Suburb</th>
		</tr>

		<?php
			if ($results != 0) {
				foreach($results as $result) {
					echo "<tr><td>";
					if ($rats[$result['id']] != "No ratings") {
						for ($i = 0; $i < floor($rats[$result['id']]); $i++) {
							echo "<img src=\"public/images/star.png\">";
						}
					} else {
						echo"<i>No ratings</i>";
					}
					echo "</td>
						  <td>{$result['parkCode']}</td>
						  <td><a href=\"park.php?itemId={$result['id']}\">{$result['name']}</a></td>
						  <td>{$result['street']}</td>
						  <td>{$result['suburb']}</td>
						  </tr>";
				}
			} else {
				echo "<tr><td colspan=\"5\">No items matched your search.</td></tr>";
			}
		?>

	</table>
</p>

<?php require './includes/partials/footer.inc' ?>