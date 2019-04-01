<?php
namespace Gonza\Banner\Model;

class Banner extends \Magento\Framework\Model\AbstractModel
{

    /**
     * _construct
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Gonza\Banner\Model\ResourceModel\Banner');
    }
}
?>