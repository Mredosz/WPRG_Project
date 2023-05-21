<?php
session_start();
include "../../main_website/php_file/config.php";
global $conn;

if (isset($_POST['submit'])) {
//mysqli_real_escape_string() remove all special characters from string
    // trim remove all white space front and back of string
//Add new item to base
    $name = trim(mysqli_real_escape_string($conn, $_POST['name']));
    $price = trim(mysqli_real_escape_string($conn, $_POST['price']));
    $category = trim(mysqli_real_escape_string($conn, $_POST['category']));
    $status = trim(mysqli_real_escape_string($conn, $_POST['status']));


    $insertCategory = "INSERT INTO item(name, price, categoryID, status)
    VALUES ('$name', '$price', '$category', '$status')";

    mysqli_query($conn, $insertCategory);
    mysqli_close($conn);
//        Moves to the same page
    header("Location: menu.php");
}
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
//Add navbar
require_once "navbar.php";
?>
<div class="container-fluid">
    <?php
    if (isset($error)) {
        foreach ($error as $item) {
            echo '<span class="error">' . $item . '</span>';
        }
    }
    ?>
    <div class="row row-cols-2">
        <div class="col-4 text-center">
            <h2>Add Item to Menu</h2>
        </div>
        <div class="col-8 text-center">
            <h2>Edit Item in Menu</h2>
        </div>
        <div class="col-4">
            <form method="post" action="" enctype="multipart/form-data">
                <label for="name"><b>Name</b></label>
                <input type="text" name="name" placeholder="Enter name of dish" required>

                <label for="price"><b>Price</b></label>
                <input type="text" name="price" placeholder="Enter price of dish" required>

                <label for="category"><b>Category</b></label>
                <select name="category">
                    <?php
                    //Show select with all cells from table
                    $queryCategory = "SELECT * FROM category";
                    $resultCategory = mysqli_query($conn, $queryCategory);
                    while ($row = mysqli_fetch_array($resultCategory)) {
                        $id = $row['categoryID'];
                        $name = $row['name'];
                        ?>
                        <option value="<?php echo $id; ?>"><?php echo $name; ?> </option>
                        <?php
                    }
                    ?>
                </select>

                <label><b>Status on website</b></label><br>
                <input type="radio" class="btn-check" name="status" id="option1" value="1" checked>
                <label class="btn btn-outline-dark btn1" for="option1">ON</label>

                <input type="radio" class="btn-check" name="status" id="option2" value="0">
                <label class="btn btn-outline-dark btn1" for="option2">OFF</label>

                <div class="clearfix">
                    <button type="reset" class="cancelbtn">Cancel</button>
                    <button type="submit" class="signupbtn" name="submit">Add Dish</button>
                </div>
            </form>
        </div>
        <div class="col-8">
            <!--            Display information about all dish -->
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <?php
                $selectItem = "SELECT item.name, price, c.name AS category , status, itemID FROM item 
                                JOIN category c on c.categoryID = item.categoryID";
                $resultItem = mysqli_query($conn, $selectItem);
                //            mysqli_fetch_array() - associative array
                while ($row = mysqli_fetch_array($resultItem)) {
                    echo "<tbody>";
                    echo "<tr>";
                    echo("<td>$row[name]</td>");
                    echo("<td>$row[price]</td>");
                    echo("<td>$row[category]</td>");
                    if ($row['status'] == 1) {
                        $status = 'Enable';
                    } else {
                        $status = 'Disable';
                    }
                    echo("<td>$status</td>");
//                Link to a subpage for editing a given address
                    echo("<td><a class='btn btn-outline-dark' href=\"menuEdit.php?itemID=$row[itemID]\">Edit</a></td>");
//                Link to a subpage for delete a given address
                    echo("<td><a class='btn btn-outline-dark' href=\"menuDelete.php?itemID=$row[itemID]\">Delete</a></td>");
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
