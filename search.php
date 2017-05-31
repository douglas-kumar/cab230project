<?php require './includes/partials/header.inc' ?>

<h2>Search</h2>
<div id="wholeSearchField">

    <form id="searchForm" name="search" method="POST" action="results.php">
	
        <h4>Name</h4>
        <div class="searchitem">
            <input type="text" id="searchtext" name="name" placeholder="Search by name..." />
        </div>
		
        <h4>Suburb</h4>
        <div class="searchitem">
            <select name="suburb">
                <option value="" selected>Select suburb...</option>
				<?php
				global $errors;
				global $database;
				
				// Retrieves suburbs without duplicates and prepares query for injections
				$query = "SELECT DISTINCT suburb FROM items ORDER BY suburb";
				$stmt = $database->prepare($query);
				$stmt->execute();
				
				$suburbs = $stmt->fetchAll();
				
				// Cycles through each suburb and displays it as drop down options
				foreach ($suburbs as $suburbName) {
					echo "<option value=\"{$suburbName['suburb']}\">{$suburbName['suburb']}</option>";
				}
				?>
            </select>
        </div>
        <h4>Minimum rating</h4>
        <div class="searchitem">
            <div>
                <input type="radio" name="rating" value="5" />
                <img src="public/images/star.png" alt="star.png" />
                <img src="public/images/star.png" alt="star.png" />
                <img src="public/images/star.png" alt="star.png" />
                <img src="public/images/star.png" alt="star.png" />
                <img src="public/images/star.png" alt="star.png" /><br />
                <input type="radio" name="rating" value="4" />
                <img src="public/images/star.png" alt="star.png" />
                <img src="public/images/star.png" alt="star.png" />
                <img src="public/images/star.png" alt="star.png" />
                <img src="public/images/star.png" alt="star.png" /><br />
                <input type="radio" name="rating" value="3" />
                <img src="public/images/star.png" alt="star.png" />
                <img src="public/images/star.png" alt="star.png" />
                <img src="public/images/star.png" alt="star.png" /><br />
                <input type="radio" name="rating" value="2" />
                <img src="public/images/star.png" alt="star.png" />
                <img src="public/images/star.png" alt="star.png" /><br />
                <input type="radio" name="rating" value="1" />
                <img src="public/images/star.png" alt="star.png" /><br />
                <input type="radio" name="rating" value="" checked/><i>No rating</i>
            </div>
        </div>
        <h4>Location</h4>
        <div class="searchitem">
            <button id="location" type="button" onclick="getLocation();">Search for parks near you</button>

            <p id="status">Click the button to get your location.</p>
        </div>
        <input id="lat" type="text" name="lat" hidden />
        <input id="long" type="text" name="long" hidden />
        <input id="searchBtn" name="btnSubmit" type="submit" value="Search" />

    </form>

</div>

<?php require './includes/partials/footer.inc' ?>