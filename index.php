<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Каталог одежды | 50541</title>
    <?php
    require_once __DIR__ . "/connection.php";
    $header_path = __DIR__ . "/includes/header.php";
    $banner_path = __DIR__ . "/includes/banner.php";
    $footer_path = __DIR__ . "/includes/footer.php";
    $head_path = __DIR__ . "/includes/head.php";
    $hudi_path = __DIR__ . "/includes/hudi.php";
    // Получаем худи с ID=1 из базы данных
    $product_id = 1;
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $hoodie = $result->fetch_assoc();
    
    require_once $head_path;
    ?>
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
</head>
<body>
    <?php
    require_once $header_path;
    require_once $banner_path;
    ?>
    
<div class="center-container">
        <?php if ($hoodie): ?>
            <div class="product-card">
                <div class="image-container">
                    <img src="<?= htmlspecialchars($hoodie['main_image']) ?>" 
                         alt="<?= htmlspecialchars($hoodie['name']) ?>" 
                         class="main-image">
                    <img src="<?= htmlspecialchars($hoodie['hover_image']) ?>" 
                         alt="<?= htmlspecialchars($hoodie['name']) ?> другой ракурс" 
                         class="hover-image">
                    <?php if ($hoodie['is_preorder']): ?>
                        <div class="pre-order-label">Предзаказ</div>
                    <?php endif; ?>
                </div>
                <h3><?= htmlspecialchars($hoodie['name']) ?></h3>
                <p><?= number_format($hoodie['price'], 0, '', ' ') ?> ₽</p>
                <a href="order.php?id=<?= $hoodie['id'] ?>" class="button">Заказать</a>
            </div>
        <?php else: ?>
            <p>Худи не найдено в базе данных</p>
        <?php endif; ?>
    </div>
    
    <?php
    require_once $footer_path;
    ?>
</body>
</html>