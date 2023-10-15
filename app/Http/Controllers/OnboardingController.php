<?php

namespace App\Http\Controllers;

use App\Cheque_detail;
use App\Invoice;
use App\Invoice_detail;
use App\Member;
use App\MobileSettings;
use App\Onboarding;
use App\Payment_detail;
use App\Plan;
use App\Role_user;
use App\Subscription;
use App\User;
use DB;
use Auth;
use Illuminate\Http\Request;

class OnboardingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $onboardingScreens = Onboarding::paginate(10);
        $onboardingTotal = Onboarding::get();
        $count = $onboardingTotal->count();

        return view('onboarding.index', compact('onboardingScreens', 'count'));
    }

    public function edit($id)
    {
        $onboardingScreen = Onboarding::findOrFail($id);

        return view('onboarding.edit', compact('onboardingScreen'));
    }

    public function create()
    {
        return view('onboarding.create');
    }

    public function update($id, Request $request)
    {
        //dd($request->all());
        $onboardingScreen = Onboarding::findOrFail($id);
        $onboardingScreen->update($request->all());

        if ($request->hasFile('photo')) {
            $onboardingScreen->clearMediaCollection('onboarding');
            $onboardingScreen->addMedia($request->file('photo'))->toCollection('onboarding');
        }


        $onboardingScreen->save();

        flash()->success('Onboarding details were successfully updated');

        return redirect(action('OnboardingController@edit', ['id' => $onboardingScreen->id]));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $onboardingScreenData = [
                'name' => $request->name,
                'description' => $request->description
            ];
            $onboarding = new Onboarding($onboardingScreenData);
            $onboarding->save();
            if ($request->hasFile('photo')) {
                $onboarding->addMedia($request->file('photo'))->toCollection('onboarding');
            }
            DB::commit();
            flash()->success('Member was successfully created');
            return redirect(action('OnboardingController@edit', ['id' => $onboarding->id]));
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            flash()->error('Error while creating the onboarding screen');

            return redirect(action('MembersController@index'));
        }
    }

    public function delete($id, Request $request)
    {
        Onboarding::where('id', $id)->delete();
        return back();
    }

}
