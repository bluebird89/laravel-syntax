<div {{ $attributes }}>
    <div {{ $attributes->merge(['class' => 'alert alert-'.$type]) }}>
        {{ $message }}
    </div>
</div>

{{--<option {{ $isSelected($value) ? 'selected="selected"' : '' }} value="{{ $value }}">--}}
{{--    {{ $label }}--}}
{{--</option>--}}
