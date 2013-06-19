@extends($model->getScaffoldRoute('manage-groups'))

@include('user-manager::fragments.navigation')

@section('form')

<p>And this is the content from the user-manager package</p>

{{ Form::open(['method' => 'put', 'route' => [$model->getScaffoldRoute('manage-groups'), $model->id]]) }}
	
	<?php
	foreach($allGroups as $group) {
		$checked = ($groups->contains($group->id)) ? true : false;
	?>
	<div class="control-group">
		{{ Form::checkbox('group[' . $group->id . ']', 1, $checked, ['id' => 'group_' . $group->id]) }}
		{{ Form::label('group_' . $group->id, $group->name) }}
	</div>
	<?php
	}
	?>
	
	{{ Form::token() }}
	
	{{ Form::submit('Update') }}
	
{{ Form::close() }}

@stop