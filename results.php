<?php require './includes/partials/header.inc' ?>
<?php require './includes/scripts/results.inc' ?>
<?php
	if (!isset($_POST['submit'])) {
		$results = 0;
	}
?>

<h2>Search Results</h2>

<iframe id="resultsmap" src="https://www.google.com/maps/embed/v1/place?q=-27.3800614,153.0387005&amp;key=AIzaSyCem3N60YuFpGNNvVAtZ7Ha_TftWl6EdbE"></iframe>

<br>
<p>
	<table>
		<tr>
			<th>Rating</th>
			<th>Name</th>
		</tr>

		<?php
			if ($results != 0) {
				foreach($results as $result) {
					echo "<tr><td>";
					for ($i = 0; $i < 3; $i++) {
						echo "<img src=\"public/images/star.png\">";
					}
					echo "</td><td><a href=\"park.php?itemId={$result['id']}\">{$result['name']}</a></td>";
				}
			} else {
				echo "<tr><td>No items matched your search.</tr></td>";
			}
		?>

	</table>
</p>

<?php require './includes/partials/footer.inc' ?>