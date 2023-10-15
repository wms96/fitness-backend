<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('validateNullable', function ($attribute, $value, $parameters, $validator) {
            // Your custom validation logic goes here
            // For example, let's consider a custom rule that checks if the input is either empty or a valid email.
            return !empty($value);
        });

        Validator::replacer('validateNullable', function ($message, $attribute, $rule, $parameters) {
            // Custom error message for your validation rule
            return "The $attribute field must be either not be empty .";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
