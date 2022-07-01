<?php
/*
 @Author: Sanjay Kumar
 @Project: PHP MySQLi Form Validation Using jQuery Tutorial
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP MySQLi Form Validation Using jQuery Tutorial</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
        .success span {
            color: green;
        }

        span.error {
            color: red;
        }

        i {
            font-weight: 900;
            font-family: 'Font Awesome 5 Free';
        }
    </style>
</head>

<body>
    <div class="container p-5">
        <div class="col-lg-12">
            <div class="card w-75 m-auto">
                <div class="card-header text-center bg-primary text-white">
                    <h4>PHP MySQLi Form Validation Using jQuery Tutorial</h4>
                </div>
                <div class="card-body">
                    <div id="message"></div>
                    <form method="POST" id="myform">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="user1"><strong>Username :</strong><span class="text-danger"> *</span></label>
                                <input type="text" name="username" id="username" class="form-control">
                                <span class="error" id="username_err"> </span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="user1"><strong>Email : </strong><span class="text-danger"> *</span></label>
                                <input type="email" name="email" id="email" class="form-control">
                                <span class="error" id="email_err"> </span>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="mob"><strong>Mobile : </strong><span class="text-danger"> *</span></label>
                                <input type="text" name="mobile" id="mobile" class="form-control">
                                <span class="error" id="mobile_err"> </span>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="password"><strong>Password : </strong><span class="text-danger"> *</span></label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control">
                                    <div class="input-group-append">
                                        <span class="input-group-text" onclick="password_show_hide();">
                                            <i class="fas fa-eye" id="show_eye"></i>
                                            <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                        </span>
                                    </div>
                                </div>
                                <span class="error" id="password_err"> </span>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="conpassword"><strong>Confirm Password : </strong><span class="text-danger"> *</span></label>
                                <input type="password" name="cpass" id="cpassword" class="form-control">
                                <span class="error" id="cpassword_err"> </span>
                            </div>

                            <div class="col-md-12 d-flex">
                                <button type="button" id="submitbtn" class="btn btn-success  ">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#username').on('input', function() {
                checkuser();
            });
            $('#email').on('input', function() {
                checkemail();
            });
            $('#password').on('input', function() {
                checkpass();
            });
            $('#cpassword').on('input', function() {
                checkcpass();
            });
            $('#mobile').on('input', function() {
                checkmobile();
            });

            $('#submitbtn').click(function() {
                if (!checkuser() && !checkemail() && !checkmobile() && !checkpass() && !checkcpass()) {

                    $("#message").html('<div class="alert alert-warning">Please fill all required field</div>');
                } else if (!checkuser() || !checkemail() || !checkmobile() || !checkpass() || !checkcpass()) {
                    $("#message").html('<div class="alert alert-warning">Please fill all required field</div>');

                } else {

                    $("#message").html("");
                    var form = $('#myform')[0];
                    var data = new FormData(form);

                    $.ajax({
                        type: "POST",
                        url: "process.php",
                        data: data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        async: false,
                        beforeSend: function() {
                            $('#submitbtn').html('<i class="fa-solid fa-spinner fa-spin"></i>');
                            $('#submitbtn').attr("disabled", true);
                            $('#submitbtn').css({
                                "border-radius": "50%"
                            });
                        },

                        success: function(data) {
                            $('#message').html(data);
                        },

                        complete: function() {
                            setTimeout(function() {
                                $('#myform').trigger("reset");
                                $('#submitbtn').html('Submit');
                                $('#submitbtn').attr("disabled", false);
                                $('#submitbtn').css({
                                    "border-radius": "4px"
                                });
                            }, 200);
                        }
                    });
                }
            });
        });

        function checkuser() {
            var pattern = /^[A-Za-z0-9]+$/;
            var user = $('#username').val();
            var validuser = pattern.test(user);

            if (user == '') {
                $('#username_err').html('Username Field is required');
                return false;
            } else if ($('#username').val().length < 4) {
                $('#username_err').html('Username length is too short');
                return false;
            } else if (!validuser) {
                $('#username_err').html('Username should be a-z ,A-Z only');
                return false;
            } else {
                $('#username_err').html('');
                return true;
            }
        }

        function checkemail() {
            var pattern1 = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            var email = $('#email').val();
            var validemail = pattern1.test(email);

            if (email == "") {
                $('#email_err').html('Email field is required');
                return false;
            } else if (!validemail) {
                $('#email_err').html('Invalid Email');
                return false;
            } else {
                $('#email_err').html('');
                return true;
            }
        }

        function checkpass() {

            var pattern2 = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
            var pass = $('#password').val();
            var validpass = pattern2.test(pass);

            if (pass == "") {
                $('#password_err').html('Password field is required');
                return false;
            } else if (!validpass) {
                $('#password_err').html('Minimum 5 and upto 15 characters, at least one uppercase letter, one lowercase letter, one number and one special character:');
                return false;

            } else {
                $('#password_err').html("");
                return true;
            }
        }

        function checkcpass() {
            var pass = $('#password').val();
            var cpass = $('#cpassword').val();

            if (cpass == "") {
                $('#cpassword_err').html('Confirm Password field is required');
                return false;
            } else if (pass !== cpass) {
                $('#cpassword_err').html('Confirm Password did not match');
                return false;
            } else {
                $('#cpassword_err').html('');
                return true;
            }
        }

        function checkmobile() {
            var mobile = $("#mobile").val();

            if (mobile == '') {
                $("#mobile_err").html("Mobile filed is required");
                return false;

            } else if (!$.isNumeric(mobile)) {
                $("#mobile_err").html("only number is allowed");
                return false;
            } else if (mobile.length != 10) {
                $("#mobile_err").html("Only Valide 10 digit");
                return false;
            } else {
                $("#mobile_err").html("");
                return true;
            }
        }

        function password_show_hide() {

            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");

            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }
    </script>
</body>

</html>