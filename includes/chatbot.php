<?php
/**
 * Чат-бот для сайта Fashion Store (стилизованный под index.css)
 */
?>
<div class="chatbot-container">
    <div class="chatbot-icon" onclick="toggleChatbot()">
        <img src="/images/gallery/chatbot-icon.png" alt="Чат-бот">
    </div>
    <div class="chatbot-window" id="chatbotWindow">
        <div class="chatbot-header">
            <div class="chatbot-avatar">
                <img src="/images/gallery/chatbot-avatar.png" alt="Аватар бота">
            </div>
            <div class="chatbot-title">
                Виртуальный помощник
            </div>
            <button class="chatbot-close" onclick="toggleChatbot()">&times;</button>
        </div>
        <div class="chatbot-messages" id="chatbotMessages">
            <div class="message bot-message">
                Привет! Я виртуальный помощник магазина Fashion Store. Чем могу помочь?
            </div>
        </div>
        <div class="chatbot-input">
            <input type="text" id="chatbotInput" placeholder="Введите ваш вопрос..." autocomplete="off">
            <button onclick="sendMessage()" class="chatbot-send-btn">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>
</div>

<style>
/* Стили чат-бота в соответствии с index.css */
.chatbot-container {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 9999;
    font-family: 'Arial', sans-serif;
}

.chatbot-icon {
    width: 60px;
    height: 60px;
    background-color: #ff6b6b;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
    transition: all 0.3s ease;
}

.chatbot-icon:hover {
    transform: scale(1.1);
    background-color: #ff5252;
}

.chatbot-icon img {
    width: 70%;
    height: 70%;
    object-fit: contain;
}

.chatbot-window {
    position: absolute;
    bottom: 70px;
    right: 0;
    width: 320px;
    background-color: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    display: none;
    flex-direction: column;
    overflow: hidden;
    transform-origin: bottom right;
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.8); }
    to { opacity: 1; transform: scale(1); }
}

.chatbot-header {
    background-color: #ff6b6b;
    color: white;
    padding: 15px;
    display: flex;
    align-items: center;
    position: relative;
}

.chatbot-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
    margin-right: 10px;
    border: 2px solid white;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.chatbot-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.chatbot-title {
    font-weight: bold;
    font-size: 16px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
}

.chatbot-close {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: white;
    font-size: 24px;
    cursor: pointer;
    opacity: 0.8;
    transition: opacity 0.2s;
    font-weight: bold;
    line-height: 1;
}

.chatbot-close:hover {
    opacity: 1;
}

.chatbot-messages {
    padding: 15px;
    height: 300px;
    overflow-y: auto;
    background-color: #ded2c2;
    display: flex;
    flex-direction: column;
}

.message {
    margin-bottom: 10px;
    padding: 10px 15px;
    border-radius: 18px;
    max-width: 80%;
    font-size: 14px;
    line-height: 1.4;
    animation: messageIn 0.2s ease;
}

@keyframes messageIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.bot-message {
    background-color: white;
    color: #333;
    align-self: flex-start;
    border-bottom-left-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    border: 1px solid #eee7dd;
}

.user-message {
    background-color: #ff6b6b;
    color: white;
    align-self: flex-end;
    border-bottom-right-radius: 5px;
    box-shadow: 0 2px 5px rgba(255, 107, 107, 0.3);
}

.chatbot-input {
    display: flex;
    padding: 15px;
    border-top: 1px solid #eee7dd;
    background-color: #ff6b6b;
}

.chatbot-input input {
    flex-grow: 1;
    padding: 12px 15px;
    border: 1px solid #eee7dd;
    border-radius: 25px;
    margin-right: 10px;
    outline: none;
    font-size: 14px;
    transition: all 0.3s ease;
    background-color: white; /* Белое поле ввода */
}

.chatbot-input input:focus {
    border-color: #ff6b6b;
    box-shadow: 0 0 0 2px rgba(255, 107, 107, 0.2);
}

.chatbot-send-btn {
    background-color: #eee7dd; /* Цвет как в index.css */
    color: #333; /* Темный цвет иконки */
    border: none;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.chatbot-send-btn:hover {
    background-color: #e0d5c5; /* Немного темнее при наведении */
    transform: scale(1.05);
}

.chatbot-send-btn i {
    font-size: 18px;
}

/* Анимация при отправке сообщения */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.chatbot-send-btn:active {
    animation: pulse 0.3s ease;
}

/* Адаптивность */
@media (max-width: 480px) {
    .chatbot-container {
        bottom: 20px;
        right: 20px;
    }
    
    .chatbot-window {
        width: calc(100vw - 40px);
        right: -20px;
    }
    
    .chatbot-icon {
        width: 50px;
        height: 50px;
    }
    
    .chatbot-messages {
        height: 250px;
    }
    
    .chatbot-input input {
        padding: 10px 12px;
    }
    
    .chatbot-send-btn {
        width: 40px;
        height: 40px;
    }
}

/* Полоса прокрутки */
.chatbot-messages::-webkit-scrollbar {
    width: 6px;
}

.chatbot-messages::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.chatbot-messages::-webkit-scrollbar-thumb {
    background: #ff6b6b;
    border-radius: 3px;
}

.chatbot-messages::-webkit-scrollbar-thumb:hover {
    background: #ff5252;
}
</style>

<script>
// Функции для работы чат-бота
function toggleChatbot() {
    const chatbotWindow = document.getElementById('chatbotWindow');
    const isVisible = chatbotWindow.style.display === 'flex';
    
    if (isVisible) {
        chatbotWindow.style.animation = 'fadeIn 0.3s ease reverse';
        setTimeout(() => {
            chatbotWindow.style.display = 'none';
        }, 250);
    } else {
        chatbotWindow.style.display = 'flex';
        chatbotWindow.style.animation = 'fadeIn 0.3s ease';
    }
    
    // Автопрокрутка вниз при открытии
    if (!isVisible) {
        setTimeout(() => {
            const messages = document.getElementById('chatbotMessages');
            messages.scrollTop = messages.scrollHeight;
        }, 100);
    }
}

function sendMessage() {
    const input = document.getElementById('chatbotInput');
    const message = input.value.trim();
    
    if (message) {
        const messagesContainer = document.getElementById('chatbotMessages');
        
        // Добавляем сообщение пользователя
        const userMessage = document.createElement('div');
        userMessage.className = 'message user-message';
        userMessage.textContent = message;
        messagesContainer.appendChild(userMessage);
        
        // Очищаем поле ввода
        input.value = '';
        
        // Прокручиваем вниз
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
        
        // Имитируем задержку ответа бота
        setTimeout(() => {
            const botResponse = document.createElement('div');
            botResponse.className = 'message bot-message';
            
            // Простые ответы на частые вопросы
            if (message.toLowerCase().includes('доставка')) {
                botResponse.textContent = 'Доставка осуществляется по всей России в течение 3-7 рабочих дней. Стоимость доставки рассчитывается при оформлении заказа.';
            } else if (message.toLowerCase().includes('размер') || message.toLowerCase().includes('размеры')) {
                botResponse.textContent = 'Размерная сетка доступна в карточке каждого товара. Если вам нужна помощь с выбором размера, укажите ваш рост и вес, и я порекомендую подходящий размер.';
            } else if (message.toLowerCase().includes('цена') || message.toLowerCase().includes('стоимость')) {
                botResponse.textContent = 'Цена указана на странице товара. Если у вас есть промокод, вы можете применить его в корзине перед оформлением заказа.';
            } else if (message.toLowerCase().includes('контакты')) {
                botResponse.textContent = 'Наши контакты: телефон +7 (XXX) XXX-XX-XX, email info@fashionstore.ru. Мы работаем с 9:00 до 21:00 без выходных.';
            } else {
                botResponse.textContent = 'Спасибо за ваш вопрос! Если я не смог помочь, вы можете связаться с нашей службой поддержки через раздел "Контакты" на сайте.';
            }
            
            messagesContainer.appendChild(botResponse);
            messagesContainer.scrollTop = messages.scrollHeight;
        }, 1000 + Math.random() * 1000); // Случайная задержка для реалистичности
    }
}

// Отправка сообщения по нажатию Enter
document.getElementById('chatbotInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        sendMessage();
    }
});

// Закрытие чата при клике вне его области
document.addEventListener('click', function(e) {
    const chatbotWindow = document.getElementById('chatbotWindow');
    const chatbotIcon = document.querySelector('.chatbot-icon');
    
    if (chatbotWindow.style.display === 'flex' && 
        !chatbotWindow.contains(e.target) && 
        !chatbotIcon.contains(e.target)) {
        toggleChatbot();
    }
});
</script>