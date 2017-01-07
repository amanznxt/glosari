@extends('layouts.master')

@section('content')
		@include('components.list.dictionary', [
			'route' => 'dictionaries',
			'resources' => $resources,
			'appends' => [],
		])
@endsection
