<?php

namespace lo\plugins\dto;

use lo\plugins\helpers\JsonHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Class ShortcodesDiffDto
 * @package lo\plugins\dto
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class ShortcodesDiffDto
{
    protected $_data = [];

    /**
     * ShortcodesDiffDto constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        foreach ($data as $item) {
            $diff['handler_class'] = ArrayHelper::getValue($item, 'handler_class');
            $config = ArrayHelper::getValue($item, 'data', null);
            if ($config) {
                $diff['data'] = $this->prepareConfig($config); // if added new config
            }
            $this->_data[$diff['handler_class']] = Json::encode($diff);
        }
    }

    /**
     * @return array
     */
    public function getDiff()
    {
        return $this->_data;
    }

    /**
     * @param $data
     * @return array
     */
    protected function prepareConfig($data)
    {
        return array_keys(JsonHelper::decode($data));
    }
}