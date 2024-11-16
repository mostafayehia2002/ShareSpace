<?php

namespace App\Http\Requests;

use App\Traits\HttpResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RegisterRequest extends FormRequest
{
    use HttpResponse;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|max:8',
            'photo' => 'image|mimes:jpg,jpeg,png|max:20480', // 20MB max
        ];
    }
    protected function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator): void
    {
        $errors = $validator->errors()->getMessages();
        if(isApiRequest($this)) {
            throw new ValidationException($validator,
                $this->returnValidationError(422,formatErrors($errors))
            );
        }
        parent::failedValidation($validator);
    }

}
