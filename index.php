<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <meta charset="utf-8" />
    <?php include 'headers.php' ?>
</head>

<body>
    <header>
        <?php include 'navigation.php' ?>
        <h2>Home</h2>
    </header>

    <main>
        <p>
            This is our finsished product for Stage 1 of the project. Use the following links to navigate through the site, or alternatively,
            use the navigation menu above.
        </p>
        <p>
            <ul>
                <li><a href="search.html"><strong>Search</strong></a> - Search for parks around Brisbane</li><br />
                <li><a href="sample_results.html"><strong>Sample Results</strong></a> - View the results of your search criteria
                    (sample)</li><br />
                <li><a href="sample_individual_item.html"><strong>Sample Item</strong></a> - View one of the parks around Brisbane
                    (sample)</li><br />
                <li><a href="registration.html"><strong>Sign Up</strong></a> - Register yourself as a user of the site</li><br
                />
            </ul>
        </p>
		    <div id="googleMap1" hidden>
			  </div>
			   <div id="googleMap2" hidden>
			  </div>
			   <div id="googleMap3" hidden>
			  </div>
    </main>

    <?php include 'footer.php' ?>
</body>

</html>