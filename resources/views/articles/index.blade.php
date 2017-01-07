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
					'label' => 'Article',
					'attr' => 'article',
				],
				[
					'label' => 'Created On',
					'attr' => 'created_at',
				],
			]
		])
@endsection
