<?php
class Mivec_Promotion_Block_Adminhtml_Widget_Renderer_Grid_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	
    public function render(Varien_Object $row)
    {
        $value  = $row->getData($this->getColumn()->getIndex());
        $url = Mivec_Promotion_Model_Widget::getImageUrl() . $value;

        return "<a href=\"".$url ."\" target=\"_blank\"><img width=80 height='50' src=\"".$url."\" /></a>";
    }
}
