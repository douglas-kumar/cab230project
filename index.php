<?php require './includes/partials/header.inc' ?>

<h2>Home</h2>
<p>
    This is our finsished product for Stage 2 of the project. Use the following links to navigate through the site, or alternatively,
    use the navigation menu above.
</p>
<p>
    <ul>
        <li><a href="search.php"><strong>Search</strong></a> - Search for parks around Brisbane</li><br />
        <li><a href="results.php"><strong>Park List</strong></a> - See a filtered list of parks
        </li><br />
        <li><a href="park.php"><strong>View Park</strong></a> - View a park
        </li><br />
        <li><a <?php if (!isset($_SESSION['loggedIn'])) { ?>href="signup.php"<?php } ?>><strong>Sign Up</strong></a> - Register yourself as a user of the site</li><br/>
        <li><a <?php if (!isset($_SESSION['loggedIn'])) { ?>href="login.php"<?php } ?>><strong>Log In</strong></a> - Log in to the site</li>
    </ul>
</p>
<div id="googleMap1" hidden>
</div>
<div id="googleMap2" hidden>
</div>
<div id="googleMap3" hidden>
</div>

<?php require './includes/partials/footer.inc' ?>