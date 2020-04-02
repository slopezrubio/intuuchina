@extends('layouts.master')

@section('content')

    @component('components.header')
        @slot('variant', 'primary')
        @slot('header', [
            'title' => __('content.industries.' .$offer->industry),
            'background' => asset('storage/images/' . $offer->picture),
            'subtitle' => $offer->title,
        ])
    @endcomponent

    <main id="{{ $view_name }}">


        @component('components.breadcrumb')
        @endcomponent


        <section id="content" class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-8">
                    @include('partials.forms.admin._edit-offer')
                </div>
            </div>
        </section>

    </main>

    {{--Formulario de edición de oferta--}}
{{--    @include('partials._edit-offer')--}}

    @include('partials._footer')
@endsection