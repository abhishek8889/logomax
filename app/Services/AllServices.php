<?php 
namespace App\Services;
use GuzzleHttp\Client;

class AllServices
{
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

?>