<?php
class Mivec_Promotion_Block_Adminhtml_Widget_Renderer_Grid_Sku extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $value  = $row->getData($this->getColumn()->getIndex());
        $_product = Mage::getModel('catalog/product')->load($value);
        return $_product->getSku();

        //return "<a href=\"".$url ."\" target=\"_blank\"><img width=80 src=\"".$url."\" /></a>";
    }
}