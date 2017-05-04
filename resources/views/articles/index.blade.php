@extends('layouts.master')

@section('content')
		@include('components.list', [
			'route' => 'articles',
			'resources' => $resources,
			'appends' => [],
			'headings' => [
				[
					'label' => 'Title',
					'attr' => 'title',
				],
				[
					'label' => 'Published On',
					'attr' => 'date',
				],
			]
		])
@endsection
