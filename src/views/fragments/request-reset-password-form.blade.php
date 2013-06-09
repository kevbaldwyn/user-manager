{{ Form::open(['method' => 'post', 'route' => 'users.reset-password'], ['class' => 'form-horizontal']) }}

	{{ Form::token() }}

	<div class="control-group">
		{{ Form::label('email', 'Email address', ['class' => 'control-label']) }}
		<div class="controls">
			{{ Form::text('email', Input::get('email')) }}
		</div>
	</div>

	<div class="control-group">
		 <div class="controls">
			{{ Form::submit('Request', ['class' => 'btn']) }}
		</div>
	</div>

{{ Form::close() }}