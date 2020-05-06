@auth
    @if(Auth::user()->program->value === 'internship' || Auth::user()->program->value === 'inter_relocat')
        @if(!Auth::user()::with('category_id')->contains($item->category_id)))

        @endif
    @endif
@else

@endauth