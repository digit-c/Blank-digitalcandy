<?php get_header(); ?>
static template
	<main role="main">
	<!-- section -->
	<section>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php if (get_field("template_type")=="how-it-works"): ?>
			<!-- how it works page -->
			
			<h1>How it works</h1>
			<p>Tell us about your pop-up plan, let us help you take care of your space details with our top class professional service partners.</p>

			<h2>Post a project</h2>
			<p>Post a pop-up project, listing details of what you need and also your contact information.</p>

			<h2>Poplet gets to work</h2>
			<p>Connect with the PopLet Concierge immediately, while our team sort for you the best match of services among our connections with Spaces Owners, Interior Builders, Production Houses, Marketing Agencies and Staffing Platforms.</p>

			<h2>Receive bids</h2>
			<p>Receive the top 3 bids from service providers for each of your requests within 24 hours after Posting.</p>

			<h2>Choose your partners</h2>
			<p>Select and accept the service bids that you wish to proceed with.</p>

			<h2>Seal the deal</h2>
			<p>Proceed with work discussions and Seal the deal.</p>

			<a href="" class="btn btn-important">Launch a Pop-up now</a>

			<?php else: ?>
			<!-- other page -->
				<?php the_content(); ?>


			<?php endif; ?>
			

<!-- 				<?php comments_template( '', true ); // Remove if you don't want comments ?>

				<br class="clear">

				<?php edit_post_link(); ?> -->

			</article>
			<!-- /article -->

		<?php endwhile; ?>

		<?php else: ?>

			<!-- article -->
			<article>

				<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>

			</article>
			<!-- /article -->

		<?php endif; ?>

	</section>
	<!-- /section -->
	</main>


<?php get_footer(); ?>
