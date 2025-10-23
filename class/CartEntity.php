<?php

require_once 'class/ProductEntity.php';
require_once 'class/FileStorageEntity.php';

class Cart 
{
    private $products = [];
    private $storage;

    public function __construct($storage = null)
    {
        $this->storage = $storage;
    }


    //fonction pour ajouter un produit dans un panier, le produit est ajouter dans un tableau de produits
    public function addProduct(Product $product) 
    {
        $this->products[] = $product;
        $this->addExceptionOnProduct($product);
    }

    //fonction pour obtenir le total du panier
    public function getTotal() 
    {
        $total = 0;
        foreach ($this->products as $product) 
        {
            $total += $product->getPrice();
        }
        return $total;
    }

    //fonction pour supprimer un produit du panier
    public function deleteProduct(Product $product)
    {
        foreach ($this->products as $index => $p) 
        {
        if ($p->getName() === $product->getName() && $p->getPrice() === $product->getPrice()) 
            {
            unset($this->products[$index]);

            $this->products = array_values($this->products);
            break;
            }
        }
    }

    public function applyDiscount(float $discountPercentage) 
    {
        foreach ($this->products as $product) 
        {
            $newPrice = $product->getPrice() * (1 - $discountPercentage / 100);
            $product->setPrice($newPrice);
        }
    }

    public function addExceptionOnProduct(Product $product) 
    {
        if ($product->getPrice() < 0) 
        {
            throw new InvalidPriceError("Le prix du produit ne peut pas être négatif.");
        }
    }

    public function saveCartOnFile($filename) 
    {
        if ($this->storage === null) {
            throw new \RuntimeException("Aucun storage n'a été fourni au Cart.");
        }
        $data = [];
        foreach ($this->products as $product) 
        {
            $data[] = [
                'name' => $product->getName(),
                'price' => $product->getPrice()
            ];
        }
        $this->storage->save($filename, json_encode($data));
    }

    public function loadFromFile(string $filename): void
    {
        if ($this->storage === null) {
            throw new \RuntimeException("Aucun storage n'a été fourni au Cart.");
        }
        $items = $this->storage->load($filename);
        $this->products = [];
        if (is_array($items)) {
            foreach ($items as $item) {
                $this->products[] = new Product($item['name'], (float)$item['price']);
            }
        }
    }
}