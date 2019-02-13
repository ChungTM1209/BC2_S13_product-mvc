<?php
/**
 * Created by PhpStorm.
 * User: chungtran
 * Date: 13/02/2019
 * Time: 14:03
 */

namespace Model;

use PDO;

class ProductDB
{
    public $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM products";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $products = [];
        foreach ($result as $item) {
            $product = new Product($item['name'], $item['price'], $item['description'], $item['manufacture']);
            $product->id = $item['id'];
            $products[] = $product;
        }
        return $products;
    }

    public function add($product)
    {
        $sql = "INSERT INTO products(name,price,description,manufacture) VALUES (?,?,?,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $product->name);
        $stmt->bindParam(2, $product->price);
        $stmt->bindParam(3, $product->description);
        $stmt->bindParam(4, $product->manufacture);
        return $stmt->execute();
    }

    public function get($id)
    {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $row = $stmt->fetch();
        $product = new Product($row['name'], $row['price'], $row['description'], $row['manufacture']);
        $product->id = $row['id'];
        return $product;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $id);
        return $stmt->execute();
    }

    public function update($id, $product)
    {
        $sql = "UPDATE products SET name = ?, price = ?, description = ?, manufacture = ? WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $product->name);
        $stmt->bindParam(2, $product->price);
        $stmt->bindParam(3, $product->description);
        $stmt->bindParam(4, $product->manufacture);
        $stmt->bindParam(5, $id);
        return $stmt->execute();
    }

}