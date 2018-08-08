<?php
namespace Yandex\Geocode;

/**
 * Class GeoObject
 * @package Yandex\Geocode
 * @license The MIT License (MIT)
 */
class GeoObject
{
    /**
     *
     * AddressHierarchy
     *
     * @var ARRAY
     *
     */
    protected $_addressHierarchy = [

        'Country'               => array('AdministrativeArea'),

        'AdministrativeArea'    => array('SubAdministrativeArea', 'Locality'),

        'SubAdministrativeArea' => array('Locality'),

        'Locality'              => array('DependentLocality', 'Thoroughfare'),

        'DependentLocality'     => array('DependentLocality', 'Thoroughfare'),

        'Thoroughfare'          => array('Premise'),

        'Premise'               => array(),

    ];
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
     * Raw data
     *
     * @var ARRAY
     *
     */
    protected $_rawData;
    /**
     *
     * Init class
     *
     * @param ARRAY $rawData
     *
     * @return VOID
     *
     */
    public function __construct(array $rawData)
    {

        $data = array(

            'Address' => $rawData['metaDataProperty']['GeocoderMetaData']['text'],

            'Kind'    => $rawData['metaDataProperty']['GeocoderMetaData']['kind'],

        );

        array_walk_recursive(

            $rawData,

            function ($value, $key) use (&$data) {

                if (in_array(

                    $key,

                    array(

                        'CountryName',

                        'CountryNameCode',

                        'AdministrativeAreaName',

                        'SubAdministrativeAreaName',

                        'LocalityName',

                        'DependentLocalityName',

                        'ThoroughfareName',

                        'PremiseNumber',

                    )

                )) {

                    $data[$key] = $value;

                }

            }

        );

        if (isset($rawData['Point']['pos'])) {

            $pos = explode(' ', $rawData['Point']['pos']);

            $data['Longitude'] = (float) $pos[0];

            $data['Latitude'] = (float) $pos[1];

        }

        $this->_data = $data;

        $this->_rawData = $rawData;

    }
    /**
     *
     * Sleep
     *
     * @return ARRAY
     *
     */
    public function __sleep()
    {

        return array('_data');

    }
    /**
     *
     * Raw data
     *
     * Необработанные данные
     *
     * @return ARRAY
     *
     */
    public function getRawData()
    {

        return $this->_rawData;

    }
    /**
     * Processed data
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
     * Latitude in degress. It has decimal performance with accuracy up to seven characters after comma
     *
     * Широта в градусах. Имеет десятичное представление с точностью до семи знаков после запятой
     *
     * @return FLOAT|NULL
     *
     */
    public function getLatitude()
    {

        return isset($this->_data['Latitude']) ? $this->_data['Latitude'] : null;

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

        return isset($this->_data['Longitude']) ? $this->_data['Longitude'] : null;

    }
    /**
     *
     * Full address
     *
     * Полный адрес
     *
     * @return STRING|NULL
     *
     */
    public function getFullAddress()
    {

        return isset($this->_data['Address']) ? $this->_data['Address'] : null;

    }
    /**
     *
     * Type
     *
     * Тип
     *
     * @return STRING|NULL
     *
     */
    public function getType()
    {
        return isset($this->_data['Kind']) ? $this->_data['Kind'] : null;
    }
    /**
     *
     * Country
     *
     * Страна
     *
     * @return STRING|NULL
     *
     */
    public function getCountry()
    {

        return isset($this->_data['CountryName']) ? $this->_data['CountryName'] : null;

    }
    /**
     *
     * Code country
     *
     * Код страны
     *
     * @return STRING|NULL
     *
     */
    public function getCountryCode()
    {

        return isset($this->_data['CountryNameCode']) ? $this->_data['CountryNameCode'] :
        null;

    }
    /**
     *
     * Region
     *
     * Область
     *
     * @return STRING|NULL
     *
     */
    public function getRegion()
    {
        return isset($this->_data['AdministrativeAreaName']) ? $this->_data['AdministrativeAreaName'] : null;
    }
    /**
     *
     * District
     *
     * Район
     *
     * @return STRING|NULL
     *
     */
    public function getDistrict()
    {

        return isset($this->_data['SubAdministrativeAreaName']) ? $this->_data['SubAdministrativeAreaName'] : null;

    }
    /**
     *
     * Locality
     *
     * Населенный пункт
     *
     * @return STRING|NULL
     *
     */
    public function getLocality()
    {

        return isset($this->_data['LocalityName']) ? $this->_data['LocalityName'] : null;

    }
    /**
     *
     *
     * @return STRING|NULL
     *
     */
    public function getDependentLocalityName()
    {

        return isset($this->_data['DependentLocalityName']) ? $this->_data['DependentLocalityName'] : null;

    }
    /**
     *
     * Street
     *
     * Улица
     *
     * @return STRING|NULL
     *
     */
    public function getStreet()
    {

        return isset($this->_data['ThoroughfareName']) ? $this->_data['ThoroughfareName'] : null;

    }
    /**
     *
     * House number
     *
     * Номер дома
     *
     * @return STRING|NULL
     *
     */
    public function getHouseNumber()
    {

        return isset($this->_data['PremiseNumber']) ? $this->_data['PremiseNumber'] : null;

    }
    /**
     *
     * Полный сырой адрес
     *
     * Full raw address
     *
     * @return ARRAY
     *
     */
    public function getRawFullAddress()
    {

        return array_unique(

            $this->_parseLevel(

                $this->_rawData['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country'],

                'Country'

            )

        );

    }
    /**
     *
     * Parse level
     *
     * @param ARRAY $level
     *
     * @param STRING $levelName
     *
     * @param ARRAY $address
     *
     * @return ARRAY
     *
     */
    protected function _parseLevel(array $level, $levelName, &$address = [])
    {
        if (!isset($this->_addressHierarchy[$levelName])) {

            return;

        }

        $nameProp = $levelName === 'Premise' ? 'PremiseNumber' : $levelName . 'Name';

        if (isset($level[$nameProp])) {

            $address[] = $level[$nameProp];

        }

        foreach ($this->_addressHierarchy[$levelName] as $child) {

            if (!isset($level[$child])) {

                continue;

            }

            $this->_parseLevel($level[$child], $child, $address);

        }

        return $address;

    }
}
