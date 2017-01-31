@extends('layouts.master')

@section('content')
<style type="text/css">
	.syntax {
		padding: 3px 3px;
		color: white;
		border-radius: 7px;
	}
	.syntax-no-suggest {
		background-color: red;
	}
	.syntax-suggest {
		background-color: green;
	}
</style>
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">{{ $article->title }}</div>
			<div class="panel-body">
				<p>{!! nl2br($article->article) !!}</p>
				<a href="{{ $article->url }}" target="_blank" class="btn btn-primary pull-right">Read More</a>

				<!-- Table -->
				<table class="table table-condensed">
					<thead>
						<tr>
							<th>Word</th>
							<th>Suggestion</th>
						</tr>
					</thead>
					<tbody>
						@forelse($results as $word)
							@if($word['status'] == false && !empty($word['suggest']))
							<tr>
								<td>{{ $word['word'] }}</td>
								<td>
									@forelse($word['suggest'] as $suggest)
										<ol>{{ $suggest }}</ol>
									@empty
										No Suggestion
									@endforelse
								</td>
							</tr>
							@endif
						@empty
							<tr class="info">
								<td colspan="2">No result</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
@endsection
