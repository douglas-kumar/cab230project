<h1>BRISBANE PARKS</h1>
<nav>
    <a href="./index.php">Home</a>
    <a href="./search.php">Search</a>
    <a href="./results.php">Park List</a>
    <a href="./park.php">View Park</a>
	
    <?php if (!isset($_SESSION['loggedIn'])) { ?>
        <a href="./signup.php">Sign Up</a>
        <a href="./login.php">Log In</a>
    <?php } else { ?>
        <a href="./logout.php">Log Out</a>
    <?php } ?>
</nav>