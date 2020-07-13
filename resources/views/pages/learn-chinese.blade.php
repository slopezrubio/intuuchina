@extends('layouts.master')

@section('title')
    {{ __('meta.title.' . $view_name) }}
@endsection

@section('description')
    <meta name="description" content="{{ __('meta.description.' . $view_name) }}">
@endsection

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

        <section id="course-info">
            @component('components.c-price-box', ['price_box' => __('component.c-price-box.'.$category->value)])
                @slot('price', $category->fee->amount)
            @endcomponent
        </section>

    </main>
    @include('partials._footer')
@endsection