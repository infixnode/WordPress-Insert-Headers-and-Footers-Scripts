<?php



add_action( 'add_meta_boxes', 'infixnode_create_custom_meta_box_post', 10, 2 );



function infixnode_create_custom_meta_box_post( $post_type, $post ) {
  add_meta_box( 
      'infixnode-custom-meta-box-id-post', // metabox ID
      
      __( 'Scripts for this Post', 'infixnode-custom-meta-box-post' ), // title  & textdomain
      
      'infixnode_custom_meta_box_content_post', // callback function
      
      'post', // post type or post types in array
      
      'normal', // position (normal, side, advanced)
      
      'high' // priority (default, low, high, core)
      
      );
}
//add_action( 'add_meta_boxes', 'infixnode_create_custom_meta_box' );


add_action( 'admin_enqueue_scripts', 'codemirror_test_que_code_editor_post' );
function codemirror_test_que_code_editor_post() {
	wp_enqueue_code_editor(array( 'type' => 'text/html', 'codemirror' => array( 'autoRefresh' => true ) ));
	//wp_add_inline_script( 'code-editor', '
//		jQuery( document ).ready( function() {
//		   wp.codeEditor.initialize( $( \'[id="metabox-content"]\' ) );
//		});'
//	);

	wp_enqueue_script('wp-theme-plugin-editor');
  wp_enqueue_style('wp-codemirror');
  $styles = '.CodeMirror{ border: 1px solid #ccd0d4; }';

		wp_add_inline_style( 'code-editor', $styles );
		
        global $setting_post; /* Global Variable Declartion */
        
		wp_add_inline_script( 'code-editor', sprintf( 'jQuery( function() { wp.codeEditor.initialize( "metabox-content-post-header", %s ); } );', wp_json_encode( $setting_post ) ) );
		wp_add_inline_script( 'code-editor', sprintf( 'jQuery( function() { wp.codeEditor.initialize( "metabox-content-post-body", %s ); } );', wp_json_encode( $setting_post ) ) );
		wp_add_inline_script( 'code-editor', sprintf( 'jQuery( function() { wp.codeEditor.initialize( "metabox-content-post-footer", %s ); } );', wp_json_encode( $setting_post ) ) );
}

		
add_filter('use_block_editor_for_post_type', '__return_false');


/**
 *  Custom Meta Box content
 */
function infixnode_custom_meta_box_content_post( $post ) {
    
  ?>
  <p>
  <lable for="metabox-content-post-header"><strong>Header Script</strong></lable>
  <textarea id="metabox-content-post-header" class="widefat" rows="8" name="metabox-content-post-header"><?php echo esc_textarea( get_post_meta( $post->ID, 'metabox-content-post-header', true )); ?></textarea>
  
  <?php
  
  printf(
										/* translators: %s: The `<head>` tag */
										esc_html__( 'These scripts will be printed in the %s section.', '' ),
										'<code>&lt;head&gt;</code>'
									);
   ?>
   </p>
   <p>
  <lable for="metabox-content-post-body"><strong>Body Script</strong></lable>
  <textarea id="metabox-content-post-body" class="widefat" rows="8" name="metabox-content-post-body"><?php echo esc_textarea( get_post_meta( $post->ID, 'metabox-content-post-body', true )); ?></textarea>
  
  <?php
  
  printf(
										/* translators: %s: The `<body>` tag */
										esc_html__( 'These scripts will be printed in the %s section.', '' ),
										'<code>&lt;body&gt;</code>'
									);
   ?>
   </p>
   <p>
   <lable for="metabox-content-post-footer"><strong>Footer Script</strong></lable>
	<textarea id="metabox-content-post-footer" class="widefat" rows="8" name="metabox-content-post-footer"><?php echo esc_textarea( get_post_meta( $post->ID, 'metabox-content-post-footer', true )); ?></textarea>
  
  <?php
  
  printf(
										/* translators: %s: The `<footer>` tag */
										esc_html__( 'These scripts will be printed in the %s section.', '' ),
										'<code>&lt;footer&gt;</code>'
									);
	?>
	</p>
	<?php								
}

/**
    *  Save textbox content
  */
function infixnode_save_custom_meta_box_content_post( $post_id ) {
    

  //$textbox_content_post = $_POST['metabox-content-post'];
  
  $textbox_content_post_header= isset( $_POST['metabox-content-post-header'] )? $_POST['metabox-content-post-header']: false;
  $textbox_content_post_body= isset( $_POST['metabox-content-post-body'] )? $_POST['metabox-content-post-body']: false;
  $textbox_content_post_footer= isset( $_POST['metabox-content-post-footer'] )? $_POST['metabox-content-post-footer']: false;

  update_post_meta( $post_id, 'metabox-content-post-header', $textbox_content_post_header );
  update_post_meta( $post_id, 'metabox-content-post-body', $textbox_content_post_body );
  update_post_meta( $post_id, 'metabox-content-post-footer', $textbox_content_post_footer );

  
}

add_action( 'save_post', 'infixnode_save_custom_meta_box_content_post' );


function generateSchemaBoxPostHeader(){
    if (is_single()) {
      global $wp_query;
      if (have_posts()) {
        while (have_posts()) {
          the_post();
          // no idea if your plugin needs anything else here
        }
      }
      //echo ('<script>');
      
      $str_post_header = esc_textarea( get_post_meta( get_the_ID(), 'metabox-content-post-header', true ) );
      echo html_entity_decode($str_post_header);
      echo ("\n");
       
      //wp_reset_query();
      //wp_reset_postdata();
    }
  }

add_action( 'wp_head', 'generateSchemaBoxPostHeader');

function generateSchemaBoxPostBody(){
    if (is_single()) {
      global $wp_query;
      if (have_posts()) {
        while (have_posts()) {
          the_post();
          // no idea if your plugin needs anything else here
        }
      }
      //echo ('<script>');
      
      $str_post_body = esc_textarea( get_post_meta( get_the_ID(), 'metabox-content-post-body', true ) );
      echo html_entity_decode($str_post_body);
      echo ("\n");
       
      //wp_reset_query();
      //wp_reset_postdata();
    }
  }

add_action( 'wp_head', 'generateSchemaBoxPostBody');


function generateSchemaBoxPostFooter(){
    if (is_single()) {
      global $wp_query;
      if (have_posts()) {
        while (have_posts()) {
          the_post();
          // no idea if your plugin needs anything else here
        }
      }
      //echo ('<script>');
      
      $str_post_footer = esc_textarea( get_post_meta( get_the_ID(), 'metabox-content-post-footer', true ) );
      echo html_entity_decode($str_post_footer);
      echo ("\n");
       
      //wp_reset_query();
      //wp_reset_postdata();
    }
  }

add_action( 'wp_body_open', 'generateSchemaBoxPostFooter');
