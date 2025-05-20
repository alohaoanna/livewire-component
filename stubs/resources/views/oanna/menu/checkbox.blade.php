@php $iconTrailing = $iconTrailing ??= $attributes->get('icon:trailing'); @endphp
@php $iconClasses = $iconClasses ??= $attributes->get('icon:class'); @endphp

@props([
    'iconTrailing' => null,
    'variant' => 'default',
    'indent' => false,
    'suffix' => null,
    'label' => null,
    'kbd' => null,
    'checked' => null,
])

@php
    if ($kbd) $suffix = $kbd;
    $target = $attributes->whereStartsWith('wire:model')->first();

    if (!$attributes->has('id')) {
        $id = $target;

        if ($attributes->has('value')) {
            $id .= "." . $attributes->get('value');
        }

		$attributes->offsetSet('id', $id);
    }
    else {
		$target = $attributes->get('id');
    }

    if (!$attributes->has('name')) {
		$attributes->offsetSet('name', $target);
    }
    else {
		$target = $attributes->get('name');
    }

    $id = $this->getId();
@endphp

<input type="checkbox" class="hidden" {{ $attributes }} />

<label for="{{ $attributes->get('id') }}" @if($checked)checked="{{ (string) $checked }}" @endif {{ $attributes }} data-oanna-menu-item data-oanna-menu-item-has-icon data-oanna-menu-checkbox>
    <oanna:icon icon="check" :class="$iconClasses" data-oanna-menu-item-icon />

    {{ $label ?? $slot }}

    @if ($suffix)
        <div class="ms-auto opacity-50 text-xs">
            {{ $suffix }}
        </div>
    @endif

    @if (is_string($iconTrailing) && $iconTrailing !== '')
        <oanna:icon :icon="$iconTrailing" :class="$iconClasses" data-oanna-menu-item-icon />
    @elseif ($iconTrailing)
        {{ $iconTrailing }}
    @endif
</label>
