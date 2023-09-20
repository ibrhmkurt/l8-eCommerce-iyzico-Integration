<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        //unique validasyonunda update formda kurtulmak için id gönderilir ve blade de hidden input olarak eklenir.
        $user_id = $this->request->get('user_id');
        return [
            "name" => "required|min:3",
            "email" => "required|email|unique:App\Models\User,email,$user_id",
            "password" => "required|sometimes|string|min:5|confirmed"
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "Bu alan zorunludur.",
            "name.min" => "Ad soyad alanı en az 3 karakterden oluşmalıdır.",
            "email.required" => "Bu alan zorunludur.",
            "email.email" => "Girdiğiniz değer e-posta formatında olmalıdır.",
            "email.unique" => "Girdiğiniz e-posta sistemde kayıtlıdır.",
            "password.required" => "Bu alan zorunludur.",
            "password.min" => "Şifre alanı en az 5 karakterden oluşmalıdır.",
            "password.confirmed" => "Girilen şifreler aynı değil.",
            "password_confirmation.required" => "Bu alan zorunludur.",
            "password_confirmation.min" => "Şifre Tekrarı alanı en az 5 karakterden oluşmalıdır.",
            "password_confirmation.confirmed" => "Girilen şifreler aynı değil."
        ];
    }
}
