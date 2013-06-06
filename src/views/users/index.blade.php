@extends($model->getScaffoldRoute('index'))

@section('list_html')

<h3>Current Users</h3>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th></th>
		</tr>
	</thead>
@foreach ($list as $item)
	<tbody>
    	<tr>
    		<td><a href="{{ URL::route($model->getScaffoldRoute('edit'), array($item->id)) }}">{{ $item->email }}</a></td>
    		<td><a href="{{ URL::route($model->getScaffoldRoute('delete'), array($item->id)) }}">Delete</a></td>
    	</tr>
	</tbody>
@endforeach
</table>

<div class="btn-group">
	<a class="btn btn-primary" href="{{ URL::route($model->getScaffoldRoute('create')) }}">New User</a>
</div>

@stop