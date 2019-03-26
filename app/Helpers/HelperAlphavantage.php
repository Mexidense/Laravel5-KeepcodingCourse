<?php

/**
 * @author Salvador Briones <salvador.briones@selectra.info>
 * @copyright Selectra
 * @since 25/03/19
 */

namespace App\Helpers;


use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Config;
use GuzzleHttp\Client;

class HelperAlphavantage {

    public static function config() {
        return [
            'api_key'  => Config::get('larastock.alphavantage_key'),
            'base_url' => Config::get('larastock.alphavantage_base_url'),
        ];
    }

    /**
     * Get call to API
     * @param $params
     * @return int|\Psr\Http\Message\StreamInterface|string|null
     */
    public static function getJsonReply($params)
    {
        $result = null;
        $config = self::config();

        $url = $config['base_url'] . '?' .
            http_build_query($params) . '&apikey=' . $config['api_key'];

        try {
            $client = new Client();
            $response = $client->request('GET', $url);
            if ($response->getStatusCode() === 200) {
                $result = $response->getBody();
            } else {
                $result = $response->getStatusCode();
            }
        } catch (GuzzleException $exception) {
            $result = $exception->getMessage();
        }

        return $result;
    }

    public static function getArrayReply($params)
    {
        return \json_decode(self::getJsonReply($params));
    }

    /**
     * Returns array with key value is date and data value is the stock value.
     * @param $results
     * @param bool $multipleValues
     * @return array
     */
    public static function processArray($results, $multipleValues = false): array
    {
        $formattedArray = [];
        foreach ($results as $key => $result) {
            if ($key !== 'Meta Data') {
                if (is_object($result)) {
                    foreach ($result as $date => $item) {
                        if (!self::isToday($date)) {
                            if (preg_match('/\d{4}-\d{2}-\d{2}$/', $date)) {
                                if ($multipleValues) {
                                    $string = '4. close';
                                    $formattedArray[$date] = $item->{$string};
                                }
                                else {
                                    $formattedArray[$date] = end($item);
                                }
                            }
                        }
                    }
                }
            }
        }
        return $formattedArray;
    }

    /**
     * Check if the day params is today.
     * @param $stockDate
     * @return bool
     */
    public static function isToday($stockDate): bool
    {
        return $stockDate == Carbon::today()->toDateString();
    }

}