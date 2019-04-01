<?php

namespace Gonza\Banner\Model\Config;

class BannerGroups implements \Magento\Framework\Option\ArrayInterface
{


    protected $_bannerFactory;
    
    /**
     * __construct
     *
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Gonza\Banner\Model\bannerFactory $bannerFactory
     * @param \Gonza\Banner\Model\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     * 
     * @return void
     */
    public function __construct(\Gonza\Banner\Model\BannerFactory $bannerFactory) {
        $this->_bannerFactory = $bannerFactory;
    }
    
    
    /**
     * toOptionArray
     *
     * @return void
     */
    public function toOptionArray()
    {
    	$optionArray = array();
    	foreach($this->toArray() as $arr){
    		$optionArray[] = array( 'value' => $arr , 'label' => $arr);
    	}
        return $optionArray;
    }

    /**
     * toArray
     *
     * @return void
     */
    public function toArray()
    {
    	$group = array();
    	$collection = $this->_bannerFactory->create()->getCollection();
    	
    	foreach($collection as $banner){
    		$group[$banner->getGroup()]  = $banner->getGroup();
    	}
        return $group;
    }
}