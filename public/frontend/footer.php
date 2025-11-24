<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flower Shop Elementor
 */

?>

<footer class="footer-side">
  <?php if( get_theme_mod( 'flower_shop_elementor_show_footer_widget',true)) : ?>
    <div class="footer-widget">
      <div class="container">
        <?php
          // Check if any footer sidebar is active
          $flower_shop_elementor_any_sidebar_active = false;
          for ( $flower_shop_elementor_i = 1; $flower_shop_elementor_i <= 4; $flower_shop_elementor_i++ ) {
            if ( is_active_sidebar( "footer{$flower_shop_elementor_i}-sidebar" ) ) {
              $flower_shop_elementor_any_sidebar_active = true;
              break;
            }
          }
          // Count active for responsive column classes
          $flower_shop_elementor_active_sidebars = 0;
          if ( $flower_shop_elementor_any_sidebar_active ) {
            for ( $flower_shop_elementor_i = 1; $flower_shop_elementor_i <= 4; $flower_shop_elementor_i++ ) {
              if ( is_active_sidebar( "footer{$flower_shop_elementor_i}-sidebar" ) ) {
                $flower_shop_elementor_active_sidebars++;
              }
            }
          }
          $flower_shop_elementor_col_class = $flower_shop_elementor_active_sidebars > 0 ? 'col-lg-' . (12 / $flower_shop_elementor_active_sidebars) . ' col-md-6 col-sm-12' : 'col-lg-3 col-md-6 col-sm-12';
        ?>
        <div class="row pt-2  <?php echo esc_attr( get_theme_mod('flower_shop_elementor_enable_footer_animation', true) ? 'zoomInUp wow' : '' ); ?>">
          <?php for ( $flower_shop_elementor_i = 1; $flower_shop_elementor_i <= 4; $flower_shop_elementor_i++ ) : ?>
            <div class="footer-area <?php echo esc_attr($flower_shop_elementor_col_class); ?>">
              <?php if ( $flower_shop_elementor_any_sidebar_active && is_active_sidebar("footer{$flower_shop_elementor_i}-sidebar") ) : ?>
                <?php dynamic_sidebar("footer{$flower_shop_elementor_i}-sidebar"); ?>
              <?php elseif ( ! $flower_shop_elementor_any_sidebar_active ) : ?>
                  <?php if ( $flower_shop_elementor_i === 1 ) : ?>
                    <aside role="complementary" aria-label="<?php echo esc_attr__( 'footer1', 'flower-shop-elementor' ); ?>" id="Search" class="sidebar-widget">
                      <h4 class="title" ><?php esc_html_e( 'Search', 'flower-shop-elementor' ); ?></h4>
                      <?php get_search_form(); ?>
                    </aside>

                  <?php elseif ( $flower_shop_elementor_i === 2 ) : ?>
                      <aside role="complementary" aria-label="<?php echo esc_attr__( 'footer2', 'flower-shop-elementor' ); ?>" id="archives" class="sidebar-widget">
                      <h4 class="title" ><?php esc_html_e( 'Archives', 'flower-shop-elementor' ); ?></h4>
                      <ul>
                          <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
                      </ul>
                      </aside>
                  <?php elseif ( $flower_shop_elementor_i === 3 ) : ?>
                    <aside role="complementary" aria-label="<?php echo esc_attr__( 'footer3', 'flower-shop-elementor' ); ?>" id="meta" class="sidebar-widget">
                      <h4 class="title"><?php esc_html_e( 'Meta', 'flower-shop-elementor' ); ?></h4>
                      <ul>
                        <?php wp_register(); ?>
                        <li><?php wp_loginout(); ?></li>
                        <?php wp_meta(); ?>
                      </ul>
                    </aside>
                  <?php elseif ( $flower_shop_elementor_i === 4 ) : ?>
                    <aside role="complementary" aria-label="<?php echo esc_attr__( 'footer4', 'flower-shop-elementor' ); ?>" id="categories" class="sidebar-widget">
                      <h4 class="title" ><?php esc_html_e( 'Categories', 'flower-shop-elementor' ); ?></h4>
                      <ul>
                          <?php wp_list_categories('title_li=');  ?>
                      </ul>
                    </aside>
                  <?php endif; ?>
              <?php endif; ?>
            </div>
          <?php endfor; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
  <?php if( get_theme_mod( 'flower_shop_elementor_show_footer_copyright',true)) : ?>
    <div class="footer-copyright  <?php echo esc_attr(get_theme_mod( 'flower_shop_elementor_sticky_copyright_enable', false ) ? 'sticky-copyright' : 'close-sticky');?>">
      <div class="container">
        <div class="row pt-2">
          <div class="col-lg-6 col-md-6 align-self-center">
            <p class="mb-0 py-3 text-center text-md-start">
              <?php
                if (!get_theme_mod('flower_shop_elementor_footer_text') ) { ?>
                  <a href="<?php echo esc_url(__('https://www.wpelemento.com/products/free-flower-shop-wordpress-theme', 'flower-shop-elementor' )); ?>" target="_blank">   
                      <?php esc_html_e('Flower Shop Elementor WordPress Theme','flower-shop-elementor'); ?>
                  </a>
                <?php } else {
                  echo esc_html(get_theme_mod('flower_shop_elementor_footer_text'));
                }
              ?>
              <?php if ( get_theme_mod('flower_shop_elementor_copyright_enable', true) == true ) : ?>
              <?php
                /* translators: %s: WP Elemento */
                printf( esc_html__( ' By %s', 'flower-shop-elementor' ), 'WP Elemento' ); ?>
              <?php endif; ?>
            </p>
          </div>
          <div class="col-lg-6 col-md-6 align-self-center text-center text-md-end">
            <?php if ( get_theme_mod('flower_shop_elementor_copyright_enable', true) == true ) : ?>
              <a href="<?php echo esc_url(__('https://wordpress.org','flower-shop-elementor') ); ?>" rel="generator"><?php  /* translators: %s: WordPress */ printf( esc_html__( 'Proudly powered by %s', 'flower-shop-elementor' ), 'WordPress' ); ?></a>
            <?php endif; ?>
          </div>
          <?php if(get_theme_mod('flower_shop_elementor_footer_social_icon_hide', false )== true){ ?>
            <div class="row">
              <div class="col-12 align-self-center py-1">
                <div class="footer-links">
                  <?php $flower_shop_elementor_settings_footer = get_theme_mod( 'flower_shop_elementor_social_links_settings_footer' ); ?>
                  <?php if ( is_array($flower_shop_elementor_settings_footer) || is_object($flower_shop_elementor_settings_footer) ){ ?>
                    <?php foreach( $flower_shop_elementor_settings_footer as $flower_shop_elementor_setting_footer ) { ?>
                      <a href="<?php echo esc_url( $flower_shop_elementor_setting_footer['link_url'] ); ?>" target="_blank">
                        <i class="<?php echo esc_attr( $flower_shop_elementor_setting_footer['link_text'] ); ?> me-2"></i>
                      </a>
                    <?php } ?>
                  <?php } ?>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
  <?php if ( get_theme_mod('flower_shop_elementor_scroll_enable_setting')) : ?>
    <div class="scroll-up">
      <a href="#tobottom"><i class="fa fa-arrow-up"></i></a>
    </div>
  <?php endif; ?>
  <?php if(get_theme_mod('flower_shop_elementor_progress_bar', true )== true): ?>
    <div id="elemento-progress-bar" class="theme-progress-bar <?php if( get_theme_mod( 'flower_shop_elementor_progress_bar_position','top') == 'top') { ?> top <?php } else { ?> bottom <?php } ?>"></div>
  <?php endif; ?>
  <?php if(get_theme_mod('flower_shop_elementor_cursor_outline', false )== true): ?>
			<!-- Custom cursor -->
			<div class="cursor-point-outline"></div>
			<div class="cursor-point"></div>
			<!-- .Custom cursor -->
  <?php endif; ?>
</footer>

<?php wp_footer(); ?>

</body>
</html>