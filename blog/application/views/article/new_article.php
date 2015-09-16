<?= validation_errors() ?>

<h2>Nuevo Articulo</h2>
<form action="<?= new_article_url() ?>" method="post" class="stack-form">

	<label>Titulo:</label>
	<input type="text" name="article_title">

	<label>Url:</label>
	<input type="text" name="article_url">

	<label>Contenido:</label>
	<textarea name="article_content"></textarea>

	<label>Categoria:</label>
	<select name="article_category">
		<option value="0">Selecciona una categoria</option>

		<?php foreach($categories as $category): ?>
		<option value="<?= $category->category_id ?>"><?= $category->category_display_name ?></option>
		<?php endforeach; ?>

	</select>

	<input type="submit" value="Guardar">

</form>