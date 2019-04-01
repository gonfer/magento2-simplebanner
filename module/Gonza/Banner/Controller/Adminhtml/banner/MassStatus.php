<?php
namespace Gonza\Banner\Controller\Adminhtml\banner;

use Magento\Backend\App\Action;

class MassStatus extends \Magento\Backend\App\Action
{

    /**
     * execute
     *
     * @return void
     */
    public function execute()
    {
        $itemIds = $this->getRequest()->getParam('banner');
        if (!is_array($itemIds) || empty($itemIds)) {
            $this->messageManager->addError(__('Please select item(s).'));
        } else {
            try {
                $status = (int) $this->getRequest()->getParam('status');
                foreach ($itemIds as $postId) {
                    $post = $this->_objectManager->get('Gonza\Banner\Model\Banner')->load($postId);
                    $post->setIsActive($status)->save();
                }
                $this->messageManager->addSuccess(
                    __('A total of %1 record(s) have been updated.', count($itemIds))
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        return $this->resultRedirectFactory->create()->setPath('banner/*/index');
    }

}
