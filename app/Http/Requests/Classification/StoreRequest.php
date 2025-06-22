<?php

namespace App\Http\Requests\Classification;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read int $value;
 * @property-read string $comment;
 * @property-read int $classifiable_item_id;
 */
class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'value'                => ['integer', 'required'],
            'comment'              => ['string', 'nullable'],
            'classifiable_item_id' => ['integer', 'required'],
            'file'                 => ['file', 'nullable'],
        ];
    }
}
