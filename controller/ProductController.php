<?php
/**
 * Created by PhpStorm.
 * User: chungtran
 * Date: 13/02/2019
 * Time: 14:03
 */

namespace Controller;

use Model\DBConnection;
use Model\ProductDB;
use Model\Product;

class ProductController
{
    public $productDB;

    public function __construct()
    {
        $connection = new DBConnection("mysql:host=localhost;dbname=products-mvc", "ChungTM1209", "Vod@nh1209");
        $this->productDB = new ProductDB($connection->connect());
    }

    public function index()
    {
        $products = $this->productDB->getAll();
        include 'view/list.php';
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            include 'view/add.php';
        } else {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $manufacture = $_POST['manufacture'];
            $product = new Product($name, $price, $description, $manufacture);
            $this->productDB->add($product);
            $message = 'Customer created';
            include 'view/add.php';

        }
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = $_GET['id'];
            $product = $this->productDB->get($id);
            include 'view/delete.php';
        } else {
            $id = $_POST['id'];
            $this->productDB->delete($id);
            header('Location: index.php');
        }
    }

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = $_GET['id'];
            $product = $this->productDB->get($id);
            include 'view/edit.php';
        } else {
            $id = $_POST['id'];
            $product = new Product($_POST['name'], $_POST['price'], $_POST['description'], $_POST['manufacture']);
            $this->productDB->update($id, $product);
            header('Location: index.php');
        }
    }
}
