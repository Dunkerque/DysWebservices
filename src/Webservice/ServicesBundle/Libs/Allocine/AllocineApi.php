<?php
/**
 * Created by PhpStorm.
 * User: LOPEZ
 * Date: 06/02/2016
 * Time: 21:15
 */

namespace Webservice\ServicesBundle\Libs\Allocine;


class AllocineApi
{
    private $_api_url = 'http://api.allocine.fr/rest/v3';
    private $_partner_key;
    private $_secret_key;
    private $_user_agent = 'Dalvik/1.6.0 (Linux; U; Android 4.2.2; Nexus 4 Build/JDQ39E)';

    public function __construct($partner_key, $secret_key)
    {
        $this->_partner_key = $partner_key;
        $this->_secret_key = $secret_key;
    }

    private function _do_request($method, $params)
    {
        // build the URL
        $query_url = $this->_api_url.'/'.$method;

        // new algo to build the query
        $sed = date('Ymd');
        $sig = urlencode(base64_encode(sha1($this->_secret_key.http_build_query($params).'&sed='.$sed, true)));
        $query_url .= '?'.http_build_query($params).'&sed='.$sed.'&sig='.$sig;

        // do the request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $query_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->_user_agent);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function search($query, $filter = null)
    {
        // build the params
        $params = array(
            'partner' => $this->_partner_key,
            'q' => $query,
            'format' => 'json',
            'filter' => $filter
        );

        // do the request
        $response = $this->_do_request('search', $params);

        return $response;
    }

    public function get($id, $filter)
    {
        // build the params
        $params = array(
            'partner' => $this->_partner_key,
            'code' => $id,
            'profile' => 'large',
            'filter' => $filter,
            'striptags' => 'synopsis,synopsisshort',
            'format' => 'json',
        );
        // do the request
        $response = $this->_do_request($filter, $params);
        return $response;
    }
}