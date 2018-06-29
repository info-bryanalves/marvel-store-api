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
    public function index()
    {
        $ts = time();
        $privateKey = '5bb59e1411546f36cadd64f118f8ebc64d505338';
        $apiKey = 'd95a14ad2277bd7fa3a5f6eff3b86517';
        $hash = md5("{$ts}{$privateKey}{$apiKey}");

        $query = http_build_query([
            'ts' => $ts,
            'apikey' => $apiKey,
            'hash' => $hash,
        ]);

        $options = array('http' =>
            array(
                'method' => 'GET',
                'header' => 'Content-type: application/x-www-form-urlencoded',
            )
        );

        $streamContext = stream_context_create($options);
        $result = file_get_contents('http://gateway.marvel.com/v1/public/characters?' . $query, null, $streamContext);

        return response()->json(json_decode($result,1));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
