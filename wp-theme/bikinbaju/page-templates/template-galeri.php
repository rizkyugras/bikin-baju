<?php
/**
 * Template Name: Galeri
 *
 * @package Bikinbaju
 */

get_header();

$theme = get_template_directory_uri();
$gallery = array(
	'galeri-01.webp' => 'Kemeja seragam kerja two-tone produksi Bikinbaju',
	'galeri-02.webp' => 'Kemeja kerja lengan panjang bordir logo perusahaan',
	'galeri-03.webp' => 'Jaket kerja navy bordir logo dan atribut perusahaan',
	'galeri-04.webp' => 'Jaket work jacket hijau untuk tim lapangan',
	'galeri-05.webp' => 'Jaket kerja abu-abu hasil produksi konveksi Bikinbaju',
	'galeri-06.webp' => 'Jaket institusi navy dengan aksen merah',
	'galeri-07.webp' => 'Jaket parasut olive untuk seragam tim',
	'galeri-08.webp' => 'Jaket varsity custom sablon belakang',
	'galeri-09.webp' => 'Jaket kerja hitam bordir logo perusahaan',
	'galeri-10.webp' => 'Jaket kerja navy dengan bordir logo dada',
	'galeri-11.webp' => 'Kemeja seragam kerja wanita navy berhijab',
	'galeri-12.webp' => 'Detail bordir logo di dada seragam kerja',
);
$wa_katalog = bb_wa_url( 'Halo Bikinbaju, saya mau minta katalog produk. Bisa dibantu?' );
?>

<main>

	<section class="page-hero">
		<div class="container">
			<nav class="breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Beranda</a><span aria-hidden="true">/</span>Galeri</nav>
			<h1>Galeri Produksi Seragam</h1>
			<p class="page-sub">Dokumentasi proses dan hasil produksi di workshop Bikinbaju — dari pemotongan kain, penjahitan, bordir, hingga pesanan siap kirim ke klien di seluruh Indonesia.</p>
		</div>
	</section>

	<section>
		<div class="container">
			<div class="gallery-page-grid">
				<?php $n = 1; foreach ( $gallery as $file => $alt ) : ?>
					<button class="gallery-item" type="button" aria-label="Perbesar foto galeri <?php echo $n; ?>"><img src="<?php echo esc_url( $theme . '/assets/img/galeri/' . $file ); ?>" alt="<?php echo esc_attr( $alt ); ?>" loading="lazy" width="400" height="400"></button>
					<?php $n++; endforeach; ?>
			</div>

			<div class="product-cta" style="margin-top:44px">
				<p>Mau lihat lebih banyak contoh hasil produksi?<small>Kunjungi Instagram kami atau minta katalog produk lengkap via WhatsApp.</small></p>
				<div class="hero-actions" style="margin-top:0">
					<a class="btn btn-ghost" href="https://www.instagram.com/official.bikinbaju" rel="noopener" target="_blank">Instagram @official.bikinbaju</a>
					<a class="btn btn-wa" href="<?php echo esc_url( $wa_katalog ); ?>" rel="noopener" target="_blank">Minta Katalog</a>
				</div>
			</div>
		</div>
	</section>

	<section class="cta-band">
		<div class="container">
			<h2>Hasil Produksi Kami Bicara Sendiri</h2>
			<p>Konsultasi gratis, desain gratis, sampel kain gratis. Mulai dari 12 pcs saja.</p>
			<div class="hero-actions">
				<a class="btn btn-wa" href="<?php echo esc_url( bb_default_wa() ); ?>" rel="noopener" target="_blank">Tanya Harga Sekarang</a>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>