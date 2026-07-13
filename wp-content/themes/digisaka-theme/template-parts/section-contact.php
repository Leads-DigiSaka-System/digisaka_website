<?php
$contact = digisaka_theme_site_content()['contact'];
?>
<section class="inner-contact-section">
	<div class="container inner-contact-grid">
		<div class="inner-contact-copy reveal">
			<p class="ds-kicker"><?php echo esc_html( $contact['eyebrow'] ); ?></p>
			<h2><?php echo esc_html( $contact['title'] ); ?></h2>
			<p><?php echo esc_html( $contact['description'] ); ?></p>
			<div class="inner-contact-details">
				<p><strong><?php esc_html_e( 'Leads Agricultural Products Corporation', 'digisaka-theme' ); ?></strong></p>
				<p><?php esc_html_e( 'Developer of the DigiSaka Digital Agriculture Platform.', 'digisaka-theme' ); ?></p>
				<a href="mailto:hello@digisaka.ph"><?php esc_html_e( 'hello@digisaka.ph', 'digisaka-theme' ); ?></a>
				<span><?php esc_html_e( 'Batangas, Philippines', 'digisaka-theme' ); ?></span>
			</div>
		</div>
		<div class="inner-contact-panel reveal reveal--delay">
			<form class="contact-form" action="#" method="post">
				<label><?php esc_html_e( 'Full Name', 'digisaka-theme' ); ?><input type="text" name="full_name"></label>
				<label><?php esc_html_e( 'Organization / Company', 'digisaka-theme' ); ?><input type="text" name="organization"></label>
				<label><?php esc_html_e( 'Email Address', 'digisaka-theme' ); ?><input type="email" name="email"></label>
				<label><?php esc_html_e( 'Subject', 'digisaka-theme' ); ?><input type="text" name="subject"></label>
				<label><?php esc_html_e( 'Message', 'digisaka-theme' ); ?><textarea name="message" rows="5"></textarea></label>
				<button class="ds-button ds-button--orange" type="submit"><?php esc_html_e( 'Submit Inquiry', 'digisaka-theme' ); ?></button>
			</form>
			<div class="inner-contact-map" aria-hidden="true"><span></span></div>
		</div>
	</div>
</section>