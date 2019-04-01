<?php
namespace Gonza\Banner\Controller\Adminhtml\banner;

use Magento\Backend\App\Action;
use Magento\Framework\App\Filesystem\DirectoryList;


class Save extends \Magento\Backend\App\Action
{

    /**
     * __construct
     *
     * @param  mixed $context
     *
     * @return void
     */
    public function __construct(Action\Context $context)
    {
        parent::__construct($context);
    }

    /**
     * execute
     *
     * @return void
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        
        
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $model = $this->_objectManager->create('Gonza\Banner\Model\Banner');

            $id = $this->getRequest()->getParam('banner_id');
            if ($id) {
                $model->load($id);
                $model->setCreatedAt(date('Y-m-d H:i:s'));
            }
			try{
				$uploader = $this->_objectManager->create(
					'Magento\MediaStorage\Model\File\Uploader',
					['fileId' => 'image']
				);
				$uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);

				$imageAdapter = $this->_objectManager->get('Magento\Framework\Image\AdapterFactory')->create();
				$uploader->setAllowRenameFiles(true);
				$uploader->setFilesDispersion(true);

				$mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
					->getDirectoryRead(DirectoryList::MEDIA);
				$result = $uploader->save($mediaDirectory->getAbsolutePath('emizen_banner'));
					if($result['error']==0)
					{
						$data['image'] = 'emizen_banner' . $result['file'];
					}
			} catch (\Exception $e) {
				//unset($data['image']);
            }

			if(isset($data['image']['delete']) && $data['image']['delete'] == '1')
				$data['image'] = '';
			if(isset($data['image']['value']) && strlen($data['image']['value']) > 1)
                         	$data['image'] = $data['image']['value'];
            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('The Banner has been saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['banner_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Banner.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['banner_id' => $this->getRequest()->getParam('banner_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
