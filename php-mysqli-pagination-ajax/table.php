<?php
/*
 @Author: Sanjay Kumar
 @Project: PHP MySQLi Data Pagination Using Ajax Tutorial
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <style type="text/css">
        #pagenation a {
            color: #fff;
        }

        #pagenation {
            text-align: center;
            margin-top: 5%;
        }

        .button-style {
            border-radius: 20px;
        }

        .link {
            border-radius: 100px !important;
        }
    </style>
</head>

<body>

    <?php
    // Include Database
    include 'dbconfig.php';

    $limit_per_page = 10;
    $page = isset($_POST['page_no']) ? $_POST['page_no'] : 1;

    $offset = ($page - 1) * $limit_per_page;

    $query = "SELECT * FROM products LIMIT {$offset},{$limit_per_page}";

    $statement = $conn->prepare($query);
    $statement->execute();
    $result = $statement->get_result();

    $products = array();

    while ($item = $result->fetch_assoc()) {
        $products[] = $item;
    }
    ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Slug</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product) { ?>
                <tr>
                    <th scope="row">
                        <?php echo $product['id']; ?>
                    </th>
                    <td>
                        <?php echo $product['name']; ?>
                    </td>
                    <td>
                        <?php echo $product['slug']; ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php
    $sql_total = "SELECT count(*) FROM products LIMIT 50";

    $stmt = $conn->prepare($sql_total);
    $stmt->execute();
    $number_filter_row = $stmt->get_result()->fetch_row();

    $total_record = $number_filter_row[0];

    $total_pages = ceil($total_record / $limit_per_page);
    ?>
    <div class="pagenation" id="pagenation">

        <?php if ($page > 1) { ?>

            <a href="" id="<?php echo $page - 1; ?>" class="button-style btn btn-success">Previous</a>

        <?php } ?>

        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
            <a id="<?php echo $i ?>" href="" class="link btn btn-primary"><?php echo $i ?></a>
        <?php } ?>

        <?php if ($page != $total_pages) { ?>

            <a href="" id="<?php echo $page + 1; ?>" class="button-style btn btn-success">Next</a>

        <?php } ?>

    </div>

</body>

</html>