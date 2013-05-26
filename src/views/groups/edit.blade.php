@extends($model->getScaffoldRoute('edit'))

@section('form')

<p>And this is the content from the user-manager package</p>

{{ Form::model($model, ['method' => 'put', 'route' => [$model->getScaffoldRoute('update'), $model->id]]) }}
	
	<?php 

	$schema = new KevBaldwyn\Avid\Schema\Table($model);
	
	echo $schema->form($ignore, array('customAttributes' => $model->getCustomAttributes()));
	
	// permissions fields
	echo KevBaldwyn\UserManager\HtmlHelper::permissionsMatrix($model->permissions);

	?>
	
	{{ Form::token() }}
	
	{{ Form::submit('Save') }}
	
{{ Form::close() }}

@stop