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


  <!-- Inititate form component -->
  <x-form :$item update_route="maintenances.update" create_route="maintenances.store">

      <!-- Start box component -->
      <x-box :$item header_icon="maintenances">

        <!-- This is an existing maintenance -->
        @if ($item->id)

          @if ($item->asset)
              <x-form-row>

                      <x-form-label>{{ trans('general.asset') }}</x-form-label>

                      <x-form-input>
                          <x-input.static>
                                {{ $item->asset->display_name }}
                          </x-input.static>
                      </x-form-input>

              </x-form-row>

              @if ($item->asset->company)
                  <x-form-row>

                          <x-form-label>{{ trans('general.company') }}</x-form-label>

                          <x-form-input>
                              <x-input.static>
                                  {{ $item->asset->company->display_name }}
                              </x-input.static>
                          </x-form-input>

                  </x-form-row>

              @endif

              @if ($item->asset->location)
                  <x-form-row>

                          <x-form-label>
                              {{ trans('general.location') }}
                          </x-form-label>

                          <x-form-input>
                              <x-input.static>
                                  {{ $item->asset->location->display_name }}
                              </x-input.static>
                          </x-form-input>

                  </x-form-row>
              @endif


          @endif

        @endif

          <!-- Name -->
          <x-form-row>
                  <x-form-label>{{ trans('general.name') }}</x-form-label>

                  <x-form-input>
                    <x-input.text
                            name="name"
                            :value="$item->name"
                            required="true"
                    />
                  </x-form-input>

          </x-form-row>

         @if (!$item->id)

              <x-form-row>
                      <x-form-label>{{ trans('general.select_asset') }}</x-form-label>
                      <x-form-input>
                          <x-input.select2-ajax
                                  name="selected_assets[]"
                                  :value="$item->name"
                                  required="true"
                                  multiple="true"
                                  data_endpoint="hardware"
                                  :data_placeholder="trans('general.select_asset')"
                          />
                      </x-form-input>
              </x-form-row>
         @endif


        <!--- Start Date -->
          <x-form-row>
                  <x-form-label>{{ trans('admin/maintenances/form.start_date') }}</x-form-label>

                  <x-form-input class="col-md-5">
                      <x-input.datepicker
                              name="start_date"
                              :value="$item->start_date"
                              required="true"
                      />
                  </x-form-input>
          </x-form-row>


        <!--- Completion Date -->
          <x-form-row>
                  <x-form-label>{{ trans('admin/maintenances/form.completion_date') }}</x-form-label>

                  <x-form-input class="col-md-5">
                      <x-input.datepicker
                              name="start_date"
                              :value="$item->completion_date"
                              required="true"
                      />
                  </x-form-input>
          </x-form-row>

        <!-- URL -->
          <x-form-row>
                  <x-form-label>{{ trans('general.url') }}</x-form-label>

                  <x-form-input>
                      <x-input.text
                              type="url"
                              :value="$item->url"
                              input_icon="link"
                              input_group_addon="left"
                              placeholder="https://example.com"
                      />
                  </x-form-input>
          </x-form-row>


        <!-- Supplier -->
          <x-form-row>

                  <x-form-label>{{ trans('general.supplier') }}</x-form-label>

                  <x-form-input>
                      <x-input.select2-ajax
                              name="supplier_id"
                              :value="$item->supplier ? $item->supplier->id : old('supplier_id')"
                              data_endpoint="suppliers"
                              :data_placeholder="trans('general.select_supplier')"
                      />
                  </x-form-input>
          </x-form-row>

        <!-- Warranty? -->
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
              <label class="form-control">
                <input type="checkbox" value="1" name="is_warranty" id="is_warranty" {{ old('is_warranty', $item->is_warranty) == '1' ? ' checked="checked"' : '' }}>
                {{ trans('admin/maintenances/form.is_warranty') }}
              </label>
          </div>
        </div>


        <!-- Cost -->
          <x-form-row>
              <x-form-label>{{ trans('admin/maintenances/form.cost') }}</x-form-label>

              <x-form-input class="col-md-5">
                  <x-input.text
                          :input_group_text="$snipeSettings->default_currency"
                          :value="$item->cost"
                          input_group_addon="left"
                          input_max="99999999999999999.000"
                          input_min="0"
                          input_min="0.00"
                          input_step="0.001"
                          maxlength="25"
                          name="cost"
                  />
              </x-form-input>

          </x-form-row>

        @include ('partials.forms.edit.image-upload', ['image_path' => app('maintenances_path')])

        <!-- Notes -->
        <x-form-row
                :label="trans('general.notes')"
                :$item
                name="notes"
                type="textarea"
                placeholder="{{ trans('general.placeholders.notes') }}"
        />


        <!-- End box component -->
  </x-box>
    <!-- Start form component -->
</x-form>

</div>
@stop
