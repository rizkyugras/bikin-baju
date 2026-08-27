<?php
/**
 * Template artikel blog (single post).
 *
 * @package Bikinbaju
 */

get_header();
?>

<main>

	<section class="page-hero">
		<div class="container">
			<nav class="breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Beranda</a><span aria-hidden="true">/</span><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a><span aria-hidden="true">/</span>Artikel</nav>
		</div>
	</section>

	<section>
		<div class="container">
			<?php while ( have_posts() ) : the_post(); ?>
				<article class="article">
					<header class="article-header">
						<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
						<h1><?php the_title(); ?></h1>
						<?php if ( has_excerpt() ) : ?>
							<p class="lead"><?php echo esc_html( get_the_excerpt() ); ?></p>
						<?php endif; ?>
					</header>
					<div class="article-body">
						<?php the_content(); ?>
					</div>
					<footer class="article-footer">
						<a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">← Semua artikel</a>
						<a class="btn btn-wa" href="<?php echo esc_url( bb_default_wa() ); ?>" rel="noopener" target="_blank">Tanya Harga</a>
					</footer>
				</article>
			<?php endwhile; ?>
		</div>
	</section>

</main>

<?php get_footer(); ?>