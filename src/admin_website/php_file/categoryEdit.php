<?php
session_start();
include "../../main_website/php_file/config.php";
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
            $num = $_GET['categoryID'];
            $selectCategory = "SELECT * FROM category WHERE categoryID ='$num'";

            $resultCategory = mysqli_query($conn, $selectCategory);
            //            mysqli_fetch_array() - associative array
            $rowCategory = mysqli_fetch_array($resultCategory);
            ?>
            <form method="post" action="" enctype="multipart/form-data">
                <label for="name"><b>Name</b></label>
                <input type="text" name="name" value="<?php echo "$rowCategory[name]"; ?>" required>

                <label for="currentImage"><b>Current Photo</b></label><br>
                <?php
                //If column imageName in data base is empty display information "Image not found" else show image
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
                    <input type="hidden" name="id" value="<?php echo $rowCategory['categoryID']; ?>">
                    <input type="hidden" name="currentImage" value="<?php echo $rowCategory['imageName']; ?>">

                    <button type="submit" class="updatebtn" name="update">Update</button>
                </div>
            </form>
            <?php
            if (isset($_POST['update'])) {
                //mysqli_real_escape_string() remove all special characters from string
                // trim remove all white space front and back of string
                //Add new item to base
                $name = trim(mysqli_real_escape_string($conn, $_POST['name']));
                $status = trim(mysqli_real_escape_string($conn, $_POST['status']));
                $currentImage = $rowCategory['imageName'];
                echo $currentImage;

                if (isset($_FILES['image']['name'])) {
                    $imageName = $_FILES['image']['name'];
                    if (!empty($imageName)) {
                        //extension upload file
                        $array = explode('.', $imageName);
                        $ext = end($array);

                        $imageName = trim(mysqli_real_escape_string($conn, "FOOD-NAME-" . rand(0, 9999) . "." . $ext));
                        $src = $_FILES['image']['tmp_name'];
                        $path = "../../../image/food/" . $imageName;

                        //move upload file to new location
                        $upload = move_uploaded_file($src, $path);

                        if (!$upload) {
                            $error[] = "Failed to upload file";
                            header("Location: category.php");
                            die();
                        }

                        if (!empty($currentImage)){
                            $removePath = "../../../image/food/" . $currentImage;
                            $remove = unlink($removePath);

                            if (!$remove){
                                $error[] = "Failed to upload file";
                                header("Location: category.php");
                                die();
                            }
                        }
                    }
                } else {
                    $imageName = $currentImage;
                }
                $updateCategory = "UPDATE category SET name = '$name', statusCategory = '$status',
                    imageName = '$imageName' WHERE categoryID = $rowCategory[categoryID]";

                mysqli_query($conn, $updateCategory);

                //refresh website
                header("Location: categoryEdit.php?categoryID=$rowCategory[categoryID]");
            }
            ?>
        </div>
        <div class="col-8">
            <!--            Display information about all category -->
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <?php
                //            mysqli_fetch_array() - associative array
                $selectCategory = "SELECT * FROM category";
                $resultCategory = mysqli_query($conn, $selectCategory);
                while ($row = mysqli_fetch_array($resultCategory)) {
                    echo "<tbody>";
                    echo "<tr>";
                    echo("<td>$row[name]</td>");
                    echo("<td><img src='../../../image/food/$row[imageName]' width='150px'></td>");
                    if ($row['statusCategory'] == 1) {
                        $status = 'Enable';
                    } else {
                        $status = 'Disable';
                    }
                    echo("<td>$status</td>");
//                Link to a subpage for editing a given category
                    echo("<td><a class='btn btn-outline-dark' href=\"categoryEdit.php?categoryID=$row[categoryID]\">Edit</a></td>");
//                Link to a subpage for delete a given category
                    echo("<td><a class='btn btn-outline-dark' href=\"categoryDelete.php?categoryID=$row[categoryID]\">Delete</a></td>");
                    echo "</tr>";
                    echo "</tbody>";
                }
                mysqli_close($conn);
                ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>