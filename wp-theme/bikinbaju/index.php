<?php
/**
 * Fallback index.
 *
 * @package Bikinbaju
 */

get_header();
?>

<main>

	<section class="page-hero">
		<div class="container">
			<nav class="breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Beranda</a></nav>
			<h1><?php _e( 'Artikel', 'bikinbaju' ); ?></h1>
		</div>
	</section>

	<section>
		<div class="container">
			<div class="post-list">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<article class="post-card">
						<div class="body">
							<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
							<a class="card-link" href="<?php the_permalink(); ?>">Baca artikel →</a>
						</div>
					</article>
				<?php endwhile; else : ?>
					<p><?php _e( 'Belum ada artikel.', 'bikinbaju' ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>