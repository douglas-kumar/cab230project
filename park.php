﻿<?php require './includes/partials/header.inc' ?>
<?php require './includes/scripts/post.inc' ?>
<?php $_SESSION['itemId'] = $_GET['itemId']; ?>
<h2 id="parktitle"><?php echo "{$_GET['itemId']}"; ?></h2>
<form action="park.php" method="post">
<div id="parkrating">
    <img src="public/images/star.png">
    <img src="public/images/star.png">
    <img src="public/images/star.png">
    <img src="public/images/star.png">
</div>

<div id="otherinfo">
    <div>
        <h4>
            Reviews &nbsp
        </h4>

        <div class="review">
            <p>
			<!-- REMOVE - Sample review
                <img src="public/images/star.png">
                <img src="public/images/star.png">
                <img src="public/images/star.png">
                <img src="public/images/star.png">
                <img src="public/images/star.png"> &nbspDavid - <q>Great Park, prime spot for a barbecue or party
                        and the kids love it!</q>
						<br /><br /><br />
						-->
						<?php
						global $database;
						global $errors;
						$reviews = getReviews();
						
						echo "<p>";
						if ($reviews != null) {
							foreach ($reviews as $review) {
								if ($review['rating'] == 1) { ?>
									<img src="public/images/star.png">
								<?php } else if ($review['rating'] == 2) { ?>
									<img src="public/images/star.png">
									<img src="public/images/star.png">
								<?php } else if ($review['rating'] == 3) { ?>
									<img src="public/images/star.png">
									<img src="public/images/star.png">
									<img src="public/images/star.png">
								<?php } else if ($review['rating'] == 4) { ?>
									<img src="public/images/star.png">
									<img src="public/images/star.png">
									<img src="public/images/star.png">
									<img src="public/images/star.png">
								<?php } else { ?>
									<img src="public/images/star.png">
									<img src="public/images/star.png">
									<img src="public/images/star.png">
									<img src="public/images/star.png">
									<img src="public/images/star.png">
							    <?php	}
								echo "{$review['firstName']}" . " - " . "<q>{$review['text']}</q> " . "</p>";
							}
						} else {
							echo "<br />no reviews have been written";
						}
						?>
            </p>
            <p>
                <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) { ?>
                    <input id="writebutton" type="button" value="Write a review" onclick="openReview()">
                <?php } ?>
            </p>
			<!-- Post openReview() call -->
            <div id="reviewwrite">
            </div>
        </div>
    </div>

    <div>
        <h4>Map</h4>
        <p>
            <!--<div id="googleMap1" hidden>
                    </div>
                    <div id="googleMap2" hidden>
                    </div>
                    <div id="googleMap3">
                    </div>-->
            <iframe id="parkmap" src="https://www.google.com/maps/embed/v1/place?q=-27.3800614,153.0387005&amp;key=AIzaSyCem3N60YuFpGNNvVAtZ7Ha_TftWl6EdbE"></iframe>
        </p>
    </div>
</div>

</form>

<?php require './includes/partials/footer.inc' ?>