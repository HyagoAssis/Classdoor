<?php

namespace App\Http\Requests\ClassifiableItem;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $name;
 * @property-read int $classification_type_id;
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'classification_type_id' => ['required', 'integer', 'exists:classification_types,id'],
            'name'                   => ['required', 'unique:classifiable_items,name'],
        ];
    }
}
