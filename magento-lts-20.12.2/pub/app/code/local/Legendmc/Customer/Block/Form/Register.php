<?php

class Legendmc_Customer_Block_Form_Register extends Mage_Customer_Block_Form_Register
{
    protected function getWhatsAppLink(): string
    {
        return "https://api.whatsapp.com/send?phone=42984147386";
    }
}