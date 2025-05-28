@php $containerClass = $containerClass ??= $attributes->get('container:class') @endphp

@props([
    "class" => "",
    "label" => null,
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
        <oanna:form.label {{ $attributes }}>{{$label}}</oanna:form.label>
    @endif

        <div wire:ignore class="wysiwyg-editor">
            <div wire:wysiwyg="{{ $target }}" {{ $attributes }} data-core="{{ $core }}" data-license-key="{{ config('oanna.editor.ckeditor.license_key') }}"></div>
        </div>

    <oanna:form.error :name="$target" />
</div>
