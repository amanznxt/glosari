@extends('layouts.master')

@section('form-components')
	@if($type == 'PUT')
		@include('components.forms.hidden', ['name' => 'id', 'value' => $resource->id])
	@endif
	@include('components.forms.input', ['type' => 'text', 'label' => 'Title', 'name' => 'title', 'value' => ($type == 'PUT' ? $resource->title : null)])
	@include('components.forms.text', ['type' => 'text', 'label' => 'Article', 'name' => 'article', 'value' => ($type == 'PUT' ? $resource->article : null)])
	@include('components.forms.input', ['type' => 'text', 'label' => 'URL', 'name' => 'url', 'value' => ($type == 'PUT' ? $resource->url : null)])
	@include('components.forms.hidden', ['name' => 'user_id', 'value' => auth()->user()->id])
	@include('components.forms.submit',['route' => 'articles'])
@endsection

@if($type == 'PUT')
	@section('scripts')
		<script type="text/javascript">
			function process() {
				jQuery.get('{{ route('articles.process', ['id' => $resource->id]) }}', {}, function(data, textStatus, xhr) {
				  notyf.alert('Analyze in progress. We will notify you when it\'s ready.');
				});
			}
		</script>
	@endsection
@endif

@section('content')
	<div class="container">
		@if($type == 'POST')
			@include('components.forms.base', ['options' => [
				'method' => 'POST',
				'route' => 'articles.store',
				'_method' => 'POST'
			]])
		@elseif($type == 'PUT')

			<div class="btn-group pull-right">
				<div class="btn btn-default">
					<a href="{{ route('check.spelling', ['id' => $resource->id]) }}">
						<span class="glyphicon glyphicon-cog"></span>
					</a>
				</div>
				<div class="btn btn-danger" onclick="process()">
					<span class="glyphicon glyphicon-refresh"></span>
				</div>
			</div>

			<hr>
			@include('components.forms.base', ['options' => [
				'method' => 'POST',
				'_method' => 'PUT',
				'route' => ['articles.update', $resource->id ]
			]])
		@endif
	</div>
@endsection
