@extends('layouts/edit-form', [
    'createText' => trans('admin/models/table.create') ,
    'updateText' => trans('admin/models/table.update'),
    'topSubmit' => true,
    'helpPosition' => 'right',
    'helpText' => trans('admin/models/general.about_models_text'),
    'formAction' => (isset($item->id)) ? route('models.update', ['model' => $item->id]) : route('models.store'),
])

{{-- Page content --}}
@section('inputFields')

<!-- Name -->
<x-form-row
        :label="trans('general.name')"
        :$item
        name="name"
/>

@include ('partials.forms.edit.category-select', ['translated_name' => trans('admin/categories/general.category_name'), 'fieldname' => 'category_id', 'required' => 'true', 'category_type' => 'asset'])
@include ('partials.forms.edit.manufacturer-select', ['translated_name' => trans('general.manufacturer'), 'fieldname' => 'manufacturer_id'])

<!-- Model Number -->
<x-form-row
        :label="trans('general.model_no')"
        :$item
        name="model_number"
/>

@include ('partials.forms.edit.depreciation')

<!-- Minimum QTY -->
<x-form-row
        :label="trans('general.min_amt')"
        :$item
        name="min_amt"
        type="number"
        input_div_class="col-md-4 col-xs-9"
        info_tooltip_text="{{ trans('general.min_amt_help') }}"
        input_min="0"

/>


<!-- require serial boolean -->
<div class="form-group">
    <label for="require_serial" class="col-md-3 control-label">
        {{ trans('admin/hardware/general.require_serial') }}
    </label>

    <div class="col-md-9">
        <div class="form-inline" style="display: flex; align-items: center; gap: 8px;">
            <input type="checkbox" name="require_serial" value="1" @checked(old('require_serial', $item->require_serial)) id="require_serial" aria-label="require_serial" />
            <x-form-tooltip>
                {{ trans('admin/hardware/general.require_serial_help') }}
            </x-form-tooltip>
        </div>

    </div>
</div>
<!-- EOL -->

<x-form-row
        :label="trans('general.eol')"
        :$item
        name="eol"
        type="number"
        input_div_class="col-md-4"
        input_group_text="{{ trans('general.months') }}"
        input_group_addon="left"
        maxlength="3"
        min="0"
/>


<!-- Custom Fieldset -->
<!-- If $item->id is null we are cloning the model and we need the $model_id variable -->
@livewire('custom-field-set-default-values-for-model', ["model_id" => $item->id ?? $model_id ?? null])

<!-- Notes -->
<x-form-row
        :label="trans('general.notes')"
        :$item
        name="notes"
        type="textarea"
        placeholder="{{ trans('general.placeholders.notes') }}"
/>

@include ('partials.forms.edit.requestable', ['requestable_text' => trans('admin/models/general.requestable')])
@include ('partials.forms.edit.image-upload', ['image_path' => app('models_upload_path')])


@stop
