<?php
/**
 * Dentics Clinic theme setup.
 *
 * @package Dentics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme supports and menus.
 */
function dentics_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array( 'height' => 48, 'width' => 48, 'flex-width' => true ) );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'dentics' ),
			'footer'  => __( 'Footer Links', 'dentics' ),
		)
	);
}
add_action( 'after_setup_theme', 'dentics_setup' );

/**
 * Styles and scripts.
 */
function dentics_assets() {
	$ver = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'dentics-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Ubuntu:wght@500&display=swap', array(), null );
	wp_enqueue_style( 'dentics-main', get_template_directory_uri() . '/assets/css/main.css', array( 'dentics-fonts' ), $ver );
	wp_enqueue_script( 'dentics-main', get_template_directory_uri() . '/assets/js/main.js', array(), $ver, true );
}
add_action( 'wp_enqueue_scripts', 'dentics_assets' );

/**
 * Image URL helper.
 *
 * @param string $file File name inside assets/img.
 * @return string
 */
function dentics_img( $file ) {
	return esc_url( get_template_directory_uri() . '/assets/img/' . $file );
}

/**
 * Editable text fields shown in Appearance > Customize.
 * Key => array( section, label, default, type ).
 *
 * @return array
 */
function dentics_fields() {
	return array(
		'hero_title_start' => array( 'hero', 'Heading (before highlight)', 'We Provide High Quality', 'text' ),
		'hero_title_mark'  => array( 'hero', 'Heading (highlighted word)', 'Dental', 'text' ),
		'hero_title_end'   => array( 'hero', 'Heading (after highlight)', 'Services', 'text' ),
		'hero_text'        => array( 'hero', 'Intro text', 'Gentle, modern dental care for the whole family, from routine check-ups to complete smile makeovers.', 'textarea' ),
		'hero_btn'         => array( 'hero', 'Main button text', 'Get Started', 'text' ),
		'hero_btn2'        => array( 'hero', 'Second button text', 'Learn More', 'text' ),
		'cta_text'         => array( 'cta', 'Text', 'Helping patients achieve good dental health & a beautiful smile is a privilege & responsibility. For over 30 years, we have proudly provided the best dental experience in New York. Our comfort-first approach is designed to meet the needs of you & your entire family.', 'textarea' ),
		'about_text'       => array( 'about', 'Our history text', 'Dentics is a well-known name in dental and oral care in New York. The journey of this institution started in 1990 under the hands of Dr. Jonathon Doe, Gold Medalist of Harvard University. Dentics dental center has been leading the way in dental treatment in the USA for more than 30 years, keeping up with the evolution of time and the modernization of the era.', 'textarea' ),
		'review_name'      => array( 'review', 'Patient name', 'Samantha Payne', 'text' ),
		'review_text'      => array( 'review', 'Review', 'I\'ve seen a lot of dentists over my lifetime because I\'ve had some serious dental issues. But my highest praise goes to Dr. Jonathon Doe and his staff. I was always very anxious going to the dentist, but this time my experience was so painless and relaxed there was no discomfort whatsoever.', 'textarea' ),
		'hours_days'       => array( 'contact', 'Opening days', 'Saturday - Thursday', 'text' ),
		'hours_time'       => array( 'contact', 'Opening hours', '10 am - 9 pm', 'text' ),
		'email'            => array( 'contact', 'Email', 'hello@reallygreatsite.com', 'email' ),
		'address'          => array( 'contact', 'Address', '123 Anywhere St., Any City, NY 39200', 'textarea' ),
		'footer_about'     => array( 'contact', 'Footer about text', 'Dentics is a well-known name in dental and oral care in New York. The journey of this institution started in 1990.', 'textarea' ),
	);
}

/**
 * Get an editable text value (falls back to the design default).
 *
 * @param string $key Field key.
 * @return string
 */
function dentics_opt( $key ) {
	$fields = dentics_fields();
	$default = isset( $fields[ $key ] ) ? $fields[ $key ][2] : '';
	return get_theme_mod( 'dentics_' . $key, $default );
}

/**
 * Register Customizer sections and controls.
 *
 * @param WP_Customize_Manager $wp_customize Customizer.
 */
function dentics_customize( $wp_customize ) {
	$sections = array(
		'hero'    => __( 'Hero', 'dentics' ),
		'cta'     => __( 'Call to action', 'dentics' ),
		'about'   => __( 'Who we are', 'dentics' ),
		'review'  => __( 'Testimonial', 'dentics' ),
		'contact' => __( 'Contact & footer', 'dentics' ),
	);
	$wp_customize->add_panel( 'dentics', array( 'title' => __( 'Dentics homepage', 'dentics' ), 'priority' => 30 ) );
	foreach ( $sections as $id => $title ) {
		$wp_customize->add_section( 'dentics_' . $id, array( 'title' => $title, 'panel' => 'dentics' ) );
	}
	foreach ( dentics_fields() as $key => $f ) {
		$wp_customize->add_setting(
			'dentics_' . $key,
			array(
				'default'           => $f[2],
				'sanitize_callback' => 'email' === $f[3] ? 'sanitize_email' : ( 'textarea' === $f[3] ? 'sanitize_textarea_field' : 'sanitize_text_field' ),
			)
		);
		$wp_customize->add_control(
			'dentics_' . $key,
			array(
				'label'   => $f[1],
				'section' => 'dentics_' . $f[0],
				'type'    => $f[3],
			)
		);
	}
}
add_action( 'customize_register', 'dentics_customize' );

/**
 * Homepage content lists (filterable so a child theme or plugin can change them).
 *
 * @param string $list List name.
 * @return array
 */
function dentics_list( $list ) {
	$lists = array(
		'steps'    => array(
			array( 'phone', 'Call for|appointment' ),
			array( 'calendar', 'Get a|Date & Serial' ),
			array( 'plus', 'Consult|Your dentist' ),
		),
		'services' => array( 'Check-ups', 'Emergencies', 'Cosmetic dentistry', 'Dental implants', 'Orthodontics', 'Children\'s dentistry', 'Preventive checks', 'Telephone consultations' ),
		'features' => array(
			array( 'feature-1.png', 'Laser Technology', 'The world\'s most advanced diode laser. Your treatment will be relaxing & smooth.' ),
			array( 'feature-2.png', 'Painless Injection', 'The only dental clinic in New York using a painless injection system. You will be amazed!' ),
			array( 'feature-3.png', 'Dental Implant', '30+ years of experience in dental implants with specialist care. You will be able to chew properly again!' ),
			array( 'feature-4.png', '3D Dental Scanner', 'One of the world\'s most advanced 3D dental scanners with auto scanning, the only one in New York!' ),
			array( 'feature-5.png', 'Digital Smile Design', 'We help redesign your smile and shape your teeth to create a customised smile for your face.' ),
			array( 'feature-6.png', 'Crown and Bridge', 'Restore damaged or missing teeth with natural-looking crowns and bridges in fewer visits.' ),
		),
		'doctors'  => array(
			array( 'doctor-1.jpg', 'Dr. Jeanette Hoff', 'Orthodontic Treatment', 'Yale Medical School' ),
			array( 'doctor-2.jpg', 'Dr. David Ambrose', 'Orthodontic Treatment', 'Harvard Medical School' ),
			array( 'doctor-3.jpg', 'Dr. Jenelia Breton', 'Orthodontic Treatment', 'Oxford Medical School' ),
			array( 'doctor-4.jpg', 'Dr. Jagajeet Aurora', 'Orthodontic Treatment', 'Harvard Medical School' ),
		),
	);
	return apply_filters( 'dentics_list_' . $list, isset( $lists[ $list ] ) ? $lists[ $list ] : array() );
}

/**
 * Small inline SVG icons (stroke icons, inherit currentColor).
 *
 * @param string $name Icon name.
 * @return string
 */
function dentics_icon( $name ) {
	$paths = array(
		'phone'    => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/>',
		'calendar' => '<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18M9 16l2 2 4-4"/>',
		'plus'     => '<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M12 8v8M8 12h8"/>',
		'shield'   => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/>',
		'left'     => '<path d="m15 18-6-6 6-6"/>',
		'right'    => '<path d="m9 18 6-6-6-6"/>',
		'menu'     => '<path d="M3 6h18M3 12h18M3 18h18"/>',
	);
	if ( ! isset( $paths[ $name ] ) ) {
		return '';
	}
	return '<svg class="icon icon-' . esc_attr( $name ) . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $paths[ $name ] . '</svg>';
}

/**
 * Appointment form handler: validates, emails the site admin, redirects back.
 */
function dentics_handle_appointment() {
	$back = wp_get_referer() ? wp_get_referer() : home_url( '/' );
	$back = remove_query_arg( 'appointment', $back );

	if ( ! isset( $_POST['dentics_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['dentics_nonce'] ) ), 'dentics_appointment' ) ) {
		wp_safe_redirect( add_query_arg( 'appointment', 'error', $back ) . '#appointment' );
		exit;
	}

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$code    = isset( $_POST['code'] ) ? sanitize_text_field( wp_unslash( $_POST['code'] ) ) : '';
	$date    = isset( $_POST['date'] ) ? sanitize_text_field( wp_unslash( $_POST['date'] ) ) : '';
	$doctor  = isset( $_POST['doctor'] ) ? sanitize_text_field( wp_unslash( $_POST['doctor'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
	$agree   = ! empty( $_POST['agree'] );

	if ( '' === $name || '' === $phone || '' === $date || ! $agree ) {
		wp_safe_redirect( add_query_arg( 'appointment', 'missing', $back ) . '#appointment' );
		exit;
	}

	$body = sprintf(
		"New appointment request\n\nName: %s\nPhone: %s %s\nDate: %s\nDoctor: %s\n\nMessage:\n%s",
		$name,
		$code,
		$phone,
		$date,
		$doctor,
		$message
	);
	wp_mail( get_option( 'admin_email' ), 'New appointment request: ' . $name, $body );

	wp_safe_redirect( add_query_arg( 'appointment', 'sent', $back ) . '#appointment' );
	exit;
}
add_action( 'admin_post_nopriv_dentics_appointment', 'dentics_handle_appointment' );
add_action( 'admin_post_dentics_appointment', 'dentics_handle_appointment' );
