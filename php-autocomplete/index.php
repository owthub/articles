<?php
/*
 @Author: Sanjay Kumar
 @Project: PHP & MySQLi Autocomplete Search From Database Using jQuery UI
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/

// Include the functions file
require 'functions.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>PHP & MySQLi Autocomplete Search From Database Using jQuery UI</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- jQuery UI JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>

<body>

    <div class="container" style="margin-top: 40px;">
        <div class="panel panel-primary">
            <div class="panel-heading">PHP & MySQLi Autocomplete Search From Database Using jQuery UI</div>
            <div class="panel-body">
                <label>Search Country...</label>
                <input class="form-control" id="autocomplete_country" type="text">
                <br>
                <p>Country ID : <span id="countryId"></span></p>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script type='text/javascript'>
        $(document).ready(function() {
            // Initialize
            $("#autocomplete_country").autocomplete({
                source: function(request, response) {
                    // Fetch data
                    $.ajax({
                        url: "functions.php",
                        type: "post",
                        dataType: "json",
                        data: {
                            search: request.term
                        },
                        success: function(data) {
                            response(data.data);
                        }
                    });
                },
                select: function(event, ui) {
                    // Set selection
                    $('#autocomplete_country').val(ui.item.label); // display the selected text
                    $('#countryId').text(ui.item.value); // save selected id to input
                    return false;
                },
                focus: function(event, ui) {
                    $("#autocomplete_country").val(ui.item.label);
                    $("#countryId").text(ui.item.value);
                    return false;
                },
            });
        });
    </script>

</body>

</html>