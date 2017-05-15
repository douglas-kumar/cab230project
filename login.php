<!DOCTYPE html>
<html>

<head>
    <title>Log In</title>
    <?php include 'headers.php' ?>
</head>

<body>
    <header>
        <?php include 'navigation.php' ?>
        <h2>Log In</h2>
    </header>
	
    <main>
	<!-- Need to make it so it checks with SQL Database entries and validates if the input matches the entry in databse -->
		<form action="__login.php" id="loginform" method="POST" onsubmit="return ValidLogin(this)">
			<div id="logindiv">
                <label id="addresslabel" for="email"><h4>Email</h4></label>
				<input type="email" id="emailad" name="email" placeholder="email account" onchange="hideError('addresserror')" required>
                <label id="pswdlabel" for="pwd"><h4>Password</h4></label>
                <input type="password" id="pswd" name="pwd" placeholder="password" onchange="hideError('passworderror')" required>
				<br/><br/>
				 <input type="submit" id="submitb" value="Log In" onclick="hideError('signupfail')">
			</div>
			<div id="loginfail" class="error"></div>
		</form>
    </main>

    <?php include 'footer.php' ?>
</body>

</html>