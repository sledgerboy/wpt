<?php

function wp_update_php_annotation_custom(){

	
	$requires_php = isset( $plugin_data['RequiresPHP'] ) ? $plugin_data['RequiresPHP'] : 7.4;
	$compatible_php = is_php_version_compatible($requires_php);
	$php_display_version = trim(stristr(phpversion(), '-', true));

	if ($compatible_php != 'false') {
		global $pagenow;
		if ( $pagenow == 'plugins.php' ) {
			echo '<div style="margin-left:11.5rem;" class="update-message notice ml-5 inline notice-error notice-alt"><p>
			Sledheader plugin error: Your version of PHP is ' . $php_display_version . '. This plugin require at least PHP '. $requires_php . '
			</p>  </div>';
		}
		
	}
}

    function enqueue_styles() {
        $version = date("Ymd") . rand(0,99);
        wp_enqueue_style( 'sledheader.css', plugin_dir_url( __FILE__ ) . 'css/sledheader.css', array(), $version, 'all' );
    }


    
    
    function set_the_header($the_title) {
        $html = '<span class="sledheader_datter">' . get_the_date() . '</span>';
        return str_replace($the_title, $the_title . $html, $the_title);
    }
    
    

