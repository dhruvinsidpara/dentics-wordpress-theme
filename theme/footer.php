<footer class="site-footer">
	<div class="container footer-grid">
		<div class="footer-col">
			<a class="brand brand-light" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo dentics_img( 'logo-mark.png' ); ?>" alt="" width="40" height="40">
				<span>Dentics</span>
			</a>
			<p><?php echo esc_html( dentics_opt( 'footer_about' ) ); ?></p>
		</div>
		<div class="footer-col">
			<p class="footer-label">We are welcoming you</p>
			<h3>Want to visit our clinic?</h3>
			<p class="footer-hours"><?php echo esc_html( dentics_opt( 'hours_days' ) ); ?><br><?php echo esc_html( dentics_opt( 'hours_time' ) ); ?></p>
		</div>
		<div class="footer-col">
			<p class="footer-label">Important links</p>
			<?php
			if ( has_nav_menu( 'footer' ) ) {
				wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'menu_class' => 'footer-links' ) );
			} else {
				?>
				<ul class="footer-links">
					<li><a href="#">Facebook</a></li>
					<li><a href="#">Career</a></li>
					<li><a href="#">Twitter</a></li>
					<li><a href="#">Support</a></li>
					<li><a href="#">Instagram</a></li>
					<li><a href="#">Privacy policy</a></li>
				</ul>
				<?php
			}
			?>
		</div>
		<div class="footer-col">
			<p class="footer-label">Say hello to us</p>
			<a class="footer-email" href="mailto:<?php echo esc_attr( dentics_opt( 'email' ) ); ?>"><?php echo esc_html( dentics_opt( 'email' ) ); ?></a>
			<p class="footer-label footer-label-sm">Address</p>
			<address><?php echo nl2br( esc_html( dentics_opt( 'address' ) ) ); ?></address>
		</div>
	</div>
	<p class="copyright">&copy; 2001-<?php echo esc_html( gmdate( 'Y' ) ); ?>, <?php esc_html_e( 'All Rights Reserved', 'dentics' ); ?></p>
</footer>
<?php wp_footer(); ?>
</body>
</html>
