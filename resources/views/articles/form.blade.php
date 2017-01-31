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
				  alert('Analyze in progress. We will notify you when it\'s ready.');
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
			<div class="btn btn-danger pull-right" onclick="process()">
				<span class="glyphicon glyphicon-refresh pull-right"></span>
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
