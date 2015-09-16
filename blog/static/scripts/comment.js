$(document).ready(function()	{

	$(".button-answer").click(function()	{

		var comment_id = $(this).attr("comment");

		$("#comment-parent").val(comment_id);

		$("#new-comment").appendTo("#comment-" + comment_id);

		$("#cancel-reply").show();

	});

	$("#cancel-reply").click(function()	{

		$("#comment-parent").val(0);

		$("#new-comment").appendTo("#ctn-new-comment");

		$("#cancel-reply").hide();

	});

	$("#form-new-comment").submit(function(){

		if($("#user_name").val() == "" || $("#user_email").val() == "" || $("#comment_content").val() == "" || $("#comment_parent").val() == "" || $("#comment_article").val() == "")
		{
			$("#status").html("<p>Llena todos los campos.</p>");
		}
		else
		{
			$.ajax({
				type: "POST",
				url: "http://localhost/Blog/blog/comment/insert",
				data: $(this).serialize(),
				beforeSend: function(){
					$("#status").html("<p>Guardando...</p>");
				},
				success: function(){
					$("#status").html("<p>Se ha enviado correctamente tu comentario para moderacion.</p>");
					$("#comment_content").html("");
				},
				error: function(){
					$("#status").html("<p>No se ha podido guardar tu comentario. Por favor intentalo mas tarde.</p>");
				}
			});
		}

		return false;

	});


	$(".btn-comment-status").click(function(){

		$.ajax({
			type: "POST",
			url: "http://localhost/Blog/blog/comment/status",
			data: { comment_id: $(this).attr("comment"), status: $(this).val() },
			success: function(){
				$(this).html("Done");
			}
		});

	});	

});