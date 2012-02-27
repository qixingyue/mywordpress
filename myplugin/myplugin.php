<?php
/*
 Plugin Name: MyPlugin
 Plugin URI: http://istrone.com/
 Description: this plugin is only a test plugin. To test I konw how to write a simple plugin.
 Version: 2.5.3
 Author: istrone
 Author URI: http://istrone.com
 License: GPLv2 or later
 */

/*
 this plugin is only a test plugin. To test I konw how to write a simple plugin.
 */

/**
 * 以此来控制你的wordpress插件对wordpress版本的要求
 * 查看filters中的default-filters.php   wp-includes/deault-filters.php
 */
global $wp_version;
if(version_compare($wp_version, "2.4","<")){
	exit('Your wordpress is too low!');
}

add_filter('the_content', 'myplugin_thecontent');
function myplugin_thecontent($content){
	if(is_single()){
	return $content.'<div id="myPluginComment" style="border: 1px dotted black;text-align: right; background-color: #EEEEEE;padding-right:80px;padding-top:8px;height:30px;">注：转载请注明文章来源：<a href=\'http://istrone.com\'>流影部落阁</a></div>';
	} else {
	   return $content;
        }
}

add_action('wp_head','myplugin_head');
function myplugin_head(){
	//在head的尾部输出信息
	if(is_single())
	    echo '<script type="text/javascript" src="'.get_bloginfo('wpurl').'/wp-content/plugins/myplugin/test.js'.'"></script>';
}



add_action('wp_footer','add_footer');

function add_footer($str){
	
	echo '<div class="footercontent">';
	echo 'Copyright © 2011, 2012 by <a href="http://istrone.com">istrone</a><font color="red">京ICP备11038298号-1</font><br>';
	echo '<script src="http://s84.cnzz.com/stat.php?id=3485916&web_id=3485916&show=pic" language="JavaScript"></script>';
	echo '<!--[if IE 6]>
		<script type="text/javascript" src="http://letskillie6.googlecode.com/svn/trunk/letskillie6.zh_CN.pack.js"></script>
		<![endif]-->';
	echo '</div>';	
}



/**
 * 是否应该用汉语选择
 */
function isChinese() {
	
	$langage = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
	return substr($langage, 0,5) == 'zh-cn';
	
}

/**
 * 注册插件
 */
function myplugin_register_widgets() {
	register_widget( 'MyWidget' );
}

add_action( 'widgets_init', 'myplugin_register_widgets' );

/**
 * 实现一个小区域
 * @author istrone
 *
 */
class MyWidget extends  WP_Widget {
	
	public $name = 'GoogleFY';
	
	public function __construct() {
		parent::__construct(false,'MY GoogleFY',array('description'=>'my google translate, to use the accept language to make it hidden when in chinese!'));
	}
	
	/**
	 * 输出函数
	 * (non-PHPdoc)
	 * @see WP_Widget::widget()
	 */
	public 	function widget($args, $instance) { 
		$fy = <<<EOT
<div id="google_translate_element"></div><script>
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'zh-CN',
    multilanguagePage: true
  }, 'google_translate_element');
}
</script><script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>	
EOT;
		if(!isChinese()) {
			echo $fy;
		}	
	}
	
	
	
}

