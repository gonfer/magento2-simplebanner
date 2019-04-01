<?php

namespace Gonza\Banner\Controller\Adminhtml\banner;

use Magento\Backend\App\Action;

class Edit extends \Magento\Backend\App\Action
{

    protected $_coreRegistry = null;


    protected $resultPageFactory;

    /**
     * __construct
     * @param Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     *
     * @return void
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }

    /**
     * _isAllowed
     *
     * @return void
     */
    protected function _isAllowed()
    {
        return true;
    }

    /**
     * _initAction
     *
     * @return void
     */
    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Gonza_Banner::banner')
            ->addBreadcrumb(__('Gonza Banner'), __('Gonza Banner'))
            ->addBreadcrumb(__('Manage Item'), __('Manage Item'));
        return $resultPage;
    }

    /**
     * execute
     *
     * @return void
     */
    public function execute()
    {

        $id = $this->getRequest()->getParam('banner_id');
        $model = $this->_objectManager->create('Gonza\Banner\Model\Banner');


        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This item no longer exists.'));

                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        $this->_coreRegistry->register('banner', $model);

        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(__('Gonza'), __('Gonza'));
        $resultPage->addBreadcrumb(
            $id ? __('Edit Item') : __('New Item'),
            $id ? __('Edit Item') : __('New Item')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Edit Item'));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getTitle() : __('New Item'));

        return $resultPage;
    }
}
