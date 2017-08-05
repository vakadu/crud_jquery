<?php

include "database.php";

$query = "SELECT * FROM cars";
$query_car_info = mysqli_query($connection, $query);
if (!$query_car_info){

    die("Query Failed " . mysqli_error($connection));
}

while ($row = mysqli_fetch_array($query_car_info)){

    echo "<tr>";
    echo "<td>{$row['id']}</td>";
    echo "<td><a rel='".$row['id']."' class='title-link' href='javascript:void(0)'> {$row['cars']}</a></td>";
//    using id in a loop works for only first item so its always better to use class in a loop for that is linked to jquery code.
    echo "</tr>";
}

?>

<!--this jquery should be in this file bcz data from php is dynamic-->
<script>
//    $("#action-container").hide();
    $(".title-link").on('click', function () {
        //alert("hello");
        $("#action-container").show();
        var id = $(this).attr('rel');
//        alert(id);
        $.post("process.php", {id: id}, function (data) {

//            alert(data);
            $("#action-container").html(data);
        });
    });
</script>
