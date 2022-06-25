<!DOCTYPE html>
<html lang="en">

<head>
    <title>PHP MySQLi How to Upload Multiple Files with Ajax</title>
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
                    <div class="card-header text-center text-white bg-primary">
                        <h4>PHP MySQLi How to Upload Multiple Files with Ajax</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible" id="success" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            File uploaded successfully
                        </div>
                        <form id="submitForm">
                            <div class="form-group">
                                <label><strong>Select Files : </strong><span class="text-danger"> *</span></label>
                                <input type="file" class="form-control" name="multipleFile[]" id="multipleFile" multiple>
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
    <script type="text/javascript" src="script.js"></script>
</body>

</html>