<?php
/*
 @Author: Sanjay Kumar
 @Project: PHP MySQLi How To Upload Multiple Images Tutorial
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/
?>

<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP MySQLi How To Upload Multiple Images</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <?php
    // Include the database configuration file 
    include "dbconfig.php";

    if (isset($_POST['submit'])) {

        $targetDir = "uploads/";

        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

        $images_arr = array();

        foreach ($_FILES['images']['name'] as $key => $val) {

            $image_name = $_FILES['images']['name'][$key];
            $tmp_name = $_FILES['images']['tmp_name'][$key];
            $size = $_FILES['images']['size'][$key];
            $type = $_FILES['images']['type'][$key];
            $error = $_FILES['images']['error'][$key];

            $fileName = basename($_FILES['images']['name'][$key]);
            $targetFilePath = $fileName;

            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            if (in_array($fileType, $allowTypes)) {

                if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $targetDir . $targetFilePath)) {

                    $images_arr[] = $targetFilePath;

                    $stmt = $conn->prepare("INSERT INTO images (image_name) VALUES (?)");
                    $stmt->bind_param("s", $imagePath);

                    $imagePath = $targetDir . $targetFilePath;

                    $stmt->execute();
                } else {
                    $statusMsg = "Sorry, there was an error uploading your file.";
                }
            } else {
                $statusMsg = 'Please Upload a Valid File';
            }
        }

        if (count($images_arr) > 0) {
            $success = count($images_arr) . " Image files successfully uploaded";
        }
    }
    ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card w-75 m-auto">
                    <div class="card-header text-center bg-primary text-white">
                        <h4>PHP MySQLi How To Upload Multiple Images</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

                            <?php if (!empty($success)) { ?>
                                <p class="alert alert-success"><?php echo $success; ?></p>
                            <?php } ?>

                            <div class="form-group">
                                <div class="custom-file">
                                    <label><strong>Select Images : <span class="text-danger">*</span></strong></label>
                                    <input type="file" name="images[]" id="customFile" class="form-control" multiple required>
                                </div>

                                <?php if (!empty($statusMsg)) { ?>
                                    <p class="text-danger"><?php echo $statusMsg; ?></p>
                                <?php } ?>

                            </div>

                            <br>
                            <div class="form-group d-flex">
                                <input type="submit" name="submit" value="Upload" class="btn btn-success rounded-0 px-3">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>