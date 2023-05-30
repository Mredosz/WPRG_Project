<?php

class Addresses
{
    static final function addressesDisplay($usersID){
        $resultAddresses = Database::query("SELECT * FROM address WHERE usersID ='$usersID'");

        ?>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">City</th>
                <th scope="col">Zip Code</th>
                <th scope="col">Street</th>
                <th scope="col">Home Number</th>
                <th scope="col">Phone Number</th>
            </tr>
            </thead>
            <?php
            //            mysqli_fetch_array() - associative array
            while ($row = mysqli_fetch_array($resultAddresses)) {
                echo "<tbody>";
                echo "<tr>";
                echo("<td>$row[city]</td>");
                echo("<td>$row[zipCode]</td>");
                echo("<td>$row[street]</td>");
                echo("<td>$row[homeNumber]</td>");
                echo("<td>$row[phoneNumber]</td>");
//                    Link to a subpage for editing a given address
                echo("<td><a class='btn btn-outline-dark' href=\"addressesEdit.php?addressID=$row[addressID]\">Edit</a></td>");
//                    Link to a subpage for delete a given address
                echo("<td><a class='btn btn-outline-dark' href=\"addressesDelete.php?addressID=$row[addressID]\">Delete</a></td>");
                echo "</tr>";
                echo "</tbody>";
            }
            ?>
        </table>
        <?php
    }

   static final function addressesAdd($usersID){
        require_once "Database.php";

        if (isset($_POST['submit'])) {
//mysqli_real_escape_string() remove all special characters from string
            $city = Database::realString($_POST['city']);
            $zipCode = Database::realString($_POST['zipCode']);
            $street = Database::realString($_POST['street']);
            $homeNumber = Database::realString($_POST['homeNumber']);
            $phoneNumber = Database::realString($_POST['phoneNumber']);

            Database::query("INSERT INTO address(usersID, city, zipCode, street, homeNumber,phoneNumber) 
                            VALUES ('$usersID', '$city', '$zipCode', '$street', '$homeNumber', '$phoneNumber')");
            Database::disconnect();
//        Moves to the same page
            header("Location: addressesAdd.php");
        }
   }

   static final function addressesUpdate($row, $usersID){
       // trim remove all white space front and back of string
       if (isset($_POST['update'])) {
           Database::query("UPDATE address SET city = '$_POST[city]', zipCode = 
                    '$_POST[zipCode]', street = '$_POST[street]', homeNumber =
                     '$_POST[homeNumber]', phoneNumber = '$_POST[phoneNumber]' 
                     WHERE addressID = $_GET[addressID] AND usersID = $usersID");
           header("Location:addressesEdit.php?addressID=$row[addressID]");
           Database::disconnect();
       }
   }

}