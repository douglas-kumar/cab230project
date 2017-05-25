<?php require './includes/partials/header.inc' ?>
<?php require "./includes/scripts/login.inc"; ?>

<h2>Log In</h2>

<!-- Need to make it so it checks with SQL Database entries and validates if the input matches the entry in databse -->
<form action="login.php" id="loginform" method="POST">
	<div id="logindiv">
		<label id="fnamelabel" for="email"><h4>Email</h4></label>
		<label id="cpswdlabel" for="password"><h4>Password</h4></label>
		<input type="email" id="fname" name="email" placeholder="123@example.com" onchange="hideError('addresserror')" required>
		<input type="password" id="cpswd" name="pwd" placeholder="Password" onchange="hideError('passworderror')" required>
		<br/><br/>
		<input type="submit" id="submitb" name="submit" value="Log In" onclick="hideError('signupfail')">
	</div>
	<div id="loginfail" class="error"></div>
</form>

<?php require './includes/partials/footer.inc' ?>