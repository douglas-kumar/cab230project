<?php require './includes/partials/header.inc' ?>
<?php require './includes/scripts/results.inc' ?>

<h2>Search Results</h2>
<!--<div id="googleMap1" hidden>
			  </div>
			   <div id="googleMap2">
			  </div>
			   <div id="googleMap3" hidden>
			  </div>-->

<iframe id="resultsmap" src="https://www.google.com/maps/embed/v1/place?q=-27.3800614,153.0387005&amp;key=AIzaSyCem3N60YuFpGNNvVAtZ7Ha_TftWl6EdbE"></iframe>

<br>
<p>
	<table>
		<tr>
			<th>Rating</th>
			<th>Name</th>
		</tr>
		<tr>
			<td>
				<img src="public/images/star.png">
				<img src="public/images/star.png">
				<img src="public/images/star.png">
				<img src="public/images/star.png">
			</td>
			<td><a href="park.php">7th Brigade Park</a></td>
		</tr>
		<tr>
			<td>
				<img src="public/images/star.png">
				<img src="public/images/star.png">
			</td>
			<td>Sample Park 2</td>
		</tr>
		<tr>
			<td>
				<img src="public/images/star.png">
				<img src="public/images/star.png">
				<img src="public/images/star.png">
			</td>
			<td>Sample Park 3</td>
		</tr>
		<tr></tr>

		<?php
			if ($results != 0) {
				foreach($results as $result) {
					echo "<tr><td>";
					for ($i = 0; $i < 2; $i++) {
						echo "<img src=\"public/images/star.png\">";
					}
					echo "</td><td><a href=\"park.php?itemId={$result['id']}\">{$result['name']}</a></td>";
				}
			} else {
				echo "<tr><td>No items matched your search.</td></tr>";
			}
		?>

	</table>
</p>

<?php require './includes/partials/footer.inc' ?>