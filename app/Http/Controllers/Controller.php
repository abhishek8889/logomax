<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected $siteData;
    public function __construct(Request $request){
        $userIp = $request->ip(); // Get the user's IP address
        $timezone = $this->getTimezoneByIP($userIp);
        $this->siteData['user_timezone'] = $userIp;

        if ($timezone !== null) {
            $this->siteData['user_timezone'] = $timezone;
            // Config::set('app.timezone', $timezone);
        } else {
            // Config::set('app.timezone', 'America/New_York');
            $this->siteData['user_timezone'] = 'Asia/Kolkata';
        }
    }
    function getTimezoneByIP($ip){
        $client = new Client();
        $response = $client->get("http://ip-api.com/json/$ip");
        if ($response->getStatusCode() === 200) {
            $data = json_decode($response->getBody());
            if($data->status === 'fail'){
                return null;
            }else{
                return $data->timezone;
            }
        }else{
            return null; 
        }
        return null; 
    }
}
