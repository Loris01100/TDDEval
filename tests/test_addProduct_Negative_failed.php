<?php

use PHPUnit\Framework\TestCase;

require_once 'class/ProductEntity.php';
require_once 'class/CartEntity.php';
require_once 'src/product.php';

class InvalidPriceError extends Exception {}

Class Test_addProduct_Negative_Failed extends TestCase
{
    public function testAddNegativePriceProductToCart() 
    {
        $cart = new Cart();
        $negativeProduct = new Product("NegativeProduct", -5.00);

        $this->expectException(InvalidPriceError::class);
        $this->expectExceptionMessage("Le prix du produit ne peut pas être négatif.");
        
        addProduct($cart, $negativeProduct);
    }
}