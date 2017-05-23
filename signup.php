<?php require './includes/partials/header.inc' ?>
<?php require "./includes/scripts/signup.inc"; ?>

<?php 
    if (isset($_POST['state'])) {
        $state = $_POST['state'];
    }
?>

<h2>Sign Up</h2>
<form action="signup.php" id="regform" method="POST">
    <div>
        <label id="fnamelabel" for="fname"><h4>First Name</h4></label>
        <label id="lnamelabel" for="lname"><h4>Last Name</h4></label>
        <input type="text" id="fname" name="firstname" placeholder="Your first name.." value="<?= $_POST['firstname'] ?? ''; ?>" onchange="hideError('nameerror')" required>
        <input type="text" id="lname" name="lastname" placeholder="Your last name.." value="<?= $_POST['lastname'] ?? ''; ?>" onchange="hideError('nameerror')" required><br
        /><br /><br />

        <div id="nameerror" class="error"></div>

        <label id="doblabel" for="dob"><h4>Date of Birth</h4></label>
        <label id="emaillabel" for="email"><h4>Email Address</h4></label>
        <input type="date" id="dateofbirth" name="dob" value="<?= $_POST['dob'] ?? ''; ?>" onchange="hideError('doberror')" required>
        <input type="email" id="emailad" name="email" placeholder="example123@sample.com" value="<?= $_POST['email'] ?? ''; ?>" required><br /><br />

        <div id="doberror" class="error"></div>
        <div id="emailerror" class="error"></div>

        <label id="addresslabel" for="address"><h4>Address</h4></label>
        <label id="statelabel" for="state"><h4>State</h4></label>
        <input id="addr" type="text" name="address" placeholder="e.g. 123 Streetroad Avenue" value="<?= $_POST['address'] ?? ''; ?>" onchange="hideError('addresserror')" required>
        <select id="ste" name="state" value="<?= $_POST['state']; ?>" onchange="hideError('stateerror')">
                    <option value="">Select state...</option>
                    <option value="qld" <?= (isset($state) && $state=="qld") ? "selected" : ''; ?>>QLD</option>
                    <option value="nsw" <?= (isset($state) && $state=="nsw") ? "selected" : ''; ?>>NSW</option>
                    <option value="act" <?= (isset($state) && $state=="act") ? "selected" : ''; ?>>ACT</option>
                    <option value="vic" <?= (isset($state) && $state=="vic") ? "selected" : ''; ?>>VIC</option>
                    <option value="tas" <?= (isset($state) && $state=="tas") ? "selected" : ''; ?>>TAS</option>
                    <option value="sa" <?= (isset($state) && $state=="sa") ? "selected" : ''; ?>>SA</option>
                    <option value="wa" <?= (isset($state) && $state=="wa") ? "selected" : ''; ?>>WA</option>
                    <option value="nt" <?= (isset($state) && $state=="nt") ? "selected" : ''; ?>>NT</option>
                </select><br /><br />

        <div id="addresserror" class="error"></div>
        <div id="stateerror" class="error"></div>

        <label id="postcodelabel" for="postcode"><h4>Postcode</h4></label>
        <label id="corlabel" for="cor"><h4>Email correspondence</h4></label>
        <input id="pc" name="postcode" type="text" placeholder="e.g. 4000" value="<?= $_POST['postcode'] ?? ''; ?>" onchange="hideError('postcodeerror')" required>
        <div id="corres">
            <input type="checkbox" name="cor" <?= isset($_POST['cor']) ? "checked" : ''; ?>>Tick to receive news and other correspondence by email</input>
        </div><br /><br />

        <div id="postcodeerror" class="error"></div>
        <div id="corerror" class="error"></div>

        <label id="pswdlabel" for="pwd"><h4>Password</h4></label>
        <label id="cpswdlabel" for="pwd"><h4>Confirm Password</h4></label>
        <input type="password" id="pswd" name="pwd" placeholder="Password..." value="<?= $_POST['pwd'] ?? ''; ?>" onchange="hideError('passworderror')" required>
        <input type="password" id="cpswd" name="cpwd" placeholder="Confirm Password..." value="<?= $_POST['cpwd'] ?? ''; ?>" onchange="hideError('passworderror')" required><br
        /><br />

        <div id="passworderror" class="error"></div>
    </div>

    <input type="submit" id="submitb" name="submit" value="Sign Up" onclick="hideError('signupfail')">
    <br />
    <div id="signupfail" class="error"></div>
</form>

<div id="googleMap1" hidden>
</div>
<div id="googleMap2" hidden>
</div>
<div id="googleMap3" hidden>
</div>

<?php require './includes/partials/footer.inc' ?>