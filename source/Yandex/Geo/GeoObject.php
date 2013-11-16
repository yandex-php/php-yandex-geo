<?php
namespace Yandex\Geo;

/**
 * Class GeoObject
 * @package Yandex\Geo
 * @author Dmitry Kuznetsov <kuznetsov2d@gmail.com>
 * @license The MIT License (MIT)
 */
class GeoObject
{
    protected $_data;

    public function __construct(array $data)
    {
        $this->_data = $data;
    }

    public function __sleep()
    {
        return array('_data');
    }

    /**
     * Исходные данные
     * @return array
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
     * Широта в градусах. Имеет десятичное представление с точностью до семи знаков после запятой
     * @return float|null
     */
    public function getLatitude()
    {
        $result = null;
        if (isset($this->_data['Point']['pos'])) {
            list($latitude,) = explode(' ', $this->_data['Point']['pos']);
            $result = (float)$latitude;
        }
        return $result;
    }

    /**
     * Долгота в градусах. Имеет десятичное представление с точностью до семи знаков после запятой
     * @return float|null
     */
    public function getLongitude()
    {
        $result = null;
        if (isset($this->_data['Point']['pos'])) {
            list(, $longitude) = explode(' ', $this->_data['Point']['pos']);
            $result = (float)$longitude;
        }
        return $result;
    }

    /**
     * Адресная строка
     * @return string|null
     */
    public function getAddress()
    {
        $result = null;
        if (isset($this->_data['metaDataProperty']['GeocoderMetaData']['text'])) {
            $result = $this->_data['metaDataProperty']['GeocoderMetaData']['text'];
        }
        return $result;
    }
}