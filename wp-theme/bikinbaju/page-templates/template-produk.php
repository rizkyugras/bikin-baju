<?php
/**
 * Template Name: Produk
 *
 * @package Bikinbaju
 */

get_header();

$theme = get_template_directory_uri();
$products = bb_products();
$slug = get_post_field( 'post_name' );
$current = null;
foreach ( $products as $p ) {
	if ( $p['slug'] === $slug ) {
		$current = $p;
		break;
	}
}

$meta = function ( $key ) {
	return get_post_meta( get_the_ID(), $key, true );
};

$harga = $meta( '_bb_harga' );
$tagline = $meta( '_bb_tagline' );
$image = $meta( '_bb_image' );
$wa_text = $meta( '_bb_wa' );
if ( empty( $image ) ) {
	$image = '/assets/img/galeri/galeri-01.webp';
}
if ( empty( $wa_text ) ) {
	$wa_text = 'Halo Bikinbaju, saya mau tanya harga seragam. Bisa dibantu?';
}
$wa_url = bb_wa_url( $wa_text );

$wa_svg = '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.297-.497.1-.198.05-.371-.025-.52-.074-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>';

$bahan = array_filter( array_map( 'trim', explode( "\n", $meta( '_bb_bahan' ) ) ) );
$specs = array_filter( array_map( 'trim', explode( "\n", $meta( '_bb_spesifikasi' ) ) ) );
$uses = array_filter( array_map( 'trim', explode( "\n", $meta( '_bb_uses' ) ) ) );
$faqs = array_filter( array_map( 'trim', explode( "\n", $meta( '_bb_faq' ) ) ) );

$related = array();
if ( $current ) {
	foreach ( $products as $p ) {
		if ( $p['slug'] !== $current['slug'] ) {
			$related[] = $p;
		}
	}
}
$related = array_slice( $related, 0, 3 );
?>

<main>

	<section class="page-hero">
		<div class="container">
			<nav class="breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Beranda</a><span aria-hidden="true">/</span><?php the_title(); ?></nav>
			<h1><?php the_title(); ?></h1>
			<?php if ( $tagline ) : ?>
				<p class="page-sub"><?php echo esc_html( $tagline ); ?></p>
			<?php endif; ?>
			<?php if ( $harga ) : ?>
				<span class="price-chip"><?php echo esc_html( $harga ); ?> / pcs</span>
			<?php endif; ?>
		</div>
	</section>

	<section>
		<div class="container product-layout">
			<div class="product-photo">
				<img src="<?php echo esc_url( $theme . $image ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?> seragam produksi konveksi Bikinbaju" width="640" height="800">
			</div>
			<div class="product-content">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php if ( trim( get_the_content() ) ) : ?>
						<h2>Deskripsi Produk</h2>
						<?php the_content(); ?>
					<?php endif; ?>
				<?php endwhile; ?>

				<?php if ( ! empty( $bahan ) ) : ?>
					<h2>Pilihan Bahan</h2>
					<ul>
						<?php foreach ( $bahan as $b ) : ?>
							<li><?php echo wp_kses_post( $b ); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

				<?php if ( ! empty( $specs ) ) : ?>
					<h2>Spesifikasi</h2>
					<table class="spec-table">
						<tbody>
							<?php foreach ( $specs as $s ) : $parts = explode( '|', $s, 2 ); ?>
								<tr><th scope="row"><?php echo esc_html( trim( $parts[0] ) ); ?></th><td><?php echo esc_html( isset( $parts[1] ) ? trim( $parts[1] ) : '' ); ?></td></tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				<?php endif; ?>

				<?php if ( ! empty( $uses ) ) : ?>
					<h2>Cocok Untuk</h2>
					<ul>
						<?php foreach ( $uses as $u ) : ?>
							<li><?php echo esc_html( $u ); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

				<div class="product-cta">
					<p>Minta penawaran <?php echo esc_html( strtolower( get_the_title() ) ); ?>?<small>Balasan cepat di jam kerja — Senin–Sabtu 08.00–17.00 WIB.</small></p>
					<a class="btn btn-wa" href="<?php echo esc_url( $wa_url ); ?>" rel="noopener" target="_blank"><?php echo $wa_svg; ?> Tanya Harga</a>
				</div>
			</div>
		</div>
	</section>

	<?php if ( ! empty( $faqs ) ) : ?>
		<section class="stitch-top" style="background:var(--teal-50);padding-top:clamp(48px,6vw,72px)">
			<div class="container">
				<div class="section-head center">
					<p class="kicker">FAQ</p>
					<h2 class="section-title">Pertanyaan Seputar <?php the_title(); ?></h2>
				</div>
				<div class="faq-list">
					<?php foreach ( $faqs as $f ) : $parts = explode( '||', $f, 2 ); ?>
						<details class="faq-item">
							<summary><?php echo esc_html( trim( $parts[0] ) ); ?></summary>
							<p class="faq-a"><?php echo esc_html( isset( $parts[1] ) ? trim( $parts[1] ) : '' ); ?></p>
						</details>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<section class="cta-band">
		<div class="container">
			<h2>Butuh Seragam Lainnya?</h2>
			<p>Kami memproduksi semua jenis seragam perusahaan — bisa dipadukan dalam satu pesanan agar desain dan warnanya seragam.</p>
			<div class="hero-actions">
				<a class="btn btn-wa" href="<?php echo esc_url( bb_default_wa() ); ?>" rel="noopener" target="_blank">Konsultasi Gratis</a>
				<a class="btn btn-outline" href="<?php echo esc_url( home_url( '/#produk' ) ); ?>">Lihat Semua Produk</a>
			</div>
		</div>
	</section>

	<?php if ( ! empty( $related ) ) : ?>
		<section class="related-products">
			<div class="container">
				<div class="section-head center">
					<p class="kicker">Produk Lainnya</p>
					<h2 class="section-title">Lengkapi Seragam Perusahaan Anda</h2>
				</div>
				<div class="product-grid">
					<?php foreach ( $related as $p ) : ?>
						<article class="product-card">
							<div class="thumb"><img src="<?php echo esc_url( $theme . $p['image'] ); ?>" alt="<?php echo esc_attr( $p['name'] ); ?> produksi Bikinbaju" loading="lazy" width="480" height="360"></div>
							<div class="body">
								<h3><a href="<?php echo esc_url( home_url( '/' ) . $p['slug'] . '/' ); ?>"><?php echo esc_html( $p['name'] ); ?></a></h3>
								<span class="price-chip"><?php echo esc_html( $p['price'] ); ?></span>
								<a class="card-link" href="<?php echo esc_url( home_url( '/' ) . $p['slug'] . '/' ); ?>">Lihat detail →</a>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

</main>

<?php get_footer(); ?>