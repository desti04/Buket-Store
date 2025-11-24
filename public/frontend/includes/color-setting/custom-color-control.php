<?php

  $flower_shop_elementor_theme_custom_setting_css = '';

	// Global Color
	$flower_shop_elementor_theme_color = get_theme_mod('flower_shop_elementor_theme_color', '#7469B6');

	$flower_shop_elementor_theme_custom_setting_css .=':root {';
		$flower_shop_elementor_theme_custom_setting_css .='--primary-theme-color: '.esc_attr($flower_shop_elementor_theme_color ).'!important;';
	$flower_shop_elementor_theme_custom_setting_css .='}';

	// Scroll to top alignment
	$flower_shop_elementor_scroll_alignment = get_theme_mod('flower_shop_elementor_scroll_alignment', 'right');

    if($flower_shop_elementor_scroll_alignment == 'right'){
        $flower_shop_elementor_theme_custom_setting_css .='.scroll-up{';
            $flower_shop_elementor_theme_custom_setting_css .='right: 30px;!important;';
			$flower_shop_elementor_theme_custom_setting_css .='left: auto;!important;';
        $flower_shop_elementor_theme_custom_setting_css .='}';
    }else if($flower_shop_elementor_scroll_alignment == 'center'){
        $flower_shop_elementor_theme_custom_setting_css .='.scroll-up{';
            $flower_shop_elementor_theme_custom_setting_css .='left: calc(50% - 10px) !important;';
        $flower_shop_elementor_theme_custom_setting_css .='}';
    }else if($flower_shop_elementor_scroll_alignment == 'left'){
        $flower_shop_elementor_theme_custom_setting_css .='.scroll-up{';
            $flower_shop_elementor_theme_custom_setting_css .='left: 30px;!important;';
			$flower_shop_elementor_theme_custom_setting_css .='right: auto;!important;';
        $flower_shop_elementor_theme_custom_setting_css .='}';
    }	

    // Related Product

    $flower_shop_elementor_show_related_product = get_theme_mod('flower_shop_elementor_show_related_product', true );

    if($flower_shop_elementor_show_related_product != true){
        $flower_shop_elementor_theme_custom_setting_css .='.related.products{';
            $flower_shop_elementor_theme_custom_setting_css .='display: none;';
        $flower_shop_elementor_theme_custom_setting_css .='}';
    }