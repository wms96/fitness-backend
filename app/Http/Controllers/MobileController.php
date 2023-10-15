<?php

namespace App\Http\Controllers;

use App\MobileSettings;
use App\Onboarding;
use App\Plan;
use App\Role_user;
use App\User;
use DB;
use Auth;
use Illuminate\Http\Request;

class MobileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * CRUD functions for Users.
     */
    public function settings()
    {
        $mobileSettings = MobileSettings::get();
        return view('mobileSettings.editSettings', compact('mobileSettings'));
    }


    public function update(Request $request)
    {
        if(!isset($request->mobileSettings->Onboradring)) {
            MobileSettings::where('key', 'Onboradring')->update([
                'status' => false
            ]);
        }

        if(isset($request->mobileSettings)) {
            foreach ($request->mobileSettings as $key => $value) {
                MobileSettings::where('key', $key)->update([
                    'status' => $value, // Assuming you want to update the label with the key
                    // Other columns you want to update
                    // For example, 'description' => 'Some description',
                    // 'status' => true,
                ]);
            }
        }
        return redirect('settings');
    }

}
