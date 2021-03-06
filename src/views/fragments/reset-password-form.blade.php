{{ Form::open(['method' => 'post', 'route' => 'users.reset-password', 'class' => 'form-horizontal']) }}

	{{ Form::token() }}
	{{ Form::hidden('token', Input::get('token')) }}

	<div class="control-group">
		{{ Form::label('email', 'Email address', ['class' => 'control-label']) }}
		<div class="controls">
			{{ Form::text('email', Input::get('email'), ['class' => 'form-control']) }}
		</div>
	</div>

	<div class="control-group">
		{{ Form::label('password', 'New Password', ['class' => 'control-label']) }}
		<div class="controls">
			{{ Form::password('password', ['class' => 'form-control']) }}
		</div>
	</div>

	<div class="control-group">
			{{ Form::submit('Reset', ['class' => 'btn btn-default']) }}
	</div>

{{ Form::close() }}