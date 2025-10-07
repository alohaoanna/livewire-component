@php $iconTrailing ??= $attributes->get('icon:trailing') @endphp
@php $iconClass ??= $attributes->get('icon:class') @endphp

@props([
    'prefix' => null,
    'suffix' => null,
    'icon' => null,
    'iconTrailing' => null,
    'iconClass' => null,
])

<div class="form-group__container" {{ $attributes }}>

    @if (! empty($prefix))
        <div class="form-group__container__side form-group__container__side--prefix">
            {!! $prefix !!}
        </div>
    @endif

    <div class="form-group__container__input">
        {!! $icon !!}

        {{ $slot }}

        {!! $iconTrailing !!}
    </div>

    @if (! empty($suffix))
        <div class="form-group__container__side form-group__container__side--suffix">
            {!! $suffix !!}
        </div>
    @endif

</div>
