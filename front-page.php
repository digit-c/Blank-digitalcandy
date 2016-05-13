<?php get_header(); ?>


	<main role="main">
		<!-- section -->
		<section>
		
		<?php //get custom page homepage
		$args = array(
		    'post_type' => 'info',
		    'post__in' => array('279')
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
		    while ( $query->have_posts() ) { 
		        $query->the_post();
		        ?>
			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<!-- <h1 class="single-title custom-post-type-title"><?php the_title(); ?></h1>
			<p><?php the_field('homepage_intro',$term); ?></p>

				<?php the_content(); ?>

				<br class="clear">

				<?php edit_post_link(); ?> -->
				<div class="intro-HP" style="background: url('<?php echo get_template_directory_uri(); ?>/img/poplet/homepage/homepage-banner.jpg');background-size: cover;
    background-position: center center;">
					<h1><?php the_field('page_title',$term); ?></h1>
					<p><?php the_field('homepage_intro',$term); ?></p>
					<a href="create-project/" class="btn btn-important">Launch a pop-up now</a>
					<a href="supplier-registration" class="btn btn-important">Help people launch</a>
					<a href="info/how-it-works/" class="side-bubble">How it works <span>&#8594;</span></a>
				</div>
	
				<div class="services-section">
					<h2><?php the_field('services_title',$term); ?></h2>
					<ul class="col-5 cf">
						<li class="inner"><img src="<?php echo get_template_directory_uri(); ?>/img/UI/space.png" alt="" width="100" height="100"> 
						<span><?php the_field('service_space_title',$term); ?></span>
						<?php the_field('service_space_description',$term); ?></li>
						<li class="inner"><img src="<?php echo get_template_directory_uri(); ?>/img/UI/renovation.png" alt="" width="100" height="100">
						<span><?php the_field('service_renovation_title',$term); ?></span>
						<?php the_field('service_renovation_description',$term); ?></li>
						<li class="inner"><img src="<?php echo get_template_directory_uri(); ?>/img/UI/design.png" alt="" width="100" height="100">
						<span><?php the_field('service_design_title',$term); ?></span>
						<?php the_field('service_design_description',$term); ?></li>
						<li class="inner"><img src="<?php echo get_template_directory_uri(); ?>/img/UI/marketing.png" alt="" width="100" height="100">
						<span><?php the_field('service_marketing_title',$term); ?></span>
						<?php the_field('service_marketing_description',$term); ?></li>
						<li class="inner"><img src="<?php echo get_template_directory_uri(); ?>/img/UI/staffing.png" alt="" width="100" height="100">
						<span><?php the_field('service_staffing_title',$term); ?></span>
						<?php the_field('service_staffing_description',$term); ?></li>
					</ul>
					<a href="info/how-it-works/" class="btn btn-important">How it works</a>
				</div>

				<div class="success-stories bg-white">
					<h2><?php the_field('success_stories_main_title',$term); ?></h2>
					<div class="verticallyCentered-2">
							<div class="inner" style="background: url('<?php the_field('success_story_1_image',$term); ?>') no-repeat center;">
								<div class="hoverDiv">
									<h3><?php the_field('success_story_1_title',$term); ?></h3>
									<p><?php the_field('success_story_1_description',$term); ?></p>
								</div>
							</div>
							<div class="inner" style="background: url('<?php the_field('success_story_2_image',$term); ?>') no-repeat center;">
								<div class="hoverDiv">
									<h3><?php the_field('success_story_2_title',$term); ?></h3>
									<p><?php the_field('success_story_2_description',$term); ?></p>
								</div>
							</div>
					</div>
					<a href="create-project/" class="btn btn-important">Post a project</a>
				</div>

				<div class="suppliers-section bg-white">
					<h2>Our Selected Supplier Partners</h2>
					<ul class="cf">
					
					<?php if( have_rows('partners') ):
						while ( have_rows('partners') ) : the_row();
							$image = get_sub_field('partner_logo');
							$width = $image['sizes'][ $size . 'large-width' ];
							$height = $image['sizes'][ $size . 'large-height' ];?>
							<li >
								<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
							</li>
						<?php endwhile;
					endif; ?>

					</ul>
				</div>

				<div id="red-banner">
					<p><?php the_field('red_banner_text',$term); ?>
					<span><a href="create-project/" class="btn btn-red">Launch a pop-up</a> or <a href="supplier-registration" class="btn btn-red">Help people launch</a></span>
					</p>
				</div>

			</article>
			<!-- /article -->
        <?php
			}
		}
		?>
		</section>
		<!-- /section -->
	</main>


<?php get_footer(); ?>
