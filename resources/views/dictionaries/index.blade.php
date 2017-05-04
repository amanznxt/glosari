@extends('layouts.master')
@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ url('css/datatables.css') }}">
@endsection

@section('scripts')
	<script type="text/javascript">
		var table;
		jQuery(document).ready(function($) {
			table = $('#dictionary-table').DataTable( {
				columnDefs: [
					{ width: "120px", targets: 1 }
				],
		        ajax: '{{ route('ajax.dictionaries.index') }}',
		        lengthMenu: [[25, 50, 75, 100], [25, 50, 75, 100]]
		    } );

		    $('#dictionary-table tbody').on( 'click', 'tr', function () {
		        if ( $(this).hasClass('selected') ) {
		            $(this).removeClass('selected');
		        }
		        else {
		            table.$('tr.selected').removeClass('selected');
		            $(this).addClass('selected');
		        }
		    } );


		    $('#dictionary_id').on('change' , function(){
		    	var word_id = $(this).data('dictionary');
		    	var lexicon_id = $(this).val();
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
		    });

		    $('#edit-dictionary-modal').on('show.bs.modal', function (event) {
			  var button = $(event.relatedTarget);
			  var dictionary_id = button.data('dictionary');
			  var dictionary_name = button.data('name');

			  $('#dictionary_name').html(dictionary_name);

			  $.ajax({
			  	url: '{!! route('ajax.dictionaries.words.lexicons.update') !!}',
			  	data: {id: dictionary_id},
			  })
			  .done(function(result) {

			  	$('#dictionary_id').attr({
		  			'data-dictionary': dictionary_id
		  		});
			  	if(result.lexicon) {
			  		$('#dictionary_id').attr({
			  			'data-lexicon': result.lexicon.id
			  		});
			  		$('#dictionary_id').val(result.lexicon.id);
			  	} else {
			  		$('#dictionary_id').val('');
			  		$('#dictionary_id').attr({
			  			'data-lexicon': ''
			  		});
			  		notyf.alert('Please update the word\'s lexicon');
			  	}
			  })
			  .fail(function() {
			  	console.log("error");
			  })
			  .always(function() {
			  	console.log("complete");
			  });
			})
		});

		function deleteDictionary(dictionary_id)
		{
			if(!confirm('Are you sure want to delete this record?')) {
				return false;
			}
			$.post('{!! route('ajax.dictionaries.words.destroy') !!}',
				{
					id : dictionary_id
				}, function(data, textStatus, xhr) {
				notyf.alert(data.message);
				table.ajax.reload();
			});
		}

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
	{{-- Edit Word Modal --}}
	<div class="modal fade" id="edit-dictionary-modal" tabindex="-1" role="dialog" aria-labelledby="edit-dictionary-modal-label">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="edit-dictionary-modal-label">Edit</h4>
	      </div>
	      <div class="modal-body">
	        <table class="table table-condensed table-hover">
				<tr>
					<td>Word</td>
					<td id="dictionary_name"></td>
				</tr>
				<tr>
					<td>Lexicon</td>
					<td>
						@include('components.dropdown', [
							'name'     => 'dictionary_id',
							'label'    => '',
				            'options'  => $lexicons,
				            'selected' => null
						])
					</td>
				</tr>
			</table>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="container">
	    <div class="row">
	        <div class="col-md-8 col-md-offset-2">
	            <div class="panel panel-default">
	                <div class="panel-heading">Dictionaries</div>

	                <div class="panel-body">
						<table id="dictionary-table" class="table table-condensed table-hover" cellspacing="0" width="100%">
					        <thead>
					            <tr>
					                <th>Name</th>
					                <th>&nbsp;</th>
					            </tr>
					        </thead>
					    </table>
	                </div>
				</div>
			</div>
		</div>
	</div>
@endsection
