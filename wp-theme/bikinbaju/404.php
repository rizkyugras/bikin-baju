<?php
/**
 * Halaman 404.
 *
 * @package Bikinbaju
 */

get_header();
?>

<main class="notfound">
	<div class="container">
		<h1>404</h1>
		<p>Halaman yang Anda cari tidak ditemukan. Silakan kembali ke beranda atau hubungi kami langsung.</p>
		<a class="btn btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">Kembali ke Beranda</a>
	</div>
</main>

<?php get_footer(); ?>