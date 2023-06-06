<?php
ob_start();
session_start();
require_once "../../class/Database.php";
require_once "../../class/Menu.php";
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
            <?php
            $num = $_GET['itemID'];
            //Get information about item with this id
            $result = Database::query("SELECT item.name, price, c.name AS category, c.categoryID AS categoryID , 
            status, itemID FROM item JOIN category c on c.categoryID = item.categoryID WHERE itemID ='$num'");
            //            mysqli_fetch_array() - associative array
            $rowItem = mysqli_fetch_array($result);
            ?>
            <form method="post" action="" enctype="multipart/form-data">
                <label for="name"><b>Name</b></label>
                <input type="text" name="name" value="<?php echo "$rowItem[name]"; ?>" required>

                <label for="price"><b>Price</b></label>
                <input type="text" name="price" value="<?php echo "$rowItem[price]"; ?>" required>

                <label for="category"><b>Category</b></label>
                <select name="category">
                    <?php
                    //Show select with all cells from table
                    $resultCategory = Database::query("SELECT * FROM category");
                    while ($row = mysqli_fetch_array($resultCategory)) {
                        $id = $row['categoryID'];
                        $name = $row['name'];
                        if ($id != 1){
                            ?>
                            <option value="<?php echo $id; ?>"<?php if($id == $rowItem['categoryID'])
                            {echo"selected";} ?>><?php echo $name; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <label><b>Status on website</b></label><br>
                <input type="radio" class="btn-check" name="status" id="option1" value="1"
                    <?php if($rowItem['status'] == '1'){echo "checked";} ?>>
                <label class="btn btn-outline-dark btn1" for="option1">ON</label>

                <input type="radio" class="btn-check" name="status" id="option2" value="0"
                    <?php if($rowItem['status'] == '0'){echo "checked";} ?>>
                <label class="btn btn-outline-dark btn1" for="option2">OFF</label>

                <div class="clearfix">
                    <button type="submit" class="updatebtn" name="update">Update</button>
                </div>
            </form>
            <?php
            //                Update changes into database
            Menu::update($rowItem);
            ?>
        </div>
        <div class="col-8">
            <!--            Display information about all dish -->
                <?php
                Menu::display();
                ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>
