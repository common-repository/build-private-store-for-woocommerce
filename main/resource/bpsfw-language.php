<?php 

add_action( 'plugins_loaded', 'BPSFW_load_textdomain' );
	function BPSFW_load_textdomain() {
	    load_plugin_textdomain( 'build-private-store-for-woocommerce', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
	}
	
	function BPSFW_load_my_own_textdomain( $mofile, $domain ) {
	    if ( 'build-private-store-for-woocommerce' === $domain && false !== strpos( $mofile, WP_LANG_DIR . '/plugins/' ) ) {
	        $locale = apply_filters( 'plugin_locale', determine_locale(), $domain );
	        $mofile = WP_PLUGIN_DIR . '/' . dirname( plugin_basename( __FILE__ ) ) . '/languages/' . $domain . '-' . $locale . '.mo';
	    }
	    return $mofile;
	}
add_filter( 'load_textdomain_mofile', 'BPSFW_load_my_own_textdomain', 10, 2 );