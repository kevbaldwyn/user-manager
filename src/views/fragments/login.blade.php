{{ Form::open(['method' => 'post', 'route' => 'login'], ['class' => 'form-horizontal']) }}

	{{ Form::token() }}

	<div class="control-group {{ Form::errorCSS('email') }}">
		{{ Form::label('email', 'Email address', ['class' => 'control-label']) }}
		<div class="controls">
			{{ Form::text('email', Input::get('email')) }}
			{{ Form::error('email') }}
		</div>
	</div>

	<div class="control-group {{ Form::errorCSS('password') }}">
		{{ Form::label('password', 'Password', ['class' => 'control-label']) }}
		<div class="controls">
			{{ Form::password('password') }}
			{{ Form::error('password') }}
		</div>
	</div>

	<div class="control-group">
		 <div class="controls">
		 	<label class="checkbox">
        		{{ Form::checkbox('remeber', '1', Input::get('remember')) }} Remember me
      		</label>
			{{ Form::submit('Login', ['class' => 'btn']) }}
		</div>
	</div>

{{ Form::close() }}
<a href="{{ URL::route('users.reset-password') }}" class="forgotten-password">Forgotten Password</a>