@extends('layouts.master')

@section('form-components')
	@if($type == 'PUT')
		@include('components.forms.hidden', ['name' => 'id', 'value' => $resource->id])
	@endif
	@include('components.forms.input', ['type' => 'text', 'name' => 'title', 'value' => ($type == 'PUT' ? $resource->title : null)])
	@include('components.forms.text', ['type' => 'text', 'name' => 'article', 'value' => ($type == 'PUT' ? $resource->article : null)])
	@include('components.forms.input', ['type' => 'text', 'name' => 'url', 'value' => ($type == 'PUT' ? $resource->url : null)])
	@include('components.forms.hidden', ['name' => 'user_id', 'value' => auth()->user()->id])
	@include('components.forms.submit',['route' => 'articles'])
@endsection

@section('content')
	<div class="container">
		@if($type == 'POST')
			@include('components.forms.base', ['options' => [
				'method' => 'POST',
				'route' => 'articles.store',
				'_method' => 'POST'
			]])
		@elseif($type == 'PUT')
			<a href="{{ route('articles.process', ['id' => $resource->id]) }}" class="btn btn-danger pull-right">
				<span class="glyphicon glyphicon-refresh pull-right"></span>
			</a>
			<hr>
			@include('components.forms.base', ['options' => [
				'method' => 'POST',
				'_method' => 'PUT',
				'route' => ['articles.update', $resource->id ]
			]])
		@endif
	</div>
@endsection
