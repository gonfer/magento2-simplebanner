<?php
namespace Gonza\Banner\Controller\Index;
class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * execute
     *
     * @return void
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}
