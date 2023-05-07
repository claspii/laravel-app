<?php
namespace App\Services;

use GoogleMaps\Service\GeocodingService;
class GoogleApiService{
    protected $geocodingService;
    
    public function __contstruct()
    {
        // $this->geocodingService  = new \GoogleMaps();
        // $this->geocodingService->geocodingService(env('GOOGLE_API_KEY'));
    }
    public function getLocationFromAddress($address)
    {
        $response  = $this->geocodingService->geocode($address);
        $location = $response->first()->geometry->location;
        return $location;
    }
    public function getNearLocation()
    {

    }
}
