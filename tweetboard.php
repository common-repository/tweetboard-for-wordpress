<?php
/**
 * @package Tweetboard for Wordpress
 * @author Flemming Mahler
 * @version 0.0.1
 */
/*
Plugin Name: Tweetboard for Wordpress
Plugin URI: http://mahler.io/tweetbard4wp
Description: A basic plugin to integrate tweetboard into Wordpress. 
Before enabling the plugin , please visit http://tweetboard.com/alpha/# and apply for your Tweetboard request
Author: Flemming Mahler 
Version: 0.0.1
Author URI: http://mahler.io/
*/


/* Frontend... */
function attach_tweetboard() {
	$twitterUsername = trim(get_option('tweetboard4wp-twitterUsername'));
	if ($twitterUsername) {
		$content = "\n".'<script src="http://tweetboard.com/'.$twitterUsername.'/tb.js" type="text/javascript"></script>'."\n";;
		echo $content;
	}
}

add_action('wp_footer', 'attach_tweetboard');

/* Backend  */
add_action('admin_menu', 'admin_menu_tweetboard');

function admin_menu_tweetboard () {
  add_options_page('Tweetboard options', 'Tweetboard', 8, 'tweetboard4wp', 'tweetboard4wp_options');
}

function tweetboard4wp_options() {
?>
  <div class="wrap">
	<h2><?php _e('Tweetboard4WordPress Options','Tweetboard4wp');?></h2>
	<form name="Tweetboard4wp" method="post" action="options.php">
		<?php wp_nonce_field('update-options'); ?>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="tweetboard4wp-twitterUsername" />
	    <table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="tweetboard4wp-twitterUsername"><?php _e('Twitter username','twitterUsername');?></label></th>
				<td><input name="tweetboard4wp-twitterUsername" type="text" id="tweetboard4wp-twitterUsername" class="code" 
				      value="<?php echo get_option('tweetboard4wp-twitterUsername') ?>" size="40" /><br /></td>
			</tr>
		</table>
		<p class="submit">
			<input type="submit" name="Submit" value="<?php _e('Save Changes', 'tweetboard4wp' ) ?>" />
		</p>
	</form>
<script type="text/javascript">
jQuery.ajax({type:"GET",url:"http://twitter.com/users/username_available",
		data:{username:'mahler'},
		dataType:"json",
		success:function(response){
			if (reponse.valid == 'false') { 
				alert('twitter username seems ok.');
			}
		}
		});
</script>

<h2>Are you  on tweetboard yet?</h2>
<p>
Before enabling the plugin , please visit <a href="http://tweetboard.com/alpha/#">http://tweetboard.com/alpha/#</a> and apply for your Tweetboard request.
</p>
</div>
<?php
}

?>
