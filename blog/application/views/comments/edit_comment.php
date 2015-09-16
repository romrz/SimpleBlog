<?= validation_errors() ?>

<section id="new-comment">
	<h3>Editar comentario</h3>
	<form action="<?= edit_comment_url($comment->comment_id) ?>" method="post" class="stack-form" id="form-new-comment">
		<label>Nombre:</label>
		<input type="text" name="comment_user_name" value="<?= $comment->comment_user_name ?>">

		<label>Email:</label>
		<input type="text" name="comment_user_email" value="<?= $comment->comment_user_email ?>">

		<label>Web:</label>
		<input type="text" name="comment_user_url" value="<?= $comment->comment_user_url ?>">

		<label>Comentario:</label>
		<textarea name="comment_content"><?= $comment->comment_content ?></textarea>

		<input type="submit" value="Guardar">
	</form>
</section>