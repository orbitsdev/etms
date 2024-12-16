@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-sksu-800 focus:ring-sksu-800 rounded-md shadow-sm']) !!}>
