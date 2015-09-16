<section class="comments" id="comments">
	<div class="comment">
		<article>
			<h4 class="inline"><a href="<?= $comment->comment_user_url ?>"><?= $comment->comment_user_name ?></a></h4>
			<small class="inline">
				<a href="<?= edit_comment_url($comment->comment_id) ?>">Editar</a>
				<a href="<?= del_comment_url($comment->comment_id) ?>">Eliminar</a>
			</small>
			<br>
			<small class="info">
				<a href="<?= comment_url($comment->comment_id) ?>">#<?= $comment->comment_id ?></a>
				<?= $comment->comment_date ?> - 
				Article: <a href="<?= article_url($comment->article_id, $comment->article_url) ?>"><?= $comment->article_title ?></a>
			</small>
			<p><?= $comment->comment_content ?></p>
		</article>

		<?php 
			$i = 0;
			foreach($answers as $answer):
				if($answer->comment_parent == $comment->comment_id):
		?>

		<article class="comment" >
			<h4><a href="<?= $answer->comment_user_url ?>"><?= $answer->comment_user_name ?></a></h4>
			<small class="info">
				<a href="<?= comment_url($answer->comment_id) ?>">#<?= $answer->comment_id ?></a>
				<?= $answer->comment_date ?>
			</small>
			<br>
			<p><?= $answer->comment_content ?></p>
		</article>

		<?php
					unset($answers[$i]);
				endif;
				$i++;
			endforeach; 
		?>

	</div>
</section>