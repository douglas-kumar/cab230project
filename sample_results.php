﻿<?php require './includes/partials/header.php' ?>

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
			<th>Features</th>
		</tr>
		<tr>
			<td>
				<img src="images/star.png">
				<img src="images/star.png">
				<img src="images/star.png">
				<img src="images/star.png">
			</td>
			<td><a href="sample_individual_item.php">7th Brigade Park</a></td>
			<td>Lucious park in a small space</td>
		</tr>
		<tr>
			<td>
				<img src="images/star.png">
				<img src="images/star.png">
			</td>
			<td>Sample Park 2</td>
			<td>Small park containing a playground, perfect for kids!</td>
		</tr>
		<tr>
			<td>
				<img src="images/star.png">
				<img src="images/star.png">
				<img src="images/star.png">
			</td>
			<td>Sample Park 3</td>
			<td>Park with a beautiful stream next to it, perfect for swimming!</td>
		</tr>

	</table>
</p>

<?php require './includes/partials/footer.php' ?>