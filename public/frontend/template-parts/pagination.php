<?php if(get_theme_mod('flower_shop_elementor_show_pagination', true )== true): ?>
	<?php
		the_posts_pagination( array(
			'prev_text' => esc_html__( 'Previous page', 'flower-shop-elementor' ),
			'next_text' => esc_html__( 'Next page', 'flower-shop-elementor' ),
		) );
	?>		
<?php endif; ?>