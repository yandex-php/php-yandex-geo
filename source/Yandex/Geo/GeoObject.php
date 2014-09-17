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
            list(, $latitude) = explode(' ', $this->_data['Point']['pos']);
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
            list($longitude, ) = explode(' ', $this->_data['Point']['pos']);
            $result = (float)$longitude;
        }
        return $result;
    }

    /**
     * Полный адрес
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

    /**
     * Страна
     * @return string|null
     */
    public function getCountry()
    {
        $result = null;
        if (isset($this->_data['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country']['CountryName'])) {
            $result = $this->_data['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country']['CountryName'];
        }
        return $result;
    }

    /**
     * Код страны
     * @return string|null
     */
    public function getCountryCode()
    {
        $result = null;
        if (isset($this->_data['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country']['CountryNameCode'])) {
            $result = $this->_data['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country']['CountryNameCode'];
        }
        return $result;
    }

    /**
     * Административный округ
     * @return string|null
     */
    public function getAdministrativeAreaName()
    {
        $result = null;
        if (isset($this->_data['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country']['AdministrativeArea']['AdministrativeAreaName'])) {
            $result = $this->_data['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country']['AdministrativeArea']['AdministrativeAreaName'];
        }
        return $result;
    }

    /**
     * @return string|null
     */
    public function getSubAdministrativeAreaName()
    {
        $result = null;
        if (isset($this->_data['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country']['AdministrativeArea']['SubAdministrativeArea']['SubAdministrativeAreaName'])) {
            $result = $this->_data['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country']['AdministrativeArea']['SubAdministrativeArea']['SubAdministrativeAreaName'];
        }
        return $result;
    }

    /**
     * @return string|null
     */
    public function getLocalityName()
    {
        $result = null;
        if (isset($this->_data['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country']['AdministrativeArea']['SubAdministrativeArea']['Locality']['LocalityName'])) {
            $result = $this->_data['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country']['AdministrativeArea']['SubAdministrativeArea']['Locality']['LocalityName'];
        }
        elseif(isset($this->_data['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country']['Locality']['LocalityName'])) {
            $result = $this->_data['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country']['Locality']['LocalityName'];
        }
        return $result;
    }

    /**
     * @return string|null
     */
    public function getDependentLocalityName()
    {
        $result = null;
        if (isset($this->_data['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country']['AdministrativeArea']['SubAdministrativeArea']['Locality']['DependentLocality']['DependentLocalityName'])) {
            $result = $this->_data['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country']['AdministrativeArea']['SubAdministrativeArea']['Locality']['DependentLocality']['DependentLocalityName'];
        }
        return $result;
    }

    /**
     * @return string|null
     */
    public function getThoroughfareName()
    {
        $result = null;
        if (isset($this->_data['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country']['AdministrativeArea']['SubAdministrativeArea']['Locality']['DependentLocality']['Thoroughfare']['ThoroughfareName'])) {
            $result = $this->_data['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country']['AdministrativeArea']['SubAdministrativeArea']['Locality']['DependentLocality']['Thoroughfare']['ThoroughfareName'];
        }
        return $result;
    }

    /**
     * @return int|null
     */
    public function getPremiseNumber()
    {
        $result = null;
        if (isset($this->_data['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country']['AdministrativeArea']['SubAdministrativeArea']['Locality']['DependentLocality']['Thoroughfare']['Premise']['PremiseNumber'])) {
            $result = (int)$this->_data['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country']['AdministrativeArea']['SubAdministrativeArea']['Locality']['DependentLocality']['Thoroughfare']['Premise']['PremiseNumber'];
        }
        return $result;
    }
}