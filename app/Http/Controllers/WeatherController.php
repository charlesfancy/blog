<?php

namespace App\Http\Controllers;

use App\Models\weather;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    protected $client;
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client;
        $this->baseUrl = 'https://opendata.cwb.gov.tw/api/v1/rest/datastore/O-A0001-001?Authorization=';
        $this->apiKey = 'CWB-4AA4B92D-7C94-4E1D-AC31-2F04A3FFDF8B';
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $client = new Client();
        $res = $client->request('GET', 'https://opendata.cwb.gov.tw/api/v1/rest/datastore/O-A0001-001?Authorization=CWB-4AA4B92D-7C94-4E1D-AC31-2F04A3FFDF8B');
        // $res = $this->client->request('GET', $url . '?' . http_build_query($query));
        dd($res->getBody());
        $body = json_decode($res->getBody(), true);
        

        dd($body);
        // dd($body);
        // $res = $client->request('GET', '/redirect/3');
        // echo $res->getStatusCode();

        // $client = new Client();

        // $response = $client->post('https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-D0047-073?Authorization=CWB-4AA4B92D-7C94-4E1D-AC31-2F04A3FFDF8B', [
        //     RequestOptions::JSON => ['foo' => 'bar']
        // ]);

        
  

    //     $client = new Client(); 
    //     $res = $client->post('https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-D0047-073?Authorization=CWB-4AA4B92D-7C94-4E1D-AC31-2F04A3FFDF8B
    //     ', [
    //         'headers' => ['Authorization'=>'your-key'
    //         ],
    //         'json' => [
    //             'data-name' => 'value'
    //         ]
    //     ]);
    //     $weather = Weather::all();

    //     $body = json_decode($res->getBody(), true);

    //     // $client = new Client(); 
    //     // $result = $client->post('https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-D0047-073?Authorization=CWB-4AA4B92D-7C94-4E1D-AC31-2F04A3FFDF8B
    //     // ');

        // dd($response);

        

        return view('weather.index', compact('weathers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\weather  $weather
     * @return \Illuminate\Http\Response
     */
    public function show(weather $weather)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\weather  $weather
     * @return \Illuminate\Http\Response
     */
    public function edit(weather $weather)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\weather  $weather
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, weather $weather)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\weather  $weather
     * @return \Illuminate\Http\Response
     */
    public function destroy(weather $weather)
    {
        //
    }
}
