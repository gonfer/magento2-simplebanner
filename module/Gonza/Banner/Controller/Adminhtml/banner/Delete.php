<?php
namespace Gonza\Banner\Controller\Adminhtml\banner;

class Delete extends \Magento\Backend\App\Action
{

    /**
     * execute
     *
     * @return void
     */
    public function execute()
    {

        $id = $this->getRequest()->getParam('banner_id');

        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {

                $model = $this->_objectManager->create('Gonza\Banner\Model\Banner');
                $model->load($id);
                $model->delete();

                $this->messageManager->addSuccess(__('The item has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {

                $this->messageManager->addError($e->getMessage());

                return $resultRedirect->setPath('*/*/edit', ['banner_id' => $id]);
            }
        }

        $this->messageManager->addError(__('We can\'t find a item to delete.'));

        return $resultRedirect->setPath('*/*/');
    }
}
