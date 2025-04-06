<!DOCTYPE html>
<html lang="ru">
<?php
$catalog1_path = __DIR__ . "/includes/catalog1.php";
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
        /* Дополнительные стили для каталога */
        .catalog {
            padding: 50px;
        }
        
        .catalog h2 {
            font-size: 32px;
            text-align: center;
            margin-bottom: 40px;
        }
        
        .categories {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        
        .category-btn {
            padding: 10px 20px;
            background-color: #f0f0f0;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .category-btn:hover, .category-btn.active {
            background-color: #ff6b6b;
            color: white;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
        }
        
        .product-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            position: relative;
            overflow: hidden;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
        }
        
        .product-card img {
            width: 100%;
            border-radius: 5px;
            margin-bottom: 15px;
            transition: opacity 0.3s ease;
        }
        
        .product-card .hover-image {
            position: absolute;
            top: 20px;
            left: 20px;
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
            margin-bottom: 10px;
        }
        
        .product-card p {
            font-weight: bold;
            color: #ff6b6b;
            margin-bottom: 15px;
        }
        
        .product-card button {
            background-color: #333;
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
    </style>
</head>
    <body>
    <?php
    require_once $header_path;
    require_once $catalog1_path;
    require_once $footer_path
    ?>
</body>
</html>