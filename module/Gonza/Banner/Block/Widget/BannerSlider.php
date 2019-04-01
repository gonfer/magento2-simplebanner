<?php
namespace Gonza\Banner\Block\Widget;

class BannerSlider extends \Magento\Framework\View\Element\Template implements \Magento\Widget\Block\BlockInterface
{

    protected $_bannerFactory;

    protected $_template = 'widget/bannerslider.phtml';
    
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
         \Gonza\Banner\Model\BannerFactory $bannerFactory
    ) {
    	 $this->_bannerFactory = $bannerFactory;
        parent::__construct($context);
    }
    
    /**
     * getBannerImages
     *
     * @return void
     */
    public function getBannerImages(){
    	$collection = $this->_bannerFactory->create()->getCollection();
    	$group = $this->getData('group');
    	$collection->addFieldToFilter('group' ,$group );
    	$collection->addFieldToFilter('is_active' ,1 );
    	return $collection;
    }
    
    /**
     * getImageMediaPath
     *
     * @return void
     */
    public function getImageMediaPath(){
    	return $this->getUrl('pub/media',['_secure' => $this->getRequest()->isSecure()]);
    }
}