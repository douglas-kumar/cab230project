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
        <label id="fnamelabel">First Name</label>
        <label id="lnamelabel">Last Name</label>
        <input type="text" id="fname" name="firstname" placeholder="Your first name.." value="<?= $_POST['firstname'] ?? ''; ?>" onchange="hideError('nameerror')" required>
        <input type="text" id="lname" name="lastname" placeholder="Your last name.." value="<?= $_POST['lastname'] ?? ''; ?>" onchange="hideError('nameerror')" required><br
        /><br /><br />

        <div id="nameerror" class="error"></div>

        <label id="doblabel">Date of Birth</label>
        <label id="emaillabel">Email Address</label>
        <input type="date" id="dateofbirth" name="dob" min="1900-01-01" max="<?php echo date('Y-m-d'); ?>" value="<?= $_POST['dob'] ?? ''; ?>" onchange="hideError('doberror')" required>
        <input type="email" id="emailad" name="email" placeholder="example123@sample.com" value="<?= $_POST['email'] ?? ''; ?>" required><br /><br />

        <div id="doberror" class="error"></div>
        <div id="emailerror" class="error"></div>

        <label id="addresslabel">Address</label>
        <label id="statelabel">State</label>
        <input id="addr" type="text" name="address" placeholder="e.g. 123 Streetroad Avenue" value="<?= $_POST['address'] ?? ''; ?>" onchange="hideError('addresserror')" required>
        <select id="ste" name="state" onchange="hideError('stateerror')" required>
                    <option value="" disabled selected>Select state...</option>
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

        <label id="postcodelabel">Postcode</label>
        <label id="corlabel">Email correspondence</label>
        <input id="pc" name="postcode" type="text" placeholder="e.g. 4000" value="<?= $_POST['postcode'] ?? ''; ?>" onchange="hideError('postcodeerror')" required>
        <div id="corres">
            <input type="checkbox" name="cor" <?= isset($_POST['cor']) ? "checked" : ''; ?>/>Tick to receive news and other correspondence by email
        </div><br /><br />

        <div id="postcodeerror" class="error"></div>
        <div id="corerror" class="error"></div>

        <label id="pswdlabel">Password</label>
        <label id="cpswdlabel">Confirm Password</label>
        <input type="password" id="pswd" name="pwd" placeholder="Password..." value="<?= $_POST['pwd'] ?? ''; ?>" onchange="hideError('passworderror')" required>
        <input type="password" id="cpswd" name="cpwd" placeholder="Confirm Password..." value="<?= $_POST['cpwd'] ?? ''; ?>" onchange="hideError('passworderror')" required><br/><br/>

        <div id="passworderror" class="error"></div>
    </div>

    <input type="submit" id="submitb" name="submit" value="Sign Up" onclick="hideError('signupfail')">
    <br />
    <div id="signupfail" class="error"></div>
</form>

<?php require './includes/partials/footer.inc' ?>