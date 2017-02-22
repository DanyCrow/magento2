<?php
/**
 * Magento 2 Training Project
 * Module Training/Helloworld
 */
namespace Training\Helloworld\Rewrite\Model;

class Product extends \Magento\Catalog\Model\Product
{

    public function getName()
    {
        $name = parent::getName();
        $name .= " (Hello World)";

        return $name;
    }

}