@extends('layouts.master')

@section('content')
	<div class="container">
		<h3>
			<a href="{{ $resource->url }}" target="blank">{{ $resource->title }}</a>
			<a href="{{ route('articles.edit', ['id' => $resource->id]) }}"
				class="btn btn-primary pull-right"
		        data-toggle="tooltip" data-placement="top"
		        title="Edit">
		        <span class="glyphicon glyphicon-pencil"></span>
			</a>
		</h3>
		<hr>
		<div class="well">{{ $resource->article }}</div>
		<a href="{{ route('articles.index') }}" class="btn btn-danger">Back</a>
	</div>
@endsection
