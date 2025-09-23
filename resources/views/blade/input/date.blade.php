@props([
    'item' => null,
    'input_style' => null,
    'end_date' => null,
])

<!-- Datepicker -->
<div {{ $attributes->merge(['class' => 'input-group date']) }} data-provide="datepicker" data-date-today-highlight="true" data-date-language="{{ auth()->user()->locale }}" data-date-locale="{{ auth()->user()->locale }}" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-date-clear-btn="true"{{ $end_date ? ' data-date-end-date=' . $end_date : '' }}>
    <input type="text" {{ $attributes->merge(['class' => 'form-control']) }}>
    <span class="input-group-addon"><x-icon type="calendar" /></span>

</div>