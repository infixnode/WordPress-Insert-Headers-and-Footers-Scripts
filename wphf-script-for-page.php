<?php


add_action( 'add_meta_boxes', 'infixnode_create_custom_meta_box_page', 10, 2 );

function infixnode_create_custom_meta_box_page( $post_type, $post ) {
  add_meta_box( 
      'infixnode-custom-meta-box-id-page', // metabox ID
  
  __( 'Scripts for this Page', 'infixnode-custom-meta-box-page' ), // title  & textdomain
  
  'infixnode_custom_meta_box_content_page', // callback function
  
  'page', // post type or post types in array
  
  'normal', // position (normal, side, advanced)
  
  'high' // priority (default, low, high, core)
  ); 
}
//add_action( 'add_meta_boxes', 'infixnode_create_custom_meta_box' );


add_action( 'admin_enqueue_scripts', 'codemirror_test_que_code_editor_page' );
function codemirror_test_que_code_editor_page() {
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
		
		global $setting_page; /* Global Variable Declartion */

		wp_add_inline_script( 'code-editor', sprintf( 'jQuery( function() { wp.codeEditor.initialize( "metabox-content-page-header", %s ); } );', wp_json_encode( $setting_page ) ) );
		wp_add_inline_script( 'code-editor', sprintf( 'jQuery( function() { wp.codeEditor.initialize( "metabox-content-page-body", %s ); } );', wp_json_encode( $setting_page ) ) );
		wp_add_inline_script( 'code-editor', sprintf( 'jQuery( function() { wp.codeEditor.initialize( "metabox-content-page-footer", %s ); } );', wp_json_encode( $setting_page ) ) );
}

		
add_filter('use_block_editor_for_post_type', '__return_false');


/**
 *  it is a callback function which actually displays the content of the meta box
 */
function infixnode_custom_meta_box_content_page( $post ) {
  ?>
  <p>
  <lable for="metabox-content-page-header"><strong>Header Script</strong></lable>
  <textarea id="metabox-content-page-header" class="widefat" rows="8" name="metabox-content-page-header"><?php echo esc_textarea( get_post_meta( $post->ID, 'metabox-content-page-header', true )); ?></textarea>
  
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
   <textarea id="metabox-content-page-body" class="widefat" rows="8" name="metabox-content-page-body"><?php echo esc_textarea( get_post_meta( $post->ID, 'metabox-content-page-body', true )); ?></textarea>
  
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
	<textarea id="metabox-content-page-footer" class="widefat" rows="8" name="metabox-content-page-footer"><?php echo esc_textarea( get_post_meta( $post->ID, 'metabox-content-page-footer', true )); ?></textarea>
  
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


function infixnode_save_custom_meta_box_content_page( $post_id ) {
    

  //$textbox_content_page = $_POST['metabox-content-page'];
  
  $textbox_content_page_header= isset( $_POST['metabox-content-page-header'] )? $_POST['metabox-content-page-header']: false;
  $textbox_content_page_body= isset( $_POST['metabox-content-page-body'] )? $_POST['metabox-content-page-body']: false;
  $textbox_content_page_footer= isset( $_POST['metabox-content-page-footer'] )? $_POST['metabox-content-page-footer']: false;


  update_post_meta( $post_id, 'metabox-content-page-header', $textbox_content_page_header );
  update_post_meta( $post_id, 'metabox-content-page-body', $textbox_content_page_body );
  update_post_meta( $post_id, 'metabox-content-page-footer', $textbox_content_page_footer );

  
}


add_action( 'save_post', 'infixnode_save_custom_meta_box_content_page' );



function generateSchemaBoxPageHeader(){
    if (is_page()) 
    {
        global $wp_query;
        
      //echo ('<script>');
      
      $str_page_header = esc_textarea( get_post_meta( get_the_ID(), 'metabox-content-page-header', true ) );
      echo html_entity_decode($str_page_header);
      echo ("\n");
      
      //wp_reset_query();
      //wp_reset_postdata();
    }
  }

add_action( 'wp_head', 'generateSchemaBoxPageHeader');


function generateSchemaBoxPageBody(){
    if (is_page()) 
    {
        global $wp_query;
        
      //echo ('<script>');
      
      $str_page_body = esc_textarea( get_post_meta( get_the_ID(), 'metabox-content-page-body', true ) );
      echo html_entity_decode($str_page_body);
      echo ("\n");
      
      //wp_reset_query();
      //wp_reset_postdata();
    }
  }

add_action( 'wp_body_open', 'generateSchemaBoxPageBody');

function generateSchemaBoxPageFooter(){
    if (is_page()) 
    {
        global $wp_query;
        
      //echo ('<script>');
      
      $str_page_footer = esc_textarea( get_post_meta( get_the_ID(), 'metabox-content-page-footer', true ) );
      echo html_entity_decode($str_page_footer);
      echo ("\n");
      
      //wp_reset_query();
      //wp_reset_postdata();
    }
  }

add_action( 'wp_footer', 'generateSchemaBoxPageFooter');