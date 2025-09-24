@extends('layouts/edit-form', [
    'createText' => trans('admin/suppliers/table.create') ,
    'updateText' => trans('admin/suppliers/table.update'),
    'helpTitle' => trans('admin/suppliers/table.about_suppliers_title'),
    'helpText' => trans('admin/suppliers/table.about_suppliers_text'),
    'formAction' => (isset($item->id)) ? route('suppliers.update', ['supplier' => $item->id]) : route('suppliers.store'),
])


{{-- Page content --}}
@section('inputFields')

    <!-- Name -->
    <x-form-row
            :label="trans('general.name')"
            :$item
            name="name"
    />

    @include ('partials.forms.edit.address')

    <!-- Contact -->
    <x-form-row
            :label="trans('admin/suppliers/table.contact')"
            :$item
            name="contact"
    />


    <!-- Phone -->
    <x-form-row
            :label="trans('general.phone')"
            :$item
            name="phone"
            type="tel"
    />

    <!-- Fax -->
    <x-form-row
            :label="trans('general.fax')"
            :$item
            name="fax"
            type="tel"
    />

    <!-- Email -->
    <x-form-row
            :label="trans('general.email')"
            :$item
            name="email"
            type="email"
    />

    <!-- URL -->
    <x-form-row
            :label="trans('general.url')"
            :$item
            name="url"
            type="url"
    />

    @include ('partials.forms.edit.image-upload', ['image_path' => app('suppliers_upload_path')])

    <!-- Notes -->
    <x-form-row
            :label="trans('general.notes')"
            :$item
            name="notes"
            type="textarea"
            maxlength="65000"
            placeholder="{{ trans('general.placeholders.notes') }}"
    />


@stop
