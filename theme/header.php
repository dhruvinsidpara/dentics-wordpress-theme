<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'dentics' ); ?></a>

<header class="site-header">
	<div class="container header-inner">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img src="<?php echo dentics_img( 'logo-mark.png' ); ?>" alt="" width="48" height="48">
			<span><?php echo esc_html( get_bloginfo( 'name' ) === 'Dentics Dental Clinic' ? 'Dentics' : get_bloginfo( 'name' ) ); ?></span>
		</a>

		<button class="nav-toggle" aria-expanded="false" aria-controls="primary-nav">
			<?php echo dentics_icon( 'menu' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'dentics' ); ?></span>
		</button>

		<nav id="primary-nav" class="primary-nav" aria-label="<?php esc_attr_e( 'Primary', 'dentics' ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'menu' ) );
			} else {
				?>
				<ul class="menu">
					<li class="current-menu-item"><a href="#top">Home</a></li>
					<li><a href="#services">Services</a></li>
					<li><a href="#about">About us</a></li>
					<li><a href="#doctors">Doctors</a></li>
				</ul>
				<?php
			}
			?>
			<a class="btn btn-primary header-btn" href="#appointment"><?php esc_html_e( 'Appointment', 'dentics' ); ?></a>
		</nav>
	</div>
</header>
