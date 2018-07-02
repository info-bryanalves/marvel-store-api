<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarvelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCharacters()
    {
        $ts = time();
        $privateKey = '5bb59e1411546f36cadd64f118f8ebc64d505338';
        $apiKey = 'd95a14ad2277bd7fa3a5f6eff3b86517';
        $hash = md5("{$ts}{$privateKey}{$apiKey}");

        $query = http_build_query([
            'ts' => $ts,
            'apikey' => $apiKey,
            'hash' => $hash,
            'offset' => 0,
            'limit' => 10,
        ]);

        $options = array('http' =>
            array(
                'method' => 'GET',
                'header' => 'Content-type: application/x-www-form-urlencoded',
            )
        );

        $streamContext = stream_context_create($options);
        $result = file_get_contents('http://gateway.marvel.com/v1/public/characters?' . $query, null, $streamContext);

        $data = json_decode($result,1);

        $data['data']['results'] = array_map(function($array) {
            $array['price'] = mt_rand(10 * 10, 100 * 10) / 10;
            return $array;
        },$data['data']['results']);

        $response = [];
        foreach ($data['data']['results'] as $result) {
            $response[$result['id']] = $result;
        }

        return response()->json($response);
    }
}
