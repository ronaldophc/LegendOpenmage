<?php

class Legendmc_Custom_Services_Products
{
    private $productId;
    private $attribute;
    private $attributeCode;
    private $attributeId;

    public function __construct($productId, $attribute)
    {
        $this->productId = $productId;
        $this->attribute = $attribute;
        $this->attributeCode = 'type_vip';
        $this->attributeId = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $this->attributeCode)->getId();
    }

    public function getPrice()
    {
        $attributeValue = $this->getAttributeValue();

        if (!isset($attributeValue)) {
            Mage::log('Attribute value not found');
            return null;
        }

        $originalProduct = Mage::getModel('catalog/product')->load($this->productId);

        if (!isset($originalProduct)) {
            Mage::log('Product Configurable not found');
            return null;
        }

        if ($originalProduct->getTypeId() != Mage_Catalog_Model_Product_Type::TYPE_CONFIGURABLE) {
            Mage::log('Product is not configurable');
            return null;
        }

        $configurableProduct = Mage::getModel('catalog/product_type_configurable')->getUsedProducts(null, $originalProduct);

        $product = $this->getFinalProduct($configurableProduct, $attributeValue);

        if (!isset($product)) {
            Mage::log('Product not found');
            return null;
        }

        return $product->getFinalPrice();
    }

    private function getFinalProduct($configurableProduct, $attributeValue)
    {
        foreach ($configurableProduct as $product) {
            if ($product->getTypeVip() == $attributeValue) {
                return Mage::getModel('catalog/product')->load($product->getId());
            }
        }
    }

    private function getAttributeValue()
    {
        foreach ($this->attribute as $key => $value) {
            if ($key == $this->attributeId) {
                return $value;
            }
        }
    }
}