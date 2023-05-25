<?php

class Users
{
    static final function display(){
    require_once "Database.php";
?>
        <table class="table">
                <thead>
                <tr>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Password</th>
                    <th scope="col">Rola</th>
                </tr>
                </thead>
                <?php
                $resultUsers = Database::query("SELECT usersID, firstName, lastName, email, password,
                                            r.name AS rola FROM users JOIN rola r on users.rolaID = r.rolaID");
                //            mysqli_fetch_array() - associative array
                while ($row = mysqli_fetch_array($resultUsers)) {
                    echo "<tbody>";
                    echo "<tr>";
                    echo("<td>$row[firstName]</td>");
                    echo("<td>$row[lastName]</td>");
                    echo("<td>$row[email]</td>");
                    echo("<td>$row[password]</td>");
                    echo("<td>$row[rola]</td>");
//                Link to a subpage for editing  users
                    echo("<td><a class='btn btn-outline-dark' href=\"users_edit.php?usersID=$row[usersID]\">Edit</a></td>");
//                Link to a subpage for delete users
                    echo("<td><a class='btn btn-outline-dark' href=\"users_delete.php?usersID=$row[usersID]\">Delete</a></td>");
                    echo "</tr>";
                    echo "</tbody>";
                }
                ?>
            </table>
<?php
    }
    static final function update($row){
        if (isset($_POST['update'])) {
            $firstName = Database::realString($_POST['firstName']);
            $lastName = Database::realString($_POST['lastName']);
            $email = Database::realString($_POST['email']);
            //if we don't change password
            if (!empty($_POST['password'])) {
                $password = trim(md5($_POST['password']));
                Database::query("UPDATE users SET firstName = '$firstName', lastName = '$lastName', 
                                        email = '$email', password = '$password',rolaID = '$_POST[rola]'
                                        WHERE usersID = $row[usersID]");
            } else {
                // if we want to change password
                Database::query("UPDATE users SET firstName = '$firstName', lastName = '$lastName', 
                            email = '$email',rolaID = '$_POST[rola]' WHERE usersID = $row[usersID]");
            }
            //refresh website
            header("Location: users_edit.php?usersID=$row[usersID]");
            Database::disconnect();
        }
    }

}