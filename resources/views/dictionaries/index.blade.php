@extends('layouts.master')
@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ url('css/datatables.css') }}">
@endsection

@section('scripts')
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('#dictionary-table').DataTable( {
		        ajax: '{{ route('ajax.dictionaries.index') }}',
		        lengthMenu: [[100, 250, 500], [100, 250, 500]]
		    } );
		});
	</script>
@endsection

@section('content')
	<div class="container">
	    <div class="row">
	        <div class="col-md-8 col-md-offset-2">
	            <div class="panel panel-default">
	                <div class="panel-heading">Dashboard</div>

	                <div class="panel-body">
						<table id="dictionary-table" class="display" cellspacing="0" width="100%">
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
