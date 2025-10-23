<?php

use PHPUnit\Framework\TestCase;

require_once 'class/ProductEntity.php';
require_once 'class/CartEntity.php';
require_once 'src/product.php';

class Test_SaveCartOnFile_Cart_Success extends TestCase
{

    public function testSaveCartToFile()
    {
        $mockStorage = $this->createMock(FileStorageEntity::class);

        $mockStorage->expects($this->once())
                    ->method('save')
                    ->with(
                        $this->equalTo('test_cart.json'),
                        $this->isType('string')
                    );

        $mockStorage->method('load')
            ->willReturn([
                ['name' => 'Cafe', 'price' => 4.50],
                ['name' => 'Croissant', 'price' => 2.00]
            ]);

        $cart = new Cart($mockStorage);
        $cart->addProduct(new Product("Cafe", 4.50));
        $cart->addProduct(new Product("Croissant", 2.00));

        $this->assertEquals(6.50, $cart->getTotal());

        $cart->saveCartOnFile('test_cart.json');

        $newCart = new Cart($mockStorage);
        $newCart->loadFromFile('test_cart.json');
        $this->assertEquals(6.50, $newCart->getTotal());
    }
}