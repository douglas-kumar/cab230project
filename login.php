<?php require './includes/partials/header.inc' ?>
<?php require "./includes/scripts/login.inc" ?>

<h2>Log In</h2>

<form action="login.php" id="loginform" method="POST">
	<div id="logindiv">
		<label id="fnamelabel">Email</label>
		<label id="cpswdlabel">Password</label>
		<input type="email" id="fname" name="email" value="<?= $_POST['email'] ?? ''; ?>" placeholder="123@example.com" onchange="hideError('addresserror')" required>
		<input type="password" id="cpswd" name="pwd" placeholder="Password" onchange="hideError('passworderror')" required>
		<br/><br/>
		<input type="submit" id="submitb" name="submit" value="Log In" onclick="hideError('signupfail')">
	</div>
	<div id="loginfail" class="error"></div>
</form>

<?php require './includes/partials/footer.inc' ?>