<script type="text/javascript" src="<?= static_scripts_url('comment.js') ?>"></script>

<section class="comments" id="comments">
	<h3>Comments</h3>

	<?php foreach($comments as $comment): ?>

	<article class="comment">
		<h4 class="inline"><a href="<?= comment_url($comment->comment_id) ?>"><?= $comment->comment_user_name ?></a></h4>
		<small class="inline">
			<a href="<?= edit_comment_url($comment->comment_id) ?>">Editar</a> - 
			<a href="<?= del_comment_url($comment->comment_id) ?>">Eliminar</a> - 
			
			<?php if($comment->comment_approved == 1): ?>
			<button class="btn-comment-status" comment="<?= $comment->comment_id ?>" value="0">Desaprobar</button>
			<?php else: ?>
			<button class="btn-comment-status" comment="<?= $comment->comment_id ?>" value="1">Aprobar</button>
			<?php endif; ?>
		</small>
		<br>
		<small class="info">
		<a href="<?= comment_url($comment->comment_id) ?>">#<?= $comment->comment_id ?></a>
		<?= $comment->comment_date ?> - 
		Article: <a href="<?= article_url($comment->article_url, $comment->article_date) ?>"><?= $comment->article_title ?></a>
		</small>
		<p><?= $comment->comment_content ?></p>
	</article>

	<?php endforeach; ?>

</section>