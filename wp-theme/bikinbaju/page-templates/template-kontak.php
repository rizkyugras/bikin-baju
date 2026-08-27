<?php
/**
 * Template Name: Kontak
 *
 * @package Bikinbaju
 */

get_header();

$wa_url = bb_default_wa();
?>

<main>

	<section class="page-hero">
		<div class="container">
			<nav class="breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Beranda</a><span aria-hidden="true">/</span>Kontak</nav>
			<h1>Hubungi Konveksi Bikinbaju</h1>
			<p class="page-sub">Konsultasi, tanya harga, atau minta desain — semuanya bisa dimulai dari satu pesan WhatsApp. Balasan cepat di jam kerja: Senin–Sabtu 08.00–17.00 WIB.</p>
		</div>
	</section>

	<section>
		<div class="container contact-grid">
			<div>
				<div class="contact-cards">
					<a class="contact-card wa" href="<?php echo esc_url( $wa_url ); ?>" rel="noopener" target="_blank">
						<div class="icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.297-.497.1-.198.05-.371-.025-.52-.074-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg></div>
						<div><h3>WhatsApp (Cara Tercepat)</h3><p>Tanya harga, minta desain, atau konsultasi bahan. Balasan cepat di jam kerja.</p><span class="value">0812-1167-1157</span></div>
					</a>
					<a class="contact-card ig" href="https://www.instagram.com/official.bikinbaju" rel="noopener" target="_blank">
						<div class="icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zm0 10.162a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg></div>
						<div><h3>Instagram</h3><p>Lihat hasil produksi terbaru, proses jahit, dan aktivitas workshop kami setiap hari.</p><span class="value">@official.bikinbaju</span></div>
					</a>
					<div class="contact-card">
						<div class="icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 22a10 10 0 110-20 10 10 0 010 20zm1-10.41V6h-2v6.41l5.29 3.04 1-1.73L13 11.59z"/></svg></div>
						<div><h3>Jam Operasional</h3><p>Workshop aktif melayani produksi dan konsultasi pada jam berikut:</p><span class="value">Senin–Sabtu, 08.00–17.00 WIB</span></div>
					</div>
				</div>

				<?php while ( have_posts() ) : the_post(); ?>
					<?php if ( trim( get_the_content() ) ) : ?>
						<div class="article" style="margin-top:24px"><?php the_content(); ?></div>
					<?php endif; ?>
				<?php endwhile; ?>

			</div>
			<div class="map-embed">
				<iframe
					src="https://maps.google.com/maps?q=Jl.%20Sadewa%20No.2%20Karanganyar%20Jawa%20Tengah&t=&z=15&ie=UTF8&iwloc=&output=embed"
					loading="lazy"
					referrerpolicy="no-referrer-when-downgrade"
					title="Peta lokasi workshop Bikinbaju di Karanganyar"
					allowfullscreen></iframe>
			</div>
		</div>
	</section>

	<section class="cta-band">
		<div class="container">
			<h2>Siap Diskusi Soal Seragam Anda?</h2>
			<p>Kirim pesan sekarang — sebutkan jenis seragam, perkiraan jumlah, dan target waktu pakai. Tim kami bantu dari desain sampai pengiriman.</p>
			<div class="hero-actions">
				<a class="btn btn-wa" href="<?php echo esc_url( bb_wa_url( 'Halo Bikinbaju, saya mau konsultasi seragam perusahaan. Bisa dibantu?' ) ); ?>" rel="noopener" target="_blank">Chat WhatsApp Sekarang</a>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>