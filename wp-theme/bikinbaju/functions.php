<?php
/**
 * Bikinbaju theme functions.
 *
 * @package Bikinbaju
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BB_VERSION', '1.0' );
define( 'BB_WA', '6281211671157' );

/* -------------------------------------------------------------------------
 * Data produk
 * ---------------------------------------------------------------------- */
$GLOBALS['bb_products'] = require get_template_directory() . '/inc/product-data.php';

function bb_products() {
	return $GLOBALS['bb_products'];
}

function bb_wa_url( $text ) {
	$url = 'https://wa.me/' . BB_WA . '?text=' . rawurlencode( $text );
	return $url;
}

function bb_default_wa() {
	return bb_wa_url( 'Halo Bikinbaju, saya mau tanya harga seragam. Bisa dibantu?' );
}

/* -------------------------------------------------------------------------
 * Pengaturan beranda di Customizer (Appearance > Customize > "Beranda - Foto")
 * ---------------------------------------------------------------------- */
function bb_image( $key, $default_rel ) {
	$v = get_theme_mod( $key, '' );
	if ( $v ) {
		return esc_url( $v );
	}
	return esc_url( get_template_directory_uri() . $default_rel );
}

function bb_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'bb_home', array(
		'title'    => __( 'Beranda - Foto', 'bikinbaju' ),
		'priority' => 30,
	) );

	$images = array(
		'bb_hero_img_a' => array( 'Foto hero kiri', '/assets/img/produk/kemeja.webp' ),
		'bb_hero_img_b' => array( 'Foto hero kanan', '/assets/img/galeri/jaket-safety.webp' ),
	);
	foreach ( $images as $key => $info ) {
		$wp_customize->add_setting( $key, array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $key, array(
			'label'   => $info[0],
			'section' => 'bb_home',
			'settings'=> $key,
		) ) );
	}

	for ( $i = 1; $i <= 12; $i++ ) {
		$num = str_pad( $i, 2, '0', STR_PAD_LEFT );
		$key = 'bb_galeri_' . $num;
		$wp_customize->add_setting( $key, array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $key, array(
			'label'   => sprintf( __( 'Foto galeri %d', 'bikinbaju' ), $i ),
			'section' => 'bb_home',
			'settings'=> $key,
		) ) );
	}
}
add_action( 'customize_register', 'bb_customize_register' );

/* -------------------------------------------------------------------------
 * Media uploader untuk gambar produk di meta box
 * ---------------------------------------------------------------------- */
function bb_admin_assets( $hook ) {
	if ( 'post.php' === $hook || 'post-new.php' === $hook ) {
		wp_enqueue_media();
		wp_enqueue_script( 'bb-admin-media', get_template_directory_uri() . '/assets/js/admin-media.js', array( 'jquery' ), BB_VERSION, true );
	}
}
add_action( 'admin_enqueue_scripts', 'bb_admin_assets' );

/* -------------------------------------------------------------------------
 * Setup tema
 * ---------------------------------------------------------------------- */
function bikinbaju_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 60,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	register_nav_menus( array(
		'primary' => __( 'Menu Utama', 'bikinbaju' ),
	) );
}
add_action( 'after_setup_theme', 'bikinbaju_setup' );

/* -------------------------------------------------------------------------
 * Style & script
 * ---------------------------------------------------------------------- */
function bikinbaju_assets() {
	wp_enqueue_style( 'bikinbaju-font', 'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap', array(), null );
	wp_enqueue_style( 'bikinbaju-style', get_template_directory_uri() . '/assets/css/style.css', array( 'bikinbaju-font' ), BB_VERSION );
	wp_enqueue_script( 'bikinbaju-main', get_template_directory_uri() . '/assets/js/main.js', array(), BB_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'bikinbaju_assets' );

/* -------------------------------------------------------------------------
 * Meta box konten produk
 * ---------------------------------------------------------------------- */
function bb_product_metabox() {
	add_meta_box( 'bb_product_fields', __( 'Konten Produk', 'bikinbaju' ), 'bb_product_metabox_render', 'page', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'bb_product_metabox' );

function bb_product_metabox_render( $post ) {
	wp_nonce_field( 'bb_product_metabox', 'bb_product_metabox_nonce' );
	$fields = array(
		'_bb_harga'       => array( 'Harga mulai', 'Contoh: Mulai Rp 90.000' ),
		'_bb_tagline'     => array( 'Tagline (sub judul)', '' ),
		'_bb_image'       => array( 'Path gambar', 'Contoh: /assets/img/produk/kemeja.webp' ),
		'_bb_wa'          => array( 'Pesan WhatsApp', 'Teks pesan praisi (URL-encoded atau biasa)' ),
		'_bb_bahan'       => array( 'Bahan (satu per baris)', 'Format: Nama — deskripsi' ),
		'_bb_spesifikasi' => array( 'Spesifikasi (satu per baris)', 'Format: Nama|Nilai' ),
		'_bb_uses'        => array( 'Cocok untuk (satu per baris)', '' ),
		'_bb_faq'         => array( 'FAQ (satu per baris)', 'Format: Pertanyaan||Jawaban' ),
	);
	echo '<table style="width:100%;border-collapse:collapse">';
	foreach ( $fields as $key => $info ) {
		$val = get_post_meta( $post->ID, $key, true );
		echo '<tr>';
		echo '<td style="width:30%;vertical-align:top;padding:8px 10px 8px 0"><label for="' . esc_attr( $key ) . '"><strong>' . esc_html( $info[0] ) . '</strong><br><small>' . esc_html( $info[1] ) . '</small></label></td>';
		echo '<td style="padding:8px 0">';
		if ( '_bb_image' === $key ) {
			echo '<div style="display:flex;gap:8px;align-items:center">';
			echo '<input type="text" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" style="width:100%" placeholder="/assets/img/produk/kemeja.webp">';
			echo '<button type="button" class="button bb-pick-image" data-target="' . esc_attr( $key ) . '">Pilih dari Media</button>';
			echo '</div>';
		} else {
			echo '<textarea id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" rows="5" style="width:100%">' . esc_textarea( $val ) . '</textarea>';
		}
		echo '</td></tr>';
	}
	echo '</table>';
}

function bb_product_metabox_save( $post_id ) {
	if ( ! isset( $_POST['bb_product_metabox_nonce'] ) || ! wp_verify_nonce( $_POST['bb_product_metabox_nonce'], 'bb_product_metabox' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	foreach ( array( '_bb_harga', '_bb_tagline', '_bb_image', '_bb_wa', '_bb_bahan', '_bb_spesifikasi', '_bb_uses', '_bb_faq' ) as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_textarea_field( wp_unslash( $_POST[ $key ] ) ) );
		}
	}
}
add_action( 'save_post', 'bb_product_metabox_save' );

/* -------------------------------------------------------------------------
 * Menu fallback (jika belum ada menu dibuat di dashboard)
 * ---------------------------------------------------------------------- */
function bb_default_menu() {
	$items = array(
		array( 'Beranda', home_url( '/' ) ),
		array( 'Produk', home_url( '/#produk' ) ),
		array( 'Galeri', home_url( '/galeri/' ) ),
		array( 'Blog', home_url( '/blog/' ) ),
		array( 'Kontak', home_url( '/kontak/' ) ),
	);
	echo '<ul>';
	foreach ( $items as $item ) {
		$current = ( trailingslashit( home_url( add_query_arg( array() ) ) ) === trailingslashit( $item[1] ) ) ? ' aria-current="page"' : '';
		echo '<li><a href="' . esc_url( $item[1] ) . '"' . $current . '>' . esc_html( $item[0] ) . '</a></li>';
	}
	echo '</ul>';
}

/* -------------------------------------------------------------------------
 * Pembuatan halaman otomatis saat tema diaktifkan
 * ---------------------------------------------------------------------- */
function bb_create_pages() {
	if ( get_option( 'bb_theme_installed' ) ) {
		return;
	}

	$products = bb_products();
	$product_ids = array();

	foreach ( $products as $p ) {
		$page_id = wp_insert_post( array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_title'   => $p['name'],
			'post_name'    => $p['slug'],
			'post_content' => $p['intro'] . "\n\n" . $p['intro2'],
		), true );

		if ( is_wp_error( $page_id ) ) {
			continue;
		}

		update_post_meta( $page_id, '_wp_page_template', 'page-templates/template-produk.php' );
		update_post_meta( $page_id, '_bb_harga', $p['price'] );
		update_post_meta( $page_id, '_bb_tagline', $p['tagline'] );
		update_post_meta( $page_id, '_bb_image', $p['image'] );
		update_post_meta( $page_id, '_bb_wa', $p['wa'] );
		update_post_meta( $page_id, '_bb_bahan', implode( "\n", $p['fabrics'] ) );
		update_post_meta( $page_id, '_bb_spesifikasi', implode( "\n", array_map( function ( $s ) { return $s[0] . '|' . $s[1]; }, $p['specs'] ) ) );
		update_post_meta( $page_id, '_bb_uses', implode( "\n", $p['uses'] ) );
		update_post_meta( $page_id, '_bb_faq', implode( "\n", array_map( function ( $q ) { return $q[0] . '||' . $q[1]; }, $p['faqs'] ) ) );

		$product_ids[] = $page_id;
	}

	$home = wp_insert_post( array(
		'post_type'   => 'page',
		'post_status' => 'publish',
		'post_title'  => 'Beranda',
		'post_name'   => 'beranda',
		'post_content' => '',
	), true );

	$blog = wp_insert_post( array(
		'post_type'   => 'page',
		'post_status' => 'publish',
		'post_title'  => 'Blog',
		'post_name'   => 'blog',
		'post_content' => '',
	), true );

	$galeri = wp_insert_post( array(
		'post_type'   => 'page',
		'post_status' => 'publish',
		'post_title'  => 'Galeri',
		'post_name'   => 'galeri',
		'post_content' => '',
	), true );
	if ( ! is_wp_error( $galeri ) ) {
		update_post_meta( $galeri, '_wp_page_template', 'page-templates/template-galeri.php' );
	}

	$kontak = wp_insert_post( array(
		'post_type'   => 'page',
		'post_status' => 'publish',
		'post_title'  => 'Kontak',
		'post_name'   => 'kontak',
		'post_content' => '',
	), true );
	if ( ! is_wp_error( $kontak ) ) {
		update_post_meta( $kontak, '_wp_page_template', 'page-templates/template-kontak.php' );
	}

	if ( ! is_wp_error( $home ) && ! is_wp_error( $blog ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home );
		update_option( 'page_for_posts', $blog );
	}

	// Contoh artikel pertama
	if ( ! get_page_by_path( 'selamat-datang' ) ) {
		wp_insert_post( array(
			'post_type'    => 'post',
			'post_status'  => 'publish',
			'post_title'   => 'Selamat Datang di Website Baru Bikin-Baju.com',
			'post_name'    => 'selamat-datang',
			'post_content' => "<p>Terima kasih sudah berkunjung. Bikin-Baju.com adalah konveksi seragam kerja dan seragam kantor yang beroperasi sejak 2017, melayani lebih dari 1.300 perusahaan di seluruh Indonesia dan luar negeri dengan total 928.000+ pcs pakaian diproduksi.</p>\n<p>Anda bisa mulai menulis artikel dari menu <strong>Posts</strong> di dashboard WordPress. Artikel yang dipublikasikan otomatis muncul di halaman Blog.</p>\n<p>Butuh bantuan memilih seragam? Hubungi kami via WhatsApp: <a href=\"" . esc_url( bb_default_wa() ) . "\" target=\"_blank\" rel=\"noopener\">0812-1167-1157</a>.</p>",
		), true );
	}

	update_option( 'bb_theme_installed', 1 );
}
add_action( 'after_switch_theme', 'bb_create_pages' );