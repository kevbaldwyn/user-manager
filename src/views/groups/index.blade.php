@extends($model->getScaffoldRoute('index'))

@section('list_html')

<h3>Current Groups</h3>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
@foreach ($list as $item)
	<tbody>
    	<tr>
    		<td><a href="{{ URL::route($model->getScaffoldRoute('edit'), array($item->id)) }}">{{ $item->name }}</a></td>
    		<td><a href="{{ URL::route($model->getScaffoldRoute('delete'), array($item->id)) }}">Delete</a></td>
    		<td>Add users</td>
    	</tr>
	</tbody>
@endforeach
</table>

<div class="btn-group">
	<a class="btn btn-primary" href="{{ URL::route($model->getScaffoldRoute('create')) }}">New Group</a>
</div>

@stop
