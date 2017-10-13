<?php
class Mivec_Promotion_Model_Widget extends Mage_Core_Model_Abstract
{
    protected static $_imageDir = 'themevast' .DS .'promotion' .DS;

    protected function _construct()
    {
        parent::_construct();
        $this->_init("promotion/widget");
    }

    public static function getImageDir()
    {
        return self::$_imageDir;
        //return Mage::getBaseDir('media') . DS .self::$_imageDir;
    }

    public static function getImageUrl()
    {
        return Mage::getBaseUrl('media');
    }
}