<?php 
session_start();
?>
<header class="main-header">
    <div class="container">
        <div class="header-content">
            <!-- Логотип -->
            <div class="logo">
                <a href="index.php" aria-label="На главную" class="logo-link">
                    <img src="/images/logo.png" alt="Логотип компании" width="182.9" height="102.9">
                </a>
            </div>
            
            <!-- Навигация -->
            <nav class="main-nav" aria-label="Основное меню">
                <ul class="nav-list">
                    <li><a href="/index.php" class="nav-link">Главная</a></li>
                    <li><a href="/catalog.php" class="nav-link">Каталог</a></li>
                    <li><a href="/about.php" class="nav-link">О нас</a></li>
                    <li><a href="/contacts.php" class="nav-link">Контакты</a></li>
                    
                    <!-- Корзина в мобильном меню -->
                    <li class="mobile-cart-item">
                        <a href="cart.php" class="nav-link">
                            <i class="fas fa-shopping-cart"></i>
                            Корзина
                            <span class="cart-counter">
                                <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                            </span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<style>
* {
    -webkit-tap-highlight-color: transparent;
}
    /* Базовые стили */
    .main-header {
        background-color: #eee7dd !important;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 15px 0;
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
        justify-content: center;
        flex-wrap: wrap;
        padding: 15px 0;
        position: relative;
        gap: 40px;
    }
    
    /* Логотип */
    .logo {
        order: 1;
        transition: opacity 0.4s ease, transform 0.4s ease;
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
        order: 2;
    }
    
    .nav-list {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 20px;
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
    
    .cart-counter {
        background-color: #ff6b6b;
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: bold;
        margin-left: 5px;
    }
    
   /* Адаптация для мобильных */
    @media (max-width: 992px) {
        .header-content {
            justify-content: space-between;
            gap: 20px;
        }
        
        .logo {
            order: 1;
            flex: 1;
            text-align: center;
            cursor: pointer;
            z-index: 1000;
            position: relative;
        }
        
        .main-nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-color: rgba(238, 231, 221, 0.98);
            z-index: 999;
            padding-top: 120px;
            transform: translateX(-100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            visibility: hidden;
            opacity: 0;
        }
        
        .main-nav.active {
            transform: translateX(0);
            visibility: visible;
            opacity: 1;
        }
        
        .logo.active img {
            transform: scale(0.9);
            opacity: 0;
            transition: all 0.05s ease;
        }
        
        .nav-list {
            flex-direction: column;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 0 20px;
        }
        
        .nav-list li {
            width: 100%;
            text-align: center;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 22px;
            padding: 20px;
            margin: 5px 0;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 100%;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            background-color: rgba(255, 107, 107, 0.2);
            transform: scale(1.02);
        }
        
        /* Стили для счетчика корзины в мобильном меню */
        .mobile-cart-item .cart-counter {
            width: 25px;
            height: 25px;
            font-size: 14px;
        }
    }
    
    @media (max-width: 768px) {
        .logo img {
            width: 250px;
            height: auto;
        }
        
        .nav-link {
            font-size: 20px;
            padding: 18px;
        }
    }
    
    @media (max-width: 480px) {
        .nav-link {
            font-size: 18px;
            padding: 16px;
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const logoLink = document.querySelector('.logo-link');
        const logo = document.querySelector('.logo');
        const mainNav = document.querySelector('.main-nav');
        const navLinks = document.querySelectorAll('.nav-link');
        
        if (window.innerWidth <= 992) {
            let touchStartX = 0;
            let currentPosition = 0;
            let isDragging = false;
            
            // Инициализация
            closeMenu(true); // Сразу скрываем меню

            // Касание началось
            mainNav.addEventListener('touchstart', function(e) {
                if (!mainNav.classList.contains('active')) return;
                
                touchStartX = e.touches[0].clientX;
                isDragging = true;
                mainNav.style.transition = 'none';
            });

            // Движение пальца
            mainNav.addEventListener('touchmove', function(e) {
                if (!isDragging) return;
                
                const touchX = e.touches[0].clientX;
                const diff = touchX - touchStartX;
                
                // Вычисляем новую позицию (не даем уйти вправо)
                currentPosition = Math.min(0, Math.max(-window.innerWidth, diff));
                
                mainNav.style.transform = `translateX(${currentPosition}px)`;
            });

            // Касание закончилось
            mainNav.addEventListener('touchend', function() {
                if (!isDragging) return;
                isDragging = false;
                
                mainNav.style.transition = 'transform 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
                
                // Определяем, закрывать или оставить меню
                const threshold = window.innerWidth * 0.2; // 20% ширины экрана
                if (currentPosition < -threshold) {
                    closeMenu();
                } else {
                    openMenu();
                }
            });

            function openMenu(immediate = false) {
                if (immediate) {
                    mainNav.style.transition = 'none';
                }
                currentPosition = 0;
                mainNav.style.transform = 'translateX(0)';
                mainNav.classList.add('active');
                logo.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeMenu(immediate = false) {
                if (immediate) {
                    mainNav.style.transition = 'none';
                }
                currentPosition = -window.innerWidth;
                mainNav.style.transform = `translateX(${-window.innerWidth}px)`;
                mainNav.classList.remove('active');
                logo.classList.remove('active');
                document.body.style.overflow = '';
                
                if (immediate) {
                    setTimeout(() => {
                        mainNav.style.transition = '';
                    }, 10);
                }
            }

            // Оригинальные обработчики
            logoLink.addEventListener('click', function(e) {
                if (mainNav.classList.contains('active')) return true;
                
                e.preventDefault();
                openMenu();
            });

            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    if (link.getAttribute('href') === '/index.php') return true;
                    
                    e.preventDefault();
                    closeMenu();
                    setTimeout(() => {
                        window.location.href = link.getAttribute('href');
                    }, 300);
                });
            });

            window.addEventListener('resize', function() {
                if (window.innerWidth > 992) {
                    mainNav.style.transform = '';
                    mainNav.classList.remove('active');
                    logo.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        }
    });
</script>