<?php
namespace Gonza\Banner\Block\Adminhtml;

class Banner extends \Magento\Backend\Block\Widget\Container
{

    protected $_template = 'banner/banner.phtml';

    /**
     * __construct
     *
     * @param  mixed $context
     * @param  mixed $data
     *
     * @return void
     */
    public function __construct(\Magento\Backend\Block\Widget\Context $context,array $data = [])
    {
        parent::__construct($context, $data);
    }

    /**
     * _prepareLayout
     *
     * @return void
     */
    protected function _prepareLayout()
    {
        $addButtonProps = [
            'id' => 'add_new',
            'label' => __('Add New'),
            'class' => 'add',
            'button_class' => '',
            'class_name' => 'Magento\Backend\Block\Widget\Button\SplitButton',
            'options' => $this->_getAddButtonOptions(),
        ];
        $this->buttonList->add('add_new', $addButtonProps);

        $this->setChild(
            'grid',
            $this->getLayout()->createBlock('Gonza\Banner\Block\Adminhtml\Banner\Grid', 'gonza.banner.grid')
        );
        return parent::_prepareLayout();
    }

    /**
     * _getAddButtonOptions
     *
     * @return void
     */
    protected function _getAddButtonOptions()
    {

        $splitButtonOptions[] = [
            'label' => __('Add New'),
            'onclick' => "setLocation('" . $this->_getCreateUrl() . "')"
        ];

        return $splitButtonOptions;
    }

    /**
     * _getCreateUrl
     *
     * @return void
     */
    protected function _getCreateUrl()
    {
        return $this->getUrl(
            'banner/*/new'
        );
    }

    /**
     * getGridHtml
     *
     * @return void
     */
    public function getGridHtml()
    {
        return $this->getChildHtml('grid');
    }

}
