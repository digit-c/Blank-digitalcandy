			<!-- footer -->
			<footer class="footer" role="contentinfo">
				<nav class="nav">
				<ul class="footerLinks">
					<?php 
				if ( is_user_logged_in() ) {
				    $user = wp_get_current_user();
						if ( in_array( 'subscriber', (array) $user->roles ) ) { //User 1 ?>
							<li><a href="<?php echo get_site_url(); ?>/create-project/">Post a pop-up project</a></li>
							<li><a href="<?php echo get_site_url(); ?>/info/how-it-works">How it works</a></li>
						<?php }

						if ( in_array( 'contributor', (array) $user->roles ) ) { //User 2 ?>
							<li><a href="<?php echo get_site_url(); ?>/supplier-registration">Join as supplier partner</a></li>
						<?php }

						if ( in_array( 'administrator', (array) $user->roles ) ) { ?>
							<li><a href="<?php echo get_site_url(); ?>/create-project/">Post a pop-up project</a></li>
							<li><a href="<?php echo get_site_url(); ?>/supplier-registration">Join as supplier partner</a></li>
							<li><a href="<?php echo get_site_url(); ?>/info/how-it-works">How it works</a></li>
						<?php }
				}
				else { ?>
					<li><a href="<?php echo get_site_url(); ?>/create-project/">Post a pop-up project</a></li>
					<li><a href="<?php echo get_site_url(); ?>/supplier-registration">Join as supplier partner</a></li>
					<li><a href="<?php echo get_site_url(); ?>/info/how-it-works">How it works</a></li>
				<?php } ?>
					<li><a href="mailto:Support@poplet.hk">Support@poplet.hk</a></li>
					<li><a href="tel:+85291902734">+852 9190 2734</a></li>
					<li><a href="#">F</a></li>
				</ul>
				</nav>
				<a href=""></a>

				<div class="logo">
							<!-- svg logo - toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script -->
							<img src="<?php echo get_template_directory_uri(); ?>/img/poplet-logo.svg" alt="POPLET Logo" class="logo-img">
					</div>
				<!-- copyright -->
				<p class="copyright">
					&copy; COPYRIGHT <?php echo date('Y'); ?><!-- <?php bloginfo('name'); ?>. -->
				</p>
				<!-- /copyright -->

			</footer>
			<!-- /footer -->
			
			</div>
			<!-- /red-border -->

		</div>
		<!-- /wrapper -->

		<?php wp_footer(); ?>

		<!-- analytics -->
		<script>
		(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
		(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
		l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
		ga('send', 'pageview');
		</script>
<div id="data" class="hidden"></div>
	</body>
</html>