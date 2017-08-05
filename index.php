<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <script src="jquery-3.2.1.js" type="text/javascript"></script>
    <script src="bootstrap.min.js" type="text/javascript"></script>
</head>
<body>

<script>
    $(document).ready(function () {

        setInterval(function () {

            updateCars();
        }, 1000);
        //The setInterval() method calls a function or evaluates an expression at specified intervals (in milliseconds).
        //The setInterval() method will continue calling the function until clearInterval() is called, or the window is closed.

        function updateCars() {

            $.ajax({

                url: 'display_cars.php',
                type: 'POST',
                success: function (show_cars) {

                    if (!show_cars.error){

                        $("#show-cars").html(show_cars);
                    }//if there is no error in show_cars then if condition executes
                }//here show_cars parameter is bringing data from display_cars
            });
        }//showing cars

        $("#search").keyup(function () {

            var search = $("#search").val();
            //whatever typed in input save that value in search variable
            //alert(search);
            $.ajax({
                url: 'search.php', //what page does we want request to go
                data: {search: search},
                type: 'POST',
                success: function (data) {

                    if (!data.error){

                        $('#result').html(data);//we are inserting data that is coming in
                    }//if  we don't have error then do the remaining
                }//success is callback function
            });//http://api.jquery.com/jquery.ajax/
        });//keyup function acts when something is typed in input with id search do something


        $("#add-car").submit(function (event) {

            event.preventDefault();//prevententing form to default functionality
            var postData = $(this).serialize();//got all form data in postdata variable
            //serialize() -> Encode a set of form elements as a string for submission
            var url = $(this).attr('action');
            //alert(postData);

            $.post(url, postData, function (php_table_data) {

                //sending data to database
                //3rd parameter is data which we are getting back
                $("#car-result").html(php_table_data);
                $("#add-car")[0].reset();//resetting first index of form so that input will cleared after adding cars
            });//jQuery.post( url [, data ] [, success ] [, dataType ] )
            //Load data from the server using a HTTP POST request
        });//on submitting form  //add cars
    });
</script>

<div id="container" class="text-center col-xs-6 col-xs-offset-3">
    <div class="row">
        <h2>Search Database</h2>
        <input type="text" class="form-control col-xs-6" name="search" id="search" placeholder="Search">
        <br>
        <br>
        <h2 class="bg-success" id="result"></h2>
    </div>

    <div class="row">
        <form action="add_cars.php" class="col-xs-6" id="add-car" method="post">
            <div class="form-group">
                <input type="text" name="car_name" class="form-control" placeholder="Add Car"
                       required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success pull-left" value="Add Car">
            </div>
        </form>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-xs-6">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody id="show-cars">

                </tbody>
            </table>
        </div>
        <div class="col-xs-6">
            <div id="feedback"></div>
            <div id="action-container">

            </div>
        </div>
    </div>
</div>

</body>
</html>