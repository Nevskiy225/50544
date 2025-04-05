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
</body>
</html>
