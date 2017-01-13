@section('scripts')
	<script type="text/javascript">
		function updateDictionary(word_id, lexicon_id)
		{
			if(lexicon_id == '') {
				return;
			}

			jQuery.post('{{ route('dictionaries.updateLexicon') }}',
				{
					_method: 'PUT',
					token: window.Laravel.csrfToken,
					word_id: word_id,
					lexicon_id: lexicon_id
				},
				function(data, textStatus, xhr) {
			  alert(data.message);
			});
		}
	</script>
@endsection

<div class="container">
		<div class="panel panel-default">
		    <div class="panel-heading">
		      <h4><span class="glyphicon glyphicon-list"></span>&nbsp;{{ title_case(str_singular($route)) }} List
				<div class="pull-right">
					<a href="{{ route($route . '.create') }}"
						class="btn btn-success pull-right"
						data-toggle="tooltip" data-placement="top"
				        title="New Record">
						<span class="glyphicon glyphicon-plus"></span>
					</a>
				</div>
		      </h4>
		    </div>
		    <div class="panel-body">

				@if($appends)
					{{ $resources->appends($appends)->links() }}
				@else
					{{ $resources->links() }}
				@endif

				<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th class="col-md-3">Lexicon</th>
							<th class="col-md-3">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($resources as $resource)
							<tr>
								<td>{{ $resource->name }}</td>
								<td>
									@include('components.forms.dropdowns-dictionary', [
										'name' => 'dictionary_id_'.$resource->id,
										'label' => '',
										'options' => $lexicons,
										'resource' => $resource,
										'selected' => ($resource->lexicon) ? $resource->lexicon->id : null]
									)
								</td>
								<td>
									@include('components.actions', ['route' => $route, 'resource' => $resource])
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				</div>

				@if($appends)
					{{ $resources->appends($appends)->links() }}
				@else
					{{ $resources->links() }}
				@endif
		</div>
	</div>
</div>
