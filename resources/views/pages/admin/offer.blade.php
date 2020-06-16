@extends('layouts.master')

@section('content')

    @component('components.header')
        @slot('variant', 'primary')
        @slot('header', [
            'title' => $offer->category->name,
            'background' => asset('storage/images/' . $offer->picture),
            'subtitle' => $offer->title,
        ])
    @endcomponent

    <main id="{{ $view_name }}">

        <section id="toolbar">
            @component('components.breadcrumb')
                @slot('links', 'component.breadcrumbs.admin.'.$view_name)
            @endcomponent
        </section>

        <section id="content" class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-8">
                    @include('partials.forms.admin._edit-offer')
                </div>
            </div>
        </section>

    </main>

    @include('partials._footer')
@endsection