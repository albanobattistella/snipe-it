@extends('layouts/edit-form', [
    'createText' => trans('admin/locations/table.create') ,
    'updateText' => trans('admin/locations/table.update'),
    'topSubmit' => true,
    'helpPosition' => 'right',
    'helpText' => trans('admin/locations/table.about_locations'),
    'formAction' => (isset($item->id)) ? route('locations.update', ['location' => $item->id]) : route('locations.store'),
])

{{-- Page content --}}
@section('inputFields')

    <!-- Name -->
    <x-form-row
            :label="trans('general.name')"
            :$item
            name="name"
    />

<!-- parent -->
@include ('partials.forms.edit.location-select', ['translated_name' => trans('admin/locations/table.parent'), 'fieldname' => 'parent_id'])

<!-- Manager-->
@include ('partials.forms.edit.user-select', ['translated_name' => trans('admin/users/table.manager'), 'fieldname' => 'manager_id'])

<!-- Company -->
@include ('partials.forms.edit.company-select', ['translated_name' => trans('general.company'), 'fieldname' => 'company_id'])

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

    <!-- Currency -->
    <x-form-row
            :label="trans('admin/locations/table.currency')"
            :$item
            name="currency"
            maxlength="3"
            input_div_class="col-md-2 col-sm-6 col-xs-6"
    />

@include ('partials.forms.edit.address')

<!-- LDAP Search OU -->
@if ($snipeSettings->ldap_enabled == 1)
    <div class="form-group {{ $errors->has('ldap_ou') ? ' has-error' : '' }}">
        <label for="ldap_ou" class="col-md-3 control-label">
            {{ trans('admin/locations/table.ldap_ou') }}
        </label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="ldap_ou" aria-label="ldap_ou" id="ldap_ou" value="{{ old('ldap_ou', $item->ldap_ou) }}"{!!  (Helper::checkIfRequired($item, 'ldap_ou')) ? ' required' : '' !!} maxlength="191" />
            @error('ldap_ou')
            <span class="alert-msg">
                <x-icon type="x" />
                {{ $message }}
        </span>
            @enderror
        </div>
    </div>
@endif


    @include ('partials.forms.edit.image-upload', ['image_path' => app('locations_upload_path')])

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

