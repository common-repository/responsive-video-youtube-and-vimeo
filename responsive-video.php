<?php
/*

Plugin Name: Responsive Video Youtube And Vimeo

Plugin URI: shopcode.org

Description: Responsive Video Youtube And Vimeo

Author: Shopcode

Version: 1.0

Author URI: http://shopcode.org

*/


// add script check video responsive

function rvyv_responsive_video_script() {

wp_register_script('rvyv_responsive_video_script', plugins_url('responsive-video-script.js', __FILE__), array('jquery'),'1.1', true);

wp_enqueue_script('rvyv_responsive_video_script');

}

add_action( 'wp_enqueue_scripts', 'rvyv_responsive_video_script' ); 



// add shorcode


function rvyv_responsive_video_shortcode(){
   add_shortcode('video-responsive', 'rvyv_responsive_video_name');
}

add_action( 'init', 'rvyv_responsive_video_shortcode');

function rvyv_responsive_video_name($atts,  $content = null) {
   extract(shortcode_atts(array(
      'embed'=> 'https://www.youtube.com/embed/',
     'v'=> '_GuOjXYl5ew', 	  
   ), $atts));


 

$mystring = $v;
$findme   = "?v=";
$pos = strpos($mystring, $findme);


if ($pos === false) {

	$y = str_replace("https://vimeo.com/", "", $v);
$embed = "https://player.vimeo.com/video/";
   


} else {
 
 $y = str_replace("https://www.youtube.com/watch", "", $v);
 $y = str_replace("?v=", "", $y);
$embed = 'https://www.youtube.com/embed/';
 

 
}
  

  
   $return_string = '<div class="auto-video full-video"><p style="text-align: center;"><iframe src="'.$embed.$y.'" width="560" height="315" frameborder="0" allowfullscreen="allowfullscreen"></iframe></p></div>';
	
   $return_string .= '';

   return $return_string;
}


//add style plugin

add_action('wp_enqueue_scripts','rvyv_responsive_video_style');
function rvyv_responsive_video_style(){

$name = dirname ( plugin_basename ( __FILE__ ) );

 wp_enqueue_style('rvyv-responsive-video-style', plugins_url('/responsive-video.css', __FILE__)); 

}


// add support tinymce

add_action('init', 'rvyv_responsive_video_tinymce_init');

function rvyv_responsive_video_tinymce_init() {
	add_filter("mce_external_plugins", "rvyv_responsive_video_register_tinymce"); 
	add_filter('mce_buttons', 'rvyv_responsive_video_tinymce_button');
}

// register tinymce

function rvyv_responsive_video_register_tinymce($plugin_array) {
	$plugin_array['rvyv_video_responsive'] = plugin_dir_url( __FILE__ ) . 'js/tinymce-buttons.js';
	return $plugin_array;
}


function rvyv_responsive_video_tinymce_button($buttons) {
$buttons[] = "rvyv_video_responsive";
	return $buttons ;
}


// style tinymce editor

function rvyv_responsive_video_editor_style() {
    wp_enqueue_style('rvyv-responsive-video-editor-style', plugins_url('editor-style.css', __FILE__));
}
add_action('admin_enqueue_scripts', 'rvyv_responsive_video_editor_style');
add_action('login_enqueue_scripts', 'rvyv_responsive_video_editor_style');








?>