<?php

namespace App\Http\Controllers\Admin\Currencies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Price;
use App\Models\Logo;

class CurrencyLanguageController extends Controller
{
    public function index(){
        $prices = Price::where('status',1)->get();
      
        return view('admin.currencies.index',compact('prices'));
    }
    public function addPrices(Request $request){
        $price = Price::where('currency',$request->currency)->first();
        if($price){
            $price->simple_price = $request->low_priced;
            $price->premium_price = $request->premium_price;
            $price->symbols = $request->symbol;
            $price->update();
        }else{
            $price = new Price;
            $price->currency = $request->currency;
            $price->simple_price = $request->low_priced;
            $price->premium_price = $request->premium_price;
            $price->symbols = $request->symbol;
            $price->save();
        }
        return redirect()->back()->with('success','Successfully updated price');
        
    }
    public function delete($id){
        $price = Price::find($id);
        if(!$price){
            abort(404);
        }
        $price->delete();
        return redirect()->back()->with('success','Successfully deleted pricee');
    }
}