<?php
function menu($name){
    global $conn;
    include "config.php";
    $select = "SELECT item.name, price FROM item JOIN category c on c.categoryID = item.categoryID WHERE c.name ='$name'";
    $result = mysqli_query($conn, $select);
    echo "<table class=\"table\">";
                        echo "<thead>";
                        echo "<tr>";
                            echo "<th scope=\"col\">Name</th>";
                            echo "<th scope=\"col\">Price</th>";
//                         <th scope="col">Street</th>
                       echo "</tr>";
                        echo "</thead>";
                        //            mysqli_fetch_array() - associative array
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tbody>";
                            echo "<tr>";
                            echo("<td>$row[name]</td>");
                            echo("<td>$row[price] $</td>");
//                            echo("<td>$row[phoneNumber]</td>");
                            echo "</tr>";
                            echo "</tbody>";
                        }

             echo"</table>";
    mysqli_close($conn);
}
?>
<section class="bg-menu bg-section" id="menu">
    <div class="container-fluid">
        <h1 class="container-h1">Menu</h1>
        <div class="row">

            <!--                Nav pills-->
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-breakfast-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-breakfast" type="button" role="tab" aria-controls="pills-breakfast"
                            aria-selected="true">Breakfast
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-lunch-tab" data-bs-toggle="pill" data-bs-target="#pills-lunch"
                            type="button" role="tab" aria-controls="pills-lunch" aria-selected="false">Lunch
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-dinner-tab" data-bs-toggle="pill" data-bs-target="#pills-dinner"
                            type="button" role="tab" aria-controls="pills-dinner" aria-selected="false">Dinner
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-dessert-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-dessert" type="button" role="tab" aria-controls="pills-dessert"
                            aria-selected="false">Dessert
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-salads-tab" data-bs-toggle="pill" data-bs-target="#pills-salads"
                            type="button" role="tab" aria-controls="pills-salads" aria-selected="false">Salads
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-drinks-tab" data-bs-toggle="pill" data-bs-target="#pills-drinks"
                            type="button" role="tab" aria-controls="pills-drinks" aria-selected="false">Drinks
                    </button>
                </li>
            </ul>

<!--            Content-->
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-breakfast" role="tabpanel"
                     aria-labelledby="pills-breakfast-tab" tabindex="0">
                    <?php
                    menu("Breakfast");
                    ?>
                </div>
                <div class="tab-pane fade" id="pills-lunch" role="tabpanel" aria-labelledby="pills-lunch-tab"
                     tabindex="0">
                    <?php
                    menu("Lunch");
                    ?>
                </div>
                <div class="tab-pane fade" id="pills-dinner" role="tabpanel" aria-labelledby="pills-dinner-tab"
                     tabindex="0">
                    <?php
                    menu("Dinner");
                    ?>
                </div>
                <div class="tab-pane fade" id="pills-dessert" role="tabpanel" aria-labelledby="pills-dessert-tab"
                     tabindex="0">
                    <?php
                    menu("Dessert");
                    ?>
                </div>
                <div class="tab-pane fade" id="pills-salads" role="tabpanel" aria-labelledby="pills-salads-tab"
                     tabindex="0">
                    <?php
                    menu("Salads");
                    ?>
                </div>
                <div class="tab-pane fade" id="pills-drinks" role="tabpanel" aria-labelledby="pills-drinks-tab"
                     tabindex="0">
                    <?php
                    menu("Drinks");
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
