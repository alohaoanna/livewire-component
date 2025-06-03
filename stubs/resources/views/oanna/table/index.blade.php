@props([
    'paginate' => null,
])


<oanna-table>
    <table data-oanna-table wire:table {{ $attributes }}>
        {{ $slot }}
    </table>

    @if ($paginate)
        {!! $paginate->links() !!}
    @endif
</oanna-table>
