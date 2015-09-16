<?php
namespace Yandex\Geo;

/**
 * Class GeoObject
 * @package Yandex\Geo
 * @author Dmitry Kuznetsov <kuznetsov2d@gmail.com>
 * @license The MIT License (MIT)
 */
class ExtendedGeoObject extends \Yandex\Geo\GeoObject
{
    static private $addressHierarchy = [
        'Country' => ['AdministrativeArea'],
        'AdministrativeArea' => ['SubAdministrativeArea'],
        'SubAdministrativeArea' => ['Locality'],
        'Locality' => ['DependentLocality', 'Thoroughfare'],
        'DependentLocality' => ['DependentLocality', 'Thoroughfare'],
        'Thoroughfare' => ['Premise'],
        'Premise' => [],
    ];
    
    /**
     * 
     * @return Array
     */
    public function getFullAddress(){
        return array_unique($this->parseLevel($this->_rawData['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country'], 'Country'));
    }
    
    /**
     * 
     * @param Array $level
     * @param String $levelName
     * @param Array $address
     * @return Array
     */
    private function parseLevel(array $level, $levelName, &$address = []) {
        if(!isset(self::$addressHierarchy[$levelName])){
            return;
        }
        $nameProp = $levelName === 'Premise' ? 'PremiseNumber' : $levelName . 'Name';
        $address[] = $level[$nameProp];

        foreach(self::$addressHierarchy[$levelName] as $child){
            if(!isset($level[$child])){
                continue;
            }
            $this->parseLevel($level[$child], $child, $address);
        }
        
        return $address;
    }
}
