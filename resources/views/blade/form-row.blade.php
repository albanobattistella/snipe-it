<!-- form-row blade component -->
@props([
    'errors_class' => ($errors->has($name) ? ' has-error' : null),
    'help_text' => null,
    'info_tooltip_text' => null,
    'input_div_class' => 'col-md-8',
    'input_group_addon' => null,
    'input_group_text' => null,
    'input_icon' => null,
    'input_options' => null,
    'input_selected' => null,
    'input_style_override' => false,
    'item' => null,
    'label' => null,
    'min' => null,
    'maxlength' => null,
    'name' => null,
    'placeholder' => null,
    'rows' => null,
    'static_value' => null,
    'type' => 'text',
])

<div {{ $attributes->merge(['class' => 'form-group'. $errors_class]) }}>

    <!-- form label -->
    @if (isset($label))
        <x-form-label  :for="$name" class="{{ $label_class ?? 'col-md-3' }}">{{ $label }}</x-form-label>
    @endif


    @php
        $blade_type = in_array($type, ['text', 'email', 'url', 'tel', 'number', 'password']) ? 'text' : $type;
    @endphp

        <div class="{{ $input_div_class }}">
            <x-dynamic-component
                    :$name
                    :$type
                    :aria-label="$name"
                    :component="'input.'.$blade_type"
                    :id="$name"
                    :required="Helper::checkIfRequired($item, $name)"
                    :value="old($name, $item->{$name})"
                    :input_icon="$input_icon"
                    :input_group_addon="$input_group_addon"
                    :input_group_text="$input_group_text"
                    :rows="$rows"
                    :placeholder="$placeholder"
                    :options="$input_options"
                    :selected="$input_selected"
                    :style="$input_style_override"
                    :maxlength="$maxlength"
                    :min="$min"
                    :static_value="$static_value"

            />
        </div>

    @if ($info_tooltip_text)
        <!-- Info Tooltip -->
        <div class="col-md-1 text-left" style="padding-left:0; margin-top: 5px;">
            <x-form-tooltip>
                {{ $info_tooltip_text }}
            </x-form-tooltip>
        </div>
    @endif


    @error($name)
    <div class="col-md-8 col-md-offset-3">
        <span class="alert-msg" aria-hidden="true">
            <x-icon type="x" />
            {{ $message }}
        </span>
    </div>
    @enderror

    @if ($help_text)
        <!-- Help Text -->
        <div class="col-md-8 col-md-offset-3">
            <p class="help-block">
                {!! $help_text !!}
            </p>
        </div>
    @endif



</div>