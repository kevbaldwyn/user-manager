@extends('users.reset-password')

@section('form')
	
	@if($reset)

		@include('user-manager::fragments.reset-password-form')

	@else
		
		@include('user-manager::fragments.request-reset-password-form')

	@endif

@stop