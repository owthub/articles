<?php
/*
 @Author: Sanjay Kumar
 @Project: PHP How To Upload Image in MySQLi Database Tutorial
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/

// Include the database configuration file 
require 'dbconfig.php';
ini_set("display_errors", 1);
if (isset($_POST['submit'])) {

    if (empty($_POST['name'])) {
        $errors['name'] = "*The name field is required.";
    }

    if (empty($_POST['email'])) {
        $errors['email'] = "*The email field is required.";
    }

    if (preg_match("/\S+/", $_FILES['image']['name']) === 0) {
        $errors['image'] = "*The image field is required.";
    }

    $filename = $_FILES['image']['name'];

    $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    $extensions_arr = array("jpg", "jpeg", "png");

    if (in_array($imageFileType, $extensions_arr)) {

        if (move_uploaded_file($_FILES["image"]["tmp_name"], 'uploads/' . $filename)) {

            $stmt = $conn->prepare("INSERT INTO students (name, email, profile_image) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $filename);

            $name = $_POST['name'];
            $email = $_POST['email'];

            $stmt->execute();

            $successful = '<h5 class="alert alert-success">Data saved successfully!</h5>';
        } else {
            echo 'Error in uploading file - ' . $_FILES['image']['name'] . '<br/>';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h4>PHP How To Upload Image in MySQLi Database Tutorial</h4>
        <div class="panel panel-primary">
            <div class="panel-heading">PHP How To Upload Image in MySQLi Database Tutorial</div>
            <div class="panel-body">
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                    <?php if (isset($successful)) {
                        echo $successful;
                    } ?>

                    <div class="form-group">
                        <div class="custom-file">
                            <label for="customFile">Name</label>
                            <input type="text" name="name" id="name" class="form-control">

                            <?php if (isset($errors['name'])) {
                                echo "<span class='text-danger'>" . $errors['name'] . "</span>";
                            } ?>
                        </div>
                    </div>
                    <br />
                    <div class="form-group">
                        <div class="custom-file">
                            <label for="customFile">Email</label>
                            <input type="text" name="email" id="email" class="form-control">

                            <?php if (isset($errors['email'])) {
                                echo "<span class='text-danger'>" . $errors['email'] . "</span>";
                            } ?>

                        </div>
                    </div>
                    <br />
                    <div class="form-group">
                        <div class="custom-file">
                            <label for="customFile">Profile Image</label>

                            <input type="file" name="image" id="customFile" class="form-control">

                            <?php if (isset($errors['image'])) {
                                echo "<span class='text-danger'>" . $errors['image'] . "</span>";
                            } ?>

                        </div>
                    </div>
                    <br><br>

                    <div class="form-group d-flex">
                        <input type='submit' name='submit' value='Submit' class="btn btn-primary px-4">
                    </div>

                </form>
            </div>
        </div>
    </div>

</body>

</html>
