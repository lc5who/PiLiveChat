<?php

declare(strict_types=1);

namespace App\Request;

use Hyperf\Validation\Request\FormRequest;

class ReplyRequest extends FormRequest
{
//    protected array $scenes = [
//        'store'=>['name','content'],
//        'update'=>['name','content'],
//    ];
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'content' => 'required|max:255',
            'keyword' => 'required|max:50',
        ];
    }
}
