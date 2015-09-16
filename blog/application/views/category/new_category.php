<h2>Nueva categoria</h2>

<?= validation_errors() ?>

<form action="<?= new_category_url() ?>" method="post" class="stack-form">
	<label>Categoria:</label>
	<input type="text" name="category_display_name">

	<label>Url:</label>
	<input type="text" name="category_url">

	<input type="submit" value="Guardar">
</form>