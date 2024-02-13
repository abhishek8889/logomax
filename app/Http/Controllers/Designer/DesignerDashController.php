<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logo;
use Auth;
use Carbon\Carbon;

class DesignerDashController extends Controller
{
    public function index(Request $request){
        $logos = Logo::where('designer_id',Auth::user()->id)->get();
        $startDateOfYear = Carbon::now()->startOfYear();
        $endDateOfYear = Carbon::now()->endOfYear();
        
        $firstDayOfMonth = Carbon::now()->startOfMonth();
        $endDateOfMonth = Carbon::now()->endOfMonth();

        $approved_logos_month = Logo::where([['designer_id',Auth::user()->id],['approved_status',1]])->whereBetween('created_at',[$firstDayOfMonth,$endDateOfMonth])->get();
        $uploaded_logos_month = Logo::where([['designer_id',Auth::user()->id]])->whereBetween('created_at',[$firstDayOfMonth,$endDateOfMonth])->get();
        

        $currentDate = Carbon::now();
        for ($i = 1; $i <= 12; $i++) {
            if($i == 1){
                $last_month = $currentDate->copy()->subMonths($i);
            }elseif($i == 12){
                $first_month = $currentDate->copy()->subMonths($i);
            }
        }
        $approved_logos_year = Logo::where([['designer_id',Auth::user()->id],['approved_status',1]])->whereBetween('created_at',[$first_month,$last_month])->get();
        $uploaded_logos_year = Logo::where([['designer_id',Auth::user()->id]])->whereBetween('created_at',[$first_month,$last_month])->get();

        $rejected_logos = Logo::where([['designer_id',Auth::user()->id],['approved_status',2]])->get();
       
        
        return view('designer.dashboard.index',compact('request','logos','approved_logos_month','approved_logos_year','uploaded_logos_month','uploaded_logos_year','rejected_logos'));
    }
    public function getStatics(Request $request){
        if($request->for == 'uploaded_logo'){   
            $endDate = Carbon::now();
            $startDate = Carbon::now()->subDays(30);
            
            $dates = [];
            $currentDate = $startDate;
            
            while ($currentDate->lte($endDate)) {
                $dates[] = $currentDate->toDateString();
                $currentDate->addDay();
            }
            foreach($dates as $date){
                $logos = Logo::where('designer_id',$request->user_id)->whereDate('created_at',$date)->get();
                $response[] = count($logos); 
            }
            return [$response,$dates];
        }elseif($request->for == 'approved_logo'){
            $endDate = Carbon::now();
            $startDate = Carbon::now()->subDays(30);
            
            $dates = [];
            $currentDate = $startDate;
            
            while ($currentDate->lte($endDate)) {
                $dates[] = $currentDate->toDateString();
                $currentDate->addDay();
            }
            foreach($dates as $date){
                $logos = Logo::where([['designer_id',$request->user_id],['approved_status',1]])->whereDate('created_at',$date)->get();
                $response[] = count($logos); 
            }
            return [$response,$dates]; 
        }elseif($request->for == 'previous_months_logo_approved'){
            $currentDate = Carbon::now();
            $previousMonths = [];

            for ($i = 1; $i <= 12; $i++) {
                $previousMonths[] = $currentDate->copy()->subMonths($i);
                $previousMonthsformat[] =$currentDate->copy()->subMonths($i)->format('Y-M');
            }
            foreach($previousMonths as $months){
                $logos = Logo::where([['designer_id',$request->user_id],['approved_status',1]])->whereMonth('created_at',$months)->get();
                $countlogos[] = count($logos);
            }
            return [$countlogos,$previousMonthsformat];
        }elseif($request->for == 'previous_months_logo_upload'){
            $currentDate = Carbon::now();
            $previousMonths = [];

            for ($i = 1; $i <= 12; $i++) {
                $previousMonths[] = $currentDate->copy()->subMonths($i);
                $previousMonthsformat[] =$currentDate->copy()->subMonths($i)->format('Y-M');
            }
            foreach($previousMonths as $months){
                $logos = Logo::where([['designer_id',$request->user_id]])->whereMonth('created_at',$months)->get();
                $countlogos[] = count($logos);
            }
            return [$countlogos,$previousMonthsformat];
        }

    }
}
