<?php
/*
 @Author: Sanjay Kumar
 @Project: PHP MySQLi Data Pagination Using Ajax Tutorial
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/
?>
<html lang="en">

<head>
    <title>PHP MySQLi Data Pagination Using Ajax Tutorial</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
</head>

<body>
    <div class="row mt-5">
        <div class="col-md-6 offset-3 mt-5">
            <div class="card">
                <div class="card-header bg-primary text-center text-white">
                    <h6 class="m-0">PHP MySQLi Data Pagination Using Ajax Tutorial</h6>
                </div>
                <div class="card-body" style="height: 280px;">
                    <div id="productTable"></div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {

            function lodetable(page) {
                $.ajax({
                    url: 'table.php',
                    type: 'POST',
                    data: {
                        page_no: page
                    },
                    success: function(data) {
                        $('#productTable').html(data);
                    }
                });
            }

            lodetable();

            $(document).on("click", "#pagenation a", function(e) {
                e.preventDefault();
                var page_id = $(this).attr("id");
                lodetable(page_id);
            });

        });
    </script>

</body>

</html>