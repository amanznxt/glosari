@extends('layouts.master')
@section('scripts')
	<script>
		function updateDictionary(word_id, lexicon_id)
		{
			if(lexicon_id == '') {
				return;
			}

			$.post('{{ route('ajax.dictionaries.words.lexicons.update') }}',
				{
					_method: 'PUT',
					_token: window.Laravel.csrfToken,
					id: word_id,
					lexicon_id: lexicon_id
				},
				function(data, textStatus, xhr) {
					notyf.alert(data.message);
					$('#resource-edit-' + word_id).removeAttr('disabled');
				}
			);
		}
	</script>
@endsection
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-primary">
					<div class="panel panel-heading">
						Dictionary Details
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-condensed">
								<tr>
									<th>Word</th>
									<th>Lexicon</th>
								</tr>
								<tr>
									<td>{{ $datum->name }}</td>
									<td>
										@include('components.forms.dropdowns-dictionary', [
								            'name'     => 'dictionary_id_' . $datum->id,
								            'label'    => '',
								            'options'  => $lexicons,
								            'resource' => $datum,
								            'selected' => ($datum->lexicon) ? $datum->lexicon->id : null]
								        )
									</td>
								</tr>
								<tr>
									<td>
										&nbsp;
									</td>
									<td>
										<a href="{{ route('dictionaries.index') }}" class="pull-right btn btn-danger">Back</a>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
