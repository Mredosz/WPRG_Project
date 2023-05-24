<?php
session_start();
require_once "../../class/Database.php";
require_once "../../class/Category.php";

if (isset($_POST['submit'])) {
Category::categoryAdd();
//        Moves to the same page
    header("Location: category.php");
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
            <form method="post" action="" enctype="multipart/form-data">
                <label for="name"><b>Name</b></label>
                <input type="text" name="name" placeholder="Enter name of category" required>

                <label for="image"><b>Photo</b></label>
                <input name="image" type="file">

                <label><b>Status on website</b></label><br>
                <input type="radio" class="btn-check" name="status" id="option1" value="1" checked>
                <label class="btn btn-outline-dark btn1" for="option1">ON</label>

                <input type="radio" class="btn-check" name="status" id="option2" value="0">
                <label class="btn btn-outline-dark btn1" for="option2">OFF</label>

                <div class="clearfix">
                    <button type="reset" class="cancelbtn">Cancel</button>
                    <button type="submit" class="signupbtn" name="submit">Add Category</button>
                </div>
            </form>
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
                $resultCategory = Database::query("SELECT * FROM category");
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
                Database::disconnect();
                ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>