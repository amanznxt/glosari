@extends('layouts.master')

@section('content')
<style type="text/css">
	.syntax {
		padding: 1px 7px;
		color: white;
		border-radius: 7px;
	}
	.syntax-no-suggest {
		background-color: rgba(233, 30, 99, 0.5);
	}
	.syntax-suggest {
		background-color: rgba(0, 150, 136, 0.5);
	}
</style>
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">{{ $article->title }}</div>
			<div class="panel-body">
				<p>{!! nl2br($article->article) !!}</p>
				<a href="{{ $article->url }}" target="_blank" class="btn btn-primary pull-right">Read More</a>

				<form action="{{ route('check.spelling.store') }}" method="post">
					{{ csrf_field() }}
					<input type="hidden" name="article_id" id="article_id" value="{{ $article->id }}">
					<table class="table table-condensed">
						<thead>
							<tr>
								<th>Word</th>
								<th>Word Suggestion</th>
							</tr>
						</thead>
						<tbody>
							@forelse($results as $word)
								@if($word['status'] == false && !empty($word['suggest']))
								<tr>
									<td>{{ $word['word'] }}</td>
									<td>
										@include('components.forms.dropdown-suggestion', [
											'options' => $word['suggest'],
											'name' => 'suggest['.$word['word'].']',
											'selected' => $word['word'],
											'label' => ''])
										OR
										@include('components.forms.checkbox', [
											'name' => 'suggest['.$word['word'].']',
											'value' => $word['word'],
											'label' => 'Use Current',
											'checked' => true
										])

										@include('components.forms.checkbox', [
											'name' => 'dictionary['.$word['word'].']',
											'value' => $word['word'],
											'label' => 'Add to Dictionary',
											'checked' => true
										])
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
					<button class="btn btn-primary pull-right">Change</button>
				</form>
			</div>
		</div>
@endsection
