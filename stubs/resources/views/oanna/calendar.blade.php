@props([
    'value' => null,
])

@php
    $target = $attributes->whereStartsWith('wire:model')->first();

    if ($target) {
        $attributes->offsetSet('wire:calendar', $target);
    }

    if (!empty($value)) {
        if (! $value instanceof \Carbon\Carbon) {
            /** @var \Carbon\Carbon $value */
            $value = \Carbon\Carbon::parse($value);
        }
    }
    else {
        /** @var \Carbon\Carbon $value */
        $value = now();
    }

    $weeks = [];
    $date = $value->copy()->startOfWeek();
    for ($i = 0; $i < 7; $i++) {
        $weeks[] = $date->translatedFormat('D');
        $date->addDay();
    }

    $calendar = [];
    $date = $value->copy();
    $date->startOfMonth();
    $previous = $date->copy();
    $previous->subMonth();

    if (! $date->isStartOfWeek()) {
        $date = $date->copy()->startOfWeek();
    }

    $i = 1;
    do {
        for ($y = 0; $y < 7; $y++) {
            $copy = $date->copy();
            $calendar[$i][$copy->day] = $copy;
            $date = $date->addDay();
        }
        $i = $i + 1;
    }
    while ($date->month == $value->month || $date->month == $previous->month);
@endphp

<div wire:calendar="{{ $target }}" {{ $attributes }} data-oanna-calendar>
    <div data-oanna-calendar-heading>
        <p data-oanna-calendar-heading-current>
            {{ $value->translatedFormat('F Y') }}
        </p>

        <div data-oanna-calendar-heading-actions>
            <oanna:button data-oanna-calendar-previous square variant="ghost">
                <oanna:icon icon="chevron-left" />
            </oanna:button>

            <oanna:button data-oanna-calendar-next square variant="ghost">
                <oanna:icon icon="chevron-right" />
            </oanna:button>
        </div>
    </div>

    <div data-oanna-calendar-container>
        @foreach($weeks as $week)
            <div data-oanna-calendar-cell>
                {{ $week }}
            </div>
        @endforeach

        @foreach($calendar as $week)
            @foreach($week as $day => $v)
                <div data-oanna-calendar-cell data-value="{{ $v->format('Y-m-d') }}" class="@if($value->format('d-m-Y') == $v->format('d-m-Y')) current @endif @if($v->format('d-m-Y') == now()->format('d-m-Y')) now @endif">
                    {{ $day }}
                </div>
            @endforeach
        @endforeach
    </div>
</div>
