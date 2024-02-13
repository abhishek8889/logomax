<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CurrencyRate;
use Illuminate\Support\Facades\Log;


class UpdateCurrency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-currency';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            Log::info('Update currency cron running.....');
            $apikey = env('CURRENCY_API_KEY');

            $from_Currency = 'USD';
            $response_json = file_get_contents("https://v6.exchangerate-api.com/v6/{$apikey}/latest/{$from_Currency}");
            
            if($response_json){
                $response = json_decode($response_json);
            }
            
            $allcurrencyrates = (array)$response->conversion_rates;
            $currencies = ['AED','AUD','CAD','CHF','CLP','COP','GBP','HKD','ILS','INR','MYR','MXN','NZD','PEN','PHP','PKR','SGD','ZAR'];
            
            foreach($currencies as $currency){
                $price = CurrencyRate::where('currency',$currency)->first();
                if($price){
                    $price->usd_price = 1;
                    $price->currency = $currency;
                    $price->exchange_price	= $allcurrencyrates[$currency];
                    $price->update();
                }else{
                    $price = new CurrencyRate;
                    $price->usd_price = 1;
                    $price->currency = $currency;
                    $price->exchange_price	= $allcurrencyrates[$currency];
                    $price->save();
                }
            }       
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            Log::error('Error in assigned job : '.$error_message);
        }
    }
}
