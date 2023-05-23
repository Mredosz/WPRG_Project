<?php
global $conn;
include "config.php";
function menu($name)
{
    ?>
    <div class="row">
        <div class="col">
<!--            Display information about item from menu-->
            <?php
            global $conn;
            include "config.php";
            $select = "SELECT item.name, price FROM item JOIN category c on c.categoryID = item.categoryID 
                                   WHERE c.name ='$name' and status ='1'";
            $result = mysqli_query($conn, $select);
            echo "<table class=\"table\">";
            echo "<thead>";
            echo "<tr>";
            echo "<th scope=\"col\">Name</th>";
            echo "<th scope=\"col\">Price</th>";
            //                            echo "<th scope=\"col\">Picture</th>";
            echo "</tr>";
            echo "</thead>";
            //            mysqli_fetch_array() - associative array
            while ($row = mysqli_fetch_array($result)) {
                echo "<tbody>";
                echo "<tr>";
                echo("<td>$row[name]</td>");
                echo("<td>$row[price] $</td>");
//                            echo("<td><img src='../../../image/food/$row[imageName]' width='150px'></td>");
//                            echo("<td>$row[phoneNumber]</td>");
                echo "</tr>";
                echo "</tbody>";
            }

            echo "</table>";
//            Select from category tab
            $selectCategory = "SELECT * FROM category WHERE name = '$name'";
            $resultCategory = mysqli_query($conn, $selectCategory);
            $rowCategory = mysqli_fetch_array($resultCategory);
            ?>
        </div>
        <div class="col-4">
<!--            Display image and category name from database-->
            <div class="right-cover">
                <h3><?php echo $rowCategory['name']; ?></h3>
                <img src='../../../image/food/<?php echo $rowCategory['imageName']; ?>' class="img-fluid" ">
            </div>
        </div>
    </div>
    <?php
    mysqli_close($conn);
}

?>
<section class="bg-menu bg-section" id="menu">
    <div class="container-fluid">
        <h1 class="container-h1">Menu</h1>
        <div class="row">
            <!--            Nav pills-->
            <ul class="nav nav-pills">
                <?php
                $select = "SELECT * FROM category WHERE statusCategory = '1'";
                $result = mysqli_query($conn, $select);
                $i = 0;
                while ($row = mysqli_fetch_array($result)) {
                    if ($i == 0) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="pill"
                               href="#<?php echo $row['categoryID']; ?>"><?php echo $row['name']; ?></a>
                        </li>
                        <?php
                    } else {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill"
                               href="#<?php echo $row['categoryID']; ?>"><?php echo $row['name']; ?></a>
                        </li>
                        <?php
                    }
                    $i++;
                }
                ?>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <?php
                $select = "SELECT * FROM category WHERE statusCategory = '1'";
                $result = mysqli_query($conn, $select);
                $j = 0;
                while ($row = mysqli_fetch_array($result)) {
                    if ($j == 0) {
                        ?>
                        <div class="tab-pane container active" id="<?php echo $row['categoryID']; ?>">
                            <?php
                            menu($row['name']);
                            ?>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="tab-pane container fade" id="<?php echo $row['categoryID']; ?>">
                            <?php
                            menu($row['name']);
                            ?>
                        </div>
                        <?php
                    }
                    $j++;
                }
                ?>
            </div>
        </div>
    </div>
</section>
