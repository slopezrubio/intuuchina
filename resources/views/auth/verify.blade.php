@extends('layouts.blank')

@section('title')
    {{ __('meta.titles.user_verification') }}
@endsection

@section('content')
<div id="verify-user" class="container absolute-center">
    <div class="cartoon">
        <img src="{{ __('pictures.user_verify_cartoon.url') }}" alt="{{ __('pictures.user_verify_cartoon.alt') }}" style="width: 200px">
    </div>
    <div class="notice">
        <div class="notice__title"><strong>{!! __('auth.verify your email address') !!}</strong></div>
        <div class="notice__message">{!! __('auth.before proceeding, please check your email', ['email' => $user->email]) !!}</div>
        <div class="notice__action">
            <a href="{{ route('verification.resend') }}" class="shutter-button">{{ __('auth.send it again') }}</a>
            @if (session('resent'))
                <div class="notice__action--alert" role="alert">
                    {{ __('auth.done it') }}
                    <i class="fas fa-check-circle"></i>
                </div>
            @endif
        </div>
        <div class="notice__footer">
            @if(!empty(__('links.verification-user')))
                <ul>
                    @foreach(__('links.user-verification') as $key => $link)
                        <li><a href="{{ $link['url'] }}" >{{ $link['text'] }}</a></li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
