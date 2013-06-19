@extends($model->getScaffoldRoute('delete'))

@include('user-manager::fragments.navigation')

@section('user-manager.content')

<p>And this is the content from the user-manager package</p>

{{ $form }}

@stop