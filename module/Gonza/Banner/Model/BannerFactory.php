<?php

namespace Gonza\Banner\Model;

class BannerFactory
{

    protected $_objectManager;


    /**
     * __construct
     *
     * @param  mixed $objectManager
     *
     * @return void
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager)
    {
        $this->_objectManager = $objectManager;
    }


    /**
     * create
     *
     * @param  mixed $arguments
     *
     * @return void
     */
    public function create(array $arguments = [])
    {
        return $this->_objectManager->create('Gonza\Banner\Model\Banner', $arguments, false);
    }
}