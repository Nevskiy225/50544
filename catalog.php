<!DOCTYPE html>
<html lang="ru">
<?php
$hoodie4_path = __DIR__ . "/includes/hoodie/hoodie4.php";
$hoodie2_path = __DIR__ . "/includes/hoodie/hoodie2.php";
$hoodie3_path = __DIR__ . "/includes/hoodie/hoodie3.php";
$head_path = __DIR__ . "/includes/head.php";
$header_path = __DIR__ . "/includes/header.php";
$banner_path = __DIR__ . "/includes/banner.php";
$popular_path = __DIR__ . "/includes/popular.php";
$footer_path = __DIR__ . "/includes/footer.php";
?>
<head>
<title>Каталог одежды | 50541</title>
<?php
    require_once $head_path;
    ?>
<style>
        body {
            background-color: #eee7dd !important;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        
        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 0;
            padding: 20px 0;
            margin: 20px 0;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .product-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            margin: 0 auto;
            position: relative;
            overflow: hidden;
        }

        .image-container {
            position: relative;
            width: 100%;
            height: 350px;
        }

        .product-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 5px;
            transition: opacity 0.3s ease;
            position: absolute;
            top: 0;
            left: 0;
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
        
        .product-card h3 {
            font-size: 18px;
            margin: 15px 0 10px;
        }
        
        .product-card p {
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }
        
        .product-card button {
            background-color: #000;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
            width: 100%;
        }
        
        .product-card button:hover {
            background-color: #555;
        }
        
        .pre-order-label {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #ff6b6b;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
            z-index: 2;
        }
    </style>
</head>
<body>
    <?php
    require_once $header_path;
    ?>
    
    <div class="center-container">
        <div class="products-grid">
            <?php require_once $hoodie4_path; ?>
            <?php require_once $hoodie2_path; ?>
            <?php require_once $hoodie3_path; ?>
        </div>
    </div>
    
    <?php
    require_once $footer_path;
    ?>
</body>
</html>