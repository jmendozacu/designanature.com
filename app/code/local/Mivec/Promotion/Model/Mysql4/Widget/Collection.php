<?php
class Mivec_Promotion_Model_Mysql4_Widget_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('promotion/widget' , 'id');
    }

    public function addAttributeToFilter($key , $value , $method='and')
    {
        if (is_array($value)) {
            foreach ($value as $val) {
                $this->_select = $method == "and" ? $this->getSelect()->where($key . '=?' , $val) : $this->getSelect()->orwhere($key . '=?' , $val);
            }
        }else{
            $this->_select = $this->getSelect()->where($key . '=?' , $value);
        }
        return $this;
    }
}