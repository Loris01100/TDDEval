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
        $livre = new Product("Livre", 20);

        addProduct($cart, $livre);
        $this->assertEquals(20, $cart->getTotal());

        $cart->applyDiscount(10);
        $this->assertEquals(18, $cart->getTotal());
    }
}