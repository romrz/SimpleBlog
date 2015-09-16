<h1>Articulos</h1>

<?php foreach($articles as $article): ?>

<article>
	<h3 class="inline">
		<a href="<?= article_url($article->article_url, $article->article_date) ?>"><?= $article->article_title ?></a>
	</h3>
	<span class="inline">
		<small><a href="<?= edit_article_url($article->article_id) ?>">Editar</a></small>
		<small><a href="<?= del_article_url($article->article_id) ?>">Eliminar</a></small>
	</span>
</article>

<?php endforeach; ?>