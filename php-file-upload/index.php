<?php
/*
 @Author: Sanjay Kumar
 @Project: PHP MySQLi jQuery Ajax File Upload with Type Validation
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>PHP MySQLi jQuery Ajax File Upload with Type Validation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card m-auto w-75">
                    <div class="card-header text-center text-white bg-dark">
                        <h4>PHP MySQLi jQuery Ajax File Upload with Type Validation</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible" id="success" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            File uploaded successfully
                        </div>
                        <form id="submitForm" enctype="multipart/form-data">
                            <div class="form-group">
                                <label><strong>Select File : </strong><span class="text-danger"> *</span></label>
                                <input type="file" class="form-control" name="file" id="file" multiple>
                                <span id="error" class="text-danger"></span><br>
                            </div>
                            <div class="form-group d-flex">
                                <button type="submit" name="upload" class="btn btn-primary">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $("input").prop('required', true);
            $('#file').change(function() {
                var ext = this.value.match(/\.(.+)$/)[1];
                switch (ext) {
                    case 'txt':
                    case 'pdf':
                    case 'docx':
                    case 'csv':
                    case 'xlsx':
                        $('#error').text("");
                        $('button').attr('disabled', false);
                        break;
                    default:
                        $('#error').text("File must be of type txt,pdf,docx,csv,xlsx.");
                        $('button').attr('disabled', true);
                        this.value = '';
                }
            });
            $("#submitForm").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    url: "process.php",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: new FormData(this),

                    success: function(response) {
                        $("#success").show();
                        $("#success").fadeOut(5000);
                    }
                });
            });
        });
    </script>
</body>

</html>