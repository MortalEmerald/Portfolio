<?php
if ( !class_exists('Raute_Dashboard_Notice') ):

    class Raute_Dashboard_Notice
    {
        function __construct()
        {   
            global $pagenow;

            if( $this->raute_show_hide_notice() ){

                add_action( 'admin_notices',array( $this,'raute_admin_notice' ) );
            }
            add_action( 'wp_ajax_raute_notice_dismiss', array( $this, 'raute_notice_dismiss' ) );
            add_action( 'switch_theme', array( $this, 'raute_notice_clear_cache' ) );
        
            if( isset( $_GET['page'] ) && $_GET['page'] == 'raute-about' ){

                add_action('in_admin_header', array( $this,'raute_hide_all_admin_notice' ),1000 );

            }
        }

        public function raute_hide_all_admin_notice(){

            remove_all_actions('admin_notices');
            remove_all_actions('all_admin_notices');

        }
        
        public static function raute_show_hide_notice(){

            // Check If current Page 
            if ( isset( $_GET['page'] ) && $_GET['page'] == 'raute-about'  ) {
                return false;
            }

            // Hide if dismiss notice
            if( get_option('raute_admin_notice') ){
                return false;
            }
            // Hide if all plugin active
            if ( class_exists( 'Booster_Extension_Class' ) && class_exists( 'Demo_Import_Kit_Class' ) && class_exists( 'Themeinwp_Import_Companion' ) ) {
                return false;
            }
            // Hide On TGMPA pages
            if ( ! empty( $_GET['tgmpa-nonce'] ) ) {
                return false;
            }
            // Hide if user can't access
            if ( current_user_can( 'manage_options' ) ) {
                return true;
            }
            
        }

        // Define Global Value
        public static function raute_admin_notice(){
            $theme_info      = wp_get_theme();
            $theme_name            = $theme_info->__get( 'Name' );
            ?>
            <div class="updated notice is-dismissible twp-raute-notice">

                <p class="notice-text">
                    <?php
                    $current_user = wp_get_current_user();

                    printf(
                    /* Translators: %1$s current user display name., %2$s this theme name., %3$s discount coupon code., %4$s discount percentage. */
                        esc_html__(
                            'Dear %1$s, We hope you are enjoying using our %2$s WordPress theme. We are constantly working to improve and enhance the user experience, and we are excited to announce that we now have a pro version available. If you are interested in upgrading to pro, simply click the link below to upgrade. As a special offer, you can use the coupon code %3$s to receive a %4$s discount on the purchase price (offer valid for a limited time).',
                            'raute'
                        ),
                        '<strong>' . esc_html( $current_user->display_name ) . '</strong>',
                        '<strong>' . esc_html( $theme_name ) . '</strong>',
                        '<code class="coupon-code">ONBOARDINGDISCOUNT</code>',
                        '25%'
                    );

                    ?>
                </p>

                <p class="notice-text"><?php esc_html_e('Thank you for your continued support and we hope you consider upgrading to pro.','raute'); ?></p>


                <p>
                    <a target="_blank" class="button button-primary button-primary-upgrade" href="<?php echo esc_url( 'https://www.themeinwp.com/theme/raute-pro/' ); ?>">
                        <span class="dashicons dashicons-thumbs-up"></span>
                        <span><?php esc_html_e('Upgrade to Pro','raute'); ?></span>
                    </a>

                    <a class="button button-secondary twp-install-active" href="javascript:void(0)">
                        <span class="dashicons dashicons-admin-plugins"></span>
                        <span><?php esc_html_e('Install and enable all recommended plugins','raute'); ?></span>
                    </a>
                    <span class="quick-loader-wrapper"><span class="quick-loader"></span></span>

                    <a target="_blank" class="button button-secondary" href="<?php echo esc_url( 'https://live-demo.themeinwp.com/raute/' ); ?>">
                        <span class="dashicons dashicons-welcome-view-site"></span>
                        <span><?php esc_html_e('View Demo','raute'); ?></span>
                    </a>

                    <a target="_blank" class="button button-primary" href="<?php echo esc_url('https://wordpress.org/support/theme/raute/reviews/?filter=5'); ?>">
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span><?php esc_html_e('Leave a review', 'raute'); ?></span>
                    </a>

                    <a class="btn-dismiss twp-custom-setup" href="javascript:void(0)"><?php esc_html_e('Dismiss this notice.','raute'); ?></a>

                </p>

            </div>

        <?php
        }

        public function raute_notice_dismiss(){

            if ( isset( $_POST[ '_wpnonce' ] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ '_wpnonce' ] ) ), 'raute_ajax_nonce' ) ) {

                update_option('raute_admin_notice','hide');

            }

            die();

        }

        public function raute_notice_clear_cache(){

            update_option('raute_admin_notice','');

        }

    }
    new Raute_Dashboard_Notice();
endif;