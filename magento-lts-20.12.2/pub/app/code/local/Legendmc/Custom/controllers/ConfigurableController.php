<?php

class Legendmc_Custom_ConfigurableController extends Mage_Core_Controller_Front_Action
{
    /**
     * @throws Mage_Core_Exception
     */
    public function updatePriceAction()
    {
        $productId = $this->getRequest()->getParam('product_id');
        $attribute = $this->getRequest()->getParam('super_attribute');

        if (empty($productId) || empty($attribute)) {
            $this->getResponse()->setBody($this->__("Product parameters were not informed."));
            return;
        }

        $priceService = new Legendmc_Custom_Services_Products($productId, $attribute);
        $price = $priceService->getPrice();

        if (!isset($price)) {
            $this->getResponse()->setBody($this->__("Price not found."));
            return;
        }

        $price = Mage::helper('core')->currency($price, true, false);

        // Enviar resposta JSON com o preço
        $this->getResponse()->setHeader('Content-Type', 'application/json');
        $this->getResponse()->setBody(Zend_Json::encode(array('price' => $price)));
    }


}