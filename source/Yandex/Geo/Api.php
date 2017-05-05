<?php
namespace Yandex\Geo;

/**
 * Class Api
 * @package Yandex\Geo
 * @license The MIT License (MIT)
 * @see http://api.yandex.ru/maps/doc/geocoder/desc/concepts/About.xml
 */
class Api
{
    /** дом */
    const KIND_HOUSE = 'house';
    /** улица */
    const KIND_STREET = 'street';
    /** станция метро */
    const KIND_METRO = 'metro';
    /** район города */
    const KIND_DISTRICT = 'district';
    /** населенный пункт (город/поселок/деревня/село/...) */
    const KIND_LOCALITY = 'locality';
    /** русский (по умолчанию) */
    const LANG_RU = 'ru-RU';
    /** украинский */
    const LANG_UA = 'uk-UA';
    /** белорусский */
    const LANG_BY = 'be-BY';
    /** американский английский */
    const LANG_US = 'en-US';
    /** британский английский */
    const LANG_BR = 'en-BR';
    /** турецкий (только для карты Турции) */
    const LANG_TR = 'tr-TR';
    /**
     * @var string Версия используемого api
     */
    protected $_version = '1.x';
    /**
     * @var array
     */
    protected $_filters = array();
    /**
     * @var \Yandex\Geo\Response|null
     */
    protected $_response;

    /**
     * @param null|string $version
     */
    public function __construct($version = null)
    {
        if (!empty($version)) {
            $this->_version = (string)$version;
        }
        $this->clear();
    }

    /**
     * @param array $options Curl options
     * @return $this
     * @throws Exception
     * @throws Exception\CurlError
     * @throws Exception\ServerError
     */
    public function load(array $options = [])
    {
        $apiUrl = sprintf('https://geocode-maps.yandex.ru/%s/?%s', $this->_version, http_build_query($this->_filters));
        $curl = curl_init($apiUrl);
        $options += array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HTTPGET => 1,
            CURLOPT_FOLLOWLOCATION => 1,
        );
        curl_setopt_array($curl, $options);
        $data = curl_exec($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (curl_errno($curl)) {
            $error = curl_error($curl);
            curl_close($curl);
            throw new \Yandex\Geo\Exception\CurlError($error);
        }
        curl_close($curl);
        if (in_array($code, array(500, 502))) {
            $msg = strip_tags($data);
            throw new \Yandex\Geo\Exception\ServerError(trim($msg), $code);
        }
        $data = json_decode($data, true);
        if (empty($data)) {
            $msg = sprintf('Can\'t load data by url: %s', $apiUrl);
            throw new \Yandex\Geo\Exception($msg);
        }

        $this->_response = new \Yandex\Geo\Response($data);

        return $this;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->_response;
    }

    /**
     * Очистка фильтров гео-кодирования
     * @return self
     */
    public function clear()
    {
        $this->_filters = array(
            'format' => 'json'
        );
        // указываем явно значения по-умолчанию
        $this
            ->setLang(self::LANG_RU)
            ->setOffset(0)
            ->setLimit(10);
//            ->useAreaLimit(false);
        $this->_response = null;
        return $this;
    }

    /**
     * Гео-кодирование по координатам
     * @see http://api.yandex.ru/maps/doc/geocoder/desc/concepts/input_params.xml#geocode-format
     * @param float $longitude Долгота в градусах
     * @param float $latitude Широта в градусах
     * @return self
     */
    public function setPoint($longitude, $latitude)
    {
        $longitude = (float)$longitude;
        $latitude = (float)$latitude;
        $this->_filters['geocode'] = sprintf('%F,%F', $longitude, $latitude);
        return $this;
    }

    /**
     * Географическая область поиска объекта
     * @param float $lengthLng Разница между максимальной и минимальной долготой в градусах
     * @param float $lengthLat Разница между максимальной и минимальной широтой в градусах
     * @param null|float $longitude Долгота в градусах
     * @param null|float $latitude Широта в градусах
     * @return self
     */
    public function setArea($lengthLng, $lengthLat, $longitude = null, $latitude = null)
    {
        $lengthLng = (float)$lengthLng;
        $lengthLat = (float)$lengthLat;
        $this->_filters['spn'] = sprintf('%f,%f', $lengthLng, $lengthLat);
        if (!empty($longitude) && !empty($latitude)) {
            $longitude = (float)$longitude;
            $latitude = (float)$latitude;
            $this->_filters['ll'] = sprintf('%f,%f', $longitude, $latitude);
        }
        return $this;
    }

    /**
     * Позволяет ограничить поиск объектов областью, заданной self::setArea()
     * @param boolean $areaLimit
     * @return self
     */
    public function useAreaLimit($areaLimit)
    {
        $this->_filters['rspn'] = $areaLimit ? 1 : 0;
        return $this;
    }

    /**
     * Гео-кодирование по запросу (адрес/координаты)
     * @param string $query
     * @return self
     */
    public function setQuery($query)
    {
        $this->_filters['geocode'] = (string)$query;
        return $this;
    }

    /**
     * Вид топонима (только для обратного геокодирования)
     * @param string $kind
     * @return self
     */
    public function setKind($kind)
    {
        $this->_filters['kind'] = (string)$kind;
        return $this;
    }

    /**
     * Максимальное количество возвращаемых объектов (по-умолчанию 10)
     * @param int $limit
     * @return self
     */
    public function setLimit($limit)
    {
        $this->_filters['results'] = (int)$limit;
        return $this;
    }

    /**
     * Количество объектов в ответе (начиная с первого), которое необходимо пропустить
     * @param int $offset
     * @return self
     */
    public function setOffset($offset)
    {
        $this->_filters['skip'] = (int)$offset;
        return $this;
    }

    /**
     * Предпочитаемый язык описания объектов
     * @param string $lang
     * @return self
     */
    public function setLang($lang)
    {
        $this->_filters['lang'] = (string)$lang;
        return $this;
    }

    /**
     * Ключ API Яндекс.Карт
     * @see http://api.yandex.ru/maps/form.xml
     * @param string $token
     * @return self
     */
    public function setToken($token)
    {
        $this->_filters['key'] = (string)$token;
        return $this;
    }
}
