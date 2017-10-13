<?php
class Mivec_Promotion_Adminhtml_WidgetController extends Mage_Adminhtml_Controller_Action
{
    protected function _init()
    {
        $this->loadLayout()
            ->_setActiveMenu("mivec/promotion")
            ->_addBreadcrumb("Promotion Widget" , "Promotion Widget");
        return $this;
    }

    public function indexAction()
    {
        $this->_init()
            ->_addContent($this->getLayout()->createBlock('promotion/adminhtml_widget'))
            ->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_init();
        $id     = $this->getRequest()->getParam('id');
        $model  = Mage::getModel('promotion/widget')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('widget_data', $model);
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Widget Manager'), Mage::helper('adminhtml')->__('Widget Manager'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('promotion/adminhtml_widget_edit'))
                ->_addLeft($this->getLayout()->createBlock('promotion/adminhtml_widget_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('promotion')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            $id = $this->getRequest()->getParam('id');

            /**
             * edit by mivec
             */
            unset($data['image']);
            //print_r($_FILES);exit;
            if ($_FILES) {
                $_image = self::uploadFile('image');
                if (!empty($_image)) {
                    $data['image'] = $_image;
                }
            }

            if (empty($id)) {
                $data['created_at'] = date("Y-m-d");
            }
            $data['updated_at'] = date("Y-m-d");
            $model = Mage::getModel('promotion/widget');

            $model->setData($data)
                ->setId($id);

            try {
                //print_r($model);exit;
                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('promotion')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError('Unable to find item to save');
        $this->_redirect('*/*/');
    }

    public function deleteAction() {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $model = Mage::getModel('promotion/widget');

                $model->setId($this->getRequest()->getParam('id'))
                    ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    protected function uploadFile($fileArea)
    {
        if ($_FILES && !empty($_FILES[$fileArea]['name'])) {

            try {
                //Starting upload
                $uploader = new Varien_File_Uploader($fileArea);

                // Any extention would work
                $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png','zip','rar'));
                $uploader->setAllowRenameFiles(true);

                // Set the file upload mode
                // false -> get the file directly in the specified folder
                // true -> get the file in the product like folders
                //	(file.jpg will go in something like /media/f/i/file.jpg)
                $uploader->setFilesDispersion(false);

                $_mainDir = Mivec_Promotion_Model_Widget::getImageDir();
                // We set media as the upload dir
                $path = Mage::getBaseDir('media') . DS . $_mainDir;
                $uploader->save($path, $_FILES[$fileArea]['name']);
                $attachment = $_mainDir .$uploader->getUploadedFileName();
                return $attachment;

            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream')
    {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK','');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename='.$fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die;
    }
}