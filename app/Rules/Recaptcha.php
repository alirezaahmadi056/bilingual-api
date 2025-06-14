<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class Recaptcha implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $response = Http::post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_GOOGLE_SECRET_KEY'),
            'response'=>$value,
            'remoteip'=>request()->ip()
        ]);
        $response = json_decode($response);
    }
}
