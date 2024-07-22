<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceSettingRequest extends FormRequest
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
        return [
            'warehouse_id' => 'nullable|exists:warehouses,id',
            'invoice_prefix' => 'nullable|string|max:255',
            'invoice_logo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'invoice_logo_text_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'invoice_watermark_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'invoice_logo_file.required' => 'The invoice logo is required',
            'invoice_logo_file.image' => 'The invoice logo must be an image',
            'invoice_logo_file.mimes' => 'The invoice logo must be a file of type: jpeg, png, jpg, gif, svg',
            'invoice_logo_file.max' => 'The invoice logo may not be greater than 2048 kilobytes',
            'invoice_logo_text_file.image' => 'The invoice logo text must be an image',
            'invoice_logo_text_file.mimes' => 'The invoice logo text must be a file of type: jpeg, png, jpg, gif, svg',
            'invoice_logo_text_file.max' => 'The invoice logo text may not be greater than 2048 kilobytes',
            'invoice_watermark_file.required' => 'The invoice watermark is required',
            'invoice_watermark_file.image' => 'The invoice watermark must be an image',
            'invoice_watermark_file.mimes' => 'The invoice watermark must be a file of type: jpeg, png, jpg, gif, svg',
            'invoice_watermark_file.max' => 'The invoice watermark may not be greater than 2048 kilobytes',
        ];
    }

    public function attributes()
    {
        return [
            'warehouse_id' => 'Warehouse',
            'invoice_prefix' => 'Invoice Prefix',
            'invoice_logo_file' => 'Invoice Logo',
            'invoice_logo_text_file' => 'Invoice Logo Text',
            'invoice_watermark_file' => 'Invoice Watermark',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'warehouse_id' => $this->warehouse_id ?? null,
            'invoice_prefix' => $this->invoice_prefix ?? null,
        ]);
    }
}
