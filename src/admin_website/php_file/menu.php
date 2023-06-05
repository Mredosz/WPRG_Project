<?php
session_start();
require_once "../../class/Database.php";
require_once "../../class/Menu.php";

if (isset($_POST['submit'])) {
//mysqli_real_escape_string() remove all special characters from string
    // trim remove all white space front and back of string
//Add new item to base
    $name = Database::realString($_POST['name']);
    $price = Database::realString($_POST['price']);
    $category = Database::realString($_POST['category']);
    $status = Database::realString($_POST['status']);

    Database::query("INSERT INTO item(name, price, categoryID, status)
    VALUES ('$name', '$price', '$category', '$status')");
    Database::disconnect();
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
                    $resultCategory = Database::query("SELECT * FROM category");
                    //Show select with all cells from table
                    while ($row = mysqli_fetch_array($resultCategory)) {
                        $id = $row['categoryID'];
                        $name = $row['name'];
                        if ($id == 1){
                        }else{
                        ?>
                    <option value="<?php echo $id; ?>"><?php echo $name; ?> </option>
                        <?php
                        }
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
            <?php
            Menu::display();
            ?>
        </div>
    </div>
</div>
</body>
</html>
