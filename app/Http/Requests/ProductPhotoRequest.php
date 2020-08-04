<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductPhotoRequest extends FormRequest
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

    public function rules()
    {
        return !$this->route('photo') ? $this->rulesCreate() : $this->rulesUpdate();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rulesCreate()
    {
        return [
            'photos' => 'required|array',
            'photos.*' => 'required|image|max:' . (3 * 1024)
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rulesUpdate()
    {
        return [
            'photo' => 'required|image|max:' . (3 * 1024)
        ];
    }
}
