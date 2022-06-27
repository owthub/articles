<?php
/*
 @Author: Sanjay Kumar
 @Project: PHP MySQLi How To Add Custom Filter To DataTable Tutorial
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/

// Include the database configuration file 
require 'dbconfig.php';

$query = "SELECT DISTINCT designation FROM employees ORDER BY designation ASC";
$statement = $conn->prepare($query);
$statement->execute();
$result = $statement->get_result();

$designationData = "";
while ($item = $result->fetch_assoc()) {
    extract($item);
    $designationData .= '<option value="' . $designation . '">' . $designation . '</option>';
}

?>

<html>

<head>
    <title>PHP MySQLi How To Add Custom Filter To DataTable Tutorial</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header text-center text-white bg-primary">
                <h4 class="text-center">PHP MySQLi How To Add Custom Filter To DataTable Tutorial</h4>
            </div>
            <div class="card-body">
                <div class="row d-flex justify-content-center mb-4">
                    <div class="col-md-4">
                        <select name="filter_designation" id="filter_designation" class="form-control" required>
                            <option value="">Select Designation</option>
                            <?php echo $designationData; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="button" name="filter" id="filter" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                    </div>
                </div>
                <table id="employees_data" class="table table-bordered table-striped mt-4">
                    <thead>
                        <tr>
                            <th width="20%">Employee Name</th>
                            <th width="10%">Username</th>
                            <th width="25%">Email</th>
                            <th width="15%">Gender</th>
                            <th width="15%">Designation</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript" language="javascript">
        $(document).ready(function() {

            fill_datatable();

            function fill_datatable(filter_designation = '') {

                var dataTable = $('#employees_data').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "order": [],
                    "searching": false,
                    "ajax": {
                        url: "process.php",
                        type: "POST",
                        data: {
                            filter_designation: filter_designation
                        }
                    }
                });
            }

            $('#filter').click(function() {
                var filter_designation = $('#filter_designation').val();

                if (filter_designation != '') {
                    $('#employees_data').DataTable().destroy();
                    fill_datatable(filter_designation);
                }
            });
        });
    </script>
</body>

</html>