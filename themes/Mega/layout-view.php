<?php 
	// render header 
	if(!is_login()):
		render_partial('login');
	else:
		render_partial('partials/header');
		render_partial('partials/sidebar');
		render_partial($__content);
		render_partial('partials/footer');	
			
	endif;
?>	