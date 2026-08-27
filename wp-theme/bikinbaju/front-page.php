<?php
/**
 * Template halaman depan (Beranda).
 *
 * @package Bikinbaju
 */

get_header();

$theme = get_template_directory_uri();
$products = bb_products();
$wa_default = bb_default_wa();
$wa_design = bb_wa_url( 'Halo Bikinbaju, saya mau minta dibuatkan desain seragam. Bisa dibantu?' );

$check = '<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>';
$wa_svg = '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.297-.497.1-.198.05-.371-.025-.52-.074-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>';
?>

<main>

	<section class="hero" aria-label="Perkenalan">
		<div class="container hero-grid">
			<div>
				<p class="kicker">Konveksi Seragam Terpercaya Sejak 2017</p>
				<h1>Konveksi <em>Seragam Kerja</em> &amp; Seragam Kantor</h1>
				<p class="hero-sub">Produsen seragam untuk perusahaan di <strong>seluruh Indonesia dan luar negeri</strong>. Lebih dari <strong>1.300 klien</strong> telah membuktikan dengan <strong>928.000+ pcs</strong> pakaian yang kami produksi — minimum order 12 pcs saja.</p>
				<div class="hero-actions">
					<a class="btn btn-wa" href="<?php echo esc_url( $wa_default ); ?>" rel="noopener" target="_blank"><?php echo $wa_svg; ?> Tanya Harga via WhatsApp</a>
					<a class="btn btn-outline" href="#produk">Lihat Produk</a>
				</div>
				<div class="hero-chips">
					<span class="chip"><?php echo $check; ?> Free ongkir</span>
					<span class="chip"><?php echo $check; ?> MOQ mulai 12 pcs</span>
					<span class="chip"><?php echo $check; ?> Desain &amp; sampel kain gratis</span>
				</div>
			</div>
			<div class="hero-visual" aria-hidden="true">
				<div class="hero-badge">Total Produksi<b>928.000+ pcs</b></div>
				<div class="hero-card a"><img src="<?php echo esc_url( $theme . '/assets/img/produk/kemeja.webp' ); ?>" alt="" loading="eager" width="480" height="600"></div>
				<div class="hero-card b"><img src="<?php echo esc_url( $theme . '/assets/img/galeri/jaket-safety.webp' ); ?>" alt="" loading="lazy" width="480" height="360"></div>
			</div>
		</div>
	</section>

	<section class="stats-band" aria-label="Statistik produksi">
		<div class="container stats-grid">
			<div class="stat"><b>1.300+</b><span>Klien perusahaan</span></div>
			<div class="stat"><b>928.000+</b><span>Pcs pakaian diproduksi</span></div>
			<div class="stat"><b>120+</b><span>Desain referensi</span></div>
			<div class="stat"><b>12 pcs</b><span>Minimum order</span></div>
		</div>
	</section>

	<section id="tentang">
		<div class="container intro-grid">
			<div class="reveal">
				<p class="kicker">Produsen Seragam Berpengalaman</p>
				<h2 class="section-title">Ahli Seragam Kerja yang Dipercaya 1.300+ Perusahaan di Seluruh Indonesia</h2>
				<p style="margin-top:18px"><strong>Bikin-Baju.com (Bikinbaju) adalah konveksi seragam kerja dan seragam kantor</strong> yang beroperasi sejak 2017, memproduksi kemeja, kaos t-shirt, polo shirt, rompi, celana, dan wearpack untuk perusahaan di seluruh Indonesia maupun luar negeri.</p>
				<p>Hingga hari ini lebih dari <strong>1.300 perusahaan</strong> — termasuk Pertamina, Pelindo, Pegadaian, dan Nusa Raya Cipta — mempercayakan seragam mereka kepada kami, dengan total lebih dari <strong>928.000 pcs pakaian diproduksi</strong>. Setiap pesanan dikerjakan tenaga jahit berpengalaman dengan kontrol kualitas berlapis: dari pemilihan bahan, pemotongan, jahitan, hingga pengemasan. Kami berkomitmen pada <strong>produksi tepat waktu, garansi produksi, dan harga bersaing</strong> — supaya perusahaan Anda mendapat seragam terbaik tanpa melebihi anggaran.</p>
			</div>
			<div class="intro-facts reveal">
				<div class="fact"><b>Sejak 2017</b><span>Berpengalaman memproduksi seragam perusahaan</span></div>
				<div class="fact"><b>1.300+ klien</b><span>Dari BUMN, swasta, hingga kontraktor proyek</span></div>
				<div class="fact"><b>928.000+ pcs</b><span>Total pakaian telah diproduksi</span></div>
				<div class="fact"><b>Indonesia &amp; LN</b><span>Area pengiriman, gratis ongkir untuk pesanan tertentu</span></div>
			</div>
		</div>
	</section>

	<section id="produk" class="stitch-top" style="background:var(--teal-50)">
		<div class="container">
			<div class="section-head center reveal">
				<p class="kicker">Produk Kami</p>
				<h2 class="section-title">Memproduksi Berbagai Jenis Pakaian Kerja</h2>
				<p class="section-sub">Enam jenis seragam yang paling banyak dipesan perusahaan — semua bisa custom model, bahan, dan logo Anda.</p>
			</div>
			<div class="product-grid">
				<?php foreach ( $products as $p ) : ?>
					<article class="product-card reveal">
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

	<section id="fasilitas">
		<div class="container">
			<div class="section-head center reveal">
				<p class="kicker">Layanan &amp; Fasilitas</p>
				<h2 class="section-title">Semua yang Anda Butuhkan Tersedia Gratis</h2>
				<p class="section-sub">Selain produk berkualitas, kami lengkapi pesanan Anda dengan fasilitas tanpa biaya tambahan.</p>
			</div>
			<div class="facility-grid">
				<div class="facility reveal"><div class="icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 000-1.41l-2.34-2.34a1 1 0 00-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg></div><h3>Desain Gratis</h3><p>Tim desain kami membuatkan mock-up seragam sesuai identitas perusahaan Anda — tanpa biaya.</p></div>
				<div class="facility reveal"><div class="icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l-5.5 9 5.5 11 5.5-11L12 2zm0 3.3L14.9 10H9.1L12 5.3zM8.3 12l2.5 5-5-5h2.5zm7.4 0h2.5l-5 5 2.5-5z"/></svg></div><h3>Sampel Kain Gratis</h3><p>Mau merasakan dulu teksturnya? Kami kirimkan sampel kain sebelum produksi dimulai.</p></div>
				<div class="facility reveal"><div class="icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20 8h-3V4H3a2 2 0 00-2 2v11h2a3 3 0 006 0h6a3 3 0 006 0h2v-5l-3-4zM6 18.5A1.5 1.5 0 117.5 17 1.5 1.5 0 016 18.5zm13.5-9l1.96 2.5H17V9.5zM18 18.5a1.5 1.5 0 111.5-1.5 1.5 1.5 0 01-1.5 1.5z"/></svg></div><h3>Gratis Ongkos Kirim</h3><p>Untuk pesanan tertentu, seragam sampai di kantor Anda tanpa tambahan biaya kirim.</p></div>
				<div class="facility reveal"><div class="icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.65 6.35A8 8 0 106 17.66l1.49-1.49A6 6 0 1117.15 7.85L15 10h6V4l-3.35 2.35zM11 14v-3h2v3h3v2h-3v3h-2v-3H8v-2h3z" transform="rotate(180 12 12)"/></svg></div><h3>Garansi Retur</h3><p>Ada cacat produksi atau keliru ukuran dari kesalahan kami? Kami ganti. Syarat &amp; ketentuan berlaku.</p></div>
			</div>
		</div>
	</section>

	<section id="proses" class="stitch-top" style="background:var(--teal-50)">
		<div class="container">
			<div class="section-head center reveal">
				<p class="kicker">Cara Kerja Kami</p>
				<h2 class="section-title">Dari Desain Sampai Seragam Tiba di Kantor Anda</h2>
				<p class="section-sub">Proses yang jelas dan transparan — Anda selalu tahu pesanan sedang berada di tahap apa.</p>
			</div>
			<div class="steps">
				<div class="step reveal"><h3>Konsultasi &amp; Desain</h3><p>Ceritakan kebutuhan Anda via WhatsApp. Tim kami bantu memilih model &amp; bahan, lalu buatkan desain gratis.</p></div>
				<div class="step reveal"><h3>Sampel Kain &amp; Penawaran</h3><p>Kami kirim sampel kain beserta penawaran resmi. Semua jelas sejak awal, tanpa biaya tersembunyi.</p></div>
				<div class="step reveal"><h3>Produksi &amp; QC</h3><p>Pesanan dijahit tenaga berpengalaman dengan pemeriksaan kualitas berlapis di setiap tahap.</p></div>
				<div class="step reveal"><h3>Kirim &amp; Garansi</h3><p>Pesanan dikirim ke alamat Anda. Ada cacat produksi atau keliru ukuran? Kami ganti.</p></div>
			</div>
		</div>
	</section>

	<section id="katalog">
		<div class="container">
			<div class="section-head center reveal">
				<p class="kicker">Silahkan Download Gratis</p>
				<h2 class="section-title">Unduh Katalog &amp; Price List</h2>
				<p class="section-sub">Semua materi dapat diunduh gratis. Butuh versi cetak atau file lain? Minta lewat WhatsApp.</p>
			</div>
			<div class="download-list">
				<?php
				$katalog = array(
					array( 'Katalog Desain', 'Ilustrasi model seragam untuk referensi', 'katalog-desain.pdf' ),
					array( 'Katalog Produk', 'Kumpulan foto produk hasil jadi', 'katalog-produk.pdf' ),
					array( 'Price List', 'Detail harga setiap jenis pakaian', 'price-list.pdf' ),
					array( 'Company Profile', 'Informasi lengkap mengenai perusahaan', 'company-profile.pdf' ),
					array( 'Katalog Warna Kain', 'Pilihan warna bahan yang tersedia', 'katalog-warna-kain.pdf' ),
					array( 'Template Desain', 'Template untuk menempatkan logo Anda', 'template-desain.pdf' ),
				);
				$dl_icon = '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M5 20h14v-2H5v2zM12 2l-5.5 5.5 1.42 1.42L11 5.83V16h2V5.83l3.08 3.09 1.42-1.42L12 2z"/></svg>';
				foreach ( $katalog as $k ) :
					$wa_kat = bb_wa_url( 'Halo Bikinbaju, saya mau minta ' . strtoupper( $k[0] ) . '. Bisa dibantu?' );
					?>
					<a class="download-item reveal" href="<?php echo esc_url( $wa_kat ); ?>" rel="noopener" target="_blank">
						<div class="icon"><?php echo $dl_icon; ?></div>
						<div><h3><?php echo esc_html( $k[0] ); ?></h3><p><?php echo esc_html( $k[1] ); ?></p></div>
						<span class="dl-label">Minta via WA ↓</span>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section id="klien" class="stitch-top" style="background:var(--teal-50)">
		<div class="container">
			<div class="section-head center reveal">
				<p class="kicker">Klien Kami</p>
				<h2 class="section-title">1.300+ Perusahaan Telah Membuktikan</h2>
				<p class="section-sub">Dari BUMN, perusahaan swasta, hingga kontraktor proyek di berbagai industri.</p>
			</div>
			<div class="clients-strip reveal">
				<span class="client-logo">PERTAMINA</span>
				<span class="client-logo">PELINDO</span>
				<span class="client-logo">PEGADAIAN</span>
				<span class="client-logo">NUSA RAYA CIPTA</span>
				<span class="client-logo">+1.300 perusahaan lain</span>
			</div>
		</div>
	</section>

	<section id="galeri">
		<div class="container">
			<div class="section-head center reveal">
				<p class="kicker">Galeri Produksi</p>
				<h2 class="section-title">Lihat Langsung Hasil Produksi Kami</h2>
				<p class="section-sub">Dokumentasi proses dan hasil produksi seragam untuk klien di berbagai industri.</p>
			</div>
			<div class="gallery-grid reveal">
				<?php
				$gallery = array(
					'galeri-01.webp' => 'Kemeja seragam kerja two-tone produksi Bikinbaju',
					'galeri-02.webp' => 'Kemeja kerja lengan panjang bordir logo perusahaan',
					'galeri-03.webp' => 'Jaket kerja navy bordir logo dan atribut perusahaan',
					'galeri-04.webp' => 'Jaket work jacket hijau untuk tim lapangan',
					'galeri-05.webp' => 'Jaket kerja abu-abu hasil produksi konveksi Bikinbaju',
					'galeri-06.webp' => 'Jaket institusi navy dengan aksen merah',
					'galeri-07.webp' => 'Jaket parasut olive untuk seragam tim',
					'galeri-08.webp' => 'Jaket varsity custom sablon belakang',
				);
				$n = 1;
				foreach ( $gallery as $file => $alt ) :
					?>
					<button class="gallery-item" type="button" aria-label="Perbesar foto galeri <?php echo $n; ?>"><img src="<?php echo esc_url( $theme . '/assets/img/galeri/' . $file ); ?>" alt="<?php echo esc_attr( $alt ); ?>" loading="lazy" width="400" height="400"></button>
					<?php $n++; endforeach; ?>
			</div>
			<div style="text-align:center;margin-top:36px" class="reveal">
				<a class="btn btn-ghost" href="<?php echo esc_url( home_url( '/galeri/' ) ); ?>">Lihat Semua Foto</a>
			</div>
		</div>
	</section>

	<section id="faq" class="stitch-top" style="background:var(--teal-50)">
		<div class="container">
			<div class="section-head center reveal">
				<p class="kicker">FAQ</p>
				<h2 class="section-title">Pertanyaan yang Sering Diajukan</h2>
			</div>
			<div class="faq-list reveal">
				<details class="faq-item"><summary>Berapa minimum pemesanan seragam di Bikinbaju?</summary><p class="faq-a">Minimum pemesanan (MOQ) kami <strong>12 pcs per model</strong>. MOQ rendah ini memungkinkan tim kecil, cabang baru, maupun perusahaan besar memesan seragam dengan nyaman.</p></details>
				<details class="faq-item"><summary>Berapa harga bikin seragam kerja?</summary><p class="faq-a">Harga mulai dari: kaos t-shirt <strong>Rp 50.000</strong>, polo shirt <strong>Rp 70.000</strong>, rompi <strong>Rp 80.000</strong>, kemeja <strong>Rp 90.000</strong>, celana <strong>Rp 100.000</strong>, dan wearpack <strong>Rp 200.000</strong> per pcs. Harga final tergantung bahan, jumlah, dan sablon/bordir. Penawaran resmi gratis via WhatsApp.</p></details>
				<details class="faq-item"><summary>Apakah bisa memesan seragam dengan desain sendiri?</summary><p class="faq-a">Bisa. Tim desain kami membuatkan <strong>mock-up gratis</strong> sesuai identitas perusahaan Anda, lengkap dengan sampel kain gratis sebelum produksi dimulai.</p></details>
				<details class="faq-item"><summary>Berapa lama waktu produksi seragam?</summary><p class="faq-a">Umumnya <strong>2–3 minggu kerja</strong>, tergantung jumlah pesanan, jenis bahan, dan detail sablon/bordir. Estimasi pasti kami berikan saat penawaran.</p></details>
				<details class="faq-item"><summary>Apakah melayani kirim ke luar pulau atau luar negeri?</summary><p class="faq-a">Ya. Kami melayani pengiriman ke <strong>seluruh Indonesia dan luar negeri</strong>. Untuk pesanan tertentu tersedia gratis ongkos kirim.</p></details>
			</div>
		</div>
	</section>

	<section class="cta-band">
		<div class="container reveal">
			<h2>Konsultasikan Kebutuhan Seragam Anda Sekarang</h2>
			<p>Konsultasi gratis, desain gratis, sampel kain gratis. Ceritakan kebutuhan Anda — tim kami balas cepat di jam kerja (Senin–Sabtu 08.00–17.00 WIB).</p>
			<div class="hero-actions">
				<a class="btn btn-wa" href="<?php echo esc_url( $wa_default ); ?>" rel="noopener" target="_blank">Tanya Harga Sekarang</a>
				<a class="btn btn-outline" href="<?php echo esc_url( $wa_design ); ?>" rel="noopener" target="_blank">Minta Desain Gratis</a>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>