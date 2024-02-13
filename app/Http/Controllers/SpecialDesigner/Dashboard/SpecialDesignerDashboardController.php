<?php

namespace App\Http\Controllers\SpecialDesigner\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\LogoRevision;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Auth;

class SpecialDesignerDashboardController extends Controller
{
    //
    public function index(Request $req)
    {
        $taskList = LogoRevision::with('logoDetail', 'logoDetail.media')->where([['assigned_designer_id', '=', auth()->user()->id], ['status', '=', 0]])->get();

        return view('special_designer.dashboard.index', compact('taskList'));
    }

    public function accountSetting()
    {
        return view('special_designer.account_settings.account_setting');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ],
        [
            'current_password.required' => 'Please enter your current password.',
            'new_password.required' => 'Please enter a new password.',
            'new_password.confirmed' => 'The new password confirmation does not match.',
            'new_password.min' => 'The new password must be at least :min characters long.',
        ]);

        $user = Auth::user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            return redirect()->back()->with('success', 'Password updated successfully.');
        }

        return back()->with(['error' => 'The old password is incorrect.']);
    }
}

