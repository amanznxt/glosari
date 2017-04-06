<div class="form-group">
	@if($label)
  		<label class=" control-label" for="{{ $name or 'select' }}">{{ $label or '' }}</label>
  	@endif
	<div class="">
		<select name="{{ $name or 'select' }}" id="{{ $name or 'select' }}" class="form-control input-md">
			<option value="">-- Select One --</option>
			@foreach($options as $option)
				<option value="{{ $option->id }}" {{ ($selected == $option->id ? 'selected' : '') }}>{{ $option->name }}</option>
			@endforeach
		</select>
	</div>
</div>
