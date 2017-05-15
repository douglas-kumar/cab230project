<!DOCTYPE html>
<html>

<head>
    <title>Sample Individual Item Page</title>
    <?php include 'headers.php' ?>
</head>

<body>
    <header>
        <?php include 'navigation.php' ?>
        <h2>7TH BRIGADE PARK</h2>
    </header>

    <main>
        <h3 id="parktitle">7TH BRIGADE PARK</h3>
        <div id="parkrating">
            <img src="images/star.png">
            <img src="images/star.png">
            <img src="images/star.png">
            <img src="images/star.png">
        </div>

        <div class="parkcont">
            <img class="parkimg" src="images/random_park.jpg"></img>
            <div id="parkimgdesc">
                This is the 7th Brigade Park. It is a nice park with wide open spaces amongst other things. It has lot&#39s of green grass
                and many trees which provide shade to park visitors on sunny days. I could go on for ages about this park,
                but I shall refrain and get back to html. This is the 7th Brigade Park. It is a nice park with wide open
                spaces amongst other things. It has lot&#39s of green grass and many trees which provide shade to park visitors
                on sunny days. I could go on for ages about this park, but I shall refrain and get back to html. This is
                the 7th Brigade Park. It is a nice park with wide open spaces amongst other things. It has lot&#39s of green
                grass and many trees which provide shade to park visitors on sunny days. I could go on for ages about this
                park, but I shall refrain and get back to html. This is the 7th Brigade Park. It is a nice park with wide
                open spaces amongst other things. It has lot&#39s of green grass and many trees which provide shade to park
                visitors on sunny days. I could go on for ages about this park, but I shall refrain and get back to html.
            </div>
        </div>
        <br />
        <div id="otherinfo">
            <div>
                <h4>
                    Reviews &nbsp
                </h4>

                <div class="review">
                    <p>
                        <img src="images/star.png">
                        <img src="images/star.png">
                        <img src="images/star.png"> &nbspKatherine - <q>I love coming here every Sunday morning, 
                        beautiful park with plenty of shade and facilities.</q>
                    </p>
                    <p>
                        <img src="images/star.png">
                        <img src="images/star.png">
                        <img src="images/star.png">
                        <img src="images/star.png">
                        <img src="images/star.png"> &nbspDavid - <q>Great Park, prime spot for a barbecue or party
                        and the kids love it!</q>
                    </p>
                    <p>
                        <input id="writebutton" type="button" value="Write a review" onclick="openReview()">
                    </p>

                    <div id="reviewwrite">
                    </div>
                </div>
            </div>
            <div>
                <h4>Events</h4>

                <p>
                    An event...<br /> An event...<br /> An event...<br /> An event...<br />
                </p>
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
    </main>

    <?php include 'footer.php' ?>
</body>

</html>