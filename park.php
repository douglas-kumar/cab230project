<?php require './includes/partials/header.inc'; ?>
<?php require './includes/scripts/post.inc'; ?>
<?php 
	global $database;
	global $errors;
	$_SESSION['itemId'] = $_GET['itemId'];
?>
<div itemscope itemtype="http://schema.org/Place">
<h2 id="parktitle"><?php 
// Retrieves park name and displays it to the page
$parkName = getPark($_SESSION['itemId']);
$parkNameTitle = ucwords(strtolower($parkName['name']), " \.(");
echo "<span itemprop=\"name\">{$parkNameTitle}</span>";
?>
</h2>


<div id="parkrating">
    <?php
        $numStars = getStarRating($parkName['id']);

        if ($numStars != 0) {
            for ($stars = 0; $stars < $numStars; $stars++) {
                echo "<img itemprop=\"image\" src=\"public/images/star.png\" alt=\"star.png\" />";
            }
        } else {
            echo "<i>No ratings</i>";
        }
    ?>
</div><br />

<div id="otherinfo">
                
    <div id="map" itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
        <h4>Map</h4>
		<?php 
		echo "<meta itemprop=\"latitude\" content=\"{$parkName['latitude']}\" /> ";
		echo "<meta itemprop=\"longitude\" content=\"{$parkName['longitude']}\" /> ";
		?>
            <iframe id="parkmap" src="https://www.google.com/maps/embed/v1/place?q=<?=$parkName['latitude']?>,<?=$parkName['longitude']?>&key=AIzaSyCem3N60YuFpGNNvVAtZ7Ha_TftWl6EdbE"></iframe>
   </div>
</div>              
</div> 

<div id="reviews" class="review" itemscope itemtype="http://schema.org/Review">
    <h4>
        Reviews
    </h4>
		<?php
			global $database;
			global $errors;
			$reviews = getReviews();
			
			if ($reviews != null) {
				// Cycles through each review and retrieves the description and rating value to microdata
				foreach ($reviews as $review) {
					echo "<div itemprop = \"itemReviewed\">";
				    for ($stars = 0; $stars < $review['rating']; $stars++) {
				        echo "<img itemprop=\"image\" src=\"public/images/star.png\" alt=\"star.png\">";
						echo "<div itemscope itemtype=\"http://schema.org/Rating\" itemprop=\"reviewRating\" hidden>";
						echo "<meta itemprop=\"worstRating\" content = \"1\">";
						echo "<meta itemprop=\"bestRating\" content = \"5\">";
						echo "<span itemprop=\"ratingValue\">{$review['rating']}</span>";
						echo "</div>";
				    }
					echo "&nbsp;<span itemprop=\"author\">{$review['firstName']}</span>" . " - " . "<q itemprop=\"reviewBody\">{$review['text']}</q> " . "<i><br/>Posted <span itemprop=\"dateCreated\">{$review['dateTime']}</span></i><br /><br />";
					echo "</div>";
				}
			} else {
				echo "<br />No reviews have been written";
			}
		?>
    <p>
        <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) { ?>
            <input id="writebutton" type="button" value="Write a review" onclick="openReview()">
        <?php } else { ?>
		<i><a href="http://fastapps04.qut.edu.au:8080/n9716751/cab230project-master/signup.php">Sign Up</a> or <a href="http://fastapps04.qut.edu.au:8080/n9716751/cab230project-master/login.php">Log In</a> to write a review</i>
        <?php } ?>
    </p>
    <form id="reviewwrite" action="park.php?itemId=<?php echo $_SESSION['itemId']; ?>" method="post">
    </form>
</div>

<?php require './includes/partials/footer.inc' ?>