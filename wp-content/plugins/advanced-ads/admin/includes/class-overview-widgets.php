<?php
/**
 * container class for callbacks for overview widgets
 *
 * @package WordPress
 * @subpackage Advanced Ads Plugin
 * @since 1.4.3
 */
class Advanced_Ads_Overview_Widgets_Callbacks {

	/**
	 * register the plugin overview widgets
	 *
	 * @since 1.4.3
	 */
	public static function setup_overview_widgets(){

		self::add_meta_box('advads_overview_news', __( 'Next steps', 'advanced-ads' ), 'left',
		    'render_next_steps');
		self::add_meta_box('advads_overview_support', __( 'Manual and Support', 'advanced-ads' ), 'right',
		    'render_support' );

		// add widgets for pro add ons
		self::add_meta_box('advads_overview_addons', __( 'Add-Ons', 'advanced-ads' ), 'full', 'render_addons' );
		
		do_action( 'advanced-ads-overview-widgets-after' );
	}
	
	/**
	 * loads a meta box into output
	 */
	public static function add_meta_box( $id = '', $title = '', $position = 'full', $callback ){
		
		ob_start();
		call_user_func(array('Advanced_Ads_Overview_Widgets_Callbacks', $callback));
		do_action( 'advanced-ads-overview-widget-content-' . $id, $id );
		$content = ob_get_clean();
	    
		include( ADVADS_BASE_PATH . 'admin/views/overview-widget.php' );
	    
	}

	/**
	 * render next steps widget
	 *
	 * @since 1.5.4
	 */
	public static function render_next_steps(){

		$primary_taken = false;
	    
		$model = Advanced_Ads::get_instance()->get_model();
		$recent_ads = $model->get_ads();
		if ( count( $recent_ads ) == 0 ) :
			echo '<p><a class="button button-primary" href="' . admin_url( 'post-new.php?post_type=' . Advanced_Ads::POST_TYPE_SLUG ) .
			'">' . __( 'Create your first ad', 'advanced-ads' ) . '</a></p>';
			$primary_taken = true;
		endif;
	    
		$is_subscribed = Advanced_Ads_Admin_Notices::get_instance()->is_subscribed();
		$options = Advanced_Ads_Admin_Notices::get_instance()->options();

		$_notice = 'nl_free_addons';
		if ( ! $is_subscribed ) {
		    ?><h3><?php _e( 'Join the newsletter for more benefits', 'advanced-ads' ); ?></h3>
		    <ul>
			<li><?php _e( 'Get 2 free add-ons', 'advanced-ads' ); ?></li>
			<li><?php _e( 'Get the first steps and more tutorials to your inbox', 'advanced-ads' ); ?></li>
			<li><?php _e( 'How to earn more with AdSense', 'advanced-ads' ); ?></li>
		    </ul>
		    <div class="advads-admin-notice">
			<button type="button" class="button-<?php echo ( $primary_taken ) ? 'secondary' : 'primary'; ?> advads-notices-button-subscribe" data-notice="<?php echo $_notice ?>"><?php _e('Join now', 'advanced-ads'); ?></button>
		    </div><?php
		}
		
		// link to manage ads
		if ( $is_subscribed && count( $recent_ads ) > 0 ) :
			echo '<p><a class="button button-secondary" href="' . admin_url( 'edit.php?post_type=' . Advanced_Ads::POST_TYPE_SLUG ) .
			'">' . __( 'Manage your ads', 'advanced-ads' ) . '</a></p>';
		endif;

		/*$_notice = 'nl_adsense';
		if ( ! isset($options['closed'][ $_notice ] ) ) {
			?><div class="advads-admin-notice">
			    <p><?php _e( 'Learn more about how and <strong>how much you can earn with AdSense</strong> and Advanced Ads from the dedicated newsletter group.', 'advanced-ads' ); ?></p>
			    <button type="button" class="button-primary advads-notices-button-subscribe" data-notice="<?php echo $_notice ?>"><?php _e('Subscribe me now', 'advanced-ads'); ?></button>
			</div><?php
		}

		$_notice = 'nl_first_steps';
		if ( ! isset($options['closed'][ $_notice ] ) && ! $is_subscribed  ) {
			?><div class="advads-admin-notice">
			    <p><?php _e( 'Get the first steps and more tutorials to your inbox.', 'advanced-ads' ); ?></p>
			    <button type="button" class="button-primary advads-notices-button-subscribe" data-notice="<?php echo $_notice ?>"><?php _e('Send it now', 'advanced-ads'); ?></button>
			</div><?php
		}*/

	}

	/**
	 * support widget
	 */
	public static function render_support(){
		?><ul>
            <li><?php printf( __( '<a href="%s" target="_blank">Manual</a>', 'advanced-ads' ), ADVADS_URL . 'manual/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-manual' ); ?></li>
            <li><?php printf( __( '<a href="%s" target="_blank">FAQ and Support</a>', 'advanced-ads' ), ADVADS_URL . 'support/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-support' ); ?></li>
            <li><?php printf( __( 'Thank the developer with a &#9733;&#9733;&#9733;&#9733;&#9733; review on <a href="%s" target="_blank">wordpress.org</a>', 'advanced-ads' ), 'https://wordpress.org/support/plugin/advanced-ads/reviews/?filter=5#new-post' ); ?></li>
        </ul><?php
	}

	/**
	 * pro addons widget
	 */
	public static function render_addons(){
	    
	    $caching_used = ! Advanced_Ads_Checks::cache();
	    
	    ob_start();
	    ?><p><?php _e( 'The solution for professional websites.', 'advanced-ads' ); ?></p><ul class='list'>
		<li><?php 
		    if( $caching_used ) : ?><strong><?php endif;
		    _e( 'support for cached sites', 'advanced-ads' ); 
		    if( $caching_used ) : ?></strong><?php endif;
		    ?></li>
		<li><?php _e( '11 more display and visitor conditions', 'advanced-ads' ); ?></li>
		<li><?php _e( '6 more placements', 'advanced-ads' ); ?></li>
		<li><?php _e( 'placement tests for ad optimization', 'advanced-ads' ); ?></li>
		<li><?php _e( 'ad grids and many more advanced features', 'advanced-ads' ); ?></li>
	    </ul><?php
	    $pro_content = ob_get_clean();
	    
	    $add_ons = array(
		    'bundle' => array(
			    'title'	=> 'Pro Bundle',
			    'desc'	=> __( 'Our best deal with all current and future add-ons included.', 'advanced-ads' ),
			    'link'	=> ADVADS_URL . 'add-ons/bundle-pro/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-add-ons',
			    'link_title' => __( 'Get the Bundle', 'advanced-ads' ),
			    'link_primary' => true,
			    'order' => 0,
		    ),
		    'tracking'	=> array(
			    'title'	=> 'Tracking',
			    'desc'	=> __( 'Analyze clicks and impressions of your ads locally or in Google Analytics, share reports, and limit ads to a specific number of impressions or clicks.', 'advanced-ads' ),
			    'link'	=> ADVADS_URL . 'add-ons/tracking/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-add-ons',
			    'order' => 4,
		    ),
		    'responsive' => array(
			    'title'	=> 'Responsive, AMP and Mobile ads',
			    'desc'	=> __( 'Display ads based on the device or the size of your visitor’s browser, and control ads on AMP pages.', 'advanced-ads' ),
			    'link'	=> ADVADS_URL . 'add-ons/responsive-ads/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-add-ons',
			    'order' => 4,
		    ),
		    'pro'	=> array(
			    'title'	=> 'Advanced Ads Pro',
			    'desc'	=> $pro_content,
			    'link'	=> ADVADS_URL . 'add-ons/advanced-ads-pro/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-add-ons',
			    'order' => 4,
		    ),
		    'selling'	=> array(
			    'title'	=> 'Selling Ads',
			    'desc'	=> __( 'Earn more money and let advertisers pay for ad space directly on the frontend of your site.', 'advanced-ads' ),
			    'link'	=> ADVADS_URL . 'add-ons/selling-ads/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-add-ons',
			    'order' => 5,
		    ),
		    'geo'	=> array(
			    'title'	=> 'Geo Targeting',
			    'desc'	=> __( 'Target visitors with ads that match their geo location and make more money with regional campaigns.', 'advanced-ads' ),
			    'link'	=> ADVADS_URL . 'add-ons/geo-targeting/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-add-ons',
			    'order' => 5,
		    ),
		    'sticky'	=> array(
			    'title'	=> 'Sticky ads',
			    'desc'	=> __( 'Increase click rates on your ads by placing them in sticky positions above, next or below your site.', 'advanced-ads' ),
			    'link'	=> ADVADS_URL . 'add-ons/sticky-ads/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-add-ons',
			    'order' => 5,
		    ),
		    'layer'	=> array(
			    'title'	=> 'PopUps and Layers',
			    'desc'	=> __( 'Users will never miss an ad or other information in a PopUp. Choose when it shows up and for how long a user can close it.', 'advanced-ads' ),
			    'link'	=> ADVADS_URL . 'add-ons/popup-and-layer-ads/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-add-ons',
			    'order' => 5,
		    ),
		    'slider'	=> array(
			    'title'	=> 'Ad Slider',
			    'desc'	=> __( 'Create a beautiful and simple slider from your ads to show more information on less space.', 'advanced-ads' ),
			    'link'	=> ADVADS_URL . 'add-ons/slider/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-add-ons',
			    'order' => 5,
		    ),
		    'code-highlighter'	=> array(
			    'title'	=> 'Code Highlighter',
			    'desc'	=> __( 'Are you using the plain text & code ad type a lot? Install this add-on to show the code highlighted like in a real IDE.', 'advanced-ads' ),
			    'class'	=> 'free',
			    'link'	=> wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=' . 'advanced-ads-code-highlighter'), 'install-plugin_' . 'advanced-ads-code-highlighter'),
			    'link_title' => __( 'Install now', 'advanced-ads' ),
			    'order' => 9,
		    )
	    );
	    
	    // get all installed plugins; installed is not activated
	    $installed_plugins = get_plugins();
	    
	    // handle Code Highlighter if already installed or not activated
	    if( isset( $installed_plugins['advanced-ads-code-highlighter/advanced-ads-code-highlighter.php'] ) && ! class_exists( 'Advanced_Ads_Code_Highlighter') ){ // is installed, but not active
		    $add_ons['code-highlighter']['link'] = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=advanced-ads-code-highlighter/advanced-ads-code-highlighter.php&amp', 'activate-plugin_advanced-ads-code-highlighter/advanced-ads-code-highlighter.php' );
		    $add_ons['code-highlighter']['link_title'] = __( 'Activate now', 'advanced-ads' );
	    } elseif( class_exists( 'Advanced_Ads_Code_Highlighter') ) {
		    // remove plugin from the list
		    unset( $add_ons['code-highlighter'] );
	    }
	    
	    // PRO
	    if( isset( $installed_plugins['advanced-ads-pro/advanced-ads-pro.php'] ) && ! class_exists( 'Advanced_Ads_Pro') ){ // is installed, but not active
		    $add_ons['pro']['link'] = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=advanced-ads-pro/advanced-ads-pro.php&amp', 'activate-plugin_advanced-ads-pro/advanced-ads-pro.php' );
		    $add_ons['pro']['link_title'] = __( 'Activate now', 'advanced-ads' );
	    } elseif( class_exists( 'Advanced_Ads_Pro') ) {
		    $add_ons['pro']['link'] = ADVADS_URL . 'add-ons/advanced-ads-pro/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-add-ons-manual';
		    $add_ons['pro']['desc'] = '';
		    $add_ons['pro']['installed'] = true;
		    $add_ons['pro']['order'] = 20;
	    } elseif( $caching_used ) {
		    $add_ons['pro']['class'] = 'recommended';
	    }
	    
	    // TRACKING
	    if( isset( $installed_plugins['advanced-ads-tracking/tracking.php'] ) && ! class_exists( 'Advanced_Ads_Tracking_Plugin') ){ // is installed, but not active
		    $add_ons['tracking']['link'] = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=advanced-ads-tracking/tracking.php&amp', 'activate-plugin_advanced-ads-tracking/tracking.php' );
		    $add_ons['tracking']['link_title'] = __( 'Activate now', 'advanced-ads' );
	    } elseif( class_exists( 'Advanced_Ads_Tracking_Plugin') ) {
		    $add_ons['tracking']['link'] = ADVADS_URL . 'add-ons/tracking/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-add-ons-manual';
		    $add_ons['tracking']['desc'] = '<a href="' . admin_url( '/admin.php?page=advanced-ads-stats' ) . '">' . __('Visit your ad stats', 'advanced-ads') . '</a>';
		    $add_ons['tracking']['installed'] = true;
		    $add_ons['tracking']['order'] = 20;
	    }
	    
	    // RESPONSIVE
	    if( isset( $installed_plugins['advanced-ads-responsive/responsive-ads.php'] ) && ! class_exists( 'Advanced_Ads_Responsive_Plugin') ){ // is installed, but not active
		    $add_ons['responsive']['link'] = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=advanced-ads-responsive/responsive-ads.php&amp', 'activate-plugin_advanced-ads-responsive/responsive-ads.php' );
		    $add_ons['responsive']['link_title'] = __( 'Activate now', 'advanced-ads' );
	    } elseif( class_exists( 'Advanced_Ads_Responsive_Plugin') ) {
		    $add_ons['responsive']['link'] = ADVADS_URL . 'add-ons/responsive-ads/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-add-ons-manual';
		    $add_ons['responsive']['desc'] = '<a href="' . admin_url( 'admin.php?page=responsive-ads-list' ) . '">' . __('List of responsive ads by browser width', 'advanced-ads-responsive') . '</a>';
		    $add_ons['responsive']['installed'] = true;
		    $add_ons['responsive']['order'] = 20;
	    }
	    
	    // STICKY
	    if( isset( $installed_plugins['advanced-ads-sticky-ads/sticky-ads.php'] ) && ! class_exists( 'Advanced_Ads_Sticky_Plugin') ){ // is installed, but not active
		    $add_ons['sticky']['link'] = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=advanced-ads-sticky-ads/sticky-ads.php&amp', 'activate-plugin_advanced-ads-sticky-ads/sticky-ads.php' );
		    $add_ons['sticky']['link_title'] = __( 'Activate now', 'advanced-ads' );
	    } elseif( class_exists( 'Advanced_Ads_Sticky_Plugin') ) {
		    $add_ons['sticky']['link'] = ADVADS_URL . 'add-ons/sticky-ads/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-add-ons-manual';
		    $add_ons['sticky']['desc'] = '';
		    $add_ons['sticky']['installed'] = true;
		    $add_ons['sticky']['order'] = 20;
	    }
	    
	    // LAYER
	    if( isset( $installed_plugins['advanced-ads-layer/layer-ads.php'] ) && ! class_exists( 'Advanced_Ads_Layer_Plugin') ){ // is installed, but not active
		    $add_ons['layer']['link'] = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=advanced-ads-layer/layer-ads.php&amp', 'activate-plugin_advanced-ads-layer/layer-ads.php' );
		    $add_ons['layer']['link_title'] = __( 'Activate now', 'advanced-ads' );
	    } elseif( class_exists( 'Advanced_Ads_Layer_Plugin') ) {
		    $add_ons['layer']['link'] = ADVADS_URL . 'add-ons/popup-and-layer-ads/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-add-ons-manual';
		    $add_ons['layer']['desc'] = '';
		    $add_ons['layer']['installed'] = true;
		    $add_ons['layer']['order'] = 20;
	    }
	    
	    // SELLING ADS
	    if( isset( $installed_plugins['advanced-ads-selling/advanced-ads-selling.php'] ) && ! class_exists( 'Advanced_Ads_Selling_Plugin') ){ // is installed, but not active
		    $add_ons['selling']['link'] = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=advanced-ads-selling/advanced-ads-selling.php&amp', 'activate-plugin_advanced-ads-selling/advanced-ads-selling.php' );
		    $add_ons['selling']['link_title'] = __( 'Activate now', 'advanced-ads' );
	    } elseif( class_exists( 'Advanced_Ads_Selling_Plugin') ) {
		    $add_ons['selling']['link'] = ADVADS_URL . 'add-ons/selling-ads/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-add-ons-manual';
		    $add_ons['selling']['desc'] = '';
		    $add_ons['selling']['installed'] = true;
		    $add_ons['selling']['order'] = 20;
	    }
	    
	    // GEO TARGETING
	    if( isset( $installed_plugins['advanced-ads-geo/advanced-ads-geo.php'] ) && ! class_exists( 'Advanced_Ads_Geo_Plugin') ){ // is installed, but not active
		    $add_ons['geo']['link'] = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=advanced-ads-geo/advanced-ads-geo.php&amp', 'activate-plugin_advanced-ads-geo/advanced-ads-geo.php' );
		    $add_ons['geo']['link_title'] = __( 'Activate now', 'advanced-ads' );
	    } elseif( class_exists( 'Advanced_Ads_Geo_Plugin') ) {
		    $add_ons['geo']['link'] = ADVADS_URL . 'add-ons/geo-targeting/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-add-ons-manual';
		    $add_ons['geo']['desc'] = '';
		    $add_ons['geo']['installed'] = true;
		    $add_ons['geo']['order'] = 20;
	    }
	    
	    // SLIDER
	    if( isset( $installed_plugins['advanced-ads-slider/slider.php'] ) && ! class_exists( 'Advanced_Ads_Slider_Plugin') ){ // is installed, but not active
		    $add_ons['slider']['link'] = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=advanced-ads-slider/slider.php&amp', 'activate-plugin_advanced-ads-slider/slider.php' );
		    $add_ons['slider']['link_title'] = __( 'Activate now', 'advanced-ads' );
	    } elseif( class_exists( 'Advanced_Ads_Slider_Plugin') ) {
		    $add_ons['slider']['link'] = ADVADS_URL . 'add-ons/slider/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-add-ons-manual';
		    $add_ons['slider']['desc'] = '';
		    $add_ons['slider']['installed'] = true;
		    $add_ons['slider']['order'] = 20;
	    }
	    
	    // add Genesis Ads, if Genesis based theme was detected
	    if( defined( 'PARENT_THEME_NAME') && 'Genesis' === PARENT_THEME_NAME ) {
		    $add_ons['genesis'] = array(
			    'title'	=> 'Genesis Ads',
			    'desc'	=> __( 'Use Genesis specific ad positions.', 'advanced-ads' ),
			    'order'	=> 2,
			    'class'	=> 'free',
			    'link'	=> wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=' . 'advanced-ads-genesis'), 'install-plugin_' . 'advanced-ads-genesis'),
			    'link_title' => __( 'Install now', 'advanced-ads' ),
		    );
		    // handle install link as long as we can not be sure this is done by the Genesis plugin itself
		    if( isset( $installed_plugins['genesis-ads/genesis-ads.php'] ) && ! defined( 'AAG_SLUG') ){ // is installed, but not active
			    $add_ons['genesis']['link'] = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=genesis-ads/genesis-ads.php&amp', 'activate-plugin_genesis-ads/genesis-ads.php' );
			    $add_ons['genesis']['link_title'] = __( 'Activate now', 'advanced-ads' );
		    } elseif( defined( 'AAG_SLUG') ) {
			    unset( $add_ons['genesis'] );
		    }	
	    }
	    
	    // add Visual Composer Ads, if VC was detected
	    if( defined( 'WPB_VC_VERSION') ) {
		    $add_ons['visual_composer'] = array(
			    'title'	=> 'Visual Composer Ads',
			    'desc'	=> __( 'Manage ad positions with Visual Composer.', 'advanced-ads' ),
			    'order'	=> 2,
			    'class'	=> 'free',
			    'link'	=> wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=' . 'ads-for-visual-composer'), 'install-plugin_' . 'ads-for-visual-composer'),
			    'link_title' => __( 'Install now', 'advanced-ads' ),
		    );
		    // handle install link as long as we can not be sure this is done by the Genesis plugin itself
		    if( isset( $installed_plugins['ads-for-visual-composer/advanced-ads-vc.php'] ) && ! class_exists( 'Advanced_Ads_Visual_Composer') ){ // is installed, but not active
			    $add_ons['visual_composer']['link'] = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=ads-for-visual-composer/advanced-ads-vc.php&amp', 'activate-plugin_ads-for-visual-composer/advanced-ads-vc.php' );
			    $add_ons['visual_composer']['link_title'] = __( 'Activate now', 'advanced-ads' );
		    } elseif( class_exists( 'Advanced_Ads_Visual_Composer') ) {
			    unset( $add_ons['visual_composer'] );
		    }	
	    }
	    
	    // allow add-ons to manipulate the output
	    $add_ons = apply_filters( 'advanced-ads-overview-add-ons', $add_ons );
	    
	    uasort( $add_ons, 'self::sort_by_order' );
	    
	    ?><table class="widefat striped"><?php
	    foreach( $add_ons as $_addon ) :
		    if( isset( $_addon['installed'] ) ){
			    $link_title = __( 'Visit the manual', 'advanced-ads' );
			    $_addon['title'] = '<span class="dashicons dashicons-yes" style="color: green; font-size: 1.5em;"></span> ' . $_addon['title'];
		    } else {
			    $link_title = isset( $_addon['link_title'] ) ? $_addon['link_title'] : __( 'Get this add-on', 'advanced-ads' );
		    }
		    include ADVADS_BASE_PATH . 'admin/views/overview-addons-line.php';
	    endforeach;
	    ?></table><?php
	}
	
	/**
	 * sort by installed add-ons
	 */
	private static function sort_by_order( $a, $b ) {
		return $a['order'] - $b['order'];
	}

}
