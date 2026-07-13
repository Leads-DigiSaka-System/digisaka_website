<article <?php post_class( 'post-card post-card--inner reveal' ); ?>>
	<a class="post-card__image" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'medium_large' );
		} else {
			echo '<span class="placeholder-image"></span>';
		}
		?>
		<span class="post-card__badge"><?php echo esc_html( get_the_date( 'M j' ) ); ?></span>
	</a>
	<div class="post-card__body">
		<p class="post-card__meta"><?php echo esc_html( get_the_date() ); ?></p>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php the_excerpt(); ?>
		<a class="post-card__read" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read update', 'digisaka-theme' ); ?></a>
	</div>
</article>