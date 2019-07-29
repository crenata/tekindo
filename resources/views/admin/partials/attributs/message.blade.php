@if(session('success'))
	<div class="ui mini modal modal-success">
		<i class="close icon"></i>
		<div class="header">Success</div>
		<div class="content text-center">
			<p>{{ session('success') }}</p>
		</div>
		<div class="actions">
			<div class="ui positive right labeled icon button">
				Ok<i class="checkmark icon"></i>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.ui.modal.modal-success').modal({detachable: false}).modal('show');
		});
	</script>
@endif

@if(session('message') || session('status'))
	<div class="ui mini modal modal-message">
		<i class="close icon"></i>
		<div class="header">Message</div>
		<div class="content text-center">
			@if(session('message'))
				<p>{{ session('message') }}</p>
			@elseif(session('status'))
				<p>{{ session('status') }}</p>
			@endif
		</div>
		<div class="actions">
			<div class="ui positive right labeled icon button">
				Ok<i class="checkmark icon"></i>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.ui.modal.modal-message').modal({detachable: false}).modal('show');
		});
	</script>
@endif

@if(session('errors'))
	<div class="ui mini modal modal-error">
		<i class="close icon"></i>
		<div class="header">Error</div>
		<div class="content text-center">
			<p>{{ session('errors') }}</p>
		</div>
		<div class="actions">
			<div class="ui negative right labeled icon button">
				Ok<i class="checkmark icon"></i>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.ui.modal.modal-error').modal({detachable: false}).modal('show');
		});
	</script>
@endif