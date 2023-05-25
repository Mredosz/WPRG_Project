<?php

class Menu
{
    static final function display(){
        require_once "Database.php";

?>
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
                $resultItem = Database::query("SELECT item.name, price, c.name AS category , 
                    item.status, itemID FROM item JOIN category c on c.categoryID = item.categoryID");
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
//                Link to a subpage for editing a given item
                    echo("<td><a class='btn btn-outline-dark' href=\"menuEdit.php?itemID=$row[itemID]\">Edit</a></td>");
//                Link to a subpage for delete a given item
                    echo("<td><a class='btn btn-outline-dark' href=\"menuDelete.php?itemID=$row[itemID]\">Delete</a></td>");
                    echo "</tr>";
                    echo "</tbody>";
                }
                ?>
            </table>
<?php
    }

    static final function update($rowItem){
        if (isset($_POST['update'])) {
            $name = Database::realString($_POST['name']);
            $price = Database::realString($_POST['price']);
            $category = Database::realString($_POST['category']);
            $status = Database::realString($_POST['status']);

            Database::query("UPDATE item SET name = '$name', price = '$price', 
                    categoryID = '$_POST[category]', status = '$status' WHERE itemID = $rowItem[itemID]");
            //refresh website
            header("Location: menuEdit.php?itemID=$rowItem[itemID]");
            Database::disconnect();

        }
    }

}