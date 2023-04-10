<?php
/**
 * Social Link Widgets.
 *
 * @package Raute
 */
if ( !function_exists('raute_social_link_widget') ) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function raute_social_link_widget(){
        // Social Link Widget.
        register_widget('Raute_Social_Link_widget');
    }
endif;
add_action('widgets_init', 'raute_social_link_widget');
/*Social widget*/
if ( !class_exists( 'Raute_Social_Link_widget' ))  :
    /**
     * Social widget Class.
     *
     * @since 1.0.0
     */
    class Raute_Social_Link_widget extends Raute_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'raute_social_widget',
                'description' => esc_html__('Displays Social share.', 'raute'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => esc_html__('Title:', 'raute'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'url-fb' => array(
                   'label' => esc_html__('Facebook URL:', 'raute'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-tw' => array(
                   'label' => esc_html__('Twitter URL:', 'raute'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-lt' => array(
                   'label' => esc_html__('Linkedin URL:', 'raute'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-ig' => array(
                   'label' => esc_html__('Instagram URL:', 'raute'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-pt' => array(
                   'label' => esc_html__('Pinterest URL:', 'raute'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-rt' => array(
                   'label' => esc_html__('Reddit URL:', 'raute'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-sk' => array(
                   'label' => esc_html__('Skype URL:', 'raute'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-sc' => array(
                   'label' => esc_html__('Snapchat URL:', 'raute'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-tr' => array(
                   'label' => esc_html__('Tumblr URL:', 'raute'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-th' => array(
                   'label' => esc_html__('Twitch URL:', 'raute'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-yt' => array(
                   'label' => esc_html__('Youtube URL:', 'raute'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-vo' => array(
                   'label' => esc_html__('Vimeo URL:', 'raute'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-wa' => array(
                   'label' => esc_html__('Whatsapp URL:', 'raute'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-wp' => array(
                   'label' => esc_html__('WordPress URL:', 'raute'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-gh' => array(
                   'label' => esc_html__('Github URL:', 'raute'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-fs' => array(
                   'label' => esc_html__('FourSquare URL:', 'raute'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-db' => array(
                   'label' => esc_html__('Dribbble URL:', 'raute'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-vk' => array(
                   'label' => esc_html__('VK URL:', 'raute'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
            );
            parent::__construct( 'raute-social-layout', esc_html__('MP: Social Widget', 'raute'), $opts, array(), $fields );
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget( $args, $instance )
        {
            $params = $this->get_params( $instance );
            echo $args['before_widget'];
            if ( ! empty( $params['title'] ) ) {
                echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
            } ?>
            <div class="twp-social-widget">
                <ul class="social-widget-wrapper">
                    <?php if ( !empty( $params['url-fb'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-fb']); ?>" target="_blank">
                              <?php raute_the_theme_svg('facebook'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-tw'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-tw']); ?>" target="_blank">
                              <?php raute_the_theme_svg('twitter'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-lt'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-lt']); ?>" target="_blank">
                              <?php raute_the_theme_svg('linkedin'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-ig'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-ig']); ?>" target="_blank">
                              <?php raute_the_theme_svg('instagram'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-pt'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-pt']); ?>" target="_blank">
                              <?php raute_the_theme_svg('pinterest'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-rt'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-rt']); ?>" target="_blank">
                              <?php raute_the_theme_svg('reddit'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-sk'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-sk']); ?>" target="_blank">
                              <?php raute_the_theme_svg('skype'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-sc'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-sc']); ?>" target="_blank">
                              <?php raute_the_theme_svg('snapchat'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-tr'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-tr']); ?>" target="_blank">
                              <?php raute_the_theme_svg('tumblr'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-th'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-th']); ?>" target="_blank">
                              <?php raute_the_theme_svg('twitch'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-yt'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-yt']); ?>" target="_blank">
                              <?php raute_the_theme_svg('youtube'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-vo'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-vo']); ?>" target="_blank">
                              <?php raute_the_theme_svg('vimeo'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-wa'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-wa']); ?>" target="_blank">
                              <?php raute_the_theme_svg('whatsapp'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-wp'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-wp']); ?>" target="_blank">
                              <?php raute_the_theme_svg('WordPress'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-gh'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-gh']); ?>" target="_blank">
                              <?php raute_the_theme_svg('github'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-fs'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-fs']); ?>" target="_blank">
                              <?php raute_the_theme_svg('foursquare'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-db'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-db']); ?>" target="_blank">
                              <?php raute_the_theme_svg('dribbble'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-vk'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-vk']); ?>" target="_blank">
                              <?php raute_the_theme_svg('vk'); ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;
