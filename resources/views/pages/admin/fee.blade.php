@extends('layouts.master')

@section('content')

    @component('components.header')
        @slot('variant', 'tertiary')
        @slot('header', [
            'title' => $fee->heading,
        ])
    @endcomponent

    <main id="{{ $view_name }}">

        <section id="toolbar">
            @component('components.breadcrumb')
                @slot('links', 'component.breadcrumbs.admin.fee')
            @endcomponent
        </section>

        <section id="content" class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-8">
                    @include('partials.forms.admin._edit-fee')
                </div>
            </div>
        </section>

    </main>
@endsection