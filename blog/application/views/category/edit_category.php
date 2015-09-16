<?= validation_errors() ?>

<h2>Editar Categoria</h2>
<form action="<?= edit_category_url($category->category_id) ?>" method="post" class="stack-form">

	<label>Categoria:</label>
	<input type="text" name="category_display_name" value="<?= $category->category_display_name ?>">

	<label>Url:</label>
	<input type="text" name="category_url" value="<?= $category->category_url ?>">

	<input type="submit" value="Guardar">

</form>