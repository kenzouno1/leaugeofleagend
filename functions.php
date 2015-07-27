<?php
	 function wz_seo()
	 {
		  $html = '';
		  $render_seo_desc = array(
		   'data' => rs::getOption('seo_description'),
		   'default' => get_bloginfo("name")
		  );
		  $render_seo_key = array(
		   'data' => rs::getOption('seo_keywords'),
		   'default' => get_bloginfo("name")
		  );
		  $render_seo_author = array(
		   'data' => rs::getOption('seo_author'),
		   'default' => get_bloginfo("name")
		  );
		  $render_seo_favicon = array(
		   'data' => rs::getOption('seo_favicon'),
		   'default' => get_bloginfo("template_directory").'/favicon.ico'
		  );
		  
		  // Render HTML
		  $html .= "\n";
		  $html .= '<!-- Good meta tags for SEO -->';
		  $html .= "\n";
		  $html .= '<meta name="description" content="'.wz_render($render_seo_desc).'" />';
		  $html .= "\n";
		  $html .= '<meta name="keywords" content="'.wz_render($render_seo_key).'" />';
		  $html .= "\n";
		  $html .= '<meta name="author" content="'.wz_render($render_seo_author).'" />';
		  $html .= "\n";
		  $html .= "\n";
		  $html .= '<!-- Favicon -->';
		  $html .= "\n";
		  $html .= '<link rel="shortcut icon" type="image/x-icon" href="'.wz_render($render_seo_favicon).'" />';
		  if (is_numeric( wz_render($render_seo_favicon) )) {
		   $favicon = wp_get_attachment_image_src( wz_render($render_seo_favicon), 'full' );
		   $favicon = $favicon[0];
		   $ext = pathinfo($favicon, PATHINFO_EXTENSION);
		   
		   if($ext == 'jpg'){
			$html .= '<link rel="icon" type="image/jpeg" href="'.$favicon.'" />';
		   }elseif($ext == 'png'){
			$html .= '<link rel="icon" type="image/png" href="'.$favicon.'" />';
		   }elseif($ext == 'gif'){
			$html .= '<link rel="icon" type="image/gif" href="'.$favicon.'" />';
		   }else{
			$html .= '<link rel="shortcut icon" type="image/x-icon" href="'.$favicon.'" />';
		   }
		   
		  }else{
			$favicon = wz_render($render_seo_favicon);
		  }
		  echo $html;
	 }
	
	// --------------------------------------------------------------------
	/**
	* Description: Render data use for WordPress
	* Author: Write by ANHLE
	* Use:
	$render_data = array(
		'data' => get data,
		'default' => data default
	);
	echo wz_render($render_data);
	*/
	function wz_render($data)
	{

			if (array_key_exists('type', $data)) {
				$type = $data['type'];
				switch($type){
					case 'tel':
							if($data['data']){
								$render = 'tel:'.str_replace('.', '', $data['data']);
							}else{
								$render = 'tel:'.str_replace('.', '', $data['default']);
							}
						break;
					case 'email':
							if($data['data']){
								$render = 'mailto:'.strtolower($data['data']);
							}else{
								$render = 'mailto:'.strtolower($data['default']);
							}
						break;
					case 'link':
							if($data['link']){
								$render = '<a href="'.str_replace(array(' '), '', $data['link']).'">'.$data['data'].'</a>';
							}else{
								$render = $data['data'];
							}
						break;
					case 'repeater':
							if($data['data']){


							
								$string = $data['render'];
								foreach($data['data'] as $key => $val){
									$pattern = '\[(\[?)(render)(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*+(?:\[(?!\/\2\])[^\[]*+)*+)\[\/\2\])?)(\]?)';		
									
									echo preg_replace_callback('/'.$pattern.'/s', function($matches) use (&$val) {
										$data = trim($matches[3]);
										
										if(is_numeric($val[$data])){
											$v_img = wp_get_attachment_image_src( $val[$data], 'full' );
											$v_img = $v_img[0];
										}else{
											$v_img = $val[$data];
										}

										return $v_img;
									}, $string);
		
								}
							}else{
								$render = $data['default'];
							}
						break;
					default:
							if($data['data']){
								$render = $data['data'];
							}else{
								$render = $data['default'];
							}
						break;
				}
			}else{
				if($data['data']){
					$render = $data['data'];
				}else{
					$render = $data['default'];
				}
				
			}

		return $render;
	}
	
	/**
	* Cho phép người dùng tùy chỉnh code trong thẻ <head>
	*/
	function wz_head()
	{
		global $RS;
		$google_analytics = rs::getOption('seo_ga_group');
		if($google_analytics['seo_google_analytics_option'] == 'header'){
			echo $google_analytics['seo_google_analytics'];
		}
	}
	/**
	* Cho phép người dùng tùy chỉnh code trên thẻ </body>
	*/
	function wz_footer()
	{
		global $RS;
		$google_analytics = rs::getOption('seo_ga_group');
		if($google_analytics['seo_google_analytics_option'] == 'footer'){
			echo $google_analytics['seo_google_analytics'];
		}
	}
 // --------------------------------------------------------------------

 /**
 * Cắt nội dung, cắt nội dung theo số ký tự
 */
 function wz_excerpt($content, $num){        
            $limit = $num - 1 ;
            $str_tmp = '';
            $arrstr = explode(" ", $content);
            if ( count($arrstr) <= $num ) {
                if (strlen($content)>(9*$num))
                    return mb_substr($content,0,(9*$num), 'UTF-8')."...";
                else
                    return $content; 
            }
            if (!empty($arrstr))
            {
                for ( $j=0; $j< count($arrstr) ; $j++)
                {
                    $str_tmp .= " " . $arrstr[$j];
                    if ($j == $limit)
                    {  break; }
                }
            }

            if (strlen($str_tmp)>9*$num)
            {
    return mb_substr($str_tmp, 0, 9*$num, 'UTF-8')." ...";
            }
            $c = trim(strip_tags($str_tmp."."));

   return utf8_decode($c); 

    }
	
	/**
	* Description: Convert date time
	* Author: Write by ANHLE
	* Use: <title><?php echo wz_date($str, 'format');?></title>
	*/
	function wz_date( $str, $format = null)
	{
		if($format){
			$timestamp = strtotime($str);
			$str = gmdate($format, $timestamp );
		}

		return $str;
	}
	
	
	
	/* Hiển thị thumbnail post */
 function wz_thumbnail_posts($post, $default = null, $size = null)
 {
    $thumb_src =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
    if($thumb_src){
		$thumb_src = $thumb_src[0];
    }else{
		if($default){
			$pos = strpos($default, 'http');
			if ($pos === false) {
				$thumb_src = get_bloginfo ('template_directory').$default;
			} else {
				$thumb_src = $default;
			}
			
		}else{
			$thumb_src = wz_thumbail_content($post->post_content, $size);
		}
    }
	
	if($size){
		$width_height = explode('x', $size);

			$width = array(
				'width' => $width_height[0],
				'height' => $width_height[1]
			);
			if($width_height[0]==0){
				$width = array(
					'height' => $width_height[1]
				);
			}
			if($width_height[1]==0){
				$width = array(
					'width' => $width_height[0]
				);
			}
		$thumb_src = bfi_thumb($thumb_src,$width);
	}
    return $thumb_src;
 }
 /**
 * Cho phép lấy ảnh đầu tiên của bài viết.
 */
 function wz_thumbail_content($post_content, $format = null) {
   $first_img = '';
   ob_start();
   ob_end_clean();
   $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post_content, $matches);
   $first_img = $matches[1][0];

   if(empty($first_img)) {
  $first_img = "http://placehold.it/".$format."&text=No Thumbnails";
   }
   return $first_img;
 }
/* setup theme */
add_action('after_setup_theme', 'guzoski_theme_setup' );
add_action('widgets_init', 'add_sidebar');

function guzoski_theme_setup(){
	register_nav_menus(array(		
		'Footer Menu' => 'Main on Footer'
		
	));
	add_theme_support( 'post-thumbnails' );
	if ( function_exists( 'add_image_size' ) ) { 
	 add_image_size('thumbnaipage', 280, 240, true );
	}
	
	add_action('after_setup_theme', 'theme_setup');
	function theme_setup(){
		add_theme_support( 'post-thumbnails' );
	}
	include(TEMPLATEPATH.'/rslib/rslib.php');
	include(TEMPLATEPATH.'/include/theme-options.php');
	
	//Create widget
	include(TEMPLATEPATH.'/include/add-metabox.php');
	include(TEMPLATEPATH.'/include/team-post-type.php');
	include(TEMPLATEPATH.'/include/word-post-type.php');
	include(TEMPLATEPATH.'/include/template_ajax.php');
	//Register post type
	// Convert Images
	get_template_part('extras/BFI_Thumb');
}

function add_sidebar(){
	register_sidebar(
		array(
			 'id'=>'newsletter',
			 'name'=>'Newsletter',
			 'before_widget'=>'<div class="sidebar-newsletter">',
			 'after_widget'=>'</div>'
			 )
	);
	
	register_sidebar(
		array(
			 'id'=>'social-widgets',
			 'name'=>'Social Widgets',
			 'before_widget'=>'<div class="sidebar-newsletter">',
			 'after_widget'=>'</div>'
			 )
	);
 }



function twitter_photo($username, $limit = null)
{
	if(!$limit){
		$limit = 10;
	}
	include(TEMPLATEPATH.'/include/twitter/RestApi.php');
	/*
	* Config
	*/

	$consumerKey = 'B0EBizTmaxNENAIQHQfRZpvsy';
	$consumerSecret = '5OgbKrzMfJm4wgisII5QruilAFd1MTsBTudfDV2CUi5eAHXKnQ';
	$accessToken = '3186377000-SfFoHrNbG4wp5PqS13RS0byFAJ8M2osAiHiFa8E';
	$accessTokenSecret = 'YEJjW7ZYj62xoOufD6v8pfF1yWILKoxZzcApC9rBswA3l';


	/*
	* Create new RestApi instance
	* Consumer key and Consumer secret are required
	* Access Token and Access Token secret are required to use api as a user
	*/
	$twitter = new \TwitterPhp\RestApi($consumerKey,$consumerSecret,$accessToken,$accessTokenSecret);

	/*
	* Connect as application
	* https://dev.twitter.com/docs/auth/application-only-auth
	*/
	$connection = $twitter->connectAsApplication();
	
	$data_twitter_v2 = $connection->get('search/tweets', array('q'=>'from:'.$username.' filter:images','include_entities'=>1, 'count' => $limit));
	foreach($data_twitter_v2['statuses'] as $twitter){
		$media = $twitter['entities']['media'];
		$twitter_photo = $media[0];
		$media_url = $twitter_photo['media_url'];
		$expanded_url = $twitter_photo['expanded_url'];
		$data[] = array(
			'twitter_url' => $expanded_url,
			'twitter_photo' => $media_url
		);
	}
	return json_decode(json_encode($data));
}
function facebook_photo()
{
require_once(TEMPLATEPATH.'/include/facebook/src/Facebook/FacebookSession.php' );
require_once(TEMPLATEPATH.'/include/facebook/src/Facebook/FacebookRedirectLoginHelper.php' );
require_once(TEMPLATEPATH.'/include/facebook/src/Facebook/FacebookRequest.php' );
require_once(TEMPLATEPATH.'/include/facebook/src/Facebook/FacebookResponse.php' );
require_once(TEMPLATEPATH.'/include/facebook/src/Facebook/FacebookSDKException.php' );
require_once(TEMPLATEPATH.'/include/facebook/src/Facebook/FacebookRequestException.php' );
require_once(TEMPLATEPATH.'/include/facebook/src/Facebook/FacebookAuthorizationException.php' );
require_once(TEMPLATEPATH.'/include/facebook/src/Facebook/GraphObject.php' );

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
	// require_once(TEMPLATEPATH.'/include/facebook/autoload.php');
	// require_once(TEMPLATEPATH.'/include/facebook/src/Facebook/FacebookSession.php' );
	// Make sure to load the Facebook SDK for PHP via composer or manually

	// use Facebook\FacebookSession;
	// add other classes you plan to use, e.g.:
	// use Facebook\FacebookRequest;
	// use Facebook\GraphUser;
	// use Facebook\FacebookRequestException;

	// FacebookSession::setDefaultApplication('227315890780204', '11d0c5d07046179cae95c1f614900802');

	// // If you already have a valid access token:
	// $session = new FacebookSession('access-token');
	// echo 'a'.$session;

}
/* custom excerpt length */
function custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

/* Ajax project */
function is_ajax_project(){
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}
add_action('init', 'get_project');
function get_project() {
	if($_GET['get_project'] && is_ajax_project()){
		$number = $_GET['number_project'];
		$total = $_GET['total'];
		$check = true;
		$numbernew = $number + 9;
		if($numbernew > $total) {
			$check = false;
		}
		ob_start(); 
		 global $post;				
		 $args = array(
			'numberposts'	=> 9, 
			'post_type'		=>'word',
			'offset'		=> $number,
			'tax_query'		=> array()
		); 
		if($_GET['slug_term']) {
			$args['tax_query'][] = array(
				'taxonomy' => 'words',
				'field' => 'slug',
				'terms' => $_GET['slug_term']
			);
		}
		 $posts=get_posts($args);
		 foreach($posts as $key=>$post) : setup_postdata($post);
		 $key++;
		?>
		<div class="box-project <?php if($key%3==0) echo'no-margin';?>">
			<img class="expand" rel="lightbox[gallery-<?php echo $post->ID;?>]" src="<?php echo bfi_thumb(wp_get_attachment_url(get_post_thumbnail_id($post->ID)), array('width' => 434,'height' => 348 )); ?>" alt="" />
			<div class="text-project">
				<h3><a href=""><?php the_title();?></a></h3>
				<a href="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID));?>" class="expand" rel="lightbox[gallery-<?php echo $post->ID;?>]">VIEW MORE</a>
				<?php
					$gallerys = rs::getField('gallery', $post->ID);
					if($gallerys){
						foreach($gallerys as $key => $value){
							if(get_post_thumbnail_id($post->ID) != $value){
							?>
							<a href="<?php echo wp_get_attachment_image_src($value,'full')[0];?>" class="expand" rel="lightbox[gallery-<?php echo $post->ID;?>]"></a>
							<?php	}
						}
					}
				?>
			</div>
		</div>
		<?php endforeach; wp_reset_postdata(); ?>
		<div class="clear"></div>
		<?php 
		$list_project = ob_get_clean();
		$array_project = array($list_project,$check);
		echo json_encode($array_project);
		exit;
	}
}
