<?php

use PHPUnit\Framework\TestCase;

require_once 'class/ProductEntity.php';
require_once 'class/CartEntity.php';
require_once 'src/product.php';

Class Test_addProduct_Cafe_Success extends TestCase 
{
    public function testAddProductToCart() 
    {
        $cart = new Cart();
        $cafe = new Product("Cafe", 3.50);
        $croissant = new Product("Croissant", 2.00);

        addProduct($cart, $cafe);
        addProduct($cart, $croissant);
        $this->assertEquals(5.50, $cart->getTotal());

        return $cart;
    }
}