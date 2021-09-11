<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Postcode;
use App\Models\User;
use Symfony\Component\HttpFoundation\Request;

class PostcodeController extends Controller
{
    public function index()
    {
        $postcodes = Postcode::all();

        return view('postcode', [
            'distance' => '0',
            'postcodes' => $postcodes
        ]);
    }

    public function compare(Request $request)
    {
        $postcodes = Postcode::all();
        $error = null;
        $distance = 0;

        $postcodeOne = $request->input('postcodeOne');
        $postcodeTwo = $request->input('postcodeTwo');

        $postcodeModelOne = Postcode::where('postcode', $postcodeOne)->first();
        $postcodeModelTwo = Postcode::where('postcode', $postcodeTwo)->first();

        if (!isset($postcodeModelOne)) {
            $error = 'postcode one isnt listed';
        }
        if (!isset($postcodeModelTwo)) {
            $error = 'postcode two isnt listed';
        }

        if (!isset($error)) {
            $distance = $this->distance(
                $postcodeModelOne->latitude, $postcodeModelOne->longitude,
                $postcodeModelTwo->latitude, $postcodeModelTwo->longitude, 'M'
            );
        }

        return view('postcode', [
            'distance' => round($distance, 2),
            'postcodes' => $postcodes,
            'error' => $error,
        ]);
    }

    function distance($lat1, $lon1, $lat2, $lon2, $unit) {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
          return 0;
        }
        else {
          $theta = $lon1 - $lon2;
          $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
          $dist = acos($dist);
          $dist = rad2deg($dist);
          $miles = $dist * 60 * 1.1515;
          $unit = strtoupper($unit);
      
          if ($unit == "K") {
            return ($miles * 1.609344);
          } else if ($unit == "N") {
            return ($miles * 0.8684);
          } else {
            return $miles;
          }
        }
    }
}