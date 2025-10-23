<?php

//main qui appelle les fonctions depuis les classes
require_once 'class/ProductEntity.php';
require_once 'class/CartEntity.php';

function addProduct(Cart $cart, Product $product) 
{
    $cart->addProduct($product);
}

function deleteProduct(Cart $cart, Product $product) 
{
    $cart->deleteProduct($product);
}

function applyDiscountProduct(Cart $cart, float $discountPercentage) 
{
    $cart->applyDiscount($discountPercentage);
}

function saveCartToFile(Cart $cart, string $filename) 
{
    $cart->saveCartOnFile($filename);
}

function loadCartFromFile(Cart $cart, string $filename): void
{
    $cart->loadFromFile($filename);
}