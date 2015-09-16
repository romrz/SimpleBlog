<?php foreach($articles as $article): ?>
<h3><a href="<?= article_url($article->article_url, $article->article_date) ?>"><?= $article->article_title ?></a></h3>
<?php endforeach; ?>