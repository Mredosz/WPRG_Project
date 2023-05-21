<?php
include "../../../src/main_website/php_file/config.php";
global $conn;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--    Website Title-->
    <title>Admin Website</title>
    <?php
    include "../html_file/links.html";
    ?>
</head>
<body>
<?php
require_once "navbar.php";
?>
<div class="container-fluid color">
    <!--    Display errors-->
    <?php
    if (isset($error)) {
        foreach ($error as $item) {
            echo '<span class="error">' . $item . '</span>';
        }
    }
    ?>
    <div class="row">
        <div class="text-center">
            <h1 class="h1">Edit & Delete Users</h1>
        </div>
    </div>
    <div class="row row-cols-2">
        <div class="col-4">
            <?php
            global $conn;
            if ($conn === false) {
                $error[] = ("ERROR " . mysqli_connect_error());
            }
            //            ID in users table
            $num = $_GET['usersID'];
            $query = "SELECT usersID, firstName, lastName, email, password, r.name AS rola FROM users 
            JOIN rola r on users.rolaID = r.rolaID WHERE usersID = '$num'";

            $result = mysqli_query($conn, $query);
            //            mysqli_fetch_array() - associative array
            $row = mysqli_fetch_array($result);
            ?>
            <!--   echo "$row[...]" ---   Display information about this address and give user possibility to edit-->
            <form action="" method="post">
                <label for="firstName"><b>First Name</b></label>
                <input type="text" name="firstName" value="<?php echo "$row[firstName]"; ?>">

                <label for="lastName"><b>Last Name</b></label>
                <input type="text" name="lastName" value="<?php echo "$row[lastName]"; ?>">

                <label for="email"><b>E-mail</b></label>
                <input type="text" name="email" value="<?php echo "$row[email]"; ?>">

                <label for="password"><b>Password</b></label>
                <input type="text" name="password">

                <label for="rola"><b>Rola</b></label>
                <select name="rola">
                    <?php
                    //Show select with all cells from table
                    $queryRola = "SELECT * FROM rola";
                    $resultRola = mysqli_query($conn, $queryRola);
                    while ($row2 = mysqli_fetch_array($resultRola)) {
                        $id = $row2['rolaID'];
                        $rola = $row2['name'];
                        ?>
                        <option value="<?php echo $id; ?>"><?php echo $rola; ?> </option>
                        <?php
                    }
                    ?>
                </select>

                <button type="submit" class="updatebtn" name="update">Update</button>
                <?php
                //                Update changes into database
                // trim remove all white space front and back of string

                if (isset($_POST['update'])) {
                    $firstName = trim(mysqli_escape_string($conn, $_POST['firstName']));
                    $lastName = trim(mysqli_escape_string($conn, $_POST['lastName']));
                    $email = trim(mysqli_escape_string($conn, $_POST['email']));
                    //if we don't change password
                    if (!empty($_POST['password'])) {
                        $password = trim(md5($_POST['password']));
                        $sql = "UPDATE users SET firstName = ' " . $firstName . " ', lastName = ' " . $lastName . " ', 
                    email = ' " . $email . " ', password = ' " . $password . " ', 
                rolaID = ' " . $_POST['rola'] . "' WHERE usersID = $row[usersID]";
                    } else {
                        // if we want to change password
                        $sql = "UPDATE users SET firstName = ' " . $firstName . " ', lastName = ' " . $lastName . " ', 
                    email = ' " . $email . " ', rolaID = ' " . $_POST['rola'] . "' WHERE usersID = $row[usersID]";
                    }
                    mysqli_query($conn, $sql);
                    //refresh website
                    header("Location: users_edit.php?usersID=$row[usersID]");
                    mysqli_close($conn);
                }
                ?>

            </form>
        </div>
        <div class="col-8">
            <!--            Display information about all users -->
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
                $selectUsers = "SELECT usersID, firstName, lastName, email, password, r.name AS rola FROM users JOIN rola r on users.rolaID = r.rolaID";
                $resultUsers = mysqli_query($conn, $selectUsers);
                //            mysqli_fetch_array() - associative array
                while ($row = mysqli_fetch_array($resultUsers)) {
                    echo "<tbody>";
                    echo "<tr>";
                    echo("<td>$row[firstName]</td>");
                    echo("<td>$row[lastName]</td>");
                    echo("<td>$row[email]</td>");
                    echo("<td>$row[password]</td>");
                    echo("<td>$row[rola]</td>");
//                Link to a subpage for editing a given address
                    echo("<td><a class='btn btn-outline-dark' href=\"users_edit.php?usersID=$row[usersID]\">Edit</a></td>");
//                Link to a subpage for delete a given address
                    echo("<td><a class='btn btn-outline-dark' href=\"users_delete.php?usersID=$row[usersID]\">Delete</a></td>");
                    echo "</tr>";
                    echo "</tbody>";
                }
                ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>