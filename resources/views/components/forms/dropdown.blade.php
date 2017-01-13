<div class="form-group">
	{{ Form::select($name,
		$options->pluck('name', 'id'), $selected, [
			'placeholder' => '-- Select One --',
			'class' => 'form-control'
		])
	}}
  	@include('components.forms.error', ['name' => $name])
    <span class="label label-{{ $errors->has($name) ? 'danger' : 'primary' }}">{{ title_case($label) }}</span>
</div>
