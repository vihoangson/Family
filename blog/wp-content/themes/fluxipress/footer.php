	</div><?php /* #main */ ?>
	
	<?php
		$displayFooter = (bool) get_theme_mod('fluxipress_display_footer', true);
		if(!is_single() || $displayFooter) :
	?>
	<div id="footer" class="wrap">
		<?php if(!is_404()) get_sidebar('footer'); ?>
	</div>
	<?php endif; ?>
	
	<?php /* Keep the theme attribution to share a little love. If you want. No pressure! */ ?>
	<small class="themeinfo"><?php echo __('Powered by WordPress', 'fluxipress'); ?> | <a href="http://www.netzhautmassage.de/fluxipress" title="<?php echo __('Fluxipress Theme', 'fluxipress'); ?>" target="_blank"><?php echo __('Fluxipress Theme', 'fluxipress'); ?></a></small>
	
</div><?php /* #page */ ?>
</div><?php /* #page-wrap */ ?>


<?php wp_footer(); ?>
</body>
</html>