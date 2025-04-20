<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты | 50541</title>
    <?php
    require_once __DIR__ . "/includes/head.php";
    require_once __DIR__ . "/includes/header.php";
    ?>
    <link rel="stylesheet" href="/css/contacts.css">
</head>
<body class="contacts-page">
    <?php require_once __DIR__ . "/includes/header.php"; ?>
    
    <main class="contacts-main">
        <section class="contacts-section container">
            <h1 class="contacts-title">Наши контакты</h1>

            <div class="contact-grid">
                <!-- Адрес -->
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h2 class="contact-heading">Адрес</h2>
                    <p>г. Нижний Новгород, ул. Бекетова, д. 6</p>
                    <p>Офис 530, 5 этаж</p>
                </div>

                <!-- Телефоны -->
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h2 class="contact-heading">Телефоны</h2>
                    <p><a href="tel:+79990761840">+7 (999) 076-18-40</a></p>
                    <p><a href="tel:+79049214568">+7 (904) 921-45-68</a></p>
                </div>

                <!-- Email -->
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h2 class="contact-heading">Электронная почта</h2>
                    <p><a href="mailto:50541sup@gmail.com">50541sup@gmail.com</a></p>
                </div>

                <!-- Часы работы -->
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h2 class="contact-heading">Часы работы</h2>
                    <p>Пн-Пт: 10:00 - 21:00</p>
                    <p>Сб-Вс: 12:00 - 20:00</p>
                </div>

                <!-- Соцсети -->
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fab fa-vk"></i>
                    </div>
                    <h2 class="contact-heading">ВКонтакте</h2>
                    <p><a href="https://vk.com/club230178208" target="_blank" rel="noopener">Наша группа ВК</a></p>
                </div>

                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fab fa-telegram"></i>
                    </div>
                    <h2 class="contact-heading">Telegram</h2>
                    <p><a href="https://t.me/shop50541" target="_blank" rel="noopener">Наш канал в Telegram</a></p>
                </div>
                 <div class="contact-card instagram-card">
        <div class="contact-icon">
            <i class="fab fa-instagram"></i>
        </div>
        <h2 class="contact-heading">Instagram</h2>
        <p><a href="https://www.instagram.com/50541_shop" target="_blank">Наш Instagram "Запрещённо на территории РФ"</a></p>
        </div>
        </div>

           <div class="map-container">
    <iframe 
        src="https://yandex.ru/map-widget/v1/?um=constructor%3A1a2b3c4d5e6f7g8h9i0j&amp;source=constructor&amp;scroll=false&amp;lang=ru_RU&amp;mode=search&amp;text=%D0%93.%20%D0%9D%D0%B8%D0%B6%D0%BD%D0%B8%D0%B9%20%D0%9D%D0%BE%D0%B2%D0%B3%D0%BE%D1%80%D0%BE%D0%B4%2C%20%D1%83%D0%BB.%20%D0%91%D0%B5%D0%BA%D0%B5%D1%82%D0%BE%D0%B2%D0%B0%2C%20%D0%B4.%206" 
        width="100%" 
        height="400" 
        frameborder="0"
        title="Карта с местоположением 50541"
        aria-label="Карта с местоположением 50541"
        allowfullscreen="true">
    </iframe>
</div>
        </section>
    </main>

    <?php require_once __DIR__ . "/includes/footer.php"; ?>
</body>
</html>