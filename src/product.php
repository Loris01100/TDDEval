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