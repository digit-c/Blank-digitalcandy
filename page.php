<?php get_header(); ?>
<script>
	if (window.top!=window.self)
			{
				var css = 'body { display:none; }',
				    head = document.head || document.getElementsByTagName('head')[0],
				    style = document.createElement('style');
				style.type = 'text/css';
				if (style.styleSheet){
				  style.styleSheet.cssText = css;
				} else {
				  style.appendChild(document.createTextNode(css));
				}

				head.appendChild(style);


			  var cssLink = document.createElement("link");
				cssLink.href = "<?php echo get_template_directory_uri(); ?>/style-iframe-login.css?v10"; 
				cssLink.rel = "stylesheet"; 
				cssLink.type = "text/css"; 
				window.document.body.appendChild(cssLink);
			}
</script>
	<main role="main" class="-section cf">
		<!-- section -->
		<section>

			<!-- <h1><?php the_title(); ?></h1> -->

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php if (get_field("template_type")=="create_project"): ?>
			<!-- create project page -->
			
			<h1>Post a store project</h1>
			<!-- <p>Lorum ipsum dolor Lorum ipsum dolor Lorum ipsum dolor Lorum ipsum dolor Lorum ipsum dolor Lorum ipsum dolor </p> -->

			<div class="stepSeparator"></div>
			
			<h2>What kind of services do you need?</h2>
			<p>Please select one or more services below</p>

			<ul id="projectSelection" class="col-5 cf">
				<li id="selectionSpace" class="inner" data-pType="#spaceProject"><img src="<?php echo get_template_directory_uri(); ?>/img/UI/space-default.png"><img class="active" src="<?php echo get_template_directory_uri(); ?>/img/UI/space-hover.png" alt="get a popup space"></li>
				<li id="selectionRenovation" class="inner" data-pType="#renovationProject"><img src="<?php echo get_template_directory_uri(); ?>/img/UI/renovation-default.png"><img class="active" src="<?php echo get_template_directory_uri(); ?>/img/UI/renovation-hover.png" alt="renovate your space"></li>
				<li id="selectionDesign" class="inner" data-pType="#designProject"><img src="<?php echo get_template_directory_uri(); ?>/img/UI/design-default.png"><img class="active" src="<?php echo get_template_directory_uri(); ?>/img/UI/design-hover.png" alt="Request design service"></li>
				<li id="selectionMarketing" class="inner" data-pType="#marketingProject"><img src="<?php echo get_template_directory_uri(); ?>/img/UI/marketing-default.png"><img class="active" src="<?php echo get_template_directory_uri(); ?>/img/UI/marketing-hover.png" alt="Request marketing service"></li>
				<li id="selectionStaff" class="inner staffProject" data-pType="#staffProject"><img src="<?php echo get_template_directory_uri(); ?>/img/UI/staffing-default.png"><img class="active" src="<?php echo get_template_directory_uri(); ?>/img/UI/staffing-hover.png" alt="hire staff for your pop-up shop"></li>
			</ul>


			
			<div id="duplicateFields" class="with_frm_style frm_style_formidable-style">
			<div class="stepSeparator"></div>
				<div id="group-space-design">


				<div class="project-form">
				<h2>General</h2>
				

				<?php the_field('shortcode_project',$term); ?>
				<!-- 
					<div class="frm_form_field form-field frm_required_field frm_top_container">
						<label for="Field_1" class="frm_primary_label">Project Name</label>
						<input type="text" id="Field_1" value="" data-reqmsg="This field cannot be blank.">
					</div>
					<div class="frm_form_field form-field  frm_required_field frm_top_container">
						<label class="frm_primary_label">Type of space:</label>
						<div class="frm_opt_container">
							<div class="frm_radio"><label for="field_2-0"> <input type="radio" name="radio_1" id="field_2-0" value="Prime street shop" data-reqmsg="This field cannot be blank."> Prime street shop</label></div>
							<div class="frm_radio"><label for="field_2-1"> <input type="radio"  name="radio_1" id="field_2-1" value="Shopping mall shop" data-reqmsg="This field cannot be blank."> Shopping mall shop</label></div>
							<div class="frm_radio"><label for="field_2-2"> <input type="radio"  name="radio_1" id="field_2-2" value="Kiosk / stall" data-reqmsg="This field cannot be blank."> Kiosk / stall</label></div>
							<div class="frm_radio"><label for="field_2-3"> <input type="radio"  name="radio_1" id="field_2-3" value="Other" data-reqmsg="This field cannot be blank."> Other</label></div>
						</div>
					</div>
					<div class="frm_form_field form-field  frm_required_field frm_top_container">
						<label for="Field_3" class="frm_primary_label">When to launch:</label>
						<input type="date" id="Field_3" value="" maxlength="10"  min="2016-01-01" max="2030-01-01" data-reqmsg="This field cannot be blank." data-invmsg="Date is invalid" class="frm_date hasDatepicker">
					</div> -->
					</div>
				</div>
			</div>


			<div id="subProjects">
				<!-- space project form -->
				<div id="spaceProject" class="project-form">
					<div class="stepSeparator"></div>
					<h2>Space creation</h2>
					<!-- <p>Lorum ipsum dolor Lorum ipsum dolor Lorum ipsum</p> -->
					<?php the_field('shortcode_1',$term); ?>
				</div>

				<!-- renovation project form -->
				<div id="renovationProject" class="project-form">
					<div class="stepSeparator"></div>
					<h2>Renovation</h2>
					<!-- <p>Lorum ipsum dolor Lorum ipsum dolor Lorum ipsum</p> -->
					<?php the_field('shortcode_2',$term); ?>
				</div>
				
				<!-- design project form -->
				<div id="designProject" class="project-form">
					<div class="stepSeparator"></div>
					<h2>Design</h2>
					<!-- <p>Lorum ipsum dolor Lorum ipsum dolor Lorum ipsum</p> -->
					<?php the_field('shortcode_3',$term); ?>
				</div>
								
				<!-- marketing project form -->
				<div id="marketingProject" class="project-form">
					<div class="stepSeparator"></div>
					<h2>Marketing</h2>
					<!-- <p>Lorum ipsum dolor Lorum ipsum dolor Lorum ipsum</p> -->
					<?php the_field('shortcode_4',$term); ?>
				</div>

				<!-- staff project form -->
				<div id="staffProject" class="project-form">
					<div class="stepSeparator"></div>
					<h2>Staffing</h2>
					<!-- <p>Lorum ipsum dolor Lorum ipsum dolor Lorum ipsum</p> -->
					<?php the_field('shortcode_5',$term); ?>
				</div>
				

				
					<?php 
						if ( is_user_logged_in() ) {
						    $user = wp_get_current_user();
								if ( in_array( 'subscriber', (array) $user->roles ) ) {
								    //User 1
								    ?>
									
									<?php
								}
								if ( in_array( 'contributor', (array) $user->roles ) ) {
								    ?>
								    <!-- User account area -->
									<div class="stepSeparator"></div>
									<div id="userLoginArea" class="project-form cf">
										<h2>LOGIN OR REGISTER</h2>

									<h3>You must use a different type of account in order to create a project.</h3>
								    <?php
								}

								if ( in_array( 'administrator', (array) $user->roles ) ) {
								    	?>
								    	<!-- User account area -->
								<div class="stepSeparator"></div>
								<div id="userLoginArea" class="project-form cf">
										<h2>LOGIN OR REGISTER</h2>
									<div id="accountType">
									<div>
									 <input type="radio" id="radio01" name="radio" checked/>
									 <label for="radio01"><span></span>I am a new user</label>
									</div>
									<div>
									 <input type="radio" id="radio02" name="radio" />
									 <label for="radio02"><span></span>I am a returning user</label>
									</div>
									</div>
									<div id="loginNewUser" class="loginFormCreatePage">
									<?php the_field('shortcode_6',$term); ?>
									</div>
									<div id="loginReturningUser" class="loginFormCreatePage">
										<iframe name="frame1" src="<?php echo get_site_url(); ?>/data/login/" frameborder="0"></iframe>
									</div>
								</div>
										<?php
									
								}
						} else {
							?>
								<!-- User account area -->
							<div class="stepSeparator"></div>
							<div id="userLoginArea" class="project-form cf">
										<h2>LOGIN OR REGISTER</h2>
								<div id="accountType">
								<div>
								 <input type="radio" id="radio01" name="radio" checked/>
								 <label for="radio01"><span></span>I am a new user</label>
								</div>
								<div>
								 <input type="radio" id="radio02" name="radio" />
								 <label for="radio02"><span></span>I am a returning user</label>
								</div>
								</div>
								<div id="loginNewUser" class="loginFormCreatePage">
								<?php the_field('shortcode_6',$term); ?>
								</div>
								<div id="loginReturningUser" class="loginFormCreatePage">
									<iframe name="frame1" src="<?php echo get_site_url(); ?>/data/login/" frameborder="0"></iframe>
								</div>
							</div>
									<?php
						}
					?>
				
			</div>

			<div class="stepSeparator"></div>
			
				<div id="SubmitAll" class="col-2 cf">
					<div class="inner" id="tcWrapper">
						<input type="radio" id="radioTandC" name="radioTandC"/>
						<label for="radioTandC"><span></span>I agree to <a href="#">Terms and conditions</a></label>
					</div>
					<div class="inner">
						<span id="customSubmitAll" class="btn btn-important">Submit</span>	
					</div>
					
				</div>
			
			<div class="stepSeparator"></div>


			<?php else: ?><!-- end of post project page-->

				<?php if (get_field("template_type")=="user2_registration"): ?>
				
				<h1>Create profile as supplier</h1>

				<div id="howItWorks" class="services-section">
				<h2>Supplier - How it works</h2>

					<ul class="col-5 cf">
						<li class="inner"><img src="<?php echo get_template_directory_uri(); ?>/img/poplet/supplier-profile/create-account.png" width="40" height="43">
						<span>Create Account</span>
						sign up on PopLet website (below) by providing basic information of your service offering and your contact detail</li>
						<li class="inner"><img src="<?php echo get_template_directory_uri(); ?>/img/poplet/supplier-profile/connect.png" width="40" height="43">
						<span>Connect with Poplet</span>
						Connect with us to verify supplier identity and ressources</li>
						<li class="inner"><img src="<?php echo get_template_directory_uri(); ?>/img/poplet/supplier-profile/receive-project-info.png" width="40" height="43">
						<span>Receive project info</span>
						Receive notifications through our filtering system for projects/services required</li>
						<li class="inner"><img src="<?php echo get_template_directory_uri(); ?>/img/poplet/supplier-profile/bid.png" width="40" height="43">
						<span>Bid for project</span>
						Bid for projects of your choice, providing basic information
						</li>
						<li class="inner staffProject"><img src="<?php echo get_template_directory_uri(); ?>/img/poplet/supplier-profile/seal-the-deal.png" width="40" height="43">
						<span>Seal the deal</span>
						Connect with project poster once your bid is accepted. Proceed to discuss and seal the deal</li>
					</ul>
				</div>

				<h2>Create profile</h2>
				<?php the_field('user2_register_form',$term); ?>

				<?php else: ?><!-- end of user2 register page-->
				<!-- other page -->
					<?php the_content(); ?>


				<?php endif; ?>
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

<?php echo("
	<script type='text/javascript'>
	var currentYear = '". date('Y')."';
	var currentMonth = '".date('m')."';
	</script>");
?>

<?php get_footer(); ?>
