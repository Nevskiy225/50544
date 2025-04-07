<!-- Популярные товары -->
<section class="featured-products">
    <div class="featured-products-container">
        <h2>Популярные товары</h2>
        <div class="products-grid">
            <div class="product-card">
                <!-- Обёртка для изображений -->
                <div class="image-container">
                    <!-- Основное изображение -->
                    <img src="images/вывцв.png" alt="Худи" class="main-image">
                <!-- Изображение при наведении -->
                    <img src="images/вццвцв.png" alt="Худи другой ракурс" class="hover-image">
                </div>
                <h3>Худи "Классический"</h3>
                <p>4 999 ₽</p>
                <button>В корзину</button>
            </div>
            
            <!-- Первый товар с предзаказом -->
            <div class="product-card">
                <div class="image-container">
                    <!-- Основное изображение -->
                    <img src="images/вывцв2.png" alt="Худи" class="main-image">
                <!-- Изображение при наведении -->
                    <img src="images/вццвцв2.png" alt="Худи другой ракурс" class="hover-image">
                    <div class="pre-order-label">Предзаказ</div>
                </div>
                <h3>Худи "Летний беспредел"</h3>
                <p>7 999 ₽</p>
                <button>Заказать</button>
            </div>
            
            <!-- Второй товар с предзаказом -->
            <div class="product-card">
                <div class="image-container">
                    <!-- Основное изображение -->
                    <img src="images/вывцв3.png" alt="Худи" class="main-image">
                <!-- Изображение при наведении -->
                    <img src="images/вццвцв3.png" alt="Худи другой ракурс" class="hover-image">
                    <div class="pre-order-label">Предзаказ</div>
                </div>
                <h3>Худи "Убица монстров"</h3>
                <p>9 999 ₽</p>
                <button>Заказать</button>
            </div>
        </div>
    </div>
</section>

<style>
    /* Общие стили для разделов с товарами (можно вынести в отдельный файл CSS) */
    .featured-products, .catalog {
        display: flex;
        justify-content: center;
        width: 100%;
        padding: 20px 0;
        background-color: #f5f5f5;
    }

    .featured-products-container, .catalog-container {
        max-width: 1200px;
        width: 100%;
        padding: 0 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .featured-products h2, .catalog h2 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 32px;
        color: #333;
    }

    .products-grid {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 30px;
        width: 100%;
    }

    .product-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 280px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    /* Обёртка для изображений */
    .product-card .image-container {
        position: relative;
        width: 100%; /* Задаем фиксированную ширину */
        height: 300px; /* Задаем фиксированную высоту */
        overflow: hidden;
    }

    .product-card .image-container img {
        width: 100%;
        height: 100%; /* Растягиваем изображения до размеров контейнера */
        object-fit: cover;  /* Обрезаем изображения, чтобы соответствовать размерам */
        transition: opacity 0.3s ease;
    }

    .product-card .main-image {
        position: relative;
        z-index: 1;
    }

    .product-card .hover-image {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 0;
        opacity: 0;
    }

    .product-card:hover .main-image {
        opacity: 0;
    }

    .product-card:hover .hover-image {
        opacity: 1;
    }

    .product-card h3 {
        margin: 15px 0;
        width: 100%;
    }

    .product-card p {
        font-size: 1.2em;
        font-weight: bold;
        color: #333;
    }

    /* Цвет кнопки "В корзину" из примера popular */
    .product-card button {
        background-color: #000000;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin-top: 10px;
        cursor: pointer;
        border-radius: 5px;
    }
    
    /* Стиль для метки предзаказа */
    .pre-order-label {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: #ff6b6b;
        color: white;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 12px;
        font-weight: bold;
        z-index: 2;
    }
</style>