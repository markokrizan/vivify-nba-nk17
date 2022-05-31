<?php

namespace App\Http\Requests;

use App\Rules\NotContains;
use Illuminate\Foundation\Http\FormRequest;

use function PHPSTORM_META\map;

class CommentRequest extends FormRequest
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
        return [
            'content' => [
                'required',
                'string',
                'min:10',
                new NotContains(['hate', 'idiot', 'stupid'])
                // 'not_regex:/hate|idiot|stupid/'  // niz zbog | u regexu
            ]
        ];
    }

    // override message if regex is used
    // public function messages()
    // {
    //     return ['content.not_regex' => 'Comment cannot contain words hate, idiot and stupid'];
    // }
}
