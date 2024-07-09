<?php 
/**
* Comments for wordpress 
* @package MainterThemes
*/
if ( post_password_required() ) return;?>

<div id="comments" class="comments">
	
	<?php if(have_comments()): ?>
		<h2>Numero de comentario: <?php comments_number(); ?></h2>
			<ul>
				<?php wp_list_comments(); ?>
			</ul>
	
	<?php endif; ?>

	<!-- Formulario de los commentarios -->
	<?php comment_form(); ?>
</div>