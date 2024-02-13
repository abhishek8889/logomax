<?php

namespace App\Http\Controllers\Admin\Discount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\DiscountTranslate;
use Carbon\Carbon;

class AdminDiscountController extends Controller
{
    public function index($id = null){
        if($id){
            $discount = Discount::find($id);
        }else{
            $discount = [];
        }

        return view('admin.discount.discount',compact('discount'));
    }
    public function discountList(){
        $discounts = Discount::all();

        return view('admin.discount.discount_list',compact('discounts'));
    }
    public function addProcc(Request $request){
        
        $on_admin_lang_code = $request->session()->get('on_admin_lang_code');
        if(!($request->id)){
        $request->validate([
            'discount_name'=>'required',
            'normal_price' => 'required',
            'premium_price' => 'required',
            'from_date' => 'required',
            'to_date'=> 'required',
        ]);
        $discounts = Discount::where('default_discount',0)->get();
        foreach($discounts as $discount){
            $toDate = Carbon::parse($discount->to_date);
            $fromDate = Carbon::parse($discount->from_date);
            $checktoDate = Carbon::parse($request->to_date);
            $checkfromDate = Carbon::parse($request->from_date);
            if($checktoDate->between($toDate, $fromDate)){
                return redirect()->back()->with('error','Your dates are not justified correctly');
            }
            if($checkfromDate->between($toDate,$fromDate)){
                return redirect()->back()->with('error','Your dates are not justified correctly');
            }
            if($toDate->between($checktoDate, $checktoDate)){
                return redirect()->back()->with('error','Your dates are not justified correctly');
            }
            if($fromDate->between($checktoDate,$checkfromDate)){
                return redirect()->back()->with('error','Your dates are not justified correctly');
            }
        }

        $discount = new Discount;
        $discount->name	 = $request->discount_name;
        $discount->from_date = $request->from_date;
        $discount->to_date = $request->to_date;
        $discount->normal_logo_price = $request->normal_price;
        $discount->premium_logo_price = $request->premium_price;
        $discount->default_discount = 0;
        $discount->save();

        $discountlang = new DiscountTranslate;
        $discountlang->lang_code = $on_admin_lang_code;
        $discountlang->name = $request->discount_name;
        $discountlang->discount_id = $discount->id;
        $discountlang->save();

        return redirect()->back()->with('success','Successfully created discount');
    }else{
        $request->validate([
            'discount_name'=>'required',
            'normal_price' => 'required',
            'premium_price' => 'required',
            
        ]);
        $discounts = Discount::where([['default_discount',0],['id','!=',$request->id]])->get();

        $discount = Discount::find($request->id);
        if(!$discount){
            abort(404);
        }
        if($discount->default_discount == 0){
            $request->validate([
                'from_date' => 'required',
                'to_date'=> 'required',
            ]);

        foreach($discounts as $discount){
            $toDate = Carbon::parse($discount->to_date);
            $fromDate = Carbon::parse($discount->from_date);
            $checktoDate = Carbon::parse($request->to_date);
            $checkfromDate = Carbon::parse($request->from_date);
            if($checktoDate->between($toDate, $fromDate)){
                return redirect()->back()->with('error','Your dates are not justified correctly');
            }
            if($checkfromDate->between($toDate,$fromDate)){
                return redirect()->back()->with('error','Your dates are not justified correctly');
            }
            if($toDate->between($checktoDate, $checktoDate)){
                return redirect()->back()->with('error','Your dates are not justified correctly');
            }
            if($fromDate->between($checktoDate,$checkfromDate)){
                return redirect()->back()->with('error','Your dates are not justified correctly');
            }
        }
    }
        $discount = Discount::find($request->id);
        $discount->name	 = $request->discount_name;
        $discount->from_date = $request->from_date;
        $discount->to_date = $request->to_date;
        $discount->normal_logo_price = $request->normal_price;
        $discount->premium_logo_price = $request->premium_price;
        $discount->default_discount = $discount->default_discount;
        $discount->update();
        return redirect()->back()->with('success','Succcessfuly updated discounts');
    }
    }
    public function delete($id){
        $discount = Discount::find($id);
        if(!$discount){
            abort(404);
        }
        $discount->delete();
        return redirect()->back()->with('success','Successfully deleted data');
    }
}
