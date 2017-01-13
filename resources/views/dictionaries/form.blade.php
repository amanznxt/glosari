@extends('layouts.master')

@section('form-components')
	@include('components.forms.input', [
			'type' => 'text',
			'name' => 'name',
			'label' => 'Name',
			'value' => ($type == 'PUT' ? $resource->name : null)
		])
	@include('components.forms.dropdown', [
			'name' => 'lexicon_id',
			'label' => 'Lexicon',
			'options' => $lexicons,
			'selected' => ($type == 'PUT' ? $resource->lexicon->id : null)
		])
	@include('components.forms.submit',['route' => 'dictionaries'])
@endsection

@section('content')
	<div class="container">
		@if($type == 'POST')
			@include('components.forms.base', ['options' => [
				'method' => 'POST',
				'route' => 'dictionaries.store',
				'_method' => 'POST'
			]])
		@elseif($type == 'PUT')
			@include('components.forms.base', ['options' => [
				'method' => 'POST',
				'_method' => 'PUT',
				'route' => ['dictionaries.update', $resource->id ]
			]])
		@endif
	</div>
@endsection
