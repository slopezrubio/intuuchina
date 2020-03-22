@extends('layouts.master')

@section('content')
    @component('components.header')
        @slot('variant', 'tertiary')

        @slot('title', __('heading.admin.' .$view_name. '.title'))
    @endcomponent
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-8">
                    @component('components.tab', [
                        'tabs' => __('component.dashboard.admin'),
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