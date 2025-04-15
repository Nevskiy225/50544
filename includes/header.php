<?php 
session_start(); // Добавьте эту строку в самое начало
?>
<header class="main-header">
    <div class="container">
        <div class="header-content">
            <!-- Логотип -->
            <div class="logo">
                <a href="index.php" aria-label="На главную">
                    <img src="/images/logo.png" alt="Логотип компании" width="182.9" height="102.9">
                </a>
            </div>
            
            <!-- Кнопка корзины (видна всегда) -->
            <div class="user-actions">
                <a href="cart.php" class="cart-btn" aria-label="Корзина">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-counter">
                        <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                    </span>
                </a>
            </div>
            
            <!-- Кнопка мобильного меню -->
            <button class="mobile-menu-btn" aria-label="Открыть меню" aria-expanded="false">
                <span class="menu-line"></span>
                <span class="menu-line"></span>
                <span class="menu-line"></span>
            </button>
            
            <!-- Навигация -->
            <nav class="main-nav" aria-label="Основное меню">
                <ul class="nav-list">
                    <li><a href="/index.php">Главная</a></li>
                    <li><a href="/catalog.php">Каталог</a></li>
                    <li><a href="/about.php">О нас</a></li>
                    <li><a href="/contacts.php">Контакты</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<style>
    /* Базовые стили */
    .main-header {
            background-color: #eee7dd !important;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 15px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 100;
    }
    
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }
    
    .header-content {
        display: flex;
        align-items: center;
        padding: 15px 0;
        position: relative;
    }
    
    /* Логотип */
    .logo {
        flex: 0 0 auto;
        margin-right: 40px;
    }
    
    .logo img {
        width: 182.9px;
        height: 102.9px;
        transition: transform 0.3s;
    }
    
    .logo img:hover {
        transform: scale(1.05);
    }
    
    /* Навигация */
    .main-nav {
        flex: 1;
        margin: 0 20px;
    }
    
    .nav-list {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        justify-content: center;
    }
    
    .nav-list li {
        margin: 0 15px;
    }
    
    .nav-list a {
        color: #333;
        text-decoration: none;
        font-weight: 500;
        font-size: 16px;
        padding: 8px 12px;
        border-radius: 4px;
        transition: all 0.3s;
    }
    
    .nav-list a:hover {
        color: #ff6b6b;
        background-color: rgba(255, 107, 107, 0.1);
    }
    
    /* Корзина */
    .user-actions {
        margin-left: auto;
        order: 2; /* Для мобильной версии */
    }
    
    .cart-btn {
        position: relative;
        color: #333;
        font-size: 20px;
        padding: 8px;
    }
    
    .cart-counter {
        position: absolute;
        top: -5px;
        right: -5px;
        background-color: #ff6b6b;
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: bold;
    }
    
    /* Мобильное меню */
    .mobile-menu-btn {
        display: none;
        background: none;
        border: none;
        cursor: pointer;
        padding: 10px;
        z-index: 1001;
        order: 3; /* Для мобильной версии */
    }
    
    .menu-line {
        display: block;
        width: 25px;
        height: 2px;
        background-color: #333;
        margin: 5px 0;
        transition: all 0.3s;
    }
    
    /* Адаптация для мобильных */
    @media (max-width: 768px) {
        .header-content {
            justify-content: space-between;
            flex-wrap: wrap;
        }
        
        .logo {
            order: 1;
            margin-right: 0;
            flex: 0 0 auto;
        }
        
        .logo img {
            width: 150px;
            height: auto;
        }
        
        .user-actions {
            order: 2;
            margin-left: 0;
        }
        
        .mobile-menu-btn {
            display: block;
            order: 3;
        }
        
        .main-nav {
            order: 4;
            flex: 0 0 100%;
            position: fixed;
            top: 0;
            right: -100%;
            width: 80%;
            max-width: 300px;
            height: 100vh;
            background-color: #fff;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
            transition: right 0.3s;
            padding-top: 70px;
            z-index: 1000;
            margin: 0;
        }
        
        .main-nav.active {
            right: 0;
        }
        
        .nav-list {
            flex-direction: column;
            padding: 20px;
        }
        
        .nav-list li {
            margin: 10px 0;
        }
        
        .nav-list a {
            display: block;
            padding: 12px 15px;
        }
        
        .mobile-menu-btn.active .menu-line:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }
        
        .mobile-menu-btn.active .menu-line:nth-child(2) {
            opacity: 0;
        }
        
        .mobile-menu-btn.active .menu-line:nth-child(3) {
            transform: rotate(-45deg) translate(5px, -5px);
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuBtn = document.querySelector('.mobile-menu-btn');
        const mainNav = document.querySelector('.main-nav');
        
        menuBtn.addEventListener('click', function() {
            this.classList.toggle('active');
            mainNav.classList.toggle('active');
            this.setAttribute('aria-expanded', this.classList.contains('active'));
        });
        
        const navLinks = document.querySelectorAll('.nav-list a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    menuBtn.classList.remove('active');
                    mainNav.classList.remove('active');
                    menuBtn.setAttribute('aria-expanded', 'false');
                }
            });
        });
    });
</script>