<?php

class SM_Imagecc_Block_Form_Cc extends Mage_Payment_Block_Form_Ccsave
{
    protected function _construct()
    {
        parent::_construct();
        $mark = Mage::getConfig()->getBlockClassName('core/template');
        $mark = new $mark;
        $mark->setTemplate('sm/checkout/cc.phtml');
        $this->setMethodLabelAfterHtml($mark->toHtml());
        $this->setTemplate('payment/form/cc.phtml');
    }
}