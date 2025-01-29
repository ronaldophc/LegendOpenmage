<?php

class Legendmc_Page_Block_Categories extends Mage_Core_Block_Template
{
    public function getCategories() {
        $categories = Mage::getModel('catalog/category')->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('is_active', 1)
            ->addAttributeToFilter('include_in_menu', 1)
            ->addAttributeToSort('position', 'asc');
        return $categories;
    }

    public function getProductsByCategory($category) {
        $products = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('*')
            ->addCategoryFilter($category)
            ->addAttributeToFilter('status', 1)
            ->addAttributeToFilter('visibility', 4);
        return $products;
    }
}