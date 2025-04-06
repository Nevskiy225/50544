<!DOCTYPE html>
<html lang="ru">
<?php
$head_path = __DIR__ . "/includes/head.php";
$header_path = __DIR__ . "/includes/header.php";
$banner_path = __DIR__ . "/includes/banner.php";
$popular_path = __DIR__ . "/includes/popular.php";
$footer_path = __DIR__ . "/includes/footer.php";
?>
<head>
<title>50541</title>
<?php
    require_once $head_path;
    ?>
 <style>
        /* Стили для центрирования */
        .products-grid {
            display: flex;
            justify-content: center;
        }
        .product-card {
            width: 300px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .product-card img {
            width: 100%;
            transition: opacity 0.3s ease;
        }
        .product-card .hover-image {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }
        .product-card:hover .main-image {
            opacity: 0;
        }
        .product-card:hover .hover-image {
            opacity: 1;
        }
    </style>
    </head>
<body>
    <?php
    require_once $header_path;
    require_once $banner_path;
    require_once $popular_path;
    require_once $footer_path;
    ?>
    </body>
</html>