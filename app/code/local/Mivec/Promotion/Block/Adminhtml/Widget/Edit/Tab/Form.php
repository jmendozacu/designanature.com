<?php
class Mivec_Promotion_Block_Adminhtml_Widget_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('widget_form', array('legend'=>'Item information'));
		
      $fieldset->addField('title', 'text', array(
          'label'     => 'Title',
          'required'  => true,
          'name'      => 'title',
      ));

      $fieldset->addField("entity_id" , "text" , array(
          "label"       => "Product ID",
          "required"    => true,
          "name"        => "entity_id"
      ));

      $fieldset->addField('image', 'image', array(
          'label'     => 'Image',
          'required'  => true,
          'name'      => 'image',
      ));

      if (Mage::registry('widget_data')->getData()['id']) {
          $fieldset->addField("created_at", "text", array(
              "label" => "Create Date",
              //"name"        => "created_at",
              "read-only" => true,
          ));

          $fieldset->addField("updated_at", "text", array(
              "label" => "Updated Date",
              //"name"        => "Updated Date",
              "read-only" => true,
          ));
      }
          /*$fieldset->addField('stores', 'multiselect', array(
              'name' => 'stores[]',
              'label' => $this->__('Store View'),
              'required' => TRUE,
              'values' => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(FALSE, TRUE),
          ));
          */

          /*
	  $fieldset->addField('position' , 'select' , array(
	  		'label'		=> 'position',
			'name'		=> 'position',
			'values'	=> Mivec_Banner_Model_Position::getPositionValues()
	  ));
          */
	  
      $fieldset->addField('status', 'select', array(
          'label'     => 'Status',
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => 'Enabled',
              ),

              array(
                  'value'     => 0,
                  'label'     => 'Disabled',
              ),
          ),
      ));

     
      if ( Mage::getSingleton('adminhtml/session')->getWidgetData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getWidgetData());
          Mage::getSingleton('adminhtml/session')->getWidgetData(null);
      } elseif ( Mage::registry('widget_data') ) {
          $form->setValues(Mage::registry('widget_data')->getData());
      }
      return parent::_prepareForm();
  }
}

