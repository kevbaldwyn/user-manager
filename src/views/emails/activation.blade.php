@extends('emails.users.register')

@section('user-manager.content')
<p>Please follow <a href="{{ URL::route('users.activate') }}?token={{ $activation_code }}">this link</a> to activate your account</p>
@stop