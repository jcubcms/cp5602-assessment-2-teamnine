        <footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
				<p class="white-text">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer") ) : ?>
<?php endif;?>	  
				</p>
              </div>
              <div class="col l4 offset-l2 s12">
				  <ul class="white-text">
					  <?php wp_nav_menu(array('theme_location' => 'footer', 'menu_class' => 'right'));?>
				  </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2019 Copyright
            </div>
          </div>
        </footer>
    <?php wp_footer(); ?> 

  </body>
</html>
