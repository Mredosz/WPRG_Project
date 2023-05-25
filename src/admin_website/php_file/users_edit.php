<?php
require_once "../../class/Database.php";
require_once "../../class/Users.php";
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
            //            ID in users table
            $num = $_GET['usersID'];

            $result = Database::query("SELECT usersID, firstName, lastName, email,r.rolaID, password, r.name 
                        AS rola FROM users JOIN rola r on users.rolaID = r.rolaID WHERE usersID = '$num'");
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
                    $resultRola = Database::query("SELECT * FROM rola");
                    while ($row2 = mysqli_fetch_array($resultRola)) {
                        $id = $row2['rolaID'];
                        $rola = $row2['name'];
                        ?>
                        <option value="<?php echo $id; ?>"<?php if($id == $row['rolaID'])
                        {echo"selected";} ?>><?php echo $rola; ?></option>
                        <?php
                    }
                    ?>
                </select>

                <button type="submit" class="updatebtn" name="update">Update</button>
                <?php
                //                Update changes into database
                Users::update($row);
                ?>

            </form>
        </div>
        <div class="col-8">
            <!--            Display information about all users -->
                <?php
                    Users::display();
                ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>