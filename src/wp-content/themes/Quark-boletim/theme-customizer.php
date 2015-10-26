<?php

global $wp_customize;

get_template_part('theme-customizer-extensions/color-utils');

if (isset($wp_customize)) {

	/* Add additional options to Theme Customizer */
	function quark_init_customizer( $wp_customize ) {
		// Used fonts
		$body_font = '//fonts.googleapis.com/css?family=Open+Sans:300,400,500,700';
		$header_font = '';
		$other_font = '';
		// Selectors for the used fonts
		$body_font_selectors = 'body,
button,
.button,
input[type="submit"],
input[type="button"],
select,
textarea,
input[type="text"],
input[type="password"],
input[type="url"],
input[type="email"],
article header h1,
article header h2';

		$header_font_selectors = 'blockquote:before,
blockquote p:after';

		$other_font_selectors = '';

        // Add new settings sections
	    $wp_customize->add_section(
		    'quark_font_options',
		    array(
		        'title'     => __('Font options', 'quark'),
		        'capability' => 'edit_theme_options',
		        'priority'  => 200
	    	)
	    );

	    $wp_customize->add_section(
		    'quark_layout_options',
		    array(
		        'title'     => __('Layout', 'quark'),
		        'capability' => 'edit_theme_options',
		        'priority'  => 300
	    	)
	    );

	    $wp_customize->add_section(
		    'quark_features_options',
		    array(
		        'title'     => __('Features', 'quark'),
		        'capability' => 'edit_theme_options',
		        'priority'  => 400
	    	)
	    );

	    $wp_customize->add_section(
		    'quark_images',
		    array(
		        'title'     => __('Images', 'quark'),
		        'capability' => 'edit_theme_options',
		        'description' => __('Image settings connected with images of the header.', 'quark'),
		        'priority'  => 450
	    	)
	    );

	    $wp_customize->add_section(
		    'quark_social_options',
		    array(
		        'title'     => __('Social API', 'quark'),
		        'capability' => 'edit_theme_options',
		        'description' => __('Settings connected with Social API.', 'quark'),
		        'priority'  => 470
	    	)
	    );

	    $wp_customize->add_section(
		    'quark_cookie_options',
		    array(
		        'title'     => __('Cookie Law', 'quark'),
		        'capability' => 'edit_theme_options',
		        'description' => __('Settings connected with Cookie consent plugin.', 'quark'),
		        'priority'  => 480
	    	)
	    );

	    $wp_customize->add_section(
		    'quark_frontpage_options',
		    array(
		        'title'     => __('Frontpage', 'quark'),
		        'capability' => 'edit_theme_options',
		        'description' => __('Frontpage settings are visible only on your frontpage.', 'quark'),
		        'active_callback' => 'is_front_page',
		        'priority'  => 500
	    	)
	    );

	    $wp_customize->add_section(
		    'quark_template_contact',
		    array(
		        'title'     => __('Contact Page', 'quark'),
		        'capability' => 'edit_theme_options',
		        'description' => __('These options are visible only on the contact template page.','quark'),
		        'priority'  => 1000
	    	)
	    );

	    // Add new settings
	    $wp_customize->add_setting(
	    	'quark_primary_color',
	    	array(
	    		'default' => '#f079a3',
	    		'capability' => 'edit_theme_options',
	    		'transport' => 'postMessage',
	    		'sanitize_callback' => 'sanitize_hex_color'
	    	)
	    );

	    $wp_customize->add_setting(
	    	'quark_secondary_color',
	    	array(
	    		'default' => '#26292b',
	    		'capability' => 'edit_theme_options',
	    		'transport' => 'postMessage',
	    		'sanitize_callback' => 'sanitize_hex_color'
	    	)
	    );

	    $wp_customize->add_setting(
            'quark_font_size',
            array(
                'default'   => '62.5',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_setting(
            'quark_body_font',
            array(
                'default'   => 'google',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'quark_sanitize_font'
                )
            );

        $wp_customize->add_setting(
            'quark_body_google_font',
            array(
                'default'   => $body_font,
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw'
            )
        );

        $wp_customize->add_setting(
            'quark_body_font_selectors',
            array(
                'default'   => $body_font_selectors,
                'capability' => 'edit_theme_options',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'esc_textarea'
            )
        );

		$wp_customize->add_setting(
			'quark_headers_font',
			array(
			    'default'   => 'google',
			    'capability' => 'edit_theme_options',
			    'sanitize_callback' => 'quark_sanitize_font'
			)
		);

		$wp_customize->add_setting(
		    'quark_headers_google_font',
		    array(
		        'default'   => $header_font,
		        'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'esc_url_raw'
		    )
		);

		$wp_customize->add_setting(
			'quark_headers_font_selectors',
			array(
			    'default'   => $header_font_selectors,
			    'sanitize_callback' => 'esc_textarea'
			)
		);

        $wp_customize->add_setting(
            'quark_other_font',
            array(
                'default'   => 'google',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'quark_sanitize_font'
                )
            );

        $wp_customize->add_setting(
            'quark_other_google_font',
            array(
                'default'   => $other_font,
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw'
            )
        );

        $wp_customize->add_setting(
            'quark_other_font_selectors',
            array(
                'default'   => $other_font_selectors,
                'capability' => 'edit_theme_options',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'esc_textarea'
            )
        );

		$wp_customize->add_setting(
			'quark_theme_width',
			array(
				'default'   => '1040',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_number'
			)
		);

		$wp_customize->add_setting(
			'quark_tablet_width',
			array(
				'default'   => '1040',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_number'
			)
		);

		$wp_customize->add_setting(
			'quark_small_tablet_width',
			array(
				'default'   => '840',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_number'
			)
		);

		$wp_customize->add_setting(
			'quark_mobile_width',
			array(
				'default'   => '640',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_number'
			)
		);

		$wp_customize->add_setting(
			'quark_sidebar_width',
			array(
				'default'   => '33.333333',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_number'
			)
		);

		$wp_customize->add_setting(
			'quark_sidebar_pos',
			array(
				'default'   => 'right',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_sidebar_pos'
			)
		);

		$wp_customize->add_setting(
			'quark_logo',
			array(
				'default' => '',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'quark_logo_dark',
			array(
				'default' => '',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'quark_error_bg',
			array(
				'default' => '',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'quark_author_bg',
			array(
				'default' => '',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'quark_search_bg',
			array(
				'default' => '',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
            'quark_slogan_switch',
            array(
                'default'   => 0,
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'quark_sanitize_switch'
            )
        );

        $wp_customize->add_setting(
            'quark_word_break',
            array(
                'default'   => '0',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'quark_sanitize_switch'
            )
        );

        $wp_customize->add_setting(
			'quark_scroll_reveal',
			array(
				'default'   => '1',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);

		$wp_customize->add_setting(
			'quark_photo_swipe',
			array(
				'default'   => '1',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);

		$wp_customize->add_setting(
			'quark_related_posts',
			array(
				'default'   => '1',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);

		$wp_customize->add_setting(
			'quark_post_social_icons',
			array(
				'default'   => '1',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);

		$wp_customize->add_setting(
			'quark_page_social_icons',
			array(
				'default'   => '',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);

		$wp_customize->add_setting(
			'quark_popup_social_icons',
			array(
				'default'   => 1,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);

		$wp_customize->add_setting(
			'quark_popup_social_fb',
			array(
				'default'   => 1,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);

		$wp_customize->add_setting(
			'quark_popup_social_twitter',
			array(
				'default'   => 1,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);

		$wp_customize->add_setting(
			'quark_popup_social_gplus',
			array(
				'default'   => 1,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);

		$wp_customize->add_setting(
			'quark_popup_social_pinterest',
			array(
				'default'   => 1,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);

		$wp_customize->add_setting(
			'quark_popup_social_linked',
			array(
				'default'   => 0,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);

		$wp_customize->add_setting(
			'quark_popup_social_vk',
			array(
				'default'   => 0,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);

		$wp_customize->add_setting(
			'quark_social_fb',
			array(
				'default'   => 1,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);

		$wp_customize->add_setting(
			'quark_social_twitter',
			array(
				'default'   => 1,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);

		$wp_customize->add_setting(
			'quark_social_gplus',
			array(
				'default'   => 1,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);

        $wp_customize->add_setting(
            'quark_dark_image',
            array(
				'default'   => 1,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
        );

        $wp_customize->add_setting(
            'quark_dark_image_frontpage',
            array(
				'default'   => 0,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
        );

        $wp_customize->add_setting(
            'quark_category_read_more',
            array(
				'default'   => 0,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
        );

        $wp_customize->add_setting(
            'quark_js_parallax',
            array(
				'default'   => 1,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
        );

        $wp_customize->add_setting(
            'quark_page_loader',
            array(
				'default'   => 1,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
        );

        $wp_customize->add_setting(
            'quark_login_popup',
            array(
				'default'   => 1,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
        );

		$wp_customize->add_setting(
			'quark_date_format',
			array(
				'default'   => 'default',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_date_format'
			)
		);

		$wp_customize->add_setting(
			'quark_copyright_text',
			array(
				'default'   => '&copy; 2014 GavickPro. All rights reserved.',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_copyright'
			)
		);

		$wp_customize->add_setting(
			'quark_contact_enable_captcha',
			array(
				'default'   => 0,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);

		$wp_customize->add_setting(
			'quark_contact_public_key',
			array(
				'default'   => '',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$wp_customize->add_setting(
			'quark_contact_private_key',
			array(
				'default'   => '',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$wp_customize->add_setting(
			'quark_contact_email',
			array(
				'default'   => '',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$wp_customize->add_setting(
			'quark_contact_email_header',
			array(
				'default'   => 'blank@gavick.com',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$wp_customize->add_setting(
			'quark_contact_fb',
			array(
				'default'   => '#',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$wp_customize->add_setting(
			'quark_contact_twitter',
			array(
				'default'   => '#',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$wp_customize->add_setting(
			'quark_contact_gplus',
			array(
				'default'   => '#',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$wp_customize->add_setting(
			'quark_contact_map_url',
			array(
				'default'   => '#',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$wp_customize->add_setting(
			'quark_header_mouse_icon',
			array(
				'default'   => 1,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);
		// navigation settings
		$wp_customize->add_setting(
			'quark_menu_classic',
			array(
				'default'   => 0,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);

		$wp_customize->add_setting(
			'quark_menu_fixed',
			array(
				'default'   => 1,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);

		// header image settins
		$wp_customize->add_setting(
			'quark_header_image',
			array(
				'default'   => '920',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_number'
			)
		);

		$wp_customize->add_setting(
			'quark_header_image2',
			array(
				'default'   => '640',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_number'
			)
		);

		$wp_customize->add_setting(
			'quark_header_image3',
			array(
				'default'   => '600',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_number'
			)
		);

		$wp_customize->add_setting(
			'quark_header_image4',
			array(
				'default'   => '520',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_number'
			)
		);

		$wp_customize->add_setting(
			'quark_header_image5',
			array(
				'default'   => '440',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_number'
			)
		);

		$wp_customize->add_setting(
			'quark_header_image6',
			array(
				'default'   => '360',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_number'
			)
		);

		// header image frontpage settins
		$wp_customize->add_setting(
			'quark_header_image_front',
			array(
				'default'   => '880',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_number'
			)
		);

		$wp_customize->add_setting(
			'quark_header_image_front2',
			array(
				'default'   => '800',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_number'
			)
		);

		$wp_customize->add_setting(
			'quark_header_image_front3',
			array(
				'default'   => '640',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_number'
			)
		);

		$wp_customize->add_setting(
			'quark_header_image_front4',
			array(
				'default'   => '500',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_number'
			)
		);

		$wp_customize->add_setting(
			'quark_header_image_front5',
			array(
				'default'   => '320',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_number'
			)
		);

		$wp_customize->add_setting(
			'quark_header_image_front6',
			array(
				'default'   => '240',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_number'
			)
		);

		// Frontpage options
		$wp_customize->add_setting(
			'quark_slider_autoanim',
			array(
				'default'   => 1,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);

		$wp_customize->add_setting(
			'quark_slider_interval',
			array(
				'default'   => '5000',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_number'
			)
		);

		$wp_customize->add_setting(
			'quark_slider_pagination',
			array(
				'default'   => 1,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);

		$wp_customize->add_setting(
			'quark_slider_slider',
			array(
				'default'   => 1,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);

		$wp_customize->add_setting(
			'quark_slider_preview',
			array(
				'default'   => 0,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);

		$wp_customize->add_setting(
			'quark_slider_height_desktop',
			array(
				'default'   => '700',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_number'
			)
		);

		$wp_customize->add_setting(
			'quark_slider_height_tablet',
			array(
				'default'   => '500',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_number'
			)
		);

		$wp_customize->add_setting(
			'quark_slider_height_mobile',
			array(
				'default'   => '300',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_number'
			)
		);

		$wp_customize->add_setting(
			'quark_tab_autoanim',
			array(
				'default'   => 0,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);

		$wp_customize->add_setting(
			'quark_tab_interval',
			array(
				'default'   => '5000',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_number'
			)
		);

		// Cookie law settings
		$wp_customize->add_setting(
			'quark_cookie_enable',
			array(
				'default'   => 1,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);

		$wp_customize->add_setting(
			'quark_cookie_mode',
			array(
				'default'   => 'explicit',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_cookie_mode'
			)
		);

		$wp_customize->add_setting(
			'quark_cookie_ssl',
			array(
				'default'   => 1,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);

		$wp_customize->add_setting(
			'quark_cookie_banner_placement',
			array(
				'default'   => 'bottom',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_cookie_banner'
			)
		);

		$wp_customize->add_setting(
			'quark_cookie_tag_placement',
			array(
				'default'   => 'bottom-right',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_cookie_tag'
			)
		);

		$wp_customize->add_setting(
			'quark_cookie_refresh',
			array(
				'default'   => 0,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'quark_sanitize_switch'
			)
		);

		// Add control for the settings
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'quark_primary_color',
				array(
					'label' => __('Primary Color', 'quark'),
					'section' => 'colors',
					'settings' => 'quark_primary_color'
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'quark_secondary_color',
				array(
					'label' => __('Secondary Color', 'quark'),
					'section' => 'colors',
					'settings' => 'quark_secondary_color'
				)
			)
		);

		$wp_customize->add_control(
		    'quark_font_size',
		    array(
		        'section'  => 'quark_font_options',
		        'label'    => __('Define size of the fonts', 'quark'),
		        'description' => __('Base value is 62.5, you can change this value to increase/decrease all font sizes used in this theme.', 'quark'),
		        'type'     => 'text',
		        'priority' => 1
	    	)
		);

		$wp_customize->add_control(
		    'quark_body_font',
		    array(
		        'section'  => 'quark_font_options',
		        'label'    => __('Body Font', 'quark'),
		        'type'     => 'select',
		        'choices'  => array(
		        	'google'    		=> 'Google Font',
		        	'verdana'   		=> 'Verdana',
		        	'georgia'    		=> 'Georgia',
		        	'arial'      		=> 'Arial',
		        	'impact'     		=> 'Impact',
		        	'tahoma'     		=> 'Tahoma',
		            'times'      		=> 'Times New Roman',
		            'comic sans ms'     => 'Comic Sans MS',
		            'courier new'   	=> 'Courier New',
		            'helvetica'  		=> 'Helvetica'
		        ),
		        'priority' => 2
		   	 )
		);

		$wp_customize->add_control(
		    'quark_body_google_font',
		    array(
		        'section'  => 'quark_font_options',
		        'label'    => __('Google Font URL for the Body', 'quark'),
		        'active_callback' => 'quark_show_font_body',
		        'type'     => 'text',
		        'priority' => 3
	    	)
		);

		$wp_customize->add_control(
			'quark_body_font_selectors',
			array(
		    	'label' => __('Selectors for the body font', 'quark'),
		    	'section' => 'quark_font_options',
		    	'settings' => 'quark_body_font_selectors',
		    	'type' => 'textarea',
		    	'priority' => 4
			)
		);

        $wp_customize->add_control(
            'quark_headers_font',
            array(
                'section'  => 'quark_font_options',
                'label'    => __('Header Font', 'quark'),
                'type'     => 'select',
                'choices'  => array(
                    'google'            => 'Google Font',
                    'verdana'           => 'Verdana',
                    'georgia'           => 'Georgia',
                    'arial'             => 'Arial',
                    'impact'            => 'Impact',
                    'tahoma'            => 'Tahoma',
                    'times'             => 'Times New Roman',
                    'comic sans ms'     => 'Comic Sans MS',
                    'courier new'       => 'Courier New',
                    'helvetica'         => 'Helvetica'
                ),
                'priority' => 5
             )
        );

        $wp_customize->add_control(
            'quark_headers_google_font',
            array(
                'section'  => 'quark_font_options',
                'label'    => __('Google Font URL for Header', 'quark'),
                'active_callback' => 'quark_show_font_headers',
                'type'     => 'text',
                'priority' => 6
            )
        );

        $wp_customize->add_control(
            'quark_headers_font_selectors',
            array(
                'label' => __('Selectors for the header font', 'quark'),
                'section' => 'quark_font_options',
                'settings' => 'quark_headers_font_selectors',
                'type' => 'textarea',
                'priority' => 7
            )
        );

        $wp_customize->add_control(
            'quark_other_font',
            array(
                'section'  => 'quark_font_options',
                'label'    => __('Other Elements Font', 'quark'),
                'type'     => 'select',
                'choices'  => array(
                    'google'            => 'Google Font',
                    'verdana'           => 'Verdana',
                    'georgia'           => 'Georgia',
                    'arial'             => 'Arial',
                    'impact'            => 'Impact',
                    'tahoma'            => 'Tahoma',
                    'times'             => 'Times New Roman',
                    'comic sans ms'     => 'Comic Sans MS',
                    'courier new'       => 'Courier New',
                    'helvetica'         => 'Helvetica'
                ),
                'priority' => 8
             )
        );

        $wp_customize->add_control(
            'quark_other_google_font',
            array(
                'section'  => 'quark_font_options',
                'label'    => __('Google Font URL for the other elements', 'quark'),
                'active_callback' => 'quark_show_font_others',
                'type'     => 'text',
                'priority' => 9
            )
        );

        $wp_customize->add_control(
            'quark_other_font_selectors',
            array(
                'label' => __('Selectors for the other elements font', 'quark'),
                'section' => 'quark_font_options',
                'settings' => 'quark_other_font_selectors',
                'type' => 'textarea',
                'priority' => 10
            )
        );

		$wp_customize->add_control(
		    'quark_theme_width',
		    array(
		        'section'  => 'quark_layout_options',
		        'label'    => __('Theme width (px)', 'quark'),
		        'type'     => 'text',
		        'priority' => 0
			)
		);

		$wp_customize->add_control(
		    'quark_tablet_width',
		    array(
		        'section'  => 'quark_layout_options',
		        'label'    => __('Tablet width (px)', 'quark'),
		        'type'     => 'text',
		        'priority' => 1
			)
		);

		$wp_customize->add_control(
		    'quark_small_tablet_width',
		    array(
		        'section'  => 'quark_layout_options',
		        'label'    => __('Small tablet width (px)', 'quark'),
		        'type'     => 'text',
		        'priority' => 2
			)
		);

		$wp_customize->add_control(
		    'quark_mobile_width',
		    array(
		        'section'  => 'quark_layout_options',
		        'label'    => __('Mobile width (px)', 'quark'),
		        'type'     => 'text',
		        'priority' => 3
			)
		);

		$wp_customize->add_control(
		    'quark_sidebar_width',
		    array(
		        'section'  => 'quark_layout_options',
		        'label'    => __('Sidebar width (%)', 'quark'),
		        'type'     => 'text',
		        'priority' => 4
			)
		);

		$wp_customize->add_control(
		    'quark_sidebar_pos',
		    array(
		        'section'  => 'quark_layout_options',
		        'label'    => __('Sidebar position', 'quark'),
		        'type'     => 'select',
		        'choices'  => array(
		            'left'     => __('Left', 'quark'),
		            'right'    => __('Right', 'quark')
		        ),
		        'priority' => 5
		    )
		);

		$wp_customize->add_control(
		   new WP_Customize_Image_Control(
		       $wp_customize,
		       'quark_logo',
		       array(
		           'label'      => __('Upload an image logo', 'quark'),
		           'description' => __('Leave blank if  you want to use Text logo', 'quark'),
		           'section'    => 'title_tagline',
		           'settings'   => 'quark_logo',
		           'priority'   => 90
		       )
		   )
		);

		$wp_customize->add_control(
		   new WP_Customize_Image_Control(
		       $wp_customize,
		       'quark_logo_dark',
		       array(
		           'label'      => __('Upload a dark image logo', 'quark'),
		           'description' => __('This logo will be used on the bright headers and in the menu bar.', 'quark'),
		           'section'    => 'title_tagline',
		           'settings'   => 'quark_logo_dark',
		           'priority'   => 95
		       )
		   )
		);

		$wp_customize->add_control(
            'quark_slogan_switch',
            array(
                'section'  => 'title_tagline',
                'label'    => __('Show tagline', 'quark'),
                'type'     => 'checkbox',
                'priority' => 80
            )
        );

        $wp_customize->add_control(
            'quark_word_break',
            array(
                'section'  => 'quark_features_options',
                'label'    => __('Enable word-break', 'quark'),
                'type'     => 'checkbox',
                'priority' => 2
            )
        );

        $wp_customize->add_control(
		    'quark_scroll_reveal',
		    array(
		        'section'  => 'quark_features_options',
		        'label'    => __('Use Scroll Reveal', 'quark'),
		        'type'     => 'checkbox',
		        'priority' => 3
		    )
		);

		$wp_customize->add_control(
		    'quark_photo_swipe',
		    array(
		        'section'  => 'quark_features_options',
		        'label'    => __('Use Photo Swipe', 'quark'),
		        'type'     => 'checkbox',
		        'priority' => 4
		    )
		);

		$wp_customize->add_control(
            'quark_js_parallax',
            array(
                'label' => __('Use JS Parallax engine', 'quark'),
                'section' => 'quark_features_options',
                'type' => 'checkbox',
                'priority' => 5
            )
        );

		$wp_customize->add_control(
		    'quark_related_posts',
		    array(
		        'section'  => 'quark_features_options',
		        'label'    => __('Display related posts', 'quark'),
		        'type'     => 'checkbox',
		        'priority' => 6
		    )
		);

		$wp_customize->add_control(
		    'quark_post_social_icons',
		    array(
		        'section'  => 'quark_social_options',
		        'label'    => __('Post Social Icons', 'quark'),
		        'type'     => 'checkbox',
		        'priority' => 7
		    )
		);

		$wp_customize->add_control(
		    'quark_page_social_icons',
		    array(
		        'section'  => 'quark_social_options',
		        'label'    => __('Page Social Icons', 'quark'),
		        'type'     => 'checkbox',
		        'priority' => 8
		    )
		);

		$wp_customize->add_control(
		    'quark_popup_social_icons',
		    array(
		        'section'  => 'quark_social_options',
		        'label'    => __('Enable Popup for social icons', 'quark'),
		        'type'     => 'checkbox',
		        'priority' => 9
		    )
		);

		$wp_customize->add_control(
		    'quark_popup_social_icons',
		    array(
		        'section'  => 'quark_social_options',
		        'label'    => __('Enable Popup for social icons', 'quark'),
		        'type'     => 'checkbox',
		        'priority' => 9
		    )
		);

		$wp_customize->add_control(
		    'quark_popup_social_fb',
		    array(
		        'section'  => 'quark_social_options',
		        'label'    => __('Enable FB icon', 'quark'),
		        'active_callback' => 'quark_show_on_social_popup',
		        'type'     => 'checkbox',
		        'priority' => 20
		    )
		);

		$wp_customize->add_control(
		    'quark_popup_social_twitter',
		    array(
		        'section'  => 'quark_social_options',
		        'label'    => __('Enable Twitter icon', 'quark'),
		        'active_callback' => 'quark_show_on_social_popup',
		        'type'     => 'checkbox',
		        'priority' => 21
		    )
		);

		$wp_customize->add_control(
		    'quark_popup_social_gplus',
		    array(
		        'section'  => 'quark_social_options',
		        'label'    => __('Enable Google icon', 'quark'),
		        'active_callback' => 'quark_show_on_social_popup',
		        'type'     => 'checkbox',
		        'priority' => 22
		    )
		);

		$wp_customize->add_control(
		    'quark_popup_social_pinterest',
		    array(
		        'section'  => 'quark_social_options',
		        'label'    => __('Enable Pinterest icon', 'quark'),
		        'active_callback' => 'quark_show_on_social_popup',
		        'type'     => 'checkbox',
		        'priority' => 23
		    )
		);

		$wp_customize->add_control(
		    'quark_popup_social_linked',
		    array(
		        'section'  => 'quark_social_options',
		        'label'    => __('Enable LinkedIn icon', 'quark'),
		        'active_callback' => 'quark_show_on_social_popup',
		        'type'     => 'checkbox',
		        'priority' => 24
		    )
		);

		$wp_customize->add_control(
		    'quark_popup_social_vk',
		    array(
		        'section'  => 'quark_social_options',
		        'label'    => __('Enable VK icon', 'quark'),
		        'active_callback' => 'quark_show_on_social_popup',
		        'type'     => 'checkbox',
		        'priority' => 25
		    )
		);

		$wp_customize->add_control(
		    'quark_social_fb',
		    array(
		        'section'  => 'quark_social_options',
		        'label'    => __('Enable FB icon', 'quark'),
		        'active_callback' => 'quark_show_on_social_default',
		        'type'     => 'checkbox',
		        'priority' => 20
		    )
		);

		$wp_customize->add_control(
		    'quark_social_twitter',
		    array(
		        'section'  => 'quark_social_options',
		        'label'    => __('Enable Twitter icon', 'quark'),
		        'active_callback' => 'quark_show_on_social_default',
		        'type'     => 'checkbox',
		        'priority' => 21
		    )
		);

		$wp_customize->add_control(
		    'quark_social_gplus',
		    array(
		        'section'  => 'quark_social_options',
		        'label'    => __('Enable Google icon', 'quark'),
		        'active_callback' => 'quark_show_on_social_default',
		        'type'     => 'checkbox',
		        'priority' => 22
		    )
		);

        $wp_customize->add_control(
            'quark_dark_image',
            array(
                'label' => __('Dark image background', 'quark'),
                'section' => 'quark_features_options',
                'type' => 'checkbox',
                'priority' => 10
            )
        );

        $wp_customize->add_control(
            'quark_dark_image_frontpage',
            array(
                'label' => __('Dark image background on frontpage', 'quark'),
                'section' => 'quark_features_options',
                'type' => 'checkbox',
                'priority' => 11
            )
        );

        $wp_customize->add_control(
            'quark_category_read_more',
            array(
                'label' => __('Read More button on categories', 'quark'),
                'section' => 'quark_features_options',
                'type' => 'checkbox',
                'priority' => 12
            )
        );

        $wp_customize->add_control(
            'quark_page_loader',
            array(
                'label' => __('Use Page preloader', 'quark'),
                'section' => 'quark_features_options',
                'type' => 'checkbox',
                'priority' => 13
            )
        );

        $wp_customize->add_control(
            'quark_login_popup',
            array(
                'label' => __('Enable popup login', 'quark'),
                'section' => 'quark_features_options',
                'type' => 'checkbox',
                'priority' => 14
            )
        );

		$wp_customize->add_control(
		    'quark_date_format',
		    array(
		        'section'  => 'quark_features_options',
		        'label'    => __('Date format', 'quark'),
		        'type'     => 'select',
		        'choices'  => array(
		            'default'     => __('Default theme format', 'quark'),
		            'wordpress'     => __('WordPress Date Format', 'quark')
		        ),
		        'priority' => 15
		    )
		);

		$wp_customize->add_control(
		    'quark_copyright_text',
		    array(
		        'section'  => 'quark_features_options',
		        'label'    => __('Copyright text', 'quark'),
		        'type'     => 'textarea',
		        'priority' => 16
			)
		);

		$wp_customize->add_control(
		    'quark_header_mouse_icon',
		    array(
		        'section'  => 'quark_features_options',
		        'label'    => __('Display mouse icon in header', 'quark'),
		        'type'     => 'checkbox',
		        'priority' => 7
		    )
		);

		$wp_customize->add_control(
		   new WP_Customize_Image_Control(
		       $wp_customize,
		       'quark_author_bg',
		       array(
		           'label'      => __('Upload author page background', 'quark'),
		           'description' => __('Select image for author pages background', 'quark'),
		           'section'    => 'quark_features_options',
		           'settings'   => 'quark_author_bg',
		           'priority'   => 17
		       )
		   )
		);

		$wp_customize->add_control(
		   new WP_Customize_Image_Control(
		       $wp_customize,
		       'quark_error_bg',
		       array(
		           'label'      => __('Upload error page background', 'quark'),
		           'description' => __('Select image for error pages background', 'quark'),
		           'section'    => 'quark_features_options',
		           'settings'   => 'quark_error_bg',
		           'priority'   => 18
		       )
		   )
		);

		$wp_customize->add_control(
		   new WP_Customize_Image_Control(
		       $wp_customize,
		       'quark_search_bg',
		       array(
		           'label'      => __('Upload search page background', 'quark'),
		           'description' => __('Select image for search page background', 'quark'),
		           'section'    => 'quark_features_options',
		           'settings'   => 'quark_search_bg',
		           'priority'   => 19
		       )
		   )
		);

		$wp_customize->add_control(
		    'quark_contact_enable_captcha',
		    array(
		        'section'  => 'quark_template_contact',
		        'label'    => __('Enable reCaptcha', 'quark'),
		        'active_callback' => 'quark_show_on_contact',
		        'type'     => 'checkbox',
		        'priority' => 2
			)
		);

		$wp_customize->add_control(
		    'quark_contact_public_key',
		    array(
		        'section'  => 'quark_template_contact',
		        'label'    => __('Captcha public key', 'quark'),
		        'active_callback' => 'quark_show_on_captcha_enabled',
		        'type'     => 'text',
		        'priority' => 3
			)
		);

		$wp_customize->add_control(
		    'quark_contact_private_key',
		    array(
		        'section'  => 'quark_template_contact',
		        'label'    => __('Captcha private key', 'quark'),
		        'active_callback' => 'quark_show_on_captcha_enabled',
		        'type'     => 'text',
		        'priority' => 4
			)
		);

		$wp_customize->add_control(
		    'quark_contact_email',
		    array(
		        'section'  => 'quark_template_contact',
		        'label'    => __('Email source', 'quark'),
		        'description'    => __('Leave this field empty to use WordPress administrator email adress', 'quark'),
		        'active_callback' => 'quark_show_on_contact',
		        'type'     => 'text',
		        'priority' => 5
			)
		);

		$wp_customize->add_control(
		    'quark_contact_email_header',
		    array(
		        'section'  => 'quark_template_contact',
		        'label'    => __('Email header text', 'quark'),
		        'description'    => __('Leave this field empty to disable this text', 'quark'),
		        'active_callback' => 'quark_show_on_contact',
		        'type'     => 'text',
		        'priority' => 6
			)
		);

		$wp_customize->add_control(
		    'quark_contact_fb',
		    array(
		        'section'  => 'quark_template_contact',
		        'label'    => __('Facebook url (leave empty to hide)', 'quark'),
		        'active_callback' => 'quark_show_on_contact',
		        'type'     => 'text',
		        'priority' => 7
			)
		);

		$wp_customize->add_control(
		    'quark_contact_twitter',
		    array(
		        'section'  => 'quark_template_contact',
		        'label'    => __('Twitter url (leave empty to hide)', 'quark'),
		        'active_callback' => 'quark_show_on_contact',
		        'type'     => 'text',
		        'priority' => 8
			)
		);

		$wp_customize->add_control(
		    'quark_contact_gplus',
		    array(
		        'section'  => 'quark_template_contact',
		        'label'    => __('Google+ url (leave empty to hide)', 'quark'),
		        'active_callback' => 'quark_show_on_contact',
		        'type'     => 'text',
		        'priority' => 9
			)
		);

		$wp_customize->add_control(
		    'quark_contact_map_url',
		    array(
		        'section'  => 'quark_template_contact',
		        'label'    => __('URL of map button', 'quark'),
		        'active_callback' => 'quark_show_on_contact',
		        'type'     => 'text',
		        'priority' => 10
			)
		);

		// navigation section controls
		$wp_customize->add_control(
            'quark_menu_classic',
            array(
                'section'  => 'nav',
                'label'    => __('Enable classic menu', 'quark'),
                'description' => __('Leave this option disabled to use Off-Canvas Menu','quark'),
                'type'     => 'checkbox',
                'priority' => 10
            )
        );

        $wp_customize->add_control(
            'quark_menu_fixed',
            array(
                'section'  => 'nav',
                'label'    => __('Enable fixed classic menu', 'quark'),   
                'active_callback' => 'quark_show_on_classic_menu',
                'type'     => 'checkbox',
                'priority' => 11
            )
        );

		// frontpage section controls
		$wp_customize->add_control(
            'quark_slider_autoanim',
            array(
                'section'  => 'quark_frontpage_options',
                'label'    => __('Enable autoanimation of slider', 'quark'),
                'type'     => 'checkbox',
                'priority' => 2
            )
        );

        $wp_customize->add_control(
		    'quark_slider_interval',
		    array(
		        'section'  => 'quark_frontpage_options',
		        'label'    => __('Slider animation interval', 'quark'),
		        'type'     => 'text',
		        'priority' => 3
			)
		);

		$wp_customize->add_control(
            'quark_slider_pagination',
            array(
                'section'  => 'quark_frontpage_options',
                'label'    => __('Show slider pagination', 'quark'),
                'type'     => 'checkbox',
                'priority' => 4
            )
        );

        $wp_customize->add_control(
            'quark_slider_slider',
            array(
                'section'  => 'quark_frontpage_options',
                'label'    => __('Show slider bar', 'quark'),
                'type'     => 'checkbox',
                'priority' => 5
            )
        );

        $wp_customize->add_control(
            'quark_slider_preview',
            array(
                'section'  => 'quark_frontpage_options',
                'label'    => __('Show slides preview', 'quark'),
                'type'     => 'checkbox',
                'priority' => 6
            )
        );

        $wp_customize->add_control(
		    'quark_slider_height_desktop',
		    array(
		        'section'  => 'quark_frontpage_options',
		        'label'    => __('Slider height - desktop', 'quark'),
		        'type'     => 'text',
		        'priority' => 7
			)
		);

		$wp_customize->add_control(
		    'quark_slider_height_tablet',
		    array(
		        'section'  => 'quark_frontpage_options',
		        'label'    => __('Slider height - tablet', 'quark'),
		        'type'     => 'text',
		        'priority' => 8
			)
		);

		$wp_customize->add_control(
		    'quark_slider_height_mobile',
		    array(
		        'section'  => 'quark_frontpage_options',
		        'label'    => __('Slider height - mobile', 'quark'),
		        'type'     => 'text',
		        'priority' => 9
			)
		);

        $wp_customize->add_control(
            'quark_tab_autoanim',
            array(
                'section'  => 'quark_frontpage_options',
                'label'    => __('Enable autoanimation of tabs', 'quark'),
                'type'     => 'checkbox',
                'priority' => 12
            )
        );

        $wp_customize->add_control(
		    'quark_tab_interval',
		    array(
		        'section'  => 'quark_frontpage_options',
		        'label'    => __('Tabs animation interval', 'quark'),
		        'type'     => 'text',
		        'priority' => 13
			)
		);

		// header image controls
		$wp_customize->add_control(
		    'quark_header_image',
		    array(
		        'section'  => 'quark_images',
		        'label'    => __('Image height (px) - full hd desktop', 'quark'),
		        'type'     => 'text',
		        'priority' => 21
			)
		);

		$wp_customize->add_control(
		    'quark_header_image2',
		    array(
		        'section'  => 'quark_images',
		        'label'    => __('Image height (px) - desktop', 'quark'),
		        'type'     => 'text',
		        'priority' => 22
			)
		);

		$wp_customize->add_control(
		    'quark_header_image3',
		    array(
		        'section'  => 'quark_images',
		        'label'    => __('Image height (px) - small desktop', 'quark'),
		        'type'     => 'text',
		        'priority' => 23
			)
		);

		$wp_customize->add_control(
		    'quark_header_image4',
		    array(
		        'section'  => 'quark_images',
		        'label'    => __('Image height (px) - tablet', 'quark'),
		        'type'     => 'text',
		        'priority' => 24
			)
		);

		$wp_customize->add_control(
		    'quark_header_image5',
		    array(
		        'section'  => 'quark_images',
		        'label'    => __('Image height (px) - small tablet', 'quark'),
		        'type'     => 'text',
		        'priority' => 25
			)
		);

		$wp_customize->add_control(
		    'quark_header_image6',
		    array(
		        'section'  => 'quark_images',
		        'label'    => __('Image height (px) - mobile', 'quark'),
		        'type'     => 'text',
		        'priority' => 26
			)
		);

		// header image frontpage controls
		$wp_customize->add_control(
		    'quark_header_image_front',
		    array(
		        'section'  => 'quark_images',
		        'label'    => __('Frontpage image height (px) - full hd desktop', 'quark'),
		        'type'     => 'text',
		        'priority' => 30
			)
		);

		$wp_customize->add_control(
		    'quark_header_image_front2',
		    array(
		        'section'  => 'quark_images',
		        'label'    => __('Frontpage image height (px) - desktop', 'quark'),
		        'type'     => 'text',
		        'priority' => 31
			)
		);

		$wp_customize->add_control(
		    'quark_header_image_front3',
		    array(
		        'section'  => 'quark_images',
		        'label'    => __('Frontpage image height (px) - small desktop', 'quark'),
		        'type'     => 'text',
		        'priority' => 32
			)
		);

		$wp_customize->add_control(
		    'quark_header_image_front4',
		    array(
		        'section'  => 'quark_images',
		        'label'    => __('Frontpage image height (px) - tablet', 'quark'),
		        'type'     => 'text',
		        'priority' => 33
			)
		);

		$wp_customize->add_control(
		    'quark_header_image_front5',
		    array(
		        'section'  => 'quark_images',
		        'label'    => __('Frontpage image height (px) - small tablet', 'quark'),
		        'type'     => 'text',
		        'priority' => 34
			)
		);

		$wp_customize->add_control(
		    'quark_header_image_front6',
		    array(
		        'section'  => 'quark_images',
		        'label'    => __('Frontpage image height (px) - mobile', 'quark'),
		        'type'     => 'text',
		        'priority' => 35
			)
		);

		// Cookie section controls
		$wp_customize->add_control(
            'quark_cookie_enable',
            array(
                'section'  => 'quark_cookie_options',
                'label'    => __('Use cookie Consent plugin', 'quark'),
                'type'     => 'checkbox',
                'priority' => 1
            )
        );

        $wp_customize->add_control(
		    'quark_cookie_mode',
		    array(
		        'section'  => 'quark_cookie_options',
		        'label'    => __('Consent mode', 'quark'),
		        'active_callback' => 'quark_show_on_cookie_enabled',
		        'type'     => 'select',
		        'description' => __('Explicit - no cookies will be set until a visitor consents, Implied - set cookies and allow visitors to opt out', 'quark'),
		        'choices'  => array(
		            'explicit'     => __('Explicit', 'quark'),
		            'implicit'    => __('Implied', 'quark')
		        ),
		        'priority' => 2
		    )
		);

		$wp_customize->add_control(
            'quark_cookie_ssl',
            array(
                'section'  => 'quark_cookie_options',
                'label'    => __('Use SSL', 'quark'),
                'active_callback' => 'quark_show_on_cookie_enabled',
                'type'     => 'checkbox',
                'priority' => 3
            )
        );

        $wp_customize->add_control(
		    'quark_cookie_banner_placement',
		    array(
		        'section'  => 'quark_cookie_options',
		        'label'    => __('Banner placement', 'quark'),
		        'active_callback' => 'quark_show_on_cookie_enabled',
		        'type'     => 'select',
		        'choices'  => array(
		            'top'     => __('Top', 'quark'),
		            'bottom'    => __('Bottom', 'quark'),
		            'push'    => __('Push from the top (experimental)', 'quark')
		        ),
		        'priority' => 4
		    )
		);

		$wp_customize->add_control(
		    'quark_cookie_tag_placement',
		    array(
		        'section'  => 'quark_cookie_options',
		        'label'    => __('Tag placement', 'quark'),
		        'active_callback' => 'quark_show_on_cookie_enabled',
		        'type'     => 'select',
		        'choices'  => array(
		            'bottom-right'     => __('Bottom right', 'quark'),
		            'bottom-left'    => __('Bottom left', 'quark'),
		            'vertical-left'    => __('Left side', 'quark'),
		            'vertical-right'    => __('Right side', 'quark')
		        ),
		        'priority' => 5
		    )
		);

        $wp_customize->add_control(
            'quark_cookie_refresh',
            array(
                'section'  => 'quark_cookie_options',
                'label'    => __('Refresh after gaining consent', 'quark'),
                'active_callback' => 'quark_show_on_cookie_enabled',
                'type'     => 'checkbox',
                'priority' => 6
            )
        );

	}

	add_action( 'customize_register', 'quark_init_customizer' );
}

function quark_customizer_fonts($group, $font, $selectors) {
    // Check the type of the font
    if (get_theme_mod('quark_'.$group.'_google_font', $font) !== '' && get_theme_mod('quark_'.$group.'_font', 'google') == 'google') {
        // Parse the google font
        $google = esc_attr(get_theme_mod('quark_'.$group.'_google_font', $font));
        $fname = array();
        preg_match('@family=(.+)$@is', $google, $fname);
        $font = "'" . str_replace('+', ' ', preg_replace('@:.+@', '', preg_replace('@&.+@', '', $fname[1]))) . "'";
    } else {
    	$font = esc_attr(get_theme_mod('quark_'.$group.'_font', 'arial'));
    }
    // Set the font selectors
    $font_selectors = esc_textarea(get_theme_mod('quark_'.$group.'_font_selectors', $selectors));
    // Output the CSS code
    $filtered_selectors = str_replace('&amp;', '&', $font_selectors);
    $filtered_selectors = str_replace('&quot;', '"', $filtered_selectors);
    echo $filtered_selectors . ' { font-family: '.$font.'; }';
}

function quark_show_font_body($control) {
    $option = $control->manager->get_setting('quark_body_font') ;
    return $option->value() == 'google';
}

function quark_show_font_headers($control) {
    $option = $control->manager->get_setting('quark_headers_font') ;
    return $option->value() == 'google';
}

function quark_show_font_others($control) {
    $option = $control->manager->get_setting('quark_other_font') ;
    return $option->value() == 'google';
}

function quark_show_on_contact() {
    $condition = is_page_template( 'template.contact.php' );
    return $condition;
}

function quark_show_on_captcha_enabled($control) {
	$option = $control->manager->get_setting('quark_contact_enable_captcha');
    $condition = is_page_template( 'template.contact.php' );
    return $option->value() == 1 && $condition;
}

function quark_show_on_classic_menu($control) {
	$option = $control->manager->get_setting('quark_menu_classic');
    return $option->value() == 1;
}

function quark_show_on_social_popup($control) {
	$option = $control->manager->get_setting('quark_popup_social_icons');
    return $option->value() == 1;
}

function quark_show_on_social_default($control) {
	$option = $control->manager->get_setting('quark_popup_social_icons');
    return $option->value() == 0;
}

function quark_show_on_cookie_enabled($control) {
	$option = $control->manager->get_setting('quark_cookie_enable');
    return $option->value() == 1;
}

function quark_sanitize_number($value) {
	if(is_numeric($value)) {
		return $value;
	}
	
	return null;
}

function quark_sanitize_copyright($string, $remove_breaks = false) {
    $string = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $string );
    $string = strip_tags($string, '<a> || <br>');

    if ( $remove_breaks )
            $string = preg_replace('/[\r\n\t ]+/', ' ', $string);

    return trim( $string );
}

function quark_sanitize_switch($value) {
	if($value == '0' || $value == '1') {
		return $value;
	}
	
	return null;
}

function quark_sanitize_font($value) {
	$fonts = array(
		'google', 
		'verdana', 
		'georgia', 
		'arial', 
		'impact', 
		'tahoma', 
		'times',
		'comic sans ms',
		'courier new',
		'helvetica'
	);
	
	if(in_array($value, $fonts)) {
		return $value;
	}
	
	return null;
}

function quark_sanitize_sidebar_pos($value) {
	if($value === 'left' || $value === 'right') {
		return $value;
	}
	return null;
}

function quark_sanitize_date_format($value) {
	if($value === 'default' || $value === 'wordpress') {
		return $value;
	}
	return null;
}

function quark_sanitize_cookie_mode($value) {
	if($value === 'explicit' || $value === 'implicit') {
		return $value;
	}
	return null;
}

function quark_sanitize_cookie_banner($value) {
	if($value === 'top' || $value === 'bottom' || $value === 'push') {
		return $value;
	}
	return null;
}

function quark_sanitize_cookie_tag($value) {
	$area = array(
		'bottom-right', 
		'bottom-left', 
		'vertical-left', 
		'vertical-right'
	);
	
	if(in_array($value, $area)) {
		return $value;
	}
	
	return null;
}


// Add CSS styles generated from GK Cusotmizer settings
function quark_customizer_css() {
	// Used fonts
	$body_font = '//fonts.googleapis.com/css?family=Open+Sans:300,400,500,700';
	$header_font = '';
	$other_font = '';
	// Selectors for the used fonts
			$body_font_selectors = 'body,
button,
.button,
input[type="submit"],
input[type="button"],
select,
textarea,
input[type="text"],
input[type="password"],
input[type="url"],
input[type="email"],
article header h1,
article header h2';

		$header_font_selectors = 'blockquote:before,
blockquote p:after';

		$other_font_selectors = '';

    // get colors
    $primary_color = esc_attr(get_theme_mod('quark_primary_color', '#f079a3'));
    $secondary_color = esc_attr(get_theme_mod('quark_secondary_color', '#26292b'));
    // get theme dimensions
    $theme_width = preg_replace('@[^0-9]@mi', '', esc_attr(get_theme_mod('quark_theme_width', '1040')));
    $tablet_width = preg_replace('@[^0-9]@mi', '', esc_attr(get_theme_mod('quark_tablet_width', '1040')));
    $small_tablet_width = preg_replace('@[^0-9]@mi', '', esc_attr(get_theme_mod('quark_small_tablet_width', '840')));
    $mobile_width = preg_replace('@[^0-9]@mi', '', esc_attr(get_theme_mod('quark_mobile_width', '640')));
    $sidebar_width = preg_replace('@[^0-9\.]@mi', '', esc_attr(get_theme_mod('quark_sidebar_width', '33.333333')));
    $sidebar_pos = esc_attr(get_theme_mod('quark_sidebar_pos', 'right'));

    ?>
    <style type="text/css">
		/* Preloader styles */
		<?php if (get_theme_mod('quark_page_loader', 1) == 1) : ?>
		#gk-page-preloader { background: #fff url('<?php echo get_stylesheet_directory_uri(); ?>/images/preloaders/default.gif') no-repeat center center; height: 100%; position: fixed; width: 100%; z-index: 10000000; }
		<?php endif; ?>

    	/* Font settings */
    	<?php quark_customizer_fonts('body', $body_font, $body_font_selectors); ?>
    	
        <?php quark_customizer_fonts('headers', $header_font, $header_font_selectors); ?>
        
        <?php quark_customizer_fonts('other', $other_font, $other_font_selectors); ?>

        <?php if(get_theme_mod('quark_word_break', '1') == '1') : ?>
        body {
            -ms-word-break: break-all;
            word-break: break-all;
            word-break: break-word;
            -webkit-hyphens: auto;
            -moz-hyphens: auto;
            -ms-hyphens: auto;
            hyphens: auto;
        }
        <?php endif; ?>

        html {
        	font-size: <?php echo get_theme_mod('quark_font_size','62.5'); ?>%;
        }

    	/* Layout settings */
    	.site,
    	#gk-header-nav-wrap,
    	.frontpage-block-wrap,
    	#gk-header-widget .widget-area {
            margin: 0 auto;
    		max-width: <?php echo $theme_width ?>px;
    		width: 100%;
    	}
    	.entry-content,
		.entry-summary,
		#comments,
		#gk-header-mod .gk-page,
		.entry-title-wrap > .gk-page {
			max-width: <?php echo $theme_width ?>px;
		}
    	<?php if(is_active_sidebar('sidebar')) : ?>
    	.content-wrapper {
    		float: <?php echo ($sidebar_pos == 'right') ? 'left' : 'right' ?>;
    		width: <?php echo 100 - $sidebar_width; ?>%;
    	}
    	#sidebar {
    		float: <?php echo ($sidebar_pos == 'right') ? 'right' : 'left' ?>;
    		padding-<?php echo ($sidebar_pos == 'right') ? 'left' : 'right' ?>: 45px;
    		width: <?php echo $sidebar_width; ?>%;
    	}
    	<?php else : ?>
    	.content-wrapper,
    	#sidebar {
    		width: 100%;
    	}
    	<?php endif; ?>

    	.gk-is-wrapper-gk_quark {
	    	height: <?php echo get_theme_mod('quark_slider_height_desktop', '700'); ?>px;
	    }

    	@media screen and (min-width: 1920px) {
	    	.entry-header {
	    		height: <?php echo get_theme_mod('quark_header_image', '920'); ?>px;
	    	}
	    	#gk-header-mod {
	    		height: <?php echo get_theme_mod('quark_header_image_front', '880'); ?>px;
	    	}
    	}

    	@media screen and (max-width: 1920px) {
	    	.entry-header {
	    		height: <?php echo get_theme_mod('quark_header_image2', '640'); ?>px;
	    	}
	    	#gk-header-mod {
	    		height: <?php echo get_theme_mod('quark_header_image_front2', '800'); ?>px;
	    	}
    	}

    	@media screen and (max-width: <?php echo $theme_width + 400; ?>px) {
    		.entry-header {
	    		height: <?php echo get_theme_mod('quark_header_image3', '600'); ?>px;
	    	}
	    	#gk-header-mod {
	    		height: <?php echo get_theme_mod('quark_header_image_front3', '640'); ?>px;
	    	}
    	}

    	@media screen and (max-width: <?php echo $tablet_width ; ?>px) {
    		.entry-header {
	    		height: <?php echo get_theme_mod('quark_header_image4', '520'); ?>px;
	    	}
	    	#gk-header-mod {
	    		height: <?php echo get_theme_mod('quark_header_image_front4', '500'); ?>px;
	    	}

	    	.gk-is-wrapper-gk_quark {
	    		height: <?php echo get_theme_mod('quark_slider_height_tablet', '500'); ?>px;
	    	}
    	}
    	@media screen and (max-width: <?php echo $small_tablet_width ; ?>px) {
    		.entry-header {
	    		height: <?php echo get_theme_mod('quark_header_image5', '440'); ?>px;
	    	}
	    	#gk-header-mod {
	    		height: <?php echo get_theme_mod('quark_header_image_front5', '320'); ?>px;
	    	}
    	}
    	@media screen and (max-width: <?php echo $mobile_width ; ?>px) {
    		.entry-header {
	    		height: <?php echo get_theme_mod('quark_header_image6', '360'); ?>px;
	    	}
	    	#gk-header-mod {
	    		height: <?php echo get_theme_mod('quark_header_image_front6', '240'); ?>px;
	    	}

	    	.gk-is-wrapper-gk_quark {
	    		height: <?php echo get_theme_mod('quark_slider_height_mobile', '300'); ?>px;
	    	}
    	}
    	
    	/* Primary color */
    	a,
    	a.inverse:hover,
		a.inverse:active,
		a.inverse:focus,
		.item-info a:hover,
		.item-info a:active,
		.item-info a:focus,
		.comment-metadata a:hover,
		.comment-metadata a:active,
		.comment-metadata a:focus,
		#gk-menu-top a:active,
		#gk-menu-top a:focus,
		#gk-menu-top a:hover,
		#gk-menu-bottom a:active,
		#gk-menu-bottom a:focus,
		#gk-menu-bottom a:hover,
		.gk-fixed-nav .nav-menu > li > a:active, 
		.gk-fixed-nav .nav-menu > li > a:focus, 
		.gk-fixed-nav .nav-menu > li > a:hover, 
		.gk-fixed-nav .nav-menu > li.current_page_item > a, 
		.gk-fixed-nav .nav-menu > li.current_page_item > a:active, 
		.gk-fixed-nav .nav-menu > li.current_page_item > a:focus, 
		.gk-fixed-nav .nav-menu > li.current_page_item > a:hover,
		.nav-menu > li .sub-menu li a:active, 
		.nav-menu > li .sub-menu li a:focus, 
		.nav-menu > li .sub-menu li a:hover,
		.nav-menu ul > li .children li a:active, 
		.nav-menu ul > li .children li a:focus, 
		.nav-menu ul > li .children li a:hover,
		#gk-menu-overlay-wrap .nav-menu a:active,
		#gk-menu-overlay-wrap .nav-menu a:focus,
		#gk-menu-overlay-wrap .nav-menu a:hover,
		#gk-menu-overlay-wrap .header > a:active,
		#gk-menu-overlay-wrap .header > a:focus,
		#gk-menu-overlay-wrap .header > a:hover,
		#gk-menu-overlay-wrap #gk-menu-overlay-close:active,
		#gk-menu-overlay-wrap #gk-menu-overlay-close:focus,
		#gk-menu-overlay-wrap #gk-menu-overlay-close:hover,
		.entry-tags a:hover,
		.gk-social-icons:hover > i,
		.gk-social-icons > span > a:active,
		.gk-social-icons > span > a:focus,
		.gk-social-icons > span > a:hover,
		.gk-cols > div.gk-social-counter a:active > i,
		.gk-cols > div.gk-social-counter a:active > strong,
		.gk-cols > div.gk-social-counter a:active > strong > span,
		.gk-cols > div.gk-social-counter a:focus > i,
		.gk-cols > div.gk-social-counter a:focus > strong,
		.gk-cols > div.gk-social-counter a:focus > strong > span,
		.gk-cols > div.gk-social-counter a:hover > i,
		.gk-cols > div.gk-social-counter a:hover > strong,
		.gk-cols > div.gk-social-counter a:hover > strong > span,
		.gk-social-icons-block > a:active,
		.gk-social-icons-block > a:focus,
		.gk-social-icons-block > a:hover,
		.gk-desc dl > dd > a:active,
		.gk-desc dl > dd > a:focus,
		.gk-desc dl > dd > a:hover,
		#gk-video-overlay > a:active,
		#gk-video-overlay > a:focus,
		#gk-video-overlay > a:hover,
		.tagcloud a:hover,
		.widget.border1 .header,
		.widget.border1 .widget-title, 
		.widget.border2 .header,
		.widget.border2 .widget-title,
		#gk-footer a:active,
		#gk-footer a:focus,
		#gk-footer a:hover,
		.gk-nsp-next:hover:after,
		.gk-nsp-prev:hover:after,
		#gk-login-popup-close,
		#cc-modal #cc-modal-closebutton a:hover,
		#cc-settingsmodal #cc-settingsmodal-closebutton a:hover {
    	  color: <?php echo $primary_color; ?>;
    	}

    	.dark.btn-border:active,
		.dark.btn-border:focus,
		.dark.btn-border:hover,
		.entry-header > img + .entry-title-wrap .search-form .btn-border:active,
		.entry-header > img + .entry-title-wrap .search-form .btn-border:focus,
		.entry-header > img + .entry-title-wrap .search-form .btn-border:hover {
    	  border-color: <?php echo $primary_color; ?>!important;
    	  color: <?php echo $primary_color; ?>!important;
    	}

    	.gk-price-table > dl dd > a:active,
		.gk-price-table > dl dd > a:focus,
		.gk-price-table > dl dd > a:hover {
		  border-color: <?php echo $primary_color; ?>;
		  color: <?php echo $primary_color; ?>;
		}

		.widget.border1, 
		.widget.border2,
		span.gk-slider-button,
		.gk-is-wrapper-gk_quark .gk-slider-button {
			border-color: <?php echo $primary_color; ?>;
		}

    	#aside-menu .gk-social-icons a:active,
		#aside-menu .gk-social-icons a:focus,
		#aside-menu .gk-social-icons a:hover,
		.widget.dark a:active,
		.widget.dark a:focus,
		.widget.dark a:hover {
    	  color: <?php echo $primary_color; ?>!important;
    	}

    	.entry-header.no-image,
    	.gk-testimonials-pagination li.active,
    	.box.color-bg,
    	.widget.color,
    	.gk-is-wrapper-gk_quark .gk-slider-bar,
    	.gk-is-wrapper-gk_quark .gk-is-quark-pagination .active,
    	.gk-nsp-arts-nav ul li.active, .gk-nsp-links-nav ul li.active,
    	#cc-tag a,
    	#cc-notification ul.cc-notification-buttons a {
		  background: <?php echo $primary_color; ?>;
		}

		.gk-map-icon:active,
		.gk-map-icon:focus,
		.gk-map-icon:hover {
		  border-bottom-color: <?php echo $primary_color; ?>;
		  color:<?php echo $primary_color; ?>;
		}

		.none .gk-tabs-wrap > ol li:hover,
		.none .gk-tabs-wrap > ol li.active,
		.none .gk-tabs-wrap > ol li.active:hover {
		  border-color: <?php echo $primary_color; ?>!important;
		  color: <?php echo $primary_color; ?>;
		}

		/* secondary color */
		legend,
		.gk-logo.text,
		#gk-header-nav .main-navigation,
		.nav-menu > li > a,
		.nav-menu > ul > li > a,
		.nav-menu > li .sub-menu li,
		.nav-menu ul > li .children li,
		.nav-menu > li .sub-menu li a,
		.nav-menu ul > li .children li a,
		#gk-mobile-menu,
		.page-template-template-login.dark-bg #gk-mobile-menu,
		.page-template-template-login.dark-bg .gk-logo.text,
		.dark-bg .gk-fixed-nav .gk-logo.text,
		#gk-login label,
		.contact label,
		.contact-details big,
		.gk-testimonials blockquote > strong,
		.gk-price-table,
		.gk-desc dl > dt,
		.gk-desc dl > dd > a,
		.box.small-text,
		.widget.small-text,
		.box .big-text,
		.entry-content ul li:before,
		.entry-summary ul li:before,
		.widget.border2 .widget-title,
		.widget.border2 a,
		.transparent-tabs .gk-tabs-nav.dark-tabs li,
		#gk-footer a  {
  			color: <?php echo $secondary_color; ?>;
		}

		#gk-mobile-menu i,
		#gk-mobile-menu i:before,
		#gk-mobile-menu i:after,
		.page-template-template-login.dark-bg #gk-mobile-menu i,
		.page-template-template-login.dark-bg #gk-mobile-menu i:before, 
		.page-template-template-login.dark-bg #gk-mobile-menu i:after,
		#gk-header-nav.show-dark i,
		#gk-header-nav.show-dark i:before,
		#gk-header-nav.show-dark i:after,
		#aside-menu,
		.gk-price-table > dl.gk-premium > dt,
		.box.dark-bg,
		.widget.dark-bg,
		#gk-video-overlay,
		.widget.dark,
		.transparent-tabs .gk-tabs-nav.dark-tabs li.active,
		.transparent-tabs .gk-tabs-nav.dark-tabs li:hover {
		  background: <?php echo $secondary_color; ?>;
		 }

		.btn-border {
		  color: <?php echo $secondary_color; ?>!important;
		}

		.gk-price-table > dl dd > a {
		  border-color: <?php echo $secondary_color; ?>;
		  color: <?php echo $secondary_color; ?>;
		}

		.gk-desc .gk-signature {
		  border-bottom-color:  <?php echo $secondary_color; ?>;
		  color: <?php echo $secondary_color; ?>;
		}

		.widget.border2 {
		  border-color: <?php echo $secondary_color; ?>;
		}

    </style>
    <?php
}

add_action( 'wp_head', 'quark_customizer_css' );

function quark_customize_register($wp_customize) {
	if ( $wp_customize->is_preview() && ! is_admin() ) {
		add_action( 'wp_footer', 'quark_customize_preview', 21);
    }
}

add_action( 'customize_register', 'quark_customize_register' );

function quark_customize_preview() {
    ?>
    <script>
    (function($){
    	// helper color change function
    	function color_change(color, diff_r, diff_g, diff_b) {
    		// validate the string
    		color = String(color).replace(/[^0-9a-f]/gi, '');
    		if (color.length < 6) {
    			return color;
    		}
    		// convert to decimal
    		var rgb = "#";
    		var subcolor;
    		var diff = [diff_r, diff_g, diff_b];

    		for (var i = 0; i < 3; i++) {
    			subcolor = parseInt(color.substr(i*2,2), 16);
    			subcolor = (subcolor - diff[i]).toString(16);
    			rgb += ("00"+subcolor).substr(subcolor.length);
    		}

    		return rgb;
    	}
    	// helper rgba converter
    	function color_rgba(color, alpha) {
    		// validate the string
			color = String(color).replace(/[^0-9a-f]/gi, '');
			if (color.length < 6) {
				return color;
			}
			// convert to decimal
			var rgb = [];
			var subcolor;

			for (var i = 0; i < 3; i++) {
				subcolor = parseInt(color.substr(i*2,2), 16);
				rgb[i] = subcolor;
			}

			return 'rgba('+rgb[0]+','+rgb[1]+','+rgb[2]+','+alpha+')';
    	}
    	// AJAX support for the color changes
    	// The CSS code can be compressed with this tool: http://refresh-sf.com/yui/
    	wp.customize('quark_primary_color', function(value) {
    	    value.bind( function( to ) {
    	    	to = to ? to : '#f079a3';
    	    	// set colors:
    	    	var new_css = 'a, a.inverse:hover, a.inverse:active, a.inverse:focus, .item-info a:hover, .item-info a:active, .item-info a:focus, .comment-metadata a:hover, .comment-metadata a:active, .comment-metadata a:focus, #gk-menu-top a:active, #gk-menu-top a:focus, #gk-menu-top a:hover, #gk-menu-bottom a:active, #gk-menu-bottom a:focus, #gk-menu-bottom a:hover, .gk-fixed-nav .nav-menu > li > a:active, .gk-fixed-nav .nav-menu > li > a:focus, .gk-fixed-nav .nav-menu > li > a:hover, .gk-fixed-nav .nav-menu > li.current_page_item > a, .gk-fixed-nav .nav-menu > li.current_page_item > a:active, .gk-fixed-nav .nav-menu > li.current_page_item > a:focus, .gk-fixed-nav .nav-menu > li.current_page_item > a:hover, .nav-menu > li .sub-menu li a:active, .nav-menu > li .sub-menu li a:focus, .nav-menu > li .sub-menu li a:hover, .nav-menu ul > li .children li a:active, .nav-menu ul > li .children li a:focus, .nav-menu ul > li .children li a:hover, #gk-menu-overlay-wrap .nav-menu a:active, #gk-menu-overlay-wrap .nav-menu a:focus, #gk-menu-overlay-wrap .nav-menu a:hover, #gk-menu-overlay-wrap .header > a:active, #gk-menu-overlay-wrap .header > a:focus, #gk-menu-overlay-wrap .header > a:hover, #gk-menu-overlay-wrap #gk-menu-overlay-close:active, #gk-menu-overlay-wrap #gk-menu-overlay-close:focus, #gk-menu-overlay-wrap #gk-menu-overlay-close:hover, .entry-tags a:hover, .gk-social-icons:hover > i, .gk-social-icons > span > a:active, .gk-social-icons > span > a:focus, .gk-social-icons > span > a:hover, .gk-cols > div.gk-social-counter a:active > i, .gk-cols > div.gk-social-counter a:active > strong, .gk-cols > div.gk-social-counter a:active > strong > span, .gk-cols > div.gk-social-counter a:focus > i, .gk-cols > div.gk-social-counter a:focus > strong, .gk-cols > div.gk-social-counter a:focus > strong > span, .gk-cols > div.gk-social-counter a:hover > i, .gk-cols > div.gk-social-counter a:hover > strong, .gk-cols > div.gk-social-counter a:hover > strong > span, .gk-social-icons-block > a:active, .gk-social-icons-block > a:focus, .gk-social-icons-block > a:hover, .gk-desc dl > dd > a:active, .gk-desc dl > dd > a:focus, .gk-desc dl > dd > a:hover, #gk-video-overlay > a:active, #gk-video-overlay > a:focus, #gk-video-overlay > a:hover, .tagcloud a:hover, .widget.border1 .header, .widget.border1 .widget-title, .widget.border2 .header, .widget.border2 .widget-title, #gk-footer a:active, #gk-footer a:focus, #gk-footer a:hover, .gk-nsp-next:hover:after, .gk-nsp-prev:hover:after, #gk-login-popup-close, #cc-modal #cc-modal-closebutton a:hover, #cc-settingsmodal #cc-settingsmodal-closebutton a:hover { color: '+to+'; } .dark.btn-border:active, .dark.btn-border:focus, .dark.btn-border:hover, .entry-header > img + .entry-title-wrap .search-form .btn-border:active, .entry-header > img + .entry-title-wrap .search-form .btn-border:focus, .entry-header > img + .entry-title-wrap .search-form .btn-border:hover { border-color: '+to+'!important; color: '+to+'!important; } .gk-price-table > dl dd > a:active, .gk-price-table > dl dd > a:focus, .gk-price-table > dl dd > a:hover { border-color: '+to+'; color: '+to+'; } .widget.border1, .widget.border2, span.gk-slider-button, .gk-is-wrapper-gk_quark .gk-slider-button { border-color: '+to+'; } #aside-menu .gk-social-icons a:active, #aside-menu .gk-social-icons a:focus, #aside-menu .gk-social-icons a:hover, .widget.dark a:active, .widget.dark a:focus, .widget.dark a:hover { color: '+to+'!important; } .entry-header.no-image, .gk-testimonials-pagination li.active, .box.color-bg, .widget.color, .gk-is-wrapper-gk_quark .gk-slider-bar, .gk-is-wrapper-gk_quark .gk-is-quark-pagination .active, .gk-nsp-arts-nav ul li.active, .gk-nsp-links-nav ul li.active, #cc-tag a, #cc-notification ul.cc-notification-buttons a { background: '+to+'; } .gk-map-icon:active, .gk-map-icon:focus, .gk-map-icon:hover { border-bottom-color: '+to+'!important; color: '+to+'; } .none .gk-tabs-wrap > ol li:hover, .none .gk-tabs-wrap > ol li.active, .none .gk-tabs-wrap > ol li.active:hover{ border-color: '+to+'!important; color: '+to+'; }';

    	    	if($(document).find('#quark-new-css-1').length) {
    	    		$(document).find('#quark-new-css-1').remove();
    	    	}

    	    	$(document).find('head').append($('<style id="quark-new-css-1">' + new_css + '</style>'));
    	    });
    	});
		wp.customize('quark_secondary_color', function(value) {
    	    value.bind( function( to ) {
    	    	to = to ? to : '#00aeef';
    	    	// set colors:
    	    	var new_css = 'legend, .gk-logo.text, #gk-header-nav .main-navigation, .nav-menu > li > a, .nav-menu > ul > li > a, .nav-menu > li .sub-menu li, .nav-menu ul > li .children li, .nav-menu > li .sub-menu li a, .nav-menu ul > li .children li a, #gk-mobile-menu, .page-template-template-login.dark-bg #gk-mobile-menu, .page-template-template-login.dark-bg .gk-logo.text, .dark-bg .gk-fixed-nav .gk-logo.text, #gk-login label, .contact label, .contact-details big, .gk-testimonials blockquote > strong, .gk-price-table, .gk-desc dl > dt, .gk-desc dl > dd > a, .box.small-text, .widget.small-text, .box .big-text, .entry-content ul li:before, .entry-summary ul li:before, .widget.border2 .widget-title, .widget.border2 a, .transparent-tabs .gk-tabs-nav.dark-tabs li, #gk-footer a  { color: '+to+'; } #gk-mobile-menu i, #gk-mobile-menu i:before, #gk-mobile-menu i:after, .page-template-template-login.dark-bg #gk-mobile-menu i, .page-template-template-login.dark-bg #gk-mobile-menu i:before, .page-template-template-login.dark-bg #gk-mobile-menu i:after, #gk-header-nav.show-dark i, #gk-header-nav.show-dark i:before, #gk-header-nav.show-dark i:after, #aside-menu, .gk-price-table > dl.gk-premium > dt, .box.dark-bg, .widget.dark-bg, #gk-video-overlay, .widget.dark, .transparent-tabs .gk-tabs-nav.dark-tabs li.active, .transparent-tabs .gk-tabs-nav.dark-tabs li:hover { background: '+to+'; } .btn-border { color: '+to+'!important; } .gk-price-table > dl dd > a { border-color: '+to+'; color: '+to+'; } .gk-desc .gk-signature { border-bottom-color: '+to+'; color: '+to+'; } .widget.border2 { border-color: '+to+'; }'

    	    	if($(document).find('#quark-new-css-2').length) {
    	    		$(document).find('#quark-new-css-2').remove();
    	    	}

    	    	$(document).find('head').append($('<style id="quark-new-css-2">' + new_css + '</style>'));
    	    });
    	});
    })(jQuery);
    </script>
    <?php
}

// EOF
