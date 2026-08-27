<?php
/**
 * Template daftar blog (archive/halaman Blog).
 *
 * @package Bikinbaju
 */

get_header();
?>

<main>

	<section class="page-hero">
		<div class="container">
			<nav class="breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Beranda</a><span aria-hidden="true">/</span>Blog</nav>
			<h1>Blog Konveksi Bikinbaju</h1>
			<p class="page-sub">Tips memilih bahan, panduan pemesanan seragam, dan informasi dunia konveksi — langsung dari pengalaman memproduksi 928.000+ pcs pakaian.</p>
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
					<p><?php _e( 'Belum ada artikel. Mulai tulis dari menu Posts di dashboard.', 'bikinbaju' ); ?></p>
				<?php endif; ?>
			</div>

			<div style="text-align:center;margin-top:36px">
				<?php the_posts_pagination( array( 'mid_size' => 2, 'screen_reader_text' => ' ' ) ); ?>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>