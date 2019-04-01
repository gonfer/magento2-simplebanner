<?php
namespace Gonza\Banner\Model\ResourceModel\Banner;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * _construct
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Gonza\Banner\Model\Banner', 'Gonza\Banner\Model\ResourceModel\Banner');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>