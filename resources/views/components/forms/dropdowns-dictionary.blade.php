<div class="form-group">
  <div class="col-md-12">
    <select onchange="updateDictionary({{ $resource->id }}, this.options[this.selectedIndex].value)" name="{{ $name or 'select' }}" id="{{ $name or 'select' }}" class="form-control input-md">
		<option value="">-- Select One --</option>
		@foreach($options as $option)
			<option value="{{ $option->id }}" {{ ($selected == $option->id ? 'selected' : '') }}>{{ $option->name }}</option>
		@endforeach
	</select>
</div>
