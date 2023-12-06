<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Auth;

class HelperController extends Controller
{
    public static function getGpsFromIp() {
        $ip = \Request::ip();
        $data = \Location::get($ip);

        $return = ['ip' => $ip, 'data' => $data];

        return $return;
    }

    public static function getGeoLocation($latitude,$longitude){
        if (!empty($latitude) && !empty($longitude)) {
            //Send request and receive json data by address
            $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.trim($longitude).'&sensor=false&key='.env('GEOCODE_KEY');
            $geocodeFromLatLong = file_get_contents($url);
            $output = json_decode($geocodeFromLatLong);

            $data = [
                'plus_code' => $output->plus_code,
                'results' => $output->results[0],
                'status' => $output->status
            ];

            $global_code = substr(trim($data['plus_code']->global_code), 0, 6);

            //Get address from json data
            $global_code = ($data['status']=="OK") ? $global_code : '';

            //Return place_id of the given latitude and longitude
            if (!empty($global_code)) {
                $return = [
                    'place_id' => $global_code,
                    'detail_location' => json_encode($data)
                ];
                return $return;
            } else {
                return false;
            }
        } else {
         return false;   
        }
    }

    public static function getGeoLocationTimezone($latitude,$longitude){
        if (!empty($latitude) && !empty($longitude)) {
            $time = time();
            $url = "https://maps.googleapis.com/maps/api/timezone/json?location=$latitude,$longitude&timestamp=$time&key=".env('GEOCODE_KEY');
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $responseJson = curl_exec($ch);
            curl_close($ch);

            $response = json_decode($responseJson);

            //Return place_id of the given latitude and longitude
            if ($response->status == 'OK') {
                $return = $response;
                return $return;
            } else {
                return false;
            }
        } else {
         return false;   
        }
    }

    public static function getDistanceBetweenPoints($lat1, $lon1, $lat2, $lon2) {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('miles','feet','yards','kilometers','meters'); 
    }

    public static function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000) {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);
        
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;
        
        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }

    public static function getGeoLocation2($latitude,$longitude){
        $formatted_address = '-';

        if (!empty($latitude) && !empty($longitude)) {
            //Send request and receive json data by address
            $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.trim($longitude).'&sensor=false&key='.env('GEOCODE_KEY');
            $geocodeFromLatLong = file_get_contents($url);
            $output = json_decode($geocodeFromLatLong);
            
            if (isset($output->results[0]->formatted_address)) {
                $formatted_address = $output->results[0]->formatted_address;
            }
        }

        return $formatted_address;
    }

    public static function hari_ini($hari){
        $hari = date("D", $hari);
     
        switch($hari){
            case 'Sun':
                $hari_ini = "Minggu";
            break;
     
            case 'Mon':			
                $hari_ini = "Senin";
            break;
     
            case 'Tue':
                $hari_ini = "Selasa";
            break;
     
            case 'Wed':
                $hari_ini = "Rabu";
            break;
     
            case 'Thu':
                $hari_ini = "Kamis";
            break;
     
            case 'Fri':
                $hari_ini = "Jumat";
            break;
     
            case 'Sat':
                $hari_ini = "Sabtu";
            break;
            
            default:
                $hari_ini = "Tidak di ketahui";		
            break;
        }
     
        return $hari_ini;
     
    }

    public static function hak_akses(){
        
        $user = Auth::User();
        }
     
}
