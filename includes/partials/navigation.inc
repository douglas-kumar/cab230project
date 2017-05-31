<?php
    // Display the name of the user logged in
    if (isset($_SESSION['loggedIn']) && ($_SESSION['loggedIn'] == true)) {
        $name = getUserFirstName($_SESSION['user']);
        echo "<div id=\"userName\">Hi, {$name['firstName']}</div>";
    }
?>

<h1>BRISBANE PARKS</h1>
<nav>
    <div id="pages">
        <a href="./index.php">Home</a>
        <a href="./search.php">Search</a>
    </div>
    <div id="userControl">
        <?php if (!isset($_SESSION['loggedIn'])) { ?>
            <a href="./signup.php">Sign Up</a>
            <a href="./login.php">Log In</a>
        <?php } else { ?>
            <a href="./logout.php">Log Out</a>
        <?php } ?>
    </div>
</nav>