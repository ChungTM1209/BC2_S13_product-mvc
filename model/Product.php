<?php
/**
 * Created by PhpStorm.
 * User: chungtran
 * Date: 13/02/2019
 * Time: 14:03
 */

namespace Model;
class Product
{
    public $id;
    public $name;
    public $price;
    public $description;
    public $manufacture;

    public function __construct($name, $price, $description, $manufacture)
    {
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->manufacture = $manufacture;
    }
}