<article>
	<h2><?= $article->article_title ?></h2>

	<small class="info">
		<?= $article->article_date ?> - 
		By <a href="#"><?= $article->user_name ?></a> - 
		Category: <a href="<?= category_url($article->category_url) ?>"><?= $article->category_display_name ?></a> - 
		<a href="#comments"><?= $article->article_comments ?> comentarios</a>
	</small>

	<p>
		<?= $article->article_content ?>
	</p>
</article>