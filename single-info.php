<?php get_header(); ?>

	<main role="main">
	<!-- section -->
	<section>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="<?php the_field('template_type',$term); ?>" <?php post_class(); ?>>

			<?php if (get_field("template_type")=="how-it-works"): ?>
			<!-- how it works page -->
			
			<div class="intro introHIW-section">
			<h1><?php the_field('page_title'); ?></h1>
			<p><?php the_field('page_intro'); ?></p>
			<a href="" class="btn btn-important">Launch a Pop-up now</a>
			</div>
			<ol class="verticallyCentered">
				<?php

				// check if the repeater field has rows of data
				if( have_rows('steps') ):
					$count = 0;
				 	// loop through the rows of data
				    while ( have_rows('steps') ) : the_row();
				    $count +=1; 
					$step_image = get_sub_field('step_image');
					$step_title = get_sub_field('step_title');
					$step_description = get_sub_field('step_description');
					$step_button = get_sub_field('step_button');
					

					if($count % 2 == 0) {  ?>
						<li>
							<div class="inner">
								<h2><?php echo $step_title; ?></h2>
								<p><?php echo $step_description; ?></p>
								<?php if($step_button): ?>
								<a href="<?php echo $step_button; ?>" class="btn btn-important">Get started now</a>
								<?php endif; ?>
							</div>
							<div class="inner innerImg"><img src="<?php echo $step_image['url']; ?>" alt="<?php echo $step_image['alt']; ?>" /></div>
						</li>
					<?php }
					else { ?>
						<li>
						<div class="inner innerImg"><img src="<?php echo $step_image['url']; ?>" alt="<?php echo $step_image['alt']; ?>" /></div>
							<div class="inner">
								<h2><?php echo $step_title; ?></h2>
								<p><?php echo $step_description; ?></p>
								<?php if($step_button): ?>
								<a href="<?php echo $step_button; ?>" class="btn btn-important">Get started now</a>
								<?php endif; ?>
							</div>
						</li>
					<?php } 
					?>
						
				    <?php endwhile;

				else :

				    // no rows found

				endif;
				?>
				<!-- <li>
					<div class="inner innerImg"><img src="http://placehold.it/400x400" alt=""></div>
					<div class="inner">
						<h2>Post a project</h2>
						<p>Post a pop-up project, listing details of what you need and also your contact information.</p>
					<a href="" class="btn btn-important">Get started now</a>
					</div>
				</li>
				<li>
					<div class="inner">
						<h2>Poplet gets to work</h2>
						<p>Connect with the PopLet Concierge immediately, while our team sort for you the best match of services among our connections with Spaces Owners, Interior Builders, Production Houses, Marketing Agencies and Staffing Platforms.</p>
					</div>
					<div class="inner innerImg"><img src="http://placehold.it/400x400" alt=""></div>
				</li>
 -->
				<!-- <li>
					<div class="inner innerImg"><img src="http://placehold.it/400x400" alt=""></div>
					<div class="inner">
						<h2>Receive bids</h2>
						<p>Receive the top 3 bids from service providers for each of your requests within 24 hours after Posting.</p>
					</div>
				</li>
				<li>
					<div class="inner">
						<h2>Choose your partners</h2>
						<p>Select and accept the service bids that you wish to proceed with.</p>
					</div>
					<div class="inner innerImg"><img src="http://placehold.it/400x400" alt=""></div>
				</li>
				<li>
					<div class="inner innerImg"><img src="http://placehold.it/400x400" alt=""></div>
					<div class="inner">
						<h2>Seal the deal</h2>
						<p>Proceed with work discussions and Seal the deal.</p>
					</div>
				</li> -->
			</ol>

			<div id="simple-red-banner">
					<a href="#" class="btn btn-red">Launch a pop-up</a>
					<a href="#" class="btn btn-red">Help people launch</a>
				</p>
			</div>


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
