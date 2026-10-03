<?php
/**
 * Homepage template: all sections from the Dentics Figma design.
 *
 * @package Dentics
 */

get_header();
$status = isset( $_GET['appointment'] ) ? sanitize_key( wp_unslash( $_GET['appointment'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
?>
<main id="main">

	<!-- Hero -->
	<section class="hero" id="top">
		<div class="container hero-grid">
			<div class="hero-copy">
				<h1>
					<?php echo esc_html( dentics_opt( 'hero_title_start' ) ); ?>
					<mark><?php echo esc_html( dentics_opt( 'hero_title_mark' ) ); ?></mark>
					<?php echo esc_html( dentics_opt( 'hero_title_end' ) ); ?>
				</h1>
				<p class="lead"><?php echo esc_html( dentics_opt( 'hero_text' ) ); ?></p>
				<div class="hero-actions">
					<a class="btn btn-primary btn-lg" href="#appointment"><?php echo esc_html( dentics_opt( 'hero_btn' ) ); ?></a>
					<a class="btn btn-outline btn-lg" href="#services"><?php echo esc_html( dentics_opt( 'hero_btn2' ) ); ?></a>
				</div>
			</div>
			<div class="hero-media">
				<img src="<?php echo dentics_img( 'hero.png' ); ?>" width="610" height="515" alt="<?php esc_attr_e( 'Smiling patient with clinic stats: 300k+ teeth fixed, 200k+ happy patients, 30+ expert dentists', 'dentics' ); ?>" fetchpriority="high">
			</div>
		</div>
	</section>

	<!-- How it works -->
	<section class="steps">
		<div class="container steps-grid">
			<div>
				<h2>How to get our service?</h2>
				<p>Just follow these simple steps</p>
			</div>
			<ol class="step-cards">
				<?php foreach ( dentics_list( 'steps' ) as $step ) : ?>
					<li class="step-card">
						<?php echo dentics_icon( $step[0] ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
						<span><?php echo implode( '<br>', array_map( 'esc_html', explode( '|', $step[1] ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>

	<!-- Services -->
	<section class="services" id="services">
		<div class="services-bg" aria-hidden="true"></div>
		<div class="container">
			<div class="services-top">
				<h2 class="h-display">Always <mark>Laugh</mark><br>Whenever It's Possible</h2>
				<p>We also offer treatments that improve the appearance of your smile, giving you the confidence boost you deserve. See our treatments below.</p>
			</div>
			<div class="services-bottom">
				<img class="services-art" src="<?php echo dentics_img( 'doctor-illustration.png' ); ?>" width="540" height="460" alt="" loading="lazy">
				<div>
					<h3 class="eyebrow">What we provide</h3>
					<ul class="service-list">
						<?php foreach ( dentics_list( 'services' ) as $service ) : ?>
							<li><?php echo dentics_icon( 'shield' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php echo esc_html( $service ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<!-- Key features -->
	<section class="features">
		<div class="container">
			<header class="section-head">
				<h2 class="head-left"><span>What Makes Us More</span> Special</h2>
				<p class="head-right">Key <mark>Feature</mark></p>
			</header>
			<div class="feature-grid">
				<?php foreach ( dentics_list( 'features' ) as $feature ) : ?>
					<article class="feature-card">
						<img src="<?php echo dentics_img( $feature[0] ); ?>" width="120" height="120" alt="" loading="lazy">
						<h3><?php echo esc_html( $feature[1] ); ?></h3>
						<p><?php echo esc_html( $feature[2] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- Call to action -->
	<section class="cta">
		<div class="container cta-inner">
			<h2><span>Let Us Brighten</span> Your Smile!</h2>
			<p><?php echo esc_html( dentics_opt( 'cta_text' ) ); ?></p>
			<a class="btn btn-ghost" href="#appointment"><?php esc_html_e( 'Make an Appointment', 'dentics' ); ?></a>
		</div>
	</section>

	<!-- Who we are -->
	<section class="about" id="about">
		<div class="container">
			<header class="section-head section-head-reverse">
				<p class="head-right">Who <mark>We Are</mark></p>
				<h2 class="head-left"><span>Our Glorious</span> History</h2>
			</header>
			<div class="about-grid">
				<figure class="photo-frame">
					<img src="<?php echo dentics_img( 'about.jpg' ); ?>" width="458" height="304" alt="<?php esc_attr_e( 'Dentist explaining a treatment plan to a patient', 'dentics' ); ?>" loading="lazy">
					<span class="stripes" aria-hidden="true"></span>
				</figure>
				<div class="about-card">
					<h3>Our history</h3>
					<p><?php echo esc_html( dentics_opt( 'about_text' ) ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<!-- Doctors -->
	<section class="doctors" id="doctors">
		<div class="container">
			<header class="section-head">
				<h2 class="head-left"><span>Meet Some of Our</span> Brains</h2>
				<p class="head-right">Meet Our <mark>Doctors</mark></p>
			</header>
			<div class="slider">
				<button class="slider-btn prev" type="button" aria-label="<?php esc_attr_e( 'Previous doctors', 'dentics' ); ?>"><?php echo dentics_icon( 'left' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></button>
				<ul class="doctor-track">
					<?php foreach ( dentics_list( 'doctors' ) as $doc ) : ?>
						<li class="doctor">
							<img src="<?php echo dentics_img( $doc[0] ); ?>" width="206" height="206" alt="<?php echo esc_attr( $doc[1] ); ?>" loading="lazy">
							<h3><?php echo esc_html( $doc[1] ); ?></h3>
							<p><?php echo esc_html( $doc[2] ); ?><br><?php echo esc_html( $doc[3] ); ?></p>
							<a class="btn btn-outline-primary" href="#appointment" data-doctor="<?php echo esc_attr( $doc[1] ); ?>"><?php esc_html_e( 'Appointment', 'dentics' ); ?></a>
						</li>
					<?php endforeach; ?>
				</ul>
				<button class="slider-btn next" type="button" aria-label="<?php esc_attr_e( 'Next doctors', 'dentics' ); ?>"><?php echo dentics_icon( 'right' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></button>
			</div>
		</div>
	</section>

	<!-- Testimonial -->
	<section class="review">
		<div class="container review-grid">
			<figure class="review-card">
				<img src="<?php echo dentics_img( 'testimonial.jpg' ); ?>" width="238" height="238" alt="" loading="lazy">
				<figcaption>
					<strong><?php echo esc_html( dentics_opt( 'review_name' ) ); ?></strong>
					<span class="stars" aria-label="<?php esc_attr_e( '5 out of 5 stars', 'dentics' ); ?>">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
				</figcaption>
			</figure>
			<div class="review-copy">
				<h2>What our clients say about us</h2>
				<blockquote>
					<span class="quote-mark" aria-hidden="true">&ldquo;</span>
					<p><?php echo esc_html( dentics_opt( 'review_text' ) ); ?></p>
				</blockquote>
				<div class="dots" aria-hidden="true"><span class="active"></span><span></span><span></span></div>
			</div>
		</div>
	</section>

	<!-- Appointment -->
	<section class="appointment" id="appointment">
		<div class="container">
			<header class="section-head section-head-reverse">
				<p class="head-right">Make an <mark>Appointment</mark></p>
				<h2 class="head-left"><span>Consult with our</span> Doctor</h2>
			</header>
			<div class="appointment-grid">
				<figure class="photo-frame photo-frame-tall">
					<img src="<?php echo dentics_img( 'appointment.jpg' ); ?>" width="444" height="584" alt="<?php esc_attr_e( 'Happy patient in the dental chair', 'dentics' ); ?>" loading="lazy">
				</figure>

				<form class="appointment-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
					<?php if ( 'sent' === $status ) : ?>
						<p class="form-note success" role="status"><?php esc_html_e( 'Thank you! Your appointment request was sent. We will call you to confirm.', 'dentics' ); ?></p>
					<?php elseif ( 'missing' === $status || 'error' === $status ) : ?>
						<p class="form-note error" role="alert"><?php esc_html_e( 'Please fill in your name, phone and date, and accept the privacy policy.', 'dentics' ); ?></p>
					<?php endif; ?>
					<input type="hidden" name="action" value="dentics_appointment">
					<?php wp_nonce_field( 'dentics_appointment', 'dentics_nonce' ); ?>

					<div class="field">
						<label for="f-name">Name</label>
						<input id="f-name" name="name" type="text" placeholder="Full name" autocomplete="name" required>
					</div>
					<div class="field">
						<label for="f-phone">Phone</label>
						<div class="phone-input">
							<select name="code" aria-label="Country code">
								<option>+1</option><option>+44</option><option>+91</option>
							</select>
							<input id="f-phone" name="phone" type="tel" placeholder="(555) 000-0000" autocomplete="tel" required>
						</div>
					</div>
					<div class="field">
						<label for="f-date">Date</label>
						<input id="f-date" name="date" type="date" required>
					</div>
					<div class="field">
						<label for="f-doctor">Doctor</label>
						<select id="f-doctor" name="doctor">
							<?php foreach ( dentics_list( 'doctors' ) as $doc ) : ?>
								<option><?php echo esc_html( $doc[1] ); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="field field-full">
						<label for="f-message">Message</label>
						<textarea id="f-message" name="message" rows="5" placeholder="Include a message..."></textarea>
					</div>
					<label class="check field-full">
						<input type="checkbox" name="agree" value="1" required>
						<span>You agree to our friendly privacy policy.</span>
					</label>
					<button class="btn btn-primary btn-block field-full" type="submit"><?php esc_html_e( 'Confirm Appointment', 'dentics' ); ?></button>
				</form>
			</div>
		</div>
	</section>

	<!-- Newsletter -->
	<section class="newsletter">
		<div class="container">
			<div class="newsletter-box">
				<h2>Subscribe to our newsletter</h2>
				<form class="newsletter-form" onsubmit="return false;">
					<label class="screen-reader-text" for="n-name">First name</label>
					<input id="n-name" type="text" placeholder="First name">
					<label class="screen-reader-text" for="n-email">Email address</label>
					<input id="n-email" type="email" placeholder="Email address">
					<button class="btn btn-white" type="submit"><?php esc_html_e( 'Subscribe Now', 'dentics' ); ?></button>
				</form>
			</div>
		</div>
	</section>

</main>
<?php
get_footer();
