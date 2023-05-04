<?php
include "addressesConnect.php";
?>

<form method="post" action="">
    <label for="city"><b>City</b></label>
    <input type="text" name="city" placeholder="Enter your City">

    <label for="zipCode"><b>Zip Code</b></label>
    <input type="text" name="zipCode" placeholder="Enter your zip code">

    <label for="street"><b>Street</b></label>
    <input type="text" name="street" placeholder="Enter your street">

    <label for="homeNumber"><b>Home Number</b></label>
    <input type="text" name="homeNumber" placeholder="Enter your home number">

    <label for="homeNumber"><b>Phone Number</b></label>
    <input type="tel" name="phoneNumber" placeholder="Enter your phone number">

    <div class="clearfix">
        <button type="reset" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn" name="submit">Add Addresses</button>
    </div>
</form>
