<?php
/**
* Custom Functions.
*
* @package Raute
*/

if( !function_exists( 'raute_sanitize_sidebar_option' ) ) :

    // Sidebar Option Sanitize.
    function raute_sanitize_sidebar_option( $raute_input ){

        $raute_metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $raute_input,$raute_metabox_options ) ){

            return $raute_input;

        }

        return;

    }

endif;

if( !function_exists( 'raute_sanitize_single_pagination_layout' ) ) :

    // Sidebar Option Sanitize.
    function raute_sanitize_single_pagination_layout( $raute_input ){

        $raute_single_pagination = array( 'no-navigation','norma-navigation','ajax-next-post-load' );
        if( in_array( $raute_input,$raute_single_pagination ) ){

            return $raute_input;

        }

        return;

    }

endif;

if( !function_exists( 'raute_sanitize_archive_layout' ) ) :

    // Sidebar Option Sanitize.
    function raute_sanitize_archive_layout( $raute_input ){

        $raute_archive_option = array( 'default','full','grid','masonry' );
        if( in_array( $raute_input,$raute_archive_option ) ){

            return $raute_input;

        }

        return;

    }

endif;

if( !function_exists( 'raute_sanitize_header_layout' ) ) :

    // Sidebar Option Sanitize.
    function raute_sanitize_header_layout( $raute_input ){

        $raute_header_options = array( 'layout-1','layout-2','layout-3' );
        if( in_array( $raute_input,$raute_header_options ) ){

            return $raute_input;

        }

        return;

    }

endif;

if( !function_exists( 'raute_sanitize_single_post_layout' ) ) :

    // Single Layout Option Sanitize.
    function raute_sanitize_single_post_layout( $raute_input ){

        $raute_single_layout = array( 'layout-1','layout-2' );
        if( in_array( $raute_input,$raute_single_layout ) ){

            return $raute_input;

        }

        return;

    }

endif;

if ( ! function_exists( 'raute_sanitize_checkbox' ) ) :

	/**
	 * Sanitize checkbox.
	 */
	function raute_sanitize_checkbox( $raute_checked ) {

		return ( ( isset( $raute_checked ) && true === $raute_checked ) ? true : false );

	}

endif;


if ( ! function_exists( 'raute_sanitize_select' ) ) :

    /**
     * Sanitize select.
     */
    function raute_sanitize_select( $raute_input, $raute_setting ) {

        // Ensure input is a slug.
        $raute_input = sanitize_text_field( $raute_input );

        // Get list of choices from the control associated with the setting.
        $choices = $raute_setting->manager->get_control( $raute_setting->id )->choices;

        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $raute_input, $choices ) ? $raute_input : $raute_setting->default );

    }

endif;

if ( ! function_exists( 'raute_sanitize_repeater' ) ) :
    
    /**
    * Sanitise Repeater Field
    */
    function raute_sanitize_repeater($input){
        $input_decoded = json_decode( $input, true );
        
        if(!empty($input_decoded)) {

            foreach ($input_decoded as $boxes => $box ){

                foreach ($box as $key => $value){

                    if( $key == 'category_color' ){

                        $input_decoded[$boxes][$key] = sanitize_hex_color( $value );

                    }else{

                        $input_decoded[$boxes][$key] = sanitize_text_field( $value );

                    }
                    
                }

            }
           
            return json_encode($input_decoded);

        }

        return $input;
    }
endif;


if ( ! function_exists( 'raute_sanitize_dropdown_pages' ) ) :

    /**
     * Sanitize dropdown pages.
     *
     * @since 1.0.0
     *
     * @param int                  $page_id Page ID.
     * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
     * @return int|string Page ID if the page is published; otherwise, the setting default.
     */
    function raute_sanitize_dropdown_pages( $page_id, $setting ) {

        // Ensure $input is an absolute integer.
        $page_id = absint( $page_id );

        // If $page_id is an ID of a published page, return it; otherwise, return the default.
        return ( 'publish' === get_post_status( $page_id ) ? $page_id : $setting->default );

    }

endif;