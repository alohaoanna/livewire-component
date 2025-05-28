<?php

namespace OANNA\Object;

use Carbon\Carbon;
use Livewire\Wireable;
use Traversable;

class DateRange implements Wireable, \IteratorAggregate
{
    public Carbon $start;
    public Carbon $end;

    public function __construct($attributes = [])
    {
        $this->start = Carbon::parse($attributes['start']);
        $this->end = Carbon::parse($attributes['end']);
    }

    public function toLivewire(): array
    {
        return [
            'start' => $this->start,
            'end' => $this->end,
        ];
    }

    public static function fromLivewire($value): self
    {
        return new self($value);
    }

    public function getIterator(): Traversable
    {
        return new \ArrayIterator([
            'start' => $this->start->format('Y-m-d'),
            'end' => $this->end->format('Y-m-d'),
        ]);
    }
}
