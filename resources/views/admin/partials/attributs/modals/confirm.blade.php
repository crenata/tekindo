<div class="ui mini modal modal-id{{ $id }}">
	<i class="close icon"></i>
	<div class="header">Delete Category</div>
	<div class="content text-center">
		<p>Are you sure?&ensp;You want to delete this category?</p>
	</div>
	<div class="actions">
		<div class="ui negative button">No</div>
		<div class="ui positive right labeled icon button">
			{{ Form::open(['route' => ['category.destroy', $category->id], 'method' => 'DELETE']) }}
				{{ Form::submit('Yes', ['class' => 'delete-button']) }}<i class="checkmark icon"></i>
			{{ Form::close() }}
		</div>
	</div>
</div>