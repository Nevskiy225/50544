<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>50541 – Магазин модной одежды</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
<!-- Шапка сайта -->
<header class="main-header">
    <div class="logo">
        <a href="index.html" aria-label="На главную">Fashion Store</a>
    </div>
    
    <nav class="main-nav" aria-label="Основное меню">
        <ul>
            <li><a href="#" aria-current="page">Главная</a></li>
            <li><a href="catalog.html">Каталог</a></li>
            <li><a href="about.html">О нас</a></li>
            <li><a href="contacts.html">Контакты</a></li>
        </ul>
    </nav>
    
    <div class="user-actions">
        <button class="search-btn" aria-label="Поиск">
            <i class="fas fa-search"></i>
        </button>
        <a href="account.html" class="user-btn" aria-label="Личный кабинет">
            <i class="fas fa-user"></i>
        </a>
        <a href="cart.html" class="cart-btn" aria-label="Корзина">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-counter">0</span>
        </a>
    </div>
</header>
</body>
</html>