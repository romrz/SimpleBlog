<?= validation_errors() ?>

<h2>Editar Articulo</h2>
<form action="<?= edit_article_url($article->article_id) ?>" method="post" class="stack-form">

	<label>Titulo:</label>
	<input type="text" name="article_title" value="<?= $article->article_title ?>">

	<label>Url:</label>
	<input type="text" name="article_url" value="<?= $article->article_url ?>">

	<label>Contenido:</label>
	<textarea name="article_content"><?= $article->article_content ?></textarea>

	<label>Categoria:</label>
	<select name="article_category">

		<?php if(empty($article->category_id)): ?>
			<option value="0" selected>Selecciona una categoria</option>
		<?php endif; ?>		
		
		<?php foreach($categories as $category): ?>
			<?php if($category->category_id == $article->category_id): ?>
			<option value="<?= $category->category_id ?>" selected><?= $category->category_display_name ?></option>
			<?php else: ?>
			<option value="<?= $category->category_id ?>"><?= $category->category_display_name ?></option>
			<?php endif; ?>
		<?php endforeach; ?>

	</select>

	<input type="submit" value="Guardar">

</form>