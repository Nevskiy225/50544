<header class="main-header">
    <div class="logo">
        <a href="index.html" aria-label="На главную">
            <img src="/images/logo.png" alt="Логотип компании" width="190" height="120">
        </a>
    </div>
    
    <nav class="main-nav" aria-label="Основное меню">
        <ul>
            <li><a href="/page.php" aria-current="page">Главная</a></li>
            <li><a href="/catalog.php">Каталог</a></li>
            <li><a href="/about.php">О нас</a></li>
            <li><a href="/contacts.php">Контакты</a></li>
        </ul>
    </nav>
    
        <div class="user-actions">
        <a href="cart.php" class="cart-btn" aria-label="Корзина">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-counter">
                <?php 
                // Отображаем количество товаров в корзине
                echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
                ?>
            </span>
        </a>
    </div>
</header>