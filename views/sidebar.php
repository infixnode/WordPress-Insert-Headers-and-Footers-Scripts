<?php
/**
 * Donations Sidebar
 */
?>
<!-- Improve Your Site -->
<div class="postbox">
	<h3 class="hndle">
		<span><?php esc_html_e( 'Improve Your Site', 'infixnode-infixnode-insert-headers-and-footers' ); ?></span>
	</h3>

	<div class="inside">
		<p>
			<?php
			printf(
				/* translators: %s: Link to WPBeginner blog */
				esc_html__( 'Want to take your site to the next level? Check out our daily free WordPress tutorials on %s.', 'infixnode-insert-headers-and-footers' ),
				sprintf(
					'<a href="http://www.wpbeginner.com/?utm_source=wpadmin&utm_campaign=freeplugins" target="_blank">%s</a>',
					esc_html__( 'InfixNode blog', 'infixnode-insert-headers-and-footers' )
				)
			);
			?>
		</p>

		<p>
			<?php esc_html_e( 'Some of our popular guides:', 'infixnode-insert-headers-and-footers' ); ?>
		</p>

		<ul>
			<li>
				<a href="#" target="_blank">
					<?php esc_html_e( 'Speed Up WordPress', 'infixnode-insert-headers-and-footers' ); ?>
				</a>
			</li>
			<li>
				<a href="#" target="_blank">
					<?php esc_html_e( 'Improve WordPress Security', 'infixnode-insert-headers-and-footers' ); ?>
				</a>
			</li>
			<li>
				<a href="#" target="_blank">
					<?php esc_html_e( 'Boost Your WordPress SEO', 'infixnode-insert-headers-and-footers' ); ?>
				</a>
			</li>
		</ul>

	</div>
</div>

<!-- Donate -->
<div class="postbox">
	<h3 class="hndle">
		<span><?php esc_html_e( 'Our WordPress Plugins', 'infixnode-insert-headers-and-footers' ); ?></span>
	</h3>
	<div class="inside">
		<p>
			<?php esc_html_e( 'Like this plugin? Check out our other WordPress plugins:', 'infixnode-insert-headers-and-footers' ); ?>
		</p>
		<p>
			<?php
			printf(
				'<a href="%1$s" target="_blank">%2$s</a> - %3$s',
				esc_url( 'https://infixnode.com/plugins/wp-add-snippet-lite/' ),
				esc_html__( 'WP Add Snippet', 'infixnode-insert-headers-and-footers' ),
				esc_html__( 'Add for specific snippet on Page, Post entire Website', 'infixnode-insert-headers-and-footers' )
			);
			?>
		</p>

	</div>
</div>
