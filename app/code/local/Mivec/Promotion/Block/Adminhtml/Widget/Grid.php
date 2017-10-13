<?php
class Mivec_Promotion_Block_Adminhtml_Widget_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId("widgetGrid");
        $this->setDefaultSort("id");
        $this->setDefaultDir("DESC");
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel("promotion/widget")->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn("id" , array(
            "header"    => "ID",
            "align"     => "right",
            "width"     => "20px",
            "index"     => "id"
        ));

        $this->addColumn("title" , array(
            "header"    => "Title",
            "align"     => "right",
            "width"     => "100px",
            "index"     => "title"
        ));

        $this->addColumn('sku',array(
            'header'    => 'SKU',
            "type"      => "text",
            'renderer'  => 'promotion/adminhtml_widget_renderer_grid_sku',
            'width'     => "50px",
            'index'     => 'entity_id',
        ));

        $this->addColumn('product',array(
            'header'    => 'Related Product',
            "type"      => "text",
            'renderer'  => 'promotion/adminhtml_widget_renderer_grid_product',
            'width'     => "100px",
            'index'     => 'entity_id',
        ));


        $this->addColumn('image',array(
            'header'    => 'Image',
            'type'      => 'image',
            'renderer'  => 'promotion/adminhtml_widget_renderer_grid_image',
            'width'     => "100px",
            'index'     => 'image',
        ));

        $this->addColumn('status', array(
            'header'    => 'Status',
            'align'     => 'left',
            'width'     => '80px',
            'index'     => 'status',
            'type'      => 'options',
            'options'   => Mivec_Promotion_Model_Status::getStatus()
        ));

        $this->addColumn('action',
            array(
                'header'    =>  'Action',
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => 'Edit',
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    ),
                    array(
                        'caption'   => 'Delete',
                        'url'       => array('base'=> '*/*/delete'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
            )
        );
        return parent::_prepareColumns();
    }
}