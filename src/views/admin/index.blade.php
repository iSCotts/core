@extends('core::admin.layout')

@section('title')
	Admin
@stop

@section('content')
	<div id="main-region"></div>
@stop

@section('footer.js')
	<script type="text/javascript">
		$(document).ready(function() {
			Lazychef.start({
				user: {{ $user }},
				users: {{ $users }},
				api_url: "{{ route('lazychef.api.index') }}",
				admin_url: "{{ route('lazychef.admin.index') }}",
				blog_url: "{{ route('lazychef.index') }}",
			});
		});
		window.Lang = {@foreach($locale as $key => $item) {{ $key }}: "{{ $item }}", @endforeach}
	</script>
@stop
