<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Log;

class UserRegisterAPIRequest extends FormRequest
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
  public function rules()
  {
    Log::info($this->input());
    return [
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8'],
      // 'confirm_password' => ['required', 'string', 'min:8', 'same:password'],
      'profile' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
      'type' => ['required'],
      'phone' => ['max:20'],
      'address' => ['max:255'],
      'dob' => []
    ];
  }

  /**
   * This is to response JSON if fail validations.
   * @param Validator $validator
   * @return Response error json response
   */
  protected function failedValidation(Validator $validator)
  {
    $errors = $validator->errors();

    throw new HttpResponseException(
      response()->json(['errors' => $errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
    );
  }
}
