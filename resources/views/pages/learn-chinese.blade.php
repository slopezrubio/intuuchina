@extends('layouts.master')

@section('content')
    @component('components.header')
        @slot('variant', 'primary')
        @slot('header', __('component.header.' . $view_name))
    @endcomponent

    <main id="learn-chinese">

        @component('components.sliders.arrow-slider', ['slides' => App\Program::where('value', 'study')->first()->studies])
            @slot('name', 'study')
            @slot('id', 'study')
            @slot('action', 'partials.forms._category-slide')

            @if(isset($slides))
                @slot('visible', $slides)
            @endif
        @endcomponent
{{--        @include('partials._chinese-courses')--}}

        @include('partials._price-course-info')
    </main>
    @include('partials._footer')
@endsection