<?php
/**
 * Футер сайта Fashion Store
 */
?>
<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-content">
            <!-- Левая часть - Соцсети -->
            <div class="footer-left">
                <div class="social-header">
                    <h3 class="social-title">Наши соцсети</h3>
                </div>
                <div class="social-telegram">
                    <a href="https://t.me/fashionstore" class="telegram-link" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-telegram"></i> Наш Telegram
                    </a>
                </div>
            </div>
            
            <!-- Правая часть - Информация -->
            <div class="footer-right">
                <div class="info-header">
                    <h3 class="info-title">Информация</h3>
                </div>
                <div class="info-links">
                    <a href="/privacy.php">Политика конфиденциальности</a>
                    <a href="/cookie-policy.php">Политика использования cookie</a>
                    <a href="/terms.php">Условия использования</a>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p class="copyright">&copy; <?php echo date('Y'); ?> Fashion Store. Все права защищены.</p>
        </div>
    </div>
</footer>

<style>
/* Основные стили футера */
.site-footer {
    background-color: #2a2a2a;
    color: #fff;
    padding: 40px 0 20px;
    font-family: 'Arial', sans-serif;
}

.footer-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.footer-content {
    display: flex;
    justify-content: space-between;
    padding-bottom: 30px;
    border-bottom: 1px solid #444;
}

/* Левая часть - Соцсети */
.footer-left {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.social-header {
    position: relative;
    display: inline-block;
    margin-bottom: 15px;
}

.social-title {
    color: #fff;
    font-size: 18px;
    margin: 0;
    padding-bottom: 8px;
}

.social-header:after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 2px;
    background: #ff6b6b;
}

.social-telegram {
    display: flex;
    justify-content: center;
    width: 100%;
}

.telegram-link {
    color: #ddd;
    text-decoration: none;
    font-size: 16px;
    display: inline-flex;
    align-items: center;
    transition: color 0.3s;
    padding: 8px 0;
}

.telegram-link:hover {
    color: #ff6b6b;
}

.telegram-link i {
    margin-right: 10px;
    font-size: 20px;
}

/* Правая часть - Информация */
.footer-right {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.info-header {
    position: relative;
    display: inline-block;
    margin-bottom: 15px;
}

.info-title {
    color: #fff;
    font-size: 18px;
    margin: 0;
    padding-bottom: 8px;
}

.info-header:after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 2px;
    background: #ff6b6b;
}

.info-links {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
}

.info-links a {
    color: #ccc;
    text-decoration: none;
    font-size: 14px;
    transition: color 0.3s;
    text-align: center;
}

.info-links a:hover {
    color: #ff6b6b;
}

/* Копирайт */
.footer-bottom {
    text-align: center;
    padding-top: 20px;
}

.copyright {
    color: #999;
    font-size: 14px;
    margin: 0;
}

/* Адаптивность */
@media (max-width: 768px) {
    .footer-content {
        flex-direction: column;
        align-items: center;
        gap: 30px;
    }
    
    .footer-left,
    .footer-right {
        width: 100%;
    }
}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">