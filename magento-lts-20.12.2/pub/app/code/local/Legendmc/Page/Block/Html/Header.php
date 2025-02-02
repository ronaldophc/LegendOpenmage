<?php

class Legendmc_Page_Block_Html_Header extends Mage_Page_Block_Html_Header
{

    public function getWhatsAppNumber()
    {
        return Mage::getStoreConfig('legendmc_custom/configs/whatsapp_number');
    }

    public function getWhatsAppOnlyNumber()
    {
        $number = $this->getWhatsAppNumber();
        return preg_replace('/\D/', '', $number);
    }

    public function getWhatsAppLink()
    {
        $number = $this->getWhatsAppOnlyNumber();
        return 'https://api.whatsapp.com/send/?phone=' . $number;
    }

    /**<?php if (Mage::getStoreConfig('legendmc_custom/configs/active')) : ?>
        <div class="col-2">
            <a href="<?= $this->getWhatsAppLink() ?>" target="_blank">
                <i class="fab fa-whatsapp"></i>
                <?= $this->getWhatsAppNumber() ?>
            </a>
        </div>
    <?php endif; ?>*/
}