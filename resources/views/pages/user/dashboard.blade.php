@extends('layouts.master')

@section('content')
    @component('components.header')
        @slot('variant', 'tertiary')
        @slot('header', __('component.header.user.dashboard'))
    @endcomponent

   <main id="dashboard">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-8">
                    @isset($data)
                        @component('components.tab', ['tabs' =>  __('component.tabs.dashboard.user'), 'data' => $data])
                            @slot('id', $view_name)

                            @if(isset($selected))
                                @slot('selected', $selected)
                            @endif
                        @endcomponent
                    @else
                        @component('components.tab', ['tabs' =>  __('component.tabs.dashboard.user')])
                            @slot('id', $view_name)

                            @if(isset($selected))
                                @slot('selected', $selected)
                            @endif
                        @endcomponent
                    @endisset
                </div>
            </div>
        </div>
    </main>

    @include('partials._footer')
@endsection