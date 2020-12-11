<?php
/**
 Plugin Name:  check my color
 Plugin URI: https://color.toshidayurika.com
 Description: This plugin provides personal color check
 Version: 1.0
 Author: Yurika Toshoda
 Author URI: https://color.toshidayurika.com
 License: GPLv2 or later
 Text Domain: contraction
 
*/

//add_action ('wp_loaded', 'my_custom_redirect');
function my_custom_redirect() {
	var_dump('test0');
	if (!is_page('diagnosis')){
		var_dump('test1');
		return;
	}

	var_dump('test2');
	if (($_SESSION["ct"]) == 5){
		var_dump('test3');
		wp_redirect( 'http://192.168.0.62:8080/dia-result' );
		return;
	}
}     



add_action('init', 'color_session_start');
function color_session_start(){
	session_start();
}

/* Simple personal color check
 */
//	var_dump($atts['yes_no']);
//	error_log('test3');
function simple_check_my_color( $content ) {

	if (!is_page('diagnosis')){
		return $content;  
	}

	/*
	$wp_session["ct"] = 1;
	$wp_session["ct"] = $wp_session["ct"] + 1;
	var_dump($wp_session["ct"]);
	 */

	if (!isset($_SESSION["ct"])){
		'初回の訪問です。セッションを開始します。';
		$_SESSION["ct"] = 1;
		$_SESSION["ret"] = '';
		return $content;  
	}
	if (!isset($_GET['id']))  {
		$_SESSION["ct"] = 1;
		$_SESSION["ret"] = '';
		return $content;  
	}
	if (($_SESSION["ct"])==4){
		$content = str_replace('diagnosis/?id=0', 'dia-result',$content);
		$content = str_replace('diagnosis/?id=1', 'dia-result',$content);
	}

	$before_str = "diagnosis_01" ;

	$_SESSION["ct"] = $_SESSION["ct"] + 1;

	$after_str  = "diagnosis_0" . $_SESSION["ct"];

	$_SESSION["ret"] = $_SESSION["ret"] . $_GET['id'];
	var_dump($_SESSION["ret"]);

	$content = str_replace($before_str, $after_str, $content);
	return $content;  
}
add_filter( 'the_content','simple_check_my_color' );

/*
function simple_see_button( $atts, $content = null ) {
	$values = shortcode_atts( array(
		'url'           => get_the_permalink() . '?id=',
		'target'	=> '_blank',
	), 
	$atts );


	if($atts['yes_no'] == 'yes'){
		$yes_no = '1';
	}else{
		$yes_no = '0';
	};
     
	$next_addr=$values['url'] . 
		$_GET['id'] . 
		$yes_no; 

	return '<a href="'. 
		esc_url( $next_addr ) .
		'"  target="'. 
		esc_url( $values['target'] ) .
		'" class="button">' . 
		$atts['yes_no'] . '</a>';
    
 
}
add_shortcode( 'simple_see_button', 'simple_see_button' );
*/


?>
