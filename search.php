<?php

include "database.php";

$search = $_POST['search'];
//echo $search;
if (!empty($search)){

    $query = "SELECT * FROM cars WHERE cars LIKE '$search%' ";
    $search_query = mysqli_query($connection, $query);
    $count = mysqli_num_rows($search_query);
    if (!$search_query){

        die("Query Failed " . mysqli_error($connection));
    }
    if ($count == 0){

        echo "<div class='alert alert-danger'>No Cars in stock.</div>";
    }
    else{

        while ($row = mysqli_fetch_array($search_query)){

            $cars = $row['cars'];
            $cars = ucfirst($cars);

            ?>
            <ul>
                <?php
                echo "<li class='list-unstyled'>{$cars} in stock.</li>";
                ?>
            </ul>
            <?php
        }
    }
}
