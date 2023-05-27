<?php
function menu($name)
{
    require_once "./src/class/Database.php";
//            mysqli_fetch_array() - associative array
    $result = Database::query("SELECT item.name,price, description, itemID FROM item JOIN category c on 
                    c.categoryID = item.categoryID WHERE c.name ='$name' and status ='1'");
//            Select from category tab
    $rowCategory = mysqli_fetch_array(Database::query("SELECT * FROM category WHERE name = '$name'"));
    ?>
    <div class="row">
        <div class="col-sm-7">
            <!--            Display information about item from menu-->
            <?php
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <ul class="list-group">
                    <li class="list-group-item">
                        <h4 class="list-group-item-heading"><?php echo $row['name']; ?>
                            <span class="badge pull-right"><?php echo $row['price'] . " $"; ?></span>
                        </h4>
                        <p class="list-group-item-text"><?php echo $row['description']; ?>
                            <button class="badge pull-right add" data-id="<?php echo $row['itemID']; ?>">
                                Add
                            </button>
                        </p>
                    </li>
                </ul>
                <?php
            }
            ?>
        </div>
        <div class="col-4">
            <!--            Display image and category name from database-->
            <div class="right-cover">
                <h3><?php echo $rowCategory['name']; ?></h3>
                <img src='../../../image/food/<?php echo $rowCategory['imageName']; ?>' class="img-fluid"  alt="">
            </div>
        </div>
    </div>
    <?php
    Database::disconnect();
}

function mostPopular($name)
{
    require_once "./src/class/Database.php";
//            mysqli_fetch_array() - associative array
    $result = Database::query("SELECT item.name,price, description FROM item JOIN category c on 
                    c.categoryID = item.categoryID WHERE c.name ='$name' and status ='1'");
//            Select from category tab
    $rowCategory = mysqli_fetch_array(Database::query("SELECT * FROM category WHERE name = '$name'"));
    ?>
    <div class="row">
        <div class="col-sm-7">
            <!--            Display information about item from menu-->
            <?php
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <ul class="list-group">
                    <li class="list-group-item">
                        <h4 class="list-group-item-heading"><?php echo $row['name']; ?>
                            <span class="badge pull-right"><?php echo $row['price'] . " $"; ?></span>
                        </h4>
                        <p class="list-group-item-text"><?php echo $row['description']; ?>
                            <button class="badge pull-right add" data-id="<?php echo $row['itemID']; ?>"></button>
                        </p>
                    </li>
                </ul>
                <?php
            }
            ?>
        </div>
        <div class="col-4">
            <!--            Display image and category name from database-->
            <div class="right-cover">
                <h3><?php echo $rowCategory['name']; ?></h3>
                <img src='../../../image/food/<?php echo $rowCategory['imageName']; ?>' class="img-fluid" alt="">
            </div>
        </div>
    </div>
    <?php
    Database::disconnect();
}

?>
<section class="bg-menu bg-section" id="menu">
    <div class="container-fluid">
        <h1 class="container-h1">Menu</h1>
        <div class="row">
            <!--            Nav pills-->
            <ul class="nav nav-pills">
                <?php
                require_once "./src/class/Database.php";

                $result = Database::query("SELECT * FROM category WHERE statusCategory = '1'");
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
                $result = Database::query("SELECT * FROM category WHERE statusCategory = '1'");
                while ($row = mysqli_fetch_array($result)) {
                    if ($row['categoryID'] == 1) {
                        ?>
                        <div class="tab-pane container active" id="<?php echo $row['categoryID']; ?>">
                            <?php
                            mostPopular($row['name']);
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
                }
                ?>
                <script>
                    var product_id = document.getElementsByClassName("add");
                    for (var i = 0; i < product_id.length; i++) {
                        product_id[i].addEventListener("click",function (event) {

                            var target= event.target;
                            var id = target.getAttribute("data-id");
                            var xml = new XMLHttpRequest();

                            xml.onreadystatechange = function (){
                                if (this.readyState == 4 && this.status == 200){
                                    var data = JSON.parse(this.responseText);
                                    document.getElementById("badge").innerHTML = data.num_cart+1;
                                }
                            }
                            xml.open("GET", "../../../../WPRG_Project/src/main_website/php_file/addToCart.php?itemID="+id, true);
                            xml.send();
                        })
                    }
                </script>
            </div>
        </div>
    </div>
</section>
