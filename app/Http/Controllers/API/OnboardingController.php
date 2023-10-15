<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\MobileSettings;
use App\Onboarding;

class OnboardingController extends Controller
{
    public function index()
    {
        $hasOnBoarding = MobileSettings::where('key', 'Onboradring')->first()->status;
        $onboardingScreens = [];

        if ($hasOnBoarding) {
            $onboardingScreensCollection = Onboarding::with('media')->get();

            $onboardingScreens = $onboardingScreensCollection->map(function ($onboardingScreen) {
                $mediaLink = $onboardingScreen->media->first()->getUrl(); // Assuming you're using a package like "spatie/media-library"

                return [
                    'id' => $onboardingScreen->id,
                    'description' => $onboardingScreen->description,
                    'title' => $onboardingScreen->title, // Add other relevant fields here
                    'image' => env('APP_URL') . $mediaLink,
                ];
            })->toArray();
        }

        return response()->json(['hasOnBoarding' => $hasOnBoarding, 'onboardingScreens' => $onboardingScreens]);
    }
}
