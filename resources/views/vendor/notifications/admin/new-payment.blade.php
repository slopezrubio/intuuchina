@extends('layouts.admin.mails')

@section('title')
    {{ __('mails.new-payment.title') }}
@endsection

@section('content')
    <h1 class="notification__heading-1">{{ __('mails.new-payment.title') }}</h1>

    <main>
        <div class="notification-card">
            <div class="notification-card__header">
                <h2>{{ __('mails.generics.payment notification') }}</h2>
            </div>
            <div class="notification-card__body">
                {!! $message !!}
                <table class="details">
                    <tr>
                        <th><p>{{ __('content.user') }}</p></th>
                        <td><p>{{ $user->name }} {{ $user->surnames }}</p></td>
                    </tr>
                    <tr>
                        <th><p>{{ __('content.program') }}</th>
                        <td><p>{{ __('content.programs.' . $user->program) }}</p></td>
                    </tr>
                    <tr>
                        <th><p>{{ __('content.issue') }}</p></th>
                        <td><p>{{ $description }}</td>
                    </tr>
                    <tr>
                        <th><p>{{ __('content.amount received') }}</p></th>
                        <td><p>{{ $total }}</p></td>
                    </tr>
                </table>
            </div>
        </div>
    </main>
@endsection