<?php
/*
 @Author: Sanjay Kumar
 @Project: PHP MySQLi How To Use Select2 for Multiple Select Tutorial
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/

// Include the database configuration file 
require 'dbconfig.php';

$countrySelect = $conn->prepare("SELECT * FROM countries");

$countrySelect->execute();
$countries = $countrySelect->get_result();

$itemRecords = array();
while ($item = $countries->fetch_assoc()) {
    extract($item);
    $itemDetails = array(
        "id" => $id,
        "name" => $name
    );
    array_push($itemRecords, $itemDetails);
}
?>

<html lang="en">

<head>
    <title>PHP MySQLi How To Use Select2 for Multiple Select Tutorial</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha256-aAr2Zpq8MZ+YA/D6JtRD3xtrwpEz2IqOS+pWD/7XKIw=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
</head>

<body>
    <div class="row mt-5">
        <div class="col-md-8 offset-2 mt-5">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>PHP MySQLi How To Use Select2 for Multiple Select Tutorial</h4>
                </div>
                <div class="card-body" style="height: 280px;">
                    <form action="#" method="post">
                        <div class="form-group">
                            <label>Country :</label>
                            <select class="dd_country related-post form-control" name="country[]" multiple>
                                <option value="">Select country</option>
                                <?php
                                if (count($itemRecords) > 0) {
                                    foreach ($itemRecords as $ct) {
                                ?>
                                        <option value="<?php echo $ct['id']; ?>"><?php echo $ct['name']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success store-related-post btn-sm">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.dd_country').select2();
        });
    </script>
</body>

</html>