@extends($model->getScaffoldRoute('create'))


@include('user-manager::fragments.navigation')


@section('user-manager.content')

<p>And this is the content from the user-manager package</p>

{{ Form::model($model, ['method' => 'post', 'route' => [$model->getScaffoldRoute('store')]]) }}
	
	<?php 
	
	$schema = new KevBaldwyn\Avid\Schema\Table($model);
	
	echo $schema->form($ignore, array('customAttributes' => $model->getCustomAttributes()));
	
	// permissions fields
	echo KevBaldwyn\UserManager\HtmlHelper::permissionsMatrix();
	
	?>
	
	{{ Form::token() }}
	
	{{ Form::submit('Create') }}

{{ Form::close() }}

@stop