@extends('layouts/default')

{{-- Page title --}}
@section('title')
  @if ($item->id)
    {{ trans('admin/maintenances/form.update') }}
  @else
    {{ trans('admin/maintenances/form.create') }}
  @endif
  @parent
@stop


@section('header_right')
<a href="{{ URL::previous() }}" class="btn btn-primary pull-right">
  {{ trans('general.back') }}</a>
@stop


{{-- Page content --}}
@section('content')
<div class="row">
  <x-box
          :$item
          header_icon="maintenances"
  >



        <!-- Name -->
        <x-form-row
                :label="trans('general.name')"
                :$item
                name="name"
        />

        <!-- This is a new maintenance -->
        @if (!$item->id)


          @include ('partials.forms.edit.asset-select', [
            'translated_name' => trans('general.assets'),
            'fieldname' => 'selected_assets[]',
            'multiple' => true,
            'required' => true,
            'select_id' => 'assigned_assets_select',
            'asset_selector_div_id' => 'assets_for_maintenance_div',
            'asset_ids' => $item->id ? $item->asset()->pluck('id')->toArray() : old('selected_assets'),
            'asset_id' => $item->id ? $item->asset()->pluck('id')->toArray() : null
          ])
        @else


          @if ($item->asset)
            <x-form-row
                    :label="trans('general.asset')"
                    :$item
                    name="asset"
                    type="static"
                    :static_value="$item->asset->display_name"
            />

            @if ($item->asset->company)
              <x-form-row
                      :label="trans('general.company')"
                      :$item
                      name="company"
                      type="static"
                      :static_value="$item->asset->company->name"
              />
            @endif


            @if ($item->asset->location)
              <x-form-row
                      :label="trans('general.location')"
                      :$item
                      name="location"
                      type="static"
                      :static_value="$item->asset->location"
              />
            @endif
          @endif

        @endif





        <x-form-row
                :label="trans('admin/maintenances/form.asset_maintenance_type')"
                :$item
                name="asset_maintenance_type"
                type="select"
                input_style_override="width:100%;"
                :input_options="$maintenanceType"
                :input_selected="old('asset_maintenance_type', $item->asset_maintenance_type)"
                includeEmpty="true"
                data-placeholder="{{ trans('admin/maintenances/form.select_type')}}"
        />



        <!--- Start Date -->
        <x-form-row
                :label="trans('admin/maintenances/form.start_date')"
                :$item
                name="start_date"
                type="datepicker"
                input_div_class="col-md-5"
        />


        <!--- Completion Date -->
        <x-form-row
                :label="trans('admin/maintenances/form.completion_date')"
                :$item
                name="completion_date"
                type="datepicker"
                input_div_class="col-md-5"
        />

        <!-- URL -->
        <x-form-row
                :label="trans('general.url')"
                :$item
                name="url"
                type="url"
                input_icon="link"
                input_group_addon="left"
                placeholder="https://example.com"
        />

        @include ('partials.forms.edit.supplier-select', ['translated_name' => trans('general.supplier'), 'fieldname' => 'supplier_id'])


        <!-- Warranty -->
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
              <label class="form-control">
                <input type="checkbox" value="1" name="is_warranty" id="is_warranty" {{ old('is_warranty', $item->is_warranty) == '1' ? ' checked="checked"' : '' }}>
                {{ trans('admin/maintenances/form.is_warranty') }}
              </label>
          </div>
        </div>


        <!-- Asset Maintenance Cost -->
        <!-- Purchase Cost -->
        <x-form-row
                :label="trans('admin/maintenances/form.cost')"
                :$item
                name="cost"
                type="number"
                input_div_class="col-md-5"
                input_min="0"
                :input_group_text="$snipeSettings->default_currency"
                input_group_addon="left"
                maxlength="25"
                input_max="99999999999999999.000"
                input_min="0.00"
                input_step="0.001"
        />


        @include ('partials.forms.edit.image-upload', ['image_path' => app('maintenances_path')])

        <!-- Notes -->
        <x-form-row
                :label="trans('general.notes')"
                :$item
                name="notes"
                type="textarea"
                placeholder="{{ trans('general.placeholders.notes') }}"
        />


  </x-box>
</div>
@stop
