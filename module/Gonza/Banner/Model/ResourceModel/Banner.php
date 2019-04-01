<?php
namespace Gonza\Banner\Model\ResourceModel;

class Banner extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * _construct
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('banner', 'banner_id');
    }
}
?>