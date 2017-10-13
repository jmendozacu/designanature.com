<?php
class Mivec_Promotion_Block_Adminhtml_Widget_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('widget_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle('Widget Information');
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => 'Item Information',
          'title'     => 'Item Information',
          'content'   => $this->getLayout()->createBlock('promotion/adminhtml_widget_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}