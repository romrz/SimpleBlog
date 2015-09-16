<h1>Categorias</h1>

<?php foreach($categories as $category): ?>

<article>
	<h3 class="inline">
		<a href="<?= category_url($category->category_display_name) ?>"><?= $category->category_display_name ?></a>
	</h3>
	<span class="inline">
		<small><a href="<?= edit_category_url($category->category_id) ?>">Editar</a></small>
		<small><a href="<?= del_category_url($category->category_id) ?>">Eliminar</a></small>
	</span>
</article>

<?php endforeach; ?>