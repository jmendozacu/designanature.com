<?php
class Mivec_Support_Model_Mysql4_Message extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init("support/message" , "id");
    }
}