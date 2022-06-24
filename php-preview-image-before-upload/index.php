<?php
/*
 @Author: Sanjay Kumar
 @Project: PHP Preview an Image Before Upload Using jQuery Tutorial
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Preview an Image Before Upload Using jQuery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card w-75 m-auto">
                    <div class="card-header text-center bg-primary text-white">
                        <h4>PHP Preview an Image Before Upload Using jQuery</h4>
                    </div>
                    <div class="card-body">
                        <form action="javascript:void(0);" id="form" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="myImage"><strong>Select Image : </strong><span class="text-danger">*</span></label>
                                <input type="file" id="myImage" class="form-control">
                                <p id="errorMs" class="text-danger"></p>
                            </div>
                            <img id="preview-image" width="200px" class="mb-2">
                            <br>
                            <div class="d-flex">
                                <input type="submit" class="btn btn-success" id="submit" value="Upload">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            // Preview image
            $('#myImage').change(function() {

                let reader = new FileReader();

                reader.onload = (e) => {
                    $('#preview-image').attr('src', e.target.result);
                    $("#errorMs").hide();
                }
                reader.readAsDataURL(this.files[0]);
            });

            // Submit data
            $("#submit").click(function(e) {

                e.preventDefault();

                let form_data = new FormData();
                let img = $("#myImage")[0].files;
                if (img.length > 0) {
                    form_data.append('my_image', img[0]);
                    $.ajax({
                        url: 'process.php',
                        type: 'post',
                        data: form_data,
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            const data = JSON.parse(res);
                            if (data.error != 1) {
                                $('.form-group').prepend('<p class="alert alert-success">Uploaded Successfully.</p>')
                            } else {
                                $("#errorMs").text(data.em);
                            }
                            $('#preview-image').fadeOut(800);
                        }
                    });
                } else {
                    $("#errorMs").text("Please select an image.");
                }
            });
        });
    </script>
</body>

</html>