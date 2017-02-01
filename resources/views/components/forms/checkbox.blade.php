<div class="form-group">
	{{ Form::checkbox($name, $value, $checked) }}
  	@include('components.forms.error', ['name' => $name])
    <span class="label label-{{ $errors->has($name) ? 'danger' : 'primary' }}">{{ title_case($label) }}</span>
</div>
