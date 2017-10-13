<?php
class Mivec_Promotion_Block_Adminhtml_Widget extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = "adminhtml_widget";
        $this->_blockGroup = "promotion";
        $this->_headerText = "Widget Manager";
        $this->_addButtonLabel = "Add Widget";
        parent::__construct();
    }
}