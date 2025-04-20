<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Основные favicon -->
<link rel="shortcut icon" href="/images/favicon/favicon.ico" type="image/x-icon">
<link rel="icon" href="/images/favicon.ico" type="image/x-icon">

<!-- PNG версии -->
<link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">

<!-- Для Apple устройств -->
<link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-touch-icon.png">

<!-- Отключение кэширования -->
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">


<div id="cookie-consent" class="cookie-consent">
    <div class="cookie-consent__text">
        Мы используем cookie-файлы для улучшения работы сайта. Оставаясь на сайте, вы соглашаетесь с 
        <a href="/privacy-policy" target="_blank">Политикой конфиденциальности</a>.
    </div>
    <div class="cookie-consent__buttons">
        <button id="cookie-consent-btn" class="cookie-consent__btn cookie-consent__btn--accept">Принять</button>
        <button id="cookie-reject-btn" class="cookie-consent__btn cookie-consent__btn--reject">Отклонить</button>
    </div>
</div>

<div id="cookie-rejected-message" class="cookie-rejected-message">
    <div class="cookie-rejected-message__text">
        Вы отклонили cookie<br>
        Вы не можете пользоваться сайтом, пока не примете использование cookie.<br><br>
        Пожалуйста, примите cookie, чтобы продолжить.
    </div>
    <button id="cookie-rejected-accept-btn" class="cookie-rejected-message__btn">Принять cookie</button>
</div>

<style>
/* Стили для уведомления о cookies */
.cookie-consent {
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    max-width: 90%;
    width: 100%;
    max-width: 1200px;
    background-color: #fff;
    padding: 15px 20px;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    display: flex;
    align-items: center;
    justify-content: space-between;
    z-index: 9999;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.cookie-consent__text {
    font-size: 14px;
    color: #333;
    margin-right: 15px;
    flex-grow: 1;
}

.cookie-consent__text a {
    color: #ff6b6b;
    text-decoration: underline;
}

.cookie-consent__buttons {
    display: flex;
    gap: 10px;
    flex-shrink: 0;
}

.cookie-consent__btn {
    border: none;
    border-radius: 5px;
    padding: 8px 20px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.cookie-consent__btn--accept {
    background-color: #ff6b6b;
    color: white;
}

.cookie-consent__btn--accept:hover {
    background-color: #e05555;
}

.cookie-consent__btn--reject {
    background-color: #f0f0f0;
    color: #333;
}

.cookie-consent__btn--reject:hover {
    background-color: #e0e0e0;
}

.cookie-consent.show {
    opacity: 1;
    visibility: visible;
}

/* Стили для сообщения об отклонении */
.cookie-rejected-message {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.8);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    z-index: 10000;
    color: white;
    text-align: center;
    padding: 20px;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.cookie-rejected-message.show {
    opacity: 1;
    visibility: visible;
}

.cookie-rejected-message__text {
    font-size: 18px;
    margin-bottom: 20px;
    line-height: 1.5;
}

.cookie-rejected-message__btn {
    background-color: #ff6b6b;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 25px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.cookie-rejected-message__btn:hover {
    background-color: #e05555;
}

@media (max-width: 768px) {
    .cookie-consent {
        flex-direction: column;
        text-align: center;
    }
    
    .cookie-consent__text {
        margin-right: 0;
        margin-bottom: 15px;
    }
    
    .cookie-consent__buttons {
        width: 100%;
        flex-direction: column;
        gap: 8px;
    }
    
    .cookie-consent__btn {
        width: 100%;
    }
}
</style>

<script>
// Проверяем, дал ли пользователь согласие на cookies
if (!localStorage.getItem('cookieConsent')) {
    // Показываем уведомление
    const cookieConsent = document.getElementById('cookie-consent');
    cookieConsent.classList.add('show');
    
    // Обработчик клика на кнопку "Принять"
    document.getElementById('cookie-consent-btn').addEventListener('click', function() {
        // Сохраняем согласие в localStorage
        localStorage.setItem('cookieConsent', 'true');
        // Скрываем уведомление
        cookieConsent.classList.remove('show');
    });
    
    // Обработчик клика на кнопку "Отклонить"
    document.getElementById('cookie-reject-btn').addEventListener('click', function() {
        // Сохраняем отказ в localStorage
        localStorage.setItem('cookieRejected', 'true');
        // Скрываем уведомление
        cookieConsent.classList.remove('show');
        // Показываем сообщение об отклонении
        document.getElementById('cookie-rejected-message').classList.add('show');
    });
    
    // Обработчик клика на кнопку "Принять" в сообщении об отклонении
    document.getElementById('cookie-rejected-accept-btn').addEventListener('click', function() {
        // Сохраняем согласие в localStorage
        localStorage.setItem('cookieConsent', 'true');
        localStorage.removeItem('cookieRejected');
        // Скрываем сообщение об отклонении
        document.getElementById('cookie-rejected-message').classList.remove('show');
    });
} else if (localStorage.getItem('cookieRejected')) {
    // Если пользователь ранее отклонил куки, показываем сообщение
    document.getElementById('cookie-rejected-message').classList.add('show');
}
</script>