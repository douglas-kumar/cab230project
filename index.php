<?php
require './includes/partials/header.inc' ?>

<h2>Home</h2>
<p>
    Welcome to Brisbane Parks! Find parks around Brisbane and see what people think of them. If you've visited a few already, log in or sign up to leave reviews.
</p>
<p>
    This is our finsished product for Stage 2 of the project. Use the following links to navigate through the site, or alternatively,
    use the navigation menu above.
</p>
    <ul>
        <li><a href="search.php"><strong>Search</strong></a> - Search for parks around Brisbane</li>
        <li><a <?php

if (!isset($_SESSION['loggedIn'])) { ?>href="signup.php"<?php
} ?>><strong>Sign Up</strong></a> - Register yourself as a user of the site</li>
        <li><a <?php

if (!isset($_SESSION['loggedIn'])) { ?>href="login.php"<?php
} ?>><strong>Log In</strong></a> - Log in to the site</li>
    </ul>
<?php
require './includes/partials/footer.inc' ?>
