<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class reCAPTCHAT implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $jsonResponse = Http::post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('app.reCaptchaKey'),
            'reponse' => $value,
        ]);

        dd(json_encode($jsonResponse));

        /*if () {
            $fail('El reCAPTCHA no es válido');
        }*/
    }
}
