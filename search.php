﻿<!DOCTYPE html>
<html>

<head>
    <title>Search</title>
    <?php include 'headers.php' ?>
</head>

<body>
    <header>
        <?php include 'navigation.php' ?>
        <h2>Search</h2>
    </header>
    <main>
        <div id="wholeSearchField">
            <!-- div to wrap the whole search field -->
			
			<form method="GET" action="sample_results" > <!-- Need to fix (links to sample_results page) -->
			
            <h3>Search by:</h3>
            <h4>Name</h4>
            <div class="searchitem">
                <input type="text" id="searchtext" name="searchname" oninput="EnableSearchBtn()" placeholder="Search by name..." />
            </div>
            <h4>Suburb</h4>
            <div class="searchitem">
                <select name="suburb" onchange="EnableSearchBtn()">
                <option value="">Select suburb...</option>
                <option value="sub1">Suburb 1</option>
                <option value="sub2">Suburb 2</option>
            </select>
            </div>
            <h4>Minimum rating</h4>
            <div class="searchitem" onchange="EnableSearchBtn()">
                <div>
                    <input type="radio" name="rating" value="5" />
                    <img src="images/star.png" />
                    <img src="images/star.png" />
                    <img src="images/star.png" />
                    <img src="images/star.png" />
                    <img src="images/star.png" /><br />
                    <input type="radio" name="rating" value="4" />
                    <img src="images/star.png" />
                    <img src="images/star.png" />
                    <img src="images/star.png" />
                    <img src="images/star.png" /><br />
                    <input type="radio" name="rating" value="3" />
                    <img src="images/star.png" />
                    <img src="images/star.png" />
                    <img src="images/star.png" /><br />
                    <input type="radio" name="rating" value="2" />
                    <img src="images/star.png" />
                    <img src="images/star.png" /><br />
                    <input type="radio" name="rating" value="1" />
                    <img src="images/star.png" /><br />
                </div>
            </div>
            <h4>Location</h4>
			<!-- CALUM: I need to fix the google maps to be real-time and add pins of map location -->
            <div class="searchitem" onclick="getLocation()">
                <input id="location" type="button" onclick="window.location.href='sample_results.html'; alert('Searching for parks close by...')" value="Search for parks near you" /> <!--alert('Searching for parks close by...')"-->

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
            <input id="searchBtn" type="button" value="Search" disabled onclick="window.location.href='sample_results.html'"/>
			
				</form>
			
        </div>
        <!-- end of whole search field div -->
    </main>

    <?php include 'footer.php' ?>
</body>

</html>