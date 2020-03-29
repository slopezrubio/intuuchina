@extends('layouts.master')

@section('content')
    @component('components.header')
        @slot('variant', 'tertiary')
        @slot('header', __('component.header.admin.' .$view_name))
    @endcomponent
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-8">
                    @component('components.tab', [
                        'tabs' => __('component.tabs.dashboard.admin'),
                        'data' => $data,
                    ]);
                        @slot('id', $view_name)
                        @if(isset($data['selected']))
                            @slot('selected', $data['selected'])
                        @endif
                    @endcomponent
                </div>
            </div>
        </div>
    </main>

    {{--Elemento FOOTER--}}
    @include('partials._footer')
@endsection