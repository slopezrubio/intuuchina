@extends('layouts.master')

@section('content')
    @component('components.header')
        @slot('variant', 'tertiary')
        @slot('header',  __('component.header.user.'.$view_name))
    @endcomponent

    <main>
        <div class="container d-flex align-items-center flex-column">
            <div class="col-12 col-md-12 col-lg-8 col-xl-8 p-0">
                @include('partials.forms.user._' .str_replace('_', '-', App\FeeType::find(Auth::user()->program->fee_type_id)->value))
            </div>
            <div class="col-12 col-md-12 col-lg-8 col-xl-8 p-0">
                <ul>
                    <li>
                        <p>
                            {!! __('content.are you in doubt') !!}
                        </p>
                    </li>
                </ul>
            </div>
        </div>

    </main>

    @include('partials._footer')
@endsection