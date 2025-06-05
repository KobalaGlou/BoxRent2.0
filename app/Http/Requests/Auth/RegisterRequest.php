<?php

namespace App\Http\Requests\Auth;

use App\Rules\UsernameRule;
use App\Rules\ValidCaptcha;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', "min:6", 'max:255'],
            'email' => ['required', 'string', 'email:rfc,dns'],
            'password' => ['required','string','min:8'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->emailExists() || $this->usernameExists()) {
                $validator->errors()->add('email', 'Impossible de créer un compte avec ces informations.');
            }
        });
    }

    protected function emailExists(): bool
    {
        return \App\Models\User::where('email', $this->input('email'))->exists();
    }

    protected function usernameExists(): bool
    {
        return \App\Models\User::where('name', $this->input('name'))->exists();
    }

    public function messages(): array
    {
        return [
            'name.min' => 'Le pseudo doit contenir au moins :min caractères.',
            'name.required' => 'Le pseudo est requis.',
            'email.required' => 'L’adresse e-mail est requise.',
            'email.email' => 'L’adresse e-mail doit être valide.',
            'password.required' => 'Le mot de passe est requis.',
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
            'captcha.required' => 'Le CAPTCHA est requis.',
            'cgu.accepted' => 'Vous devez accepter les conditions d’utilisation.',
        ];
    }
}
