@extends($model->getScaffoldRoute('index'))

@include('user-manager::fragments.navigation')

@section('list_html')

<h3>Current Users</h3>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th></th>
			<th></th>
			<th></th>
			<th>Activated</th>
		</tr>
	</thead>
@foreach ($list as $item)
	<tbody>
    	<tr>
    		<td><a href="{{ URL::route($model->getScaffoldRoute('edit'), array($item->id)) }}">{{ $item->email }}</a></td>
    		<td><a href="{{ URL::route($model->getScaffoldRoute('manage-groups'), array($item->id)) }}">Manage Groups</a></td>
    		<td><a href="{{ URL::route($model->getScaffoldRoute('delete'), array($item->id)) }}">Delete</a></td>
    		<td><a href="{{ URL::route($model->getScaffoldRoute('resetPassword'), array($item->id)) }}">Reset Password</a></td>
    		<td>
    			@if($item->isActivated()) 
    				Yes
    			@else
    				<a href="{{ URL::route($model->getScaffoldRoute('send-activation'), array($item->id)) }}">Send Activation Email</a>
    			@endif
    		</td>
    	</tr>
	</tbody>
@endforeach
</table>

<div class="btn-group">
	<a class="btn btn-primary" href="{{ URL::route($model->getScaffoldRoute('create')) }}">New User</a>
</div>

@stop