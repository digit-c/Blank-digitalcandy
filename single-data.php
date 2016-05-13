	<!doctype html>
	<html>
	<head>
		
		<script type="text/javascript" src="<?php echo get_site_url(); ?>/wp-includes/js/jquery/jquery.js?ver=1.11.3"></script>
		<script>
		jQuery(function () {
			jQuery("#wp-submit").addClass("btn btn-important");
			// jQuery(".frm_error_style a").attr('target','_parent');
		})
		</script>
		<?php
				$postid = get_the_ID();
				// login in iframe
				if ($postid===539){
					?>
					<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/normalize.css?ver=1.0" media="all">
					<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css?v=4" media="all">
					<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style-iframe-login.css?v=5" media="all">
					<?php
				}?>
		
	</head>
		<body>
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
			<?php
				$postid = get_the_ID();

				// login in iframe
				if ($postid===539){
					?><?php
					the_content();
				}
				// ajax user info
				if ($postid===312){
					?>
					<div id="userID"><?php the_content();?></div>
					<?php
				}
				else{

				}
			 ?>
		<?php endwhile; endif?>
		</body>
	</html>