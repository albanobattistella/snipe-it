@extends('layouts/edit-form', [
    'createText' => trans('admin/consumables/general.create') ,
    'updateText' => trans('admin/consumables/general.update'),
    'helpPosition'  => 'right',
    'helpText' => trans('help.consumables'),
    'formAction' => (isset($item->id)) ? route('consumables.update', ['consumable' => $item->id]) : route('consumables.store'),
    'index_route' => 'consumables.index',
    'container_classes' => 'col-lg-6 col-lg-offset-3 col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0',
    'options' => [
                'back' => trans('admin/hardware/form.redirect_to_type',['type' => trans('general.previous_page')]),
                'index' => trans('admin/hardware/form.redirect_to_all', ['type' => 'consumables']),
                'item' => trans('admin/hardware/form.redirect_to_type', ['type' => trans('general.consumable')]),
               ]
])
{{-- Page content --}}
@section('inputFields')

@include ('partials.forms.edit.company-select', ['translated_name' => trans('general.company'), 'fieldname' => 'company_id'])

<!-- Name -->
<x-form-row
        :label="trans('general.name')"
        :$item
        name="name"
/>

@include ('partials.forms.edit.category-select', ['translated_name' => trans('general.category'), 'fieldname' => 'category_id', 'required' => 'true', 'category_type' => 'consumable'])
@include ('partials.forms.edit.supplier-select', ['translated_name' => trans('general.supplier'), 'fieldname' => 'supplier_id'])
@include ('partials.forms.edit.manufacturer-select', ['translated_name' => trans('general.manufacturer'), 'fieldname' => 'manufacturer_id'])
@include ('partials.forms.edit.location-select', ['translated_name' => trans('general.location'), 'fieldname' => 'location_id'])

<!-- Model Number -->
<x-form-row
        :label="trans('general.model_no')"
        :$item
        name="model_number"
/>

@include ('partials.forms.edit.item_number')

<!-- Order Number -->
<x-form-row
        :label="trans('general.order_number')"
        :$item
        name="order_number"
/>


<!--- Purchase Date -->
<x-form-row
        :label="trans('general.purchase_date')"
        :$item
        name="purchase_date"
        type="datepicker"
        input_div_class="col-md-5"
        input_icon="email"
        input_group_addon="left"
/>


<!-- Purchase Cost -->
<x-form-row
        :label="trans('general.unit_cost')"
        :$item
        name="purchase_cost"
        type="number"
        input_div_class="col-md-5"
        input_min="0"
        input_group_text="{{ $snipeSettings->default_currency }}"
        input_group_addon="left"
        maxlength="25"
        input_max="99999999999999999.000"
        input_min="0.00"
        input_step="0.001"
/>

<!-- QTY -->
<x-form-row
        :label="trans('general.quantity')"
        :$item
        name="qty"
        type="number"
        input_div_class="col-md-4"
        input_min="1"
/>

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

<!-- Notes -->
<x-form-row
        :label="trans('general.notes')"
        :$item
        name="notes"
        type="textarea"
        placeholder="{{ trans('general.placeholders.notes') }}"
/>

@include ('partials.forms.edit.image-upload', ['image_path' => app('consumables_upload_path')])

@stop
