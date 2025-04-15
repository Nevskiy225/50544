<?php
// Настройки подключения к базе данных
define('DB_HOST', 'localhost'); // Хост базы данных
define('DB_USER', 'ci34608_50541');      // Имя пользователя (замените на актуальное)
define('DB_PASS', '1029384756awi');          // Пароль пользователя (замените на актуальное)
define('DB_NAME', 'ci34608_50541');  // Название вашей базы данных

// Установка кодировки соединения
define('DB_CHARSET', 'utf8mb4');

// Создаем соединение с базой данных
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Проверяем соединение
    if ($conn->connect_error) {
        throw new Exception("Ошибка подключения к базе данных: " . $conn->connect_error);
    }
    
    // Устанавливаем кодировку
    if (!$conn->set_charset(DB_CHARSET)) {
        throw new Exception("Ошибка установки кодировки: " . $conn->error);
    }
    
    // Для удобства делаем переменную доступной глобально
    $GLOBALS['conn'] = $conn;
    
} catch (Exception $e) {
    // В случае ошибки выводим сообщение (в продакшене лучше логировать, а не выводить)
    die("Произошла ошибка: " . $e->getMessage());
}

// Функция для безопасного закрытия соединения
function closeDatabaseConnection() {
    if (isset($GLOBALS['conn']) && $GLOBALS['conn'] instanceof mysqli) {
        $GLOBALS['conn']->close();
    }
}

// Регистрируем функцию закрытия соединения при завершении скрипта
register_shutdown_function('closeDatabaseConnection');
?>