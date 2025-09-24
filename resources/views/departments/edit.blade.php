@extends('layouts/edit-form', [
    'createText' => trans('admin/departments/table.create') ,
    'updateText' => trans('admin/departments/table.update'),
    'formAction' => (isset($item->id)) ? route('departments.update', ['department' => $item->id]) : route('departments.store'),
])

{{-- Page content --}}
@section('inputFields')

    <!-- Name -->
    <x-form-row
            :label="trans('general.name')"
            :$item
            name="name"
    />

    <!-- Company -->
    @if (\App\Models\Company::canManageUsersCompanies())
        @include ('partials.forms.edit.company-select', ['translated_name' => trans('general.company'), 'fieldname' => 'company_id'])
    @else
        <input id="hidden_company_id" type="hidden" name="company_id" value="{{ Auth::user()->company_id }}">
    @endif

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

    <!-- Manager -->
    @include ('partials.forms.edit.user-select', ['translated_name' => trans('admin/users/table.manager'), 'fieldname' => 'manager_id'])

    <!-- Location -->
    @include ('partials.forms.edit.location-select', ['translated_name' => trans('general.location'), 'fieldname' => 'location_id'])
    @include ('partials.forms.edit.image-upload', ['image_path' => app('departments_upload_path')])

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

