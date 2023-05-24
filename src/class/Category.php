<?php

class Category{
    static final function categoryDisplay(){
        ?>
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
        <?php
    }

    static final function categoryAdd(){
        require_once "Database.php";

        //mysqli_real_escape_string() remove all special characters from string
        // trim remove all white space front and back of string
//Add new item to base
        $name = Database::realString($_POST['name']);
        $status = Database::realString($_POST['status']);

        //Add image
        if (isset($_FILES['image']['name'])) {
            $imageName = $_FILES['image']['name'];
            if (!empty($imageName)) {
                //extension of upload file
                $array = explode('.', $imageName);
                $ext = end($array);

                //Rename file
                $imageName = "FOOD-NAME-" . rand(0, 9999) . "." . $ext;
                $src = $_FILES['image']['tmp_name'];
                $path = "../../../image/food/" . $imageName;

                //move upload file to new location
                $upload = move_uploaded_file($src, $path);

                if (!$upload) {
                    $error[] = "Failed to upload file";
                    header("Location: menu.php");
                    die();
                }
            }
        } else {
            $imageName = "";
        }
        //Add new category in to database

        Database::query("INSERT INTO category (name, statusCategory, imageName)
    VALUES ('$name', '$status', '$imageName')");
        Database::disconnect();
    }

    static final function categoryUpdate($rowCategory){
        $name = Database::realString($_POST['name']);
        $status = Database::realString($_POST['status']);
        $currentImage = $rowCategory['imageName'];

        if (isset($_FILES['image']['name'])) {
            $imageName = $_FILES['image']['name'];
            if (isset($imageName)) {
                //extension upload file
                $array = explode('.', $imageName);
                $ext = end($array);

                $conn = Database::connect();
                $imageName = Database::realString("FOOD-NAME-" . rand(0, 9999) . "." . $ext);
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

        Database::query("UPDATE category SET name = '$name', statusCategory = '$status',
                    imageName = '$imageName' WHERE categoryID = $rowCategory[categoryID]");
        Database::disconnect();
    }
}