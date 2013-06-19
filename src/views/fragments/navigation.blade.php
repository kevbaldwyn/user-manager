@section('user-manager.nav')
	<ul>
		<li>Groups
			<ul>
				<li><a href="{{ URL::route(App::make('group')->getScaffoldRoute('index')) }}">Show All</a></li>
				<li><a href="{{ URL::route(App::make('group')->getScaffoldRoute('create')) }}">Create New</a></li>
			</ul>
		</li>
		<li>Users
			<ul>
				<li><a href="{{ URL::route(App::make('user')->getScaffoldRoute('index')) }}">Show All</a></li>
				<li><a href="{{ URL::route(App::make('user')->getScaffoldRoute('create')) }}">Create New</a></li>
			</ul>
		</li>
	</ul>
@stop