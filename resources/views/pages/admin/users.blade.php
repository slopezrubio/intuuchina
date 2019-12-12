@extends('layouts.master')

@section('content')
    <header class="header header--no-background-image" id="users">
        {{--Elemento NAV--}}
        @include('partials._nav')

        {{--Título de la página--}}
        @include('partials._header')
    </header>

    <main>
        <div class="row">
            <table class="table m-auto col-10 col-md-8 col-lg-8">
                <thead>
                    @if (!empty($users))
                        @foreach ($users->first() as $key => $value)
                            @switch($key)
                                @case('name')
                                    <th scope="col">
                                        {{ __('content.user') }}
                                    </th>
                                    @break
                                @case('preferences')
                                    <th scope="col">
                                        {{ ucfirst($key) }}
                                    </th>
                                    @break
                                @case('stripe')
                                    <th scope="col">
                                        <i class="fab fa-stripe"></i>
                                    </th>
                                    @break
                                @endswitch
                        @endforeach
                    @endif
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <p>{{ $user->name }}</p>
                                <ul>
                                    <li>{{ $user->email }}</li>
                                    <li>{{ __('prefixes.' . json_decode($user->phone)->prefix . '.prefix') . json_decode($user->phone)->number}}</li>
                                </ul>
                                <p>{{ $user->created_at }}</p>
                            </td>
                            <td>
                                <ul class="absolute-center">
                                    <li><b>{{ __('content.programs.'. $user->preferences) }}</b></li>
                                    @switch($user->preferences)
                                        @case('university')
                                            @if(is_array(json_decode($user->degrees)))
                                                @foreach(json_decode($user->degrees) as $degree)
                                                    <li>{{ __('content.universities.' . $degree) }}</li>
                                                @endforeach
                                            @endif
                                            @break;
                                        @case('internship')
                                        @case('inter_relocat')
                                            @if(is_array(json_decode($user->industries)))
                                                @foreach(json_decode($user->industries) as $industry)
                                                    <li>{{ __('content.industries.' . $industry) }}</li>
                                                @endforeach
                                            @endif
                                            @break;
                                        @case('study')
                                            @if(is_array(json_decode($user->studies)))
                                                @foreach(json_decode($user->studies) as $study)
                                                    <li>{{ __('content.studies.' . $study) }}</li>
                                                @endforeach
                                            @endif
                                            @break;
                                    @endswitch
                                </ul>
                            </td>
                            <td>
                                <i class="absolute-center fa fa-thumbs-up {{ $user->stripe !== null ? 'text--success' : 'text--inactive'}}"></i>
                            </td>
                        </tr>
                        <tr class="status status--warning">
                            <td colspan="2">
                                <p>{{ __('content.' . $user->status . ' status text') }}</p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection