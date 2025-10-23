<?php

use PHPUnit\Framework\TestCase;

require_once 'class/ProductEntity.php';
require_once 'class/CartEntity.php';
require_once 'src/product.php';

class test_deleteProduct_cart_success extends TestCase
{
    public function testDeleteProductFromCart()
    {
        $cart = new Cart();
        $cafe = new Product("Cafe", 3.50);
        $croissant = new Product("Croissant", 2.00);

        addProduct($cart, $cafe);
        addProduct($cart, $croissant);
        $this->assertEquals(5.50, $cart->getTotal());

        deleteProduct($cart, $cafe);
        $this->assertEquals(2.00, $cart->getTotal());
    }
}