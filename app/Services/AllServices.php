<?php 
namespace App\Services;
use GuzzleHttp\Client;
use Torann\GeoIP\Facades\GeoIP;

class AllServices
{
    function getIpDetails($ip){
        $client = new Client();
        $response = $client->get("http://ip-api.com/json/$ip");
        if ($response->getStatusCode() === 200) {
            $ipDetails = json_decode($response->getBody());
            if($ipDetails->status === 'fail'){
                return null;
            }else{
                return $ipDetails;
            }
        }else{
            return null; 
        }
        return null; 
    }
    // public function getCountryCodeByIpAndLanguage($ip, $languageCode)
    // {
    //     // Get the country information based on the IP
    //     $location = GeoIP::getLocation($ip);

    //     // Check if the language is available for the country
    //     if (in_array($languageCode, $location['languages'])) {
    //         return $location['iso_code'];
    //     }

    //     // Default to a fallback country code if the language is not available
    //     return 'fallback_country_code';
    // }
}

?>