<?php get_header(); ?>

<!-- {{ Homepage }} --> 	
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


<?php endwhile; else : ?>
<p>Lo siento, no hemos encontrado ningún post.</p>
<?php endif; ?>
			
<?php get_footer(); ?>