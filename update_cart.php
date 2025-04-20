<?php
session_start();
require_once __DIR__ . "/connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_key'], $_POST['quantity'])) {
    $cart_key = $_POST['cart_key'];
    $quantity = (int)$_POST['quantity'];
    
    if (isset($_SESSION['cart'][$cart_key]) && $quantity > 0) {
        $_SESSION['cart'][$cart_key]['quantity'] = $quantity;
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    exit();
}