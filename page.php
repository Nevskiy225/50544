<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог одежды | 50541</title>
    <style>
        body {
            background-color: #eee7dd !important;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        
        /* Измененный стиль для центрирования с меньшими отступами */
        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 0; /* Убрали фиксированную высоту */
            padding: 20px 0; /* Оставили только вертикальные отступы */
            margin: 20px 0; /* Добавили небольшие отступы сверху и снизу */
        }
        
        /* Остальные стили остаются без изменений */
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
        
        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px 0; /* Уменьшенные отступы */
            margin: 10px 0; /* Уменьшенные отступы */
        }

        .product-card {
            background: white;
            border-radius: 10px;
            padding: 15px; /* Уменьшенный padding */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 300px; /* Увеличили максимальную ширину */
            margin: 0 auto;
            position: relative;
            overflow: hidden;
        }

        .image-container {
            position: relative;
            width: 100%;
            height: 350px; /* Увеличили высоту контейнера */
        }

        .product-card img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Изменили на cover для большего отображения */
            border-radius: 5px;
            transition: opacity 0.3s ease;
            position: absolute;
            top: 0;
            left: 0;
        }
        
        .product-card .hover-image {
            position: absolute;
            top: 0; /* Теперь начинается сверху */
            left: 0; /* Теперь начинается слева */
            opacity: 0;
        }
        
        .product-card:hover .main-image {
            opacity: 0;
        }
        
        .product-card:hover .hover-image {
            opacity: 1;
        }
        
        .product-card button:hover {
            background-color: #555;
        }
    </style>
    <?php
    $head_path = __DIR__ . "/includes/head.php";
    require_once $head_path;
    ?>
</head>
<body>
    <?php
    $header_path = __DIR__ . "/includes/header.php";
    $banner_path = __DIR__ . "/includes/banner.php";
    $catalog1_path = __DIR__ . "/includes/catalog1.php";
    $hoodies_dir = __DIR__ . "/includes/hoodie/hoodie1.php";
    $footer_path = __DIR__ . "/includes/footer.php";
    
    require_once $header_path;
    require_once $banner_path;
    ?>
    
    <div class="center-container">
        <?php require_once $hoodies_dir; ?>
    </div>
    
    <?php
    require_once $footer_path;
    ?>
</body>
</html>