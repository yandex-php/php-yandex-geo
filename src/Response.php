<?php
namespace Yandex\Geocode;

/**
 *
 * Class Response
 *
 * @package Yandex\Geocode
 *
 * @license The MIT License (MIT)
 *
 */
class Response
{
    /**
     *
     * List
     *
     * @var \Yandex\Geocode\GeoObject[]
     *
     */
    protected $_list = array();
    /**
     *
     * Data
     *
     * @var ARRAY
     *
     */
    protected $_data;
    /**
     *
     * Init class
     *
     * @param ARRAY $data
     *
     * @return VOID
     *
     */
    public function __construct(array $data)
    {

        $this->_data = $data;

        if (isset($data['response']['GeoObjectCollection']['featureMember'])) {

            foreach ($data['response']['GeoObjectCollection']['featureMember'] as $entry) {

                $this->_list[] = new \Yandex\Geocode\GeoObject($entry['GeoObject']);

            }

        }

    }

    /**
     *
     * Initial data
     *
     * Исходные данные
     *
     * @return ARRAY
     *
     */
    public function getData()
    {

        return $this->_data;

    }

    /**
     *
     * Get list
     *
     * @return \Yandex\Geocode\GeoObject[]
     *
     */
    public function getList()
    {

        foreach ($this->_list as $list) {

            return $list;

        }

    }
    /**
     *
     * Get first
     *
     * @return NULL|GeoObject
     *
     */
    public function getFirst()
    {
        $result = null;

        if (count($this->_list)) {

            $result = $this->_list[0];

        }

        return $result;
    }
    /**
     *
     * Return initial query
     *
     * Возвращает исходный запрос
     *
     * @return STRING|NULL
     *
     */
    public function getQuery()
    {

        $result = null;

        if (isset($this->_data['response']['GeoObjectCollection']['metaDataProperty']['GeocoderResponseMetaData']['request'])) {

            $result = $this->_data['response']['GeoObjectCollection']['metaDataProperty']['GeocoderResponseMetaData']['request'];

        }

        return $result;
    }
    /**
     *
     * Amount found results
     *
     * Кол-во найденных результатов
     *
     * @return INTEGER
     *
     */
    public function getFoundCount()
    {

        $result = null;

        if (isset($this->_data['response']['GeoObjectCollection']['metaDataProperty']['GeocoderResponseMetaData']['found'])) {

            $result = (int) $this->_data['response']['GeoObjectCollection']['metaDataProperty']['GeocoderResponseMetaData']['found'];

        }

        return $result;

    }
    /**
     *
     * Latitude in degress. It has decimal performance with accuracy up to seven characters after comma
     *
     * Широта в градусах. Имеет десятичное представление с точностью до семи знаков после запятой
     *
     * @return FLOAT|NULL
     *
     */
    public function getLatitude()
    {

        $result = null;

        if (isset($this->_data['response']['GeoObjectCollection']['metaDataProperty']['GeocoderResponseMetaData']['Point']['pos'])) {

            list(, $latitude) = explode(' ', $this->_data['response']['GeoObjectCollection']['metaDataProperty']['GeocoderResponseMetaData']['Point']['pos']);

            $result = (float) $latitude;

        }

        return $result;
    }
    /**
     *
     * Longitude in degress. It has decimal performance with accucary up to seven characters after comma
     *
     * Долгота в градусах. Имеет десятичное представление с точностью до семи знаков после запятой
     *
     * @return FLOAT|NULL
     *
     */
    public function getLongitude()
    {

        $result = null;

        if (isset($this->_data['response']['GeoObjectCollection']['metaDataProperty']['GeocoderResponseMetaData']['Point']['pos'])) {

            list($longitude) = explode(' ', $this->_data['response']['GeoObjectCollection']['metaDataProperty']['GeocoderResponseMetaData']['Point']['pos']);

            $result = (float) $longitude;

        }

        return $result;

    }
}
