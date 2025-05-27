@php $containerClass = $containerClass ??= $attributes->get('container:class') @endphp
@php $badgeVariant = $badgeVariant ??= $attributes->get('badge:variant') @endphp

@props([
    "class" => "",
    "label" => null,
    "badge" => null,
    "badge" => null,
    'dirty' => null,
])

@php
    $required = $attributes->has('required') && $attributes->get('required');
    $target = $attributes->whereStartsWith('wire:model')->first();

    if (! $attributes->has('id')) {
        $attributes->offsetSet("id", $target);
    }

    if (! $attributes->has('name')) {
        $attributes->offsetSet("name", $target);
    }

    $core = config('oanna.editor.ckeditor.enable') ? 'ckeditor' : 'quill';

@endphp

<div class="form-group form-group--textarea {{ $containerClass }}">
    @if (! is_null($label))
        <oanna:form.label :for="$attributes->get('id')"
                          :$required :$badge :$dirty :$target
                          :badgeVariant="$attributes->get('badge:variant')"
                          :badgeColor="$attributes->get('badge:color')">
            {{ $label }}
        </oanna:form.label>
    @endif

        <div wire:ignore class="wysiwyg-editor">
            <div wire:wysiwyg="{{ $target }}" {{ $attributes }} data-core="{{ $core }}" data-license-key="{{ config('oanna.editor.ckeditor.license_key') }}"></div>
        </div>

    <oanna:form.error :name="$target" />
</div>
