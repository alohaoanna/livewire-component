@props([
    'value' => null,
    'shortcut' => null,
    'action' => true,
])

@php
    $target = $attributes->whereStartsWith('wire:model')->first();
    $value = $value ??= $this->{$target} ??= now();

    if ($value instanceof \Carbon\Carbon) {
        $value = $value->format('Y-m-d');
    }
@endphp

<div {{ $attributes }} data-oanna-calendar x-data="calendar(@js($value))">
    <div data-oanna-calendar-heading>
        <p data-oanna-calendar-heading-current x-text="formatView"></p>

        <div data-oanna-calendar-heading-actions>
            @if ($shortcut == 'now')
                <oanna:button square variant="ghost" x-on:click="showNow">
                    <oanna:icon icon="calendar" />
                </oanna:button>
            @endif

            @if ($action)
                <oanna:button data-oanna-calendar-previous square variant="ghost" x-on:click="previousMonth">
                    <oanna:icon icon="chevron-left" />
                </oanna:button>

                <oanna:button data-oanna-calendar-next square variant="ghost" x-on:click="nextMonth">
                    <oanna:icon icon="chevron-right" />
                </oanna:button>
            @endif
        </div>
    </div>

    <div data-oanna-calendar-container>
        <template x-for="day in weeks">
            <div data-oanna-calendar-cell x-text="day"></div>
        </template>

        <template x-for="week in calendar">
            <div data-oanna-calendar-container-row>
                <template x-for="day in week">
                    <div data-oanna-calendar-cell x-bind:class="day.class" x-text="day.text" x-on:click="setValue(day.date)"></div>
                </template>
            </div>
        </template>
    </div>

    @script
    <script>
        Date.prototype.addDays = function(days) {
            var date = new Date(this.valueOf());
            return new Date(date.setDate(date.getDate() + days));
        }

        Date.prototype.addMonths = function(months) {
            var date = new Date(this.valueOf());
            return new Date(date.setMonth(date.getMonth() + months));
        }

        Date.prototype.subMonths = function(months) {
            var date = new Date(this.valueOf());
            return new Date(date.setMonth(date.getMonth() - months));
        }

        Date.prototype.getRealMonth = function() {
            var date = new Date(this.valueOf());
            return date.getMonth() + 1;
        }

        Date.prototype.getStringMonth = function () {
            var date = new Date(this.valueOf());
            if (date.getRealMonth() >= 10) return date.getRealMonth();
            return "0" + date.getRealMonth();
        };

        Date.prototype.getStringDate = function () {
            var date = new Date(this.valueOf());
            if (date.getDate() >= 10) return date.getDate();
            return "0" + date.getDate();
        };

        Date.prototype.startOfMonth = function() {
            var date = new Date(this.valueOf());
            return new Date(date.getFullYear(), date.getMonth(), 1);
        }

        Date.prototype.startOfWeek = function() {
            var date = new Date(this.valueOf());

            var diff = date.getDate() - date.getDay() + (date.getDay() === 0 ? -6 : 1);

            return new Date(date.setDate(diff));
        }

        Date.prototype.equal = function(date) {
            return this.getFullYear() === date.getFullYear() && this.getMonth() === date.getMonth() && this.getDate() === date.getDate();
        }

        Alpine.data('calendar', (initialOpenState = null) => ({
            value: new Date(initialOpenState),
            view: new Date(initialOpenState),
            now: new Date(),
            weeks: [],
            calendar: [],
            days: ["mon", "tue", "wen", "fri", "tur", "sat", "sun"],
            months: ["january", "february", "march", "april", "may", "june", "july", "august", "september", "october", "november", "december"],

            init() {
                this.value.setHours(0, 0, 0, 0);
                this.view.setHours(0, 0, 0, 0);
                this.now.setHours(0, 0, 0, 0);

                this.initWeeks();
                this.initCalendar();
            },

            initWeeks() {
                for (var day in this.days) {
                    this.weeks.push(this.days[day]);
                }
            },

            initCalendar() {
                this.calendar = [];
                var previousMonth = this.view.getMonth();
                var i = 0;
                var date = this.view.startOfMonth().startOfWeek();
                do {
                    var week = [];
                    for (var day in this.days) {
                        week.push({
                            value: this.format(date),
                            text: date.getDate(),
                            date: date,
                            class: this.getClass(date),
                        });
                        date = date.addDays(1);
                    }
                    this.calendar.push(week);
                    i++;
                }
                while (i < 6);
            },

            getClass(v) {
                let str = "";
                v.setHours(0, 0, 0, 0);

                if (this.value.equal(v)) {
                    str += " value";
                }
                else if (v.getRealMonth() === this.view.getRealMonth()) {
                    str += " view";
                }

                if (this.now.equal(v)) {
                    str += " now";
                }

                return str;
            },

            showNow() {
                this.view = this.now;
                this.initCalendar();
            },

            previousMonth() {
                this.view = this.view.subMonths(1);
                this.initCalendar();
            },

            nextMonth() {
                this.view = this.view.addMonths(1);
                this.initCalendar();
            },

            formatView() {
                return this.months[this.view.getMonth()] + ' ' + this.view.getFullYear();
            },

            format(date) {
                return date.getFullYear() + '-' + date.getStringMonth() + '-' + date.getStringDate();
            },

            setValue(date) {
                var target = @js($target);
                this.value = this.view = date;
                $wire.$set(target, this.format(this.value));
                this.initCalendar();
            },
        }));
    </script>
    @endscript
</div>
