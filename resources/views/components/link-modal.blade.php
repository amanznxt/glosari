<div class="btn-group">
	<a class="btn btn-xs btn-primary"
		data-toggle="modal"
		data-target="#{{ $toggle }}"
		data-dictionary="{{ $dictionary }}"
		data-name="{{ $name }}">
		<i class="glyphicon glyphicon-search"></i>
	</a>
	<div class="btn btn-xs btn-danger" onclick="deleteDictionary({{ $dictionary }})">
		<i class="glyphicon glyphicon-trash"></i>
	</div>
</div>
