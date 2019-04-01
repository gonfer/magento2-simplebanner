<?php
namespace Gonza\Banner\Controller\Adminhtml\banner;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{

    protected $resultPagee;


    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }


    /**
     * execute
     *
     * @return void
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Gonza_Banner::banner');
        $resultPage->addBreadcrumb(__('Gonza'), __('Gonza'));
        $resultPage->addBreadcrumb(__('Manage item'), __('Manage Banner'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Banner'));

        return $resultPage;
    }
}
?>