@extends('layouts/edit-form', [
    'createText' =>  trans('admin/kits/general.create'),
    'updateText' => trans('admin/kits/general.update'),
    'formAction' => (isset($item->id)) ? route('kits.update', ['kit' => $item->id]) : route('kits.store'),
])

{{-- Page content --}}
@section('inputFields')
    <!-- Name -->
    <x-form-row
            :label="trans('general.name')"
            :$item
            name="name"
    />
@stop
