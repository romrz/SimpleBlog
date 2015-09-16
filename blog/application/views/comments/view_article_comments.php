<script type="text/javascript" src="<?= static_scripts_url('comment.js') ?>"></script>

<div id="ctn-new-comment">
	<section id="new-comment">
		<div id="status"></div>
		<h3>Nuevo comentario</h3>
		<form action="" method="post" class="stack-form" id="form-new-comment">
			<label>Nombre:</label>
			<input type="text" name="comment_user_name" id="user_name">

			<label>Email:</label>
			<input type="text" name="comment_user_email" id="user_email">

			<label>Web:</label>
			<input type="text" name="comment_user_url" id="user_url">

			<label>Comentario:</label>
			<textarea name="comment_content" id="comment_content"></textarea>

			<input type="hidden" name="comment_parent" id="comment-parent" value="0">
			<input type="hidden" name="article_id" id="comment_article" value="<?= $article->article_id ?>">

			<button type="submit">Comentar</button>
		</form>
		<div id="cancel-reply">
			<button>Cancel</button>
		</div>
	</section>
</div>

<section class="comments" id="comments">

	<h3>Comments (<?= $article->article_comments ?>)</h3>

	<?php foreach($comments as $comment): ?>

	<div class="comment">
		<article id="comment-<?= $comment->comment_id ?>">
			<h4>
				<?php if($comment->comment_user_url != ''): ?>
				<a href="<?= $comment->comment_user_url ?>"><?= $comment->comment_user_name ?></a>
				<?php else: ?>
					<?= $comment->comment_user_name ?>
				<?php endif; ?>
			</h4>
			<small class="info"><?= $comment->comment_date ?></small>
			<a href="#comment-<?= $comment->comment_id ?>" class="button-answer" comment="<?= $comment->comment_id ?>">Responder</a>
			<p><?= $comment->comment_content ?></p>
		</article>

		<?php 
			$i = 0;
			foreach($answers as $answer):
				if($answer->comment_parent == $comment->comment_id):
		?>

		<article class="comment" id="comment-<?= $answer->comment_id ?>">
			<h4>
				<?php if($answer->comment_user_url != ''): ?>
				<a href="<?= $answer->comment_user_url ?>"><?= $answer->comment_user_name ?></a>
				<?php else: ?>
					<?= $answer->comment_user_name ?>
				<?php endif; ?>
			</h4>
			<small class="info"><?= $answer->comment_date ?></small>
			<p><?= $answer->comment_content ?></p>
		</article>

		<?php
					unset($answers[$i]);
				endif;
				$i++;
			endforeach;
		?>

	</div>

	<?php endforeach; ?>

</section>