@extends('layouts.master')

@section('content')

    @component('components.header')
        @slot('variant', 'tertiary')
        @slot('header', [
            'title' => $user->surnames,
            'subtitle' => $user->name,
        ])
    @endcomponent

    <main id="{{ $view_name }}">

        @component('components.breadcrumb')
        @endcomponent

        <section id="content" class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-8">
                    @include('partials.forms.admin._edit-user')
                </div>
            </div>
        </section>

    </main>
@endsection