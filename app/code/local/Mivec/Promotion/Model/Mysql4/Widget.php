<?php
class Mivec_Promotion_Model_Mysql4_Widget extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init("promotion/widget" , "id");
    }
}
