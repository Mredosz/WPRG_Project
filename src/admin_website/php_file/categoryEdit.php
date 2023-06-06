<?php
session_start();
require_once "../../class/Category.php";
require_once "../../class/Database.php";
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
<div class="container-fluid">
    <?php
    //Display error
    if (isset($error)) {
        foreach ($error as $item) {
            echo '<span class="error">' . $item . '</span>';
        }
    }
    ?>
    <div class="row row-cols-2">
        <div class="col-4 text-center">
            <h2>Add Category to Menu</h2>
        </div>
        <div class="col-8 text-center">
            <h2>Edit Category in Menu</h2>
        </div>
        <div class="col-4">
            <?php
            //Get id from link
            $num = $_GET['categoryID'];
            $rowCategory = mysqli_fetch_array(Database::query("SELECT * FROM category WHERE categoryID ='$num'"));
            ?>
            <form method="post" action="" enctype="multipart/form-data">
                <label for="name"><b>Name</b></label>
                <input type="text" name="name" value="<?php echo "$rowCategory[name]"; ?>" required>

                <label for="currentImage"><b>Current Photo</b></label><br>
                <?php
                //If column imageName in database is empty display information "Image not found" else show image
                if (empty($rowCategory['imageName'])){
                    echo "Image not found<br><br>";
                }else{
                echo "<img src='../../../image/food/$rowCategory[imageName]' width='150px'><br>";
                }
                ?>
                <label for="image"><b>Photo</b></label>
                <input name="image" type="file">

                <label><b>Status on website</b></label><br>
                <input type="radio" class="btn-check" name="status" id="option1" value="1"
                    <?php if ($rowCategory['statusCategory'] == '1'){echo "checked";} ?>>
                <label class="btn btn-outline-dark btn1" for="option1">ON</label>

                <input type="radio" class="btn-check" name="status" id="option2" value="0"
                    <?php if ($rowCategory['statusCategory'] == '0'){echo "checked";} ?>>
                <label class="btn btn-outline-dark btn1" for="option2">OFF</label>

                <div class="clearfix">

                    <button type="submit" class="updatebtn" name="update">Update</button>
                </div>
            </form>
            <?php
            if (isset($_POST['update'])) {
                // Send update information to database
                Category::categoryUpdate($rowCategory);
                //refresh website
                header("Location: categoryEdit.php?categoryID=$rowCategory[categoryID]");
            }
            ?>
        </div>
        <div class="col-8">
            <!--            Display information about all category -->
            <?php
                Category::categoryDisplay();
            ?>
        </div>
    </div>
</div>
</body>
</html>