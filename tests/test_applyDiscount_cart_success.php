<?php

use PHPUnit\Framework\TestCase;

require_once 'class/ProductEntity.php';
require_once 'class/CartEntity.php';
require_once 'src/product.php';

class Test_ApplyDiscount_Cart_Success extends TestCase
{
    public function testApplyDiscountToCart()
    {
        $cart = new Cart();
        $cafe = new Product("Cafe", 3.50);
        $croissant = new Product("Croissant", 2.00);

        addProduct($cart, $cafe);
        addProduct($cart, $croissant);
        $this->assertEquals(5.50, $cart->getTotal());

        $cart->applyDiscount(10);
        $this->assertEquals(4.95, $cart->getTotal());
    }
}