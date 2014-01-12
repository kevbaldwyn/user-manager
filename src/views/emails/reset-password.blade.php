@extends('emails.users.reset-password')

@section('user-manager.content')
<p>Please follow <a href="{{ URL::route('users.reset-password') }}?token={{ $reset_code }}">this link</a> to re-set your password</p>
@stop