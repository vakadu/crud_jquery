<?php

include "database.php";

//echo "Hello";
//displaying action box data
if (isset($_POST['id'])){

    $id = mysqli_real_escape_string($connection, $_POST['id']);
    $query = "SELECT * FROM cars WHERE id = {$id}";
    $query_car_info = mysqli_query($connection, $query);
    if (!$query_car_info){

        die("Query Failed " . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_array($query_car_info)){

        echo "<input rel='". $row['id'] ."' type='text' class='form-control car-input' value='". $row['cars'] ."'>";
        echo "<div class='pull-left' style='padding-top: 5px'>";
        echo "<input type='button' class='btn btn-success' id='update' value='Update'>";
        echo "<input type='button' class='btn btn-danger' id='delete' style='margin-left: 10px' value='Delete'>";
        echo "<input type='button' class='btn btn-close' style='margin-left: 10px' value='Close'>";
        echo "</div>";
    }
}

//updating action box data
if (isset($_POST['updatethis'])){

    $id = mysqli_real_escape_string($connection, $_POST['id']);
    $cars = mysqli_real_escape_string($connection, $_POST['cars']);

    $id = $_POST['id'];
    $cars = $_POST['cars'];

    $query = "UPDATE cars SET cars = '{$cars}' WHERE id = {$id}";
    $update_query = mysqli_query($connection, $query);
    if (!$update_query){

        die("Query Failed " . mysqli_error($connection));
    }
}

//deleting action box data
if (isset($_POST['deletethis'])){

    $id = mysqli_real_escape_string($connection, $_POST['id']);

    $id = $_POST['id'];

    $query = "DELETE FROM cars WHERE id = {$id}";
    $update_query = mysqli_query($connection, $query);
    if (!$update_query){

        die("Query Failed " . mysqli_error($connection));
    }
}

?>

<script>
    $(document).ready(function () {

        var id;
        var cars;
        var updatethis = "update";
        var deletethis = "delete";

        //Extract id and cars
        $(".car-input").on('input', function () {

            id = $(this).attr('rel');
            cars = $(this).val();
//            alert(cars);
        });//when we click on car-input class we are getting cars id and cars title

        //update
        $("#update").on('click', function () {

//            alert("hell");
            $.post("process.php", {id: id, cars: cars, updatethis: updatethis}, function (data) {
//                alert(data);
//                alert("Updated successfully");
                $("#feedback").html("<div class='alert alert-success'>Updated successfully</div>");
                //we are not doing anything to data which is coming back from db all we need is update in db
            });
        });

        //delete
        $("#delete").on('click', function () {

            id = $(".title-link").attr('rel');
//            alert("hell");
            $.post("process.php", {id: id, deletethis: deletethis}, function (data) {
//                alert("deleted");
//                alert("Updated successfully");
                $("#feedback").html("<div class='alert alert-danger'>Deleted Successfully</div>");
                $("#action-container").hide();
                //we are not doing anything to data which is coming back from db all we need is update in db
            });
        });

        //close
        $(".btn-close").on('click', function () {

            $("#action-container").hide();
        });
    });
</script>
