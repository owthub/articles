<?php
/*
 @Author: Sanjay Kumar
 @Project: PHP MySQLi Dynamic Dependent Dropdown using jQuery Ajax
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/

// Include the functions file
require 'functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>PHP MySQLi Dynamic Dependent Dropdown using jQuery Ajax</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

    <div class="container">
        <h4>PHP MySQLi Dynamic Dependent Dropdown using jQuery Ajax</h4>
        <div class="panel panel-primary">
            <div class="panel-heading">PHP MySQLi Dynamic Dependent Dropdown using jQuery Ajax</div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="country">Country:</label>
                    <select id="country" name="country" class="form-control">
                        <option value="" selected disabled>Select Country</option>
                        <?php foreach ($countries as $key => $country) { ?>
                            <option value="<?= $country['id'] ?>"> <?= $country['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="state">State:</label>
                    <select name="state" id="state" class="form-control"></select>
                </div>
                <div class="form-group">
                    <label for="city">City:</label>
                    <select name="city" id="city" class="form-control"></select>
                </div>
            </div>
        </div>
    </div>
    <script type=text/javascript>
        // when country dropdown changes
        $('#country').change(function() {

            var countryID = $(this).val();

            if (countryID) {

                $.ajax({
                    type: "POST",
                    url: "functions.php",
                    data: {
                        country_id: countryID,
                        type: "get_states"
                    },
                    success: function(res) {
                        var data = JSON.parse(res);
                        if (res) {

                            $("#state").empty();
                            $("#state").append('<option>Select State</option>');
                            $.each(data.data, function(key, value) {
                                $("#state").append('<option value="' + value.id + '">' + value.name +
                                    '</option>');
                            });

                        } else {

                            $("#state").empty();
                        }
                    }
                });
            } else {

                $("#state").empty();
                $("#city").empty();
            }
        });

        // when state dropdown changes
        $('#state').on('change', function() {

            var stateID = $(this).val();

            if (stateID) {

                $.ajax({
                    type: "POST",
                    url: "functions.php",
                    data: {
                        state_id: stateID,
                        type: "get_cities"
                    },
                    success: function(res) {
                        var data = JSON.parse(res);
                        if (res) {
                            $("#city").empty();
                            $("#city").append('<option>Select City</option>');
                            $.each(data.data, function(key, value) {
                                $("#city").append('<option value="' + value.id + '">' + value.name +
                                    '</option>');
                            });

                        } else {

                            $("#city").empty();
                        }
                    }
                });
            } else {

                $("#city").empty();
            }
        });
    </script>
</body>

</html>