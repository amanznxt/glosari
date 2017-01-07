<script type="text/javascript">
	function updateWordLexicon(id)
	{
		alert(1);
	}
</script>
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
							<th>Lexicon</th>
							<th class="col-md-3">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($resources as $resource)
							<tr>
								<td>{{ $resource->name }}</td>
								<td>
									@if($resource->lexicon)
										@include('components.dropdown', ['name' => 'lexicon_id_'.$resource->lexicon->id, 'label' => '', 'options' => $lexicons, 'selected' => $resource->lexicon->id])
										<div class="btn btn-primary" onclick="updateWordLexicon({{ $resource->lexicon->id }})">Update</div>
									@endif
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
