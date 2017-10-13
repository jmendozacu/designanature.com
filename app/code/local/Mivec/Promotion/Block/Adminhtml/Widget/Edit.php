<?php
class Mivec_Promotion_Block_Adminhtml_Widget_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'promotion';
        $this->_controller = 'adminhtml_widget';

        $this->_updateButton('save', 'label', 'Save Item');
        $this->_updateButton('delete', 'label', 'Delete Item');

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('brandlogo_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'brandlogo_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'brandlogo_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('widget_data') && Mage::registry('widget_data')->getId() ) {
            return Mage::helper('promotion')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('widget_data')->getTitle()));
        } else {
            return Mage::helper('promotion')->__('Add Item');
        }
    }
}