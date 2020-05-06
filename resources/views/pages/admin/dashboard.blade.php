@extends('layouts.master')

@section('content')
    @component('components.header')
        @slot('variant', 'tertiary')
        @slot('header', __('component.header.admin.' .$view_name))
    @endcomponent

    @foreach($data as $key => $collection)
        @if (count($collection) > 0)
            @component('components.modal')
                @slot('name', $key)

                @switch($key)
                    @case('testimonials')
                        @slot('title', $collection->first()->name . ' ' . $collection->first()->surnames)
                        @include('partials.forms.admin._delete-item', ['message' => __('messages.deletion.messages.deletion.' . Str::singular($key))])
                    @case('users')
                        @slot('title', $collection->first()->name . ' ' . $collection->first()->surnames)
                        @include('partials.forms.admin._delete-item')
                        @break
                    @default
                        @slot('title', $collection->first()->title)
                        @include('partials.forms.admin._delete-item')
                        @break
                @endswitch

            @endcomponent
        @endif
    @endforeach

    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-8">
                    @component('components.tab', ['tabs' => __('component.tabs.dashboard.admin'), 'data' => $data]);

                        @slot('id', $view_name)

                        @if(isset($selected))
                            @slot('selected', $selected)
                        @endif
                    @endcomponent
                </div>
            </div>
        </div>
    </main>

    {{--Elemento FOOTER--}}
    @include('partials._footer')
@endsection