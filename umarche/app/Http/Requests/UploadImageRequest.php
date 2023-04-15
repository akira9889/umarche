<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
            'files.*.image' => 'image|mimes:jpg,jpeg,png|max:2048',
        ];

        if (\Route::currentRouteName() === 'owner.images.store') {
            $rules = array_merge($rules, [
                'files' => 'required',
            ],);
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'image' => '指定されたファイルが画像ではありません。',
            'mimes' => '指定された拡張子(jpg/jpeg/png)ではありません。',
            'max' => 'ファイルサイズは2MB以内にしてください。',
            'files.*.image.max' => '個々のファイルサイズは2MB以内にしてください。'
        ];
    }
}
