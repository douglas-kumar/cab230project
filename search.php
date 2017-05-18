<?php require './includes/partials/header.inc' ?>
<?php require './includes/scripts/search.inc' ?>

<h2>Search</h2>
<div id="wholeSearchField">
    <!-- div to wrap the whole search field -->

    <form method="get" action="results.php">
        <!-- Need to fix (links to sample_results page) -->
	
        <h4>Name</h4>
		<!--need to insert proper thing - just code
				-->
        <div class="searchitem">
            <input type="text" id="searchtext" name="name" placeholder="Search by name..." />
				<?php
				global $errors;
				global $database;
				
				$query = "SELECT DISTINCT name FROM items ORDER BY name";
				$stmt = $database->prepare($query);
				$stmt->execute();
				
				$names = $stmt->fetchAll();
				
				foreach ($names as $parkName) {
					
					echo "<li hidden><a href='results.php'>{$parkName['name']}<br /></a></li>"; // --> remove hidden tag when ready <--
				}
				?>
        </div>
		
        <h4>Suburb</h4>
        <div class="searchitem">
            <select name="suburb">
                <option value="" disabled selected>Select suburb...</option>
				<?php
				global $errors;
				global $database;
				
				$query = "SELECT DISTINCT suburb FROM items ORDER BY suburb";
				$stmt = $database->prepare($query);
				$stmt->execute();
				
				$suburbs = $stmt->fetchAll();
				
				foreach ($suburbs as $suburbName) {
					echo "<option value={$suburbName['suburb']}>{$suburbName['suburb']}</option>";
				}
				?>
            </select>
        </div>
        <h4>Minimum rating</h4>
        <div class="searchitem">
            <div>
                <input type="radio" name="rating" value="5" />
                <img src="public/images/star.png" />
                <img src="public/images/star.png" />
                <img src="public/images/star.png" />
                <img src="public/images/star.png" />
                <img src="public/images/star.png" /><br />
                <input type="radio" name="rating" value="4" />
                <img src="public/images/star.png" />
                <img src="public/images/star.png" />
                <img src="public/images/star.png" />
                <img src="public/images/star.png" /><br />
                <input type="radio" name="rating" value="3" />
                <img src="public/images/star.png" />
                <img src="public/images/star.png" />
                <img src="public/images/star.png" /><br />
                <input type="radio" name="rating" value="2" />
                <img src="public/images/star.png" />
                <img src="public/images/star.png" /><br />
                <input type="radio" name="rating" value="1" />
                <img src="public/images/star.png" /><br />
            </div>
        </div>
        <h4>Location</h4>
        <!-- CALUM: I need to fix the google maps to be real-time and add pins of map location -->
        <div class="searchitem" onclick="getLocation()">
            <input id="location" type="button" onclick="window.location.href='results.php'; alert('Searching for parks close by...')"
                value="Search for parks near you" />
            <!--alert('Searching for parks close by...')"-->

            <div id="googleMap1" hidden>
            </div>
            <div id="googleMap2" hidden>
            </div>
            <div id="googleMap3" hidden>
            </div>
            <br>

            <p id="status">Click the button to get your coordinates.</p>
        </div>
        <!-- CALUM: ^^^ -->
        <input id="searchBtn" name="submit" type="submit" value="Search" />

    </form>

</div>
<!-- end of whole search field div -->

<?php require './includes/partials/footer.inc' ?>