@extends($model->getScaffoldRoute('manage-users'))

@include('user-manager::fragments.navigation')

@section('user-manager.content')

<p>And this is the content from the user-manager package</p>

{{ Form::open(['method' => 'put', 'route' => [$model->getScaffoldRoute('manage-users'), $model->id]]) }}
	
	<?php
	foreach($allUsers as $user) {
		$checked = ($users->contains($user->id)) ? true : false;
	?>
	<div class="control-group :css-error">
		{{ Form::checkbox('user[' . $user->id . ']', 1, $checked, ['id' => 'user_' . $user->id]) }}
		{{ Form::label('user_' . $user->id, $user->email) }}
	</div>
	<?php
	}
	?>
	
	{{ Form::token() }}
	
	{{ Form::submit('Update') }}
	
{{ Form::close() }}

@stop