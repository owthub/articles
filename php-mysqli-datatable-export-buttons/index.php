<?php
/*
 @Author: Sanjay Kumar
 @Project: PHP & MySQLi How To Add Export Buttons To DataTable Tutorial
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/

// Include the database file
require 'dbconfig.php';

$query = "SELECT * FROM employees ORDER BY id DESC";

$statement = $conn->prepare($query);
$statement->execute();
$result = $statement->get_result();

$employees = array();

while ($item = $result->fetch_assoc()) {
    $employees[] = $item;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" />
</head>

<body>

    <div class="container" style="margin-top:30px;">
        <h4 style="text-align: center;">PHP & MySQLi How To Add Export Buttons To DataTable Tutorial by Online Web Tutor</h4>

        <div class="panel panel-primary">
            <div class="panel-heading">
                Employees Report
            </div>
            <div class="panel-body">
                <table class="table table-striped" id="tbl-employees">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (count($employees) > 0) {

                            $count = 1;

                            foreach ($employees as $emp) {
                        ?>
                                <tr>
                                    <td><?= $count++ ?></td>
                                    <td><?= $emp['name'] ?></td>
                                    <td><?= $emp['email'] ?></td>
                                    <td><?= $emp['mobile'] ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>

    <script>
        $(function() {
            $("#tbl-employees").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                    'pageLength'
                ]
            });
        })
    </script>

</body>

</html>