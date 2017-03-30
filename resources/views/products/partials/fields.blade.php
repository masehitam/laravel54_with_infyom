<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', 'Category:') !!}
    {!! Form::select('category_id', $categories, $selectedCategory, ['class' => 'form-control']) !!}
</div>

<!-- Picture Field -->
<div class="form-group col-sm-6">
	<label>Picture</label>
	@if(isset($product) && $product->picture)
		<div class="existImage">
			<button class="btn btn-default btn-branch-delete-image" type="button"><i class="fa fa-times"></i></button><br>
			<input type="hidden" class="store-delete" name="isDelete" value="0">
			<img class="image-preview" src="{{ asset($product->picture) }}" >
		</div><br>
		<input type="file" class="form-control hide image-preview-option" data-image-preview="new-image-preview" name="picture" accept="image/*">
		<img class="hide new-image-preview" src="#" alt="Preview image" />
	@else
		<input type="file" class="form-control image-preview-option" data-image-preview="image-preview" name="picture" accept="image/*">
		<img class="hide image-preview" src="#" alt="Preview image" />
	@endif
</div>


<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('products.index') !!}" class="btn btn-default">Cancel</a>
</div>
