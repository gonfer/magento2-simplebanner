<?php

namespace Gonza\Banner\Model;

class Status
{

    const STATUS_ENABLED = 1;

    const STATUS_DISABLED = 2;


    /**
     * getOptionArray
     *
     * @return void
     */
    public static function getOptionArray()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }


    /**
     * getAllOptions
     *
     * @return void
     */
    public function getAllOptions()
    {
        $result = [];

        foreach (self::getOptionArray() as $index => $value) {
            $result[] = ['value' => $index, 'label' => $value];
        }

        return $result;
    }


    /**
     * getOptionText
     *
     * @param  mixed $optionId
     *
     * @return void
     */
    public function getOptionText($optionId)
    {
        $options = self::getOptionArray();

        return isset($options[$optionId]) ? $options[$optionId] : null;
    }
}