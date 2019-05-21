<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('greek_theme_config')) {

    class greek_theme_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (true == Redux_Helpers::isTheme(__FILE__)) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }
            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => esc_html__('Section via hook', 'greek'),
                'desc' => esc_html__('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'greek'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
			);

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (($sample_patterns_file = readdir($sample_patterns_dir)) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(esc_html__('Customize &#8220;%s&#8221;', 'greek'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'greek'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'greek'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(esc_html__('By %s', 'greek'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(esc_html__('Version %s', 'greek'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . esc_html__('Tags', 'greek') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . wp_kses(__('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.','greek'), array('a' => array('href' => array(),'title' => array()))) . '</p>', esc_html__('http://codex.wordpress.org/Child_Themes', 'greek'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(get_template_directory(). '/info-html.html')) {
                Redux_Functions::initWpFilesystem();
                
                global $wp_filesystem;

                $sampleHTML = $wp_filesystem->get_contents(get_template_directory(). '/info-html.html');
            }
	
            // General
            $this->sections[] = array(
                'title'     => esc_html__('General', 'greek'),
                'desc'      => esc_html__('General theme options', 'greek'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(

                    array(
                        'id'        => 'logo_main',
                        'type'      => 'media',
                        'title'     => esc_html__('Logo', 'greek'),
                        'compiler'  => 'true',
                        'mode'      => false,
                        'desc'      => esc_html__('Upload logo here.', 'greek'),
					),
					array(
                        'id'        => 'logo_text',
                        'type'      => 'text',
                        'title'     => esc_html__('Logo Text', 'greek'),
                        'default'   => ''
					),
					array(
                        'id'        => 'logo_erorr',
                        'type'      => 'media',
                        'title'     => esc_html__('Logo for error 404 page', 'greek'),
                        'compiler'  => 'true',
                        'mode'      => false,
					),
					array(
                        'id'        => 'opt-favicon',
                        'type'      => 'media',
                        'title'     => esc_html__('Favicon', 'greek'),
                        'compiler'  => 'true',
                        'mode'      => false,
                        'desc'      => esc_html__('Upload favicon here.', 'greek'),
					),
					
					array(
                        'id'        => 'greek_loading',
                        'type'      => 'switch',
                        'title'     => esc_html__('Show Loading Page', 'greek'),
						'default'   => false,
					),
				),
			);
			// Background
            $this->sections[] = array(
                'title'     => esc_html__('Background', 'greek'),
                'desc'      => esc_html__('Use this section to upload background images, select background color', 'greek'),
                'icon'      => 'el-icon-picture',
                'fields'    => array(
					
					array(
                        'id'        => 'background_opt',
                        'type'      => 'background',
                        'output'    => array('body'),
                        'title'     => esc_html__('Body Background', 'greek'),
                        'subtitle'  => esc_html__('Body background with image, color. Only work with box layout', 'greek'),
						'default'   => '#efefef',
					),
				),
			);
			// Colors
            $this->sections[] = array(
                'title'     => esc_html__('Presets', 'greek'),
                'desc'      => esc_html__('Presets options', 'greek'),
                'icon'      => 'el-icon-tint',
			);
			$this->sections[] = array(
                'title'     	=> esc_html__('Presets1', 'greek'),
                'desc'     		=> esc_html__('Presets1 options', 'greek'),
                'icon'      	=> 'el-icon-tint',
				'subsection' 	=> true,
                'fields'    	=> array(
					array(
                        'id'        	=> 'primary_color',
                        'type'      	=> 'color',
                        'title'     	=> esc_html__('Primary Color', 'greek'),
                        'subtitle'  	=> esc_html__('Pick a color for primary color (default: #ec5355).', 'greek'),
						'transparent' 	=> false,
                        'default'   	=> '#ec5355',
                        'validate'  	=> 'color',
					),
					array(
                        'id'        	=> 'rate_color',
                        'type'      	=> 'color',
                        //'output'    	=> array(),
                        'title'     	=> esc_html__('Rating Star Color', 'greek'),
                        'subtitle'  	=> esc_html__('Pick a color for star of rating (default: #eeee22).', 'greek'),
						'transparent' 	=> false,
                        'default'  		=> '#eeee22',
                        'validate'  	=> 'color',
					),
				),
			);
			$this->sections[] = array(
                'title'     	=> esc_html__('Presets2', 'greek'),
                'desc'      	=> esc_html__('Presets2 options', 'greek'),
                'icon'      	=> 'el-icon-tint',
				'subsection' 	=> true,
                'fields'    	=> array(
					array(
                        'id'        	=> 'primary2_color',
                        'type'      	=> 'color',
                        'title'     	=> esc_html__('Primary Color', 'greek'),
                        'subtitle'  	=> esc_html__('Pick a color for primary color (default: #189f2b).', 'greek'),
						'transparent' 	=> false,
                        'default'   	=> '#189f2b',
                        'validate'  	=> 'color',
					),
					array(
                        'id'        	=> 'rate2_color',
                        'type'      	=> 'color',
                        //'output'    	=> array(),
                        'title'     	=> esc_html__('Rating Star Color', 'greek'),
                        'subtitle'  	=> esc_html__('Pick a color for star of rating (default: #eeee22).', 'greek'),
						'transparent' 	=> false,
                        'default'   	=> '#eeee22',
                        'validate'  	=> 'color',
					),
				),
			);
			$this->sections[] = array(
                'title'     	=> esc_html__('Presets3', 'greek'),
                'desc'      	=> esc_html__('Presets3 options', 'greek'),
                'icon'      	=> 'el-icon-tint',
				'subsection' 	=> true,
                'fields'    	=> array(
					array(
                        'id'        	=> 'primary3_color',
                        'type'      	=> 'color',
                        'title'     	=> esc_html__('Primary Color', 'greek'),
                        'subtitle'  	=> esc_html__('Pick a color for primary color (default: #c30303).', 'greek'),
						'transparent' 	=> false,
                        'default'   	=> '#c30303',
                        'validate'  	=> 'color',
					),
					array(
                        'id'        	=> 'rate3_color',
                        'type'      	=> 'color',
                        //'output'    	=> array(),
                        'title'     	=> esc_html__('Rating Star Color', 'greek'),
                        'subtitle'  	=> esc_html__('Pick a color for star of rating (default: #eeee22).', 'greek'),
						'transparent' 	=> false,
                        'default'   	=> '#eeee22',
                        'validate'  	=> 'color',
					),
				),
			);
			$this->sections[] = array(
                'title'     	=> esc_html__('Presets4', 'greek'),
                'desc'      	=> esc_html__('Presets4 options', 'greek'),
                'icon'      	=> 'el-icon-tint',
				'subsection' 	=> true,
                'fields'    	=> array(
					array(
                        'id'        	=> 'primary4_color',
                        'type'      	=> 'color',
                        'title'     	=> esc_html__('Primary Color', 'greek'),
                        'subtitle'  	=> esc_html__('Pick a color for primary color (default: #0bd9a9).', 'greek'),
						'transparent' 	=> false,
                        'default'   	=> '#0bd9a9',
                        'validate'  	=> 'color',
					),
					array(
                        'id'        	=> 'rate4_color',
                        'type'      	=> 'color',
                        //'output'    	=> array(),
                        'title'     	=> esc_html__('Rating Star Color', 'greek'),
                        'subtitle'  	=> esc_html__('Pick a color for star of rating (default: #eeee22).', 'greek'),
						'transparent' 	=> false,
                        'default'   	=> '#eeee22',
                        'validate'  	=> 'color',
					),
				),
			);
			
			//Header
			$this->sections[] = array(
                'title'     => esc_html__('Header', 'greek'),
                'desc'      => esc_html__('Header options', 'greek'),
                'icon'      => 'el-icon-tasks',
                'fields'    => array(
					array(
                        'id'        		=> 'topbar_style',
                        'type'      		=> 'select',
                        'title'     		=> esc_html__('Top bar style', 'greek'),
						'subtitle'     		=> esc_html__('Only for header default', 'greek'),
                        'customizer_only'   => true,

                        'options'   	=> array(
                            'tb-trans' 	=> 'Transparent',
                            'tb-white' 	=> 'White',
							'tb-black' 	=> 'Black',
                    ),
                        'default'   => 'tb-trans'
					),
					array(
                        'id'        => 'mini_cart_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Mini cart title', 'greek'),
                        'default'   => 'Shopping Cart'
					),
					array(
                        'id'        => 'title_mobile_menu',
                        'type'      => 'text',
                        'title'     => esc_html__('Title Mobile Menu', 'greek'),
                        'default'   => 'Menu'
					),
				),
			);
			//Bottom 
			$this->sections[] = array(
				'title'     => esc_html__('Bottom', 'greek'),
				'des'       => esc_html__('Bottom options', 'greek'),
				'icon'      => 'el-icon-cog',
				'fields'    => array(
					array(
						'id'       => 'menu-link',
						'type'     => 'select',
						'data'     => 'menus',
						'title'    => esc_html__('Bottom Menu Link', 'greek'),
						'subtitle' => esc_html__('Select a menu', 'greek'),
					),
				)
			);
			$this->sections[] = array(
				'icon'       => 'el-icon-website',
				'title'      => esc_html__('Social Icons', 'greek'),
				'subsection' => true,
				'fields'     => array(
					array(
                        'id'        => 'follow_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Follow Us title', 'greek'),
                        'default'   => 'Follow Us'
					),
					array(
						'id'       => 'ftsocial_icons',
						'type'     => 'sortable',
						'title'    => esc_html__('Footer social Icons', 'greek'),
						'subtitle' => esc_html__('Enter social links', 'greek'),
						'desc'     => esc_html__('Drag/drop to re-arrange', 'greek'),
						'mode'     => 'text',
						'options'  => array(
							'facebook'    => '',
							'twitter'     => '',
							'instagram'   => '',
							'tumblr'      => '',
							'pinterest'   => '',
							'google-plus' => '',
							'linkedin'    => '',
							'behance'     => '',
							'dribbble'    => '',
							'youtube'     => '',
							'vimeo'       => '',
							'rss'         => '',
						),
						'default' => array(
						    'facebook'    => 'https://www.facebook.com/vinawebsolutions',
							'twitter'     => 'https://twitter.com/vnwebsolutions',
							'instagram'   => 'Instagram',
							'tumblr'      => 'Tumblr',
							'pinterest'   => 'Pinterest',
							'google-plus' => 'https://plus.google.com/+HieuJa/posts',
							'linkedin'    => 'Linkedin',
							'behance'     => 'Behance',
							'dribbble'    => 'Dribbble',
							'youtube'     => 'https://www.youtube.com/user/vinawebsolutions',
							'vimeo'       => 'Vimeo',
							'rss'         => 'RSS',
						),
					),
				)
			);
			
			//Footer
			$this->sections[] = array(
                'title'     => esc_html__('Footer', 'greek'),
                'desc'      => esc_html__('Footer options', 'greek'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(
					array(
                        'id'        => 'copyright_show',
                        'type'      => 'switch',
                        'title'     => esc_html__('Show Copyright', 'greek'),
						'default'   => true,
					),
					array(
                        'id'        => 'copyright-author',
                        'type'      => 'text',
                        'title'     => esc_html__('Copyright Author', 'greek'),
                        'default'   => 'VinaGecko.com'
					),
					array(
                        'id'        => 'copyright-link',
                        'type'      => 'text',
                        'title'     => esc_html__('Copyright Link', 'greek'),
                        'default'   => 'http://vinagecko.com'
					),
					array(
                        'id'        => 'footer_payment',
                        'type'      => 'media',
                        'title'     => esc_html__('Image Payment', 'greek'),
                        'compiler'  => 'true',
                        'mode'      => false,
                        'desc'      => esc_html__('Upload logo here.', 'greek'),
					),
				),
			);
			$this->sections[] = array(
				'icon'       => 'el-icon-website',
				'title'      => esc_html__('Popup Newsletter', 'greek'),
				'subsection' => true,
				'fields'     => array(
					array(
                        'id'        => 'newsletter_show',
                        'type'      => 'switch',
                        'title'     => esc_html__('Show Newsletter', 'greek'),
						'default'   => false,
					),
					array(
                        'id'        => 'newsletter_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Newsletter title', 'greek'),
                        'default'   => 'Get In Touch'
                  ),
					array(
						'id'       => 'newsletter_form',
						'type'     => 'text',
						'title'    => esc_html__('Newsletter form ID', 'greek'),
						'subtitle' => esc_html__('The form ID of MailPoet plugin.', 'greek'),
						'validate' => 'numeric',
						'msg'      => 'Please enter a form ID',
						'default'  => '2'
					),
				)
			);
			
			//Fonts
			$this->sections[] = array(
                'title'     => esc_html__('Fonts', 'greek'),
                'desc'      => esc_html__('Fonts options', 'greek'),
                'icon'      => 'el-icon-font',
                'fields'    => array(

                    array(
                        'id'            	=> 'bodyfont',
                        'type'          	=> 'typography',
                        'title'         	=> esc_html__('Body font', 'greek'),
                        //'compiler'      	=> true,  // Use if you want to hook in your own CSS compiler
                        'google'        	=> true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   	=> true,    // Select a backup non-google font in addition to a google font
                        //'font-style'    	=> false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        //'subsets'       	=> false, // Only appears if google is true and subsets not set to false
                        //'font-size'     	=> false,
                        //'line-height'   	=> false,
                        //'word-spacing'  	=> true,  // Defaults to false
                        //'letter-spacing'	=> true,  // Defaults to false
                        //'color'         	=> false,
                        //'preview'       	=> false, // Disable the previewer
                        'all_styles'    	=> true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        	=> array('body'), // An array of CSS selectors to apply this font style to dynamically
                        //'compiler'      	=> array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         	=> 'px', // Defaults to px
                        'subtitle'      	=> esc_html__('Main body font.', 'greek'),
                        'default'       	=> array(
                            'color'         => '#909090',
                            'font-weight'   => '400',
                            'font-family'   => 'Arial, Helvetica, sans-serif',
                            'google'        => true,
                            'font-size'     => '13px',
                            'line-height'   => '24px'),
					),
					array(
                        'id'            	=> 'headingfont',
                        'type'          	=> 'typography',
                        'title'         	=> esc_html__('Heading font', 'greek'),
                        //'compiler'      	=> true,  // Use if you want to hook in your own CSS compiler
                        'google'        	=> true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   	=> true,    // Select a backup non-google font in addition to a google font
                        //'font-style'    	=> false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        //'subsets'       	=> false, // Only appears if google is true and subsets not set to false
                        'font-size'     	=> false,
                        'line-height'   	=> false,
                        //'word-spacing'  	=> true,  // Defaults to false
                        //'letter-spacing'	=> true,  // Defaults to false
                        //'color'         	=> false,
                        //'preview'       	=> false, // Disable the previewer
                        'all_styles'    	=> true,    // Enable all Google Font style/weight variations to be added to the page
                        //'output'        	=> array('h1, h2, h3, h4, h5, h6'), // An array of CSS selectors to apply this font style to dynamically
                        //'compiler'      	=> array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         	=> 'px', // Defaults to px
                        'subtitle'      	=> esc_html__('Heading font.', 'greek'),
                        'default'       	=> array(
                            'color'         => '#909090',
                            'font-weight'   => '400',
                            'font-family'   => 'Arial, Helvetica, sans-serif',
                            'google'        => true,
						),
					),
				),
			);
			
			// Layout
            $this->sections[] = array(
                'title'     => esc_html__('Layout', 'greek'),
                'icon'      => 'el-icon-align-justify',
                'fields'    => array(
					array(
						'id'       => 'page_layout',
						'subtitle' => esc_html__('Select page default page layout.', 'greek'),
						'type'     => 'select',
						'multi'    => false,
						'title'    => esc_html__('Page Layout', 'greek'),
						'options'  => array(
							'layout-1' => 'Page Layout 01',
							'layout-2' => 'Page Layout 02',
							'layout-3' => 'Page Layout 03',
							'layout-4' => 'Page Layout 04',
							'layout-5' => 'Page Layout 05',
							'layout-6' => 'Page Layout 06',
						),
						'default'  => 'layout-1'
					),		
					array(
						'id'       => 'page_style',
						'subtitle' => esc_html__('Select layout style: Box or Full Width', 'greek'),
						'type'     => 'select',
						'multi'    => false,
						'title'    => esc_html__('Layout Style', 'greek'),
						'options'  => array(
							'full' => 'Full Width',
							'box'  => 'Box'
						),
						'default'  => 'full'
					),
					array(
                        'id'        => 'preset_option',
                        'type'      => 'select',
                        'title'     => esc_html__('Preset', 'greek'),
						'subtitle'      => esc_html__('Select a preset to quickly apply pre-defined colors and fonts', 'greek'),
                        'options'   => array(
							'1' => 'Preset 1',
                            '2' => 'Preset 2',
							'3' => 'Preset 3',
							'4' => 'Preset 4',
                    ),
                        'default'   => '1'
					),
					/* array(
                        'id'        => 'enable_nlpopup',
                        'type'      => 'switch',
                        'title'     => __('Show Newsletter Popup', 'greek'),
						'subtitle'     => __('Show newsletter popup on first time customer visits site', 'greek'),
						'default'   => true,
					), */
					array(
                        'id'        => 'enable_sswitcher',
                        'type'      => 'switch',
                        'title'     => esc_html__('Show Style Switcher', 'greek'),
						'subtitle'  => esc_html__('The style switcher is only for preview on front-end', 'greek'),
						'default'   => false,
					),
				),
			);
			
			//Brand logos
			$this->sections[] = array(
                'title'     => esc_html__('Brand Logos', 'greek'),
                'desc'      => esc_html__('Upload brand logos and links', 'greek'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(
					array(
						'id'          => 'brand_logos',
						'type'        => 'slides',
						'title'       => esc_html__('Logos', 'greek'),
						'desc'        => esc_html__('Upload logo image and enter logo link.', 'greek'),
						'placeholder' => array(
							'title'           => esc_html__('Title', 'greek'),
							'description'     => esc_html__('Description', 'greek'),
							'url'             => esc_html__('Link', 'greek'),
						),
					),
				),
			);
			
			// Sidebar
			$this->sections[] = array(
                'title'     => esc_html__('Sidebar', 'greek'),
                'desc'      => esc_html__('Sidebar options', 'greek'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(
					array(
						'id'       	=> 'sidebar_pos',
						'type'     	=> 'radio',
						'title'    	=> esc_html__('Main Sidebar Position', 'greek'),
						'subtitle'      => esc_html__('Sidebar on category page', 'greek'),
						'options'  	=> array(
							'left' 	=> 'Left',
							'right' => 'Right'),
						'default'  	=> 'left'
					),
					array(
						'id'       	=> 'sidebar_product',
						'type'     	=> 'radio',
						'title'    	=> esc_html__('Product Sidebar Position', 'greek'),
						'subtitle'      => esc_html__('Sidebar on product page', 'greek'),
						'options'  	=> array(
							'left' 	=> 'Left',
							'right' => 'Right'),
						'default'  	=> 'left'
					),
					array(
						'id'       	=> 'sidebarse_pos',
						'type'     	=> 'radio',
						'title'    	=> esc_html__('Secondary Sidebar Position', 'greek'),
						'subtitle'  => esc_html__('Sidebar on pages', 'greek'),
						'options'  	=> array(
							'left' 	=> 'Left',
							'right' => 'Right'),
						'default'  	=> 'left'
					),
					array(
						'id'       	=> 'sidebarblog_pos',
						'type'     	=> 'radio',
						'title'    	=> esc_html__('Blog Sidebar Position', 'greek'),
						'subtitle'  => esc_html__('Sidebar on Blog pages', 'greek'),
						'options'  	=> array(
							'left' 	=> 'Left',
							'right' => 'Right'),
						'default'  	=> 'right'
					),
				),
			);
			
			// Portfolio
            $this->sections[] = array(
                'title'     => esc_html__('Portfolio', 'greek'),
                'desc'      => esc_html__('Use this section to select options for portfolio', 'greek'),
                'icon'      => 'el-icon-tags',
                'fields'    => array(
					array(
						'id'        	=> 'portfolio_columns',
						'type'      	=> 'slider',
						'title'     	=> esc_html__('Portfolio Columns', 'greek'),
						"default"   	=> 3,
						"min"       	=> 2,
						"step"      	=> 1,
						"max"       	=> 4,
						'display_value' => 'text'
					),
					array(
						'id'        	=> 'portfolio_per_page',
						'type'      	=> 'slider',
						'title'     	=> esc_html__('Projects per page', 'greek'),
						'desc'      	=> esc_html__('Amount of projects per page on portfolio page', 'greek'),
						"default"   	=> 15,
						"min"       	=> 4,
						"step"      	=> 1,
						"max"       	=> 48,
						'display_value' => 'text'
					),
					array(
                        'id'        => 'related_project_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Related projects title', 'greek'),
                        'default'   => 'Related Projects'
					),
				),
			);
		  
			// Product
			$this->sections[] = array(
                'title'     => esc_html__('Product', 'greek'),
                'desc'      => esc_html__('Use this section to select options for product', 'greek'),
                'icon'      => 'el-icon-tags',
                'fields'    => array(
					array(
						'id'       => 'quick_view',
						'type'     => 'switch',
						'title'    => esc_html__('Use Быстрый просмотр product', 'greek'),
						'default'  => true,
					),	
					array(
                        'id'        => 'cat_banner_img',
                        'type'      => 'media',
                        'title'     => esc_html__('Banner Header Category', 'greek'),
                        'compiler'  => 'true',
                        'mode'      => false,
                        'desc'      => esc_html__('Upload banner category here.', 'greek'),
					),
					array(
                        'id'        => 'cat_banner_link',
                        'type'      => 'text',
                        'title'     => esc_html__('Link Banner Category', 'greek'),
                        'default'   => 'http://vinagecko.com'
					),
					array(
                        'id'        => 'shop_header',
                        'type'      => 'background',
                        'output'    => array('.shop_header'),
                        'title'     => esc_html__('Shop category header background', 'greek'),
						'default'   => '#eee',
					),
					array(
                        'id'        => 'product_header',
                        'type'      => 'background',
                        'output'    => array('.product_header'),
                        'title'     => esc_html__('Product page header background', 'greek'),
						'default'   => '#eee',
					),
					array(
						'id'		=>'product_header_code',
						'type' 		=> 'textarea',
						'title' 	=> esc_html__('Product header signup', 'greek'),
						'default' 	=> '',
					),
					array(
						'id'        	=> 'product_per_page',
						'type'      	=> 'slider',
						'title'     	=> esc_html__('Products per page', 'greek'),
						'subtitle'  	=> esc_html__('Amount of products per page on category page', 'greek'),
						"default"   	=> 12,
						"min"       	=> 3,
						"step"      	=> 1,
						"max"       	=> 48,
						'display_value' => 'text'
					),
					array(
                        'id'        => 'product_columns',
                        'type'      => 'select',
                        'title'     => esc_html__('Product Columns', 'greek'),
						'subtitle'      => esc_html__('Amount of products on row', 'greek'),
                        'options'   => array(
                            '2' => '2 columns',
							'3' => '3 columns',
							'4' => '4 columns',
                      ),
                        'default'   => '3'
					),
					array(
                        'id'        => 'upsells_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Upsell products title', 'greek'),
                        'default'   => 'Upsell Products'
					),
					array(
                        'id'        => 'crosssells_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Cross Sells title', 'greek'),
                        'default'   => 'Cross Sells'
					),
					array(
                        'id'        => 'related_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Related products title', 'greek'),
                        'default'   => 'Related Products'
					),
					array(
						'id'        	=> 'related_amount',
						'type'      	=> 'slider',
						'title'     	=> esc_html__('Number of related products', 'greek'),
						"default"   	=> 6,
						"min"       	=> 3,
						"step"      	=> 1,
						"max"       	=> 16,
						'display_value' => 'text'
					),
					
					array(
						'id'		=>'share_head_code',
						'type' 		=> 'textarea',
						'title' 	=> esc_html__('ShareThis/AddThis head tag', 'greek'), 
						'desc' 		=> esc_html__('Paste your ShareThis or AddThis head tag here', 'greek'),
						'default' 	=> '',
					),
					array(
						'id'		=>'share_code',
						'type' 		=> 'textarea',
						'title' 	=> esc_html__('ShareThis/AddThis code', 'greek'), 
						'desc' 		=> esc_html__('Paste your ShareThis or AddThis code here', 'greek'),
						'default' 	=> ''
					),
				),
			);
			
			// Less Compiler
            $this->sections[] = array(
                'title'     => esc_html__('Less Compiler', 'greek'),
                'desc'      => esc_html__('Turn on this option to apply all theme options. Turn of when you have finished changing theme options and your site is ready.', 'greek'),
                'icon'      => 'el-icon-wrench',
                'fields'    => array(
					array(
                        'id'        => 'enable_less',
                        'type'      => 'switch',
                        'title'     => esc_html__('Enable Less Compiler', 'greek'),
						'default'   => true,
					),
				),
			);
			
            $theme_info  = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . wp_kses(__('<strong>Theme URL:</strong> ', 'greek'), array('strong' => array())) . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . wp_kses(__('<strong>Author:</strong> ', 'greek'), array('strong' => array())) . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . wp_kses(__('<strong>Version:</strong> ', 'greek'), array('strong' => array())) . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs 		 = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . wp_kses(__('<strong>Tags:</strong> ', 'greek'), array('strong' => array())) . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

            $this->sections[] = array(
                'icon'              => 'el-icon-list-alt',
                'title'             => esc_html__('Customizer Only', 'greek'),
                'desc'              => wp_kses(__('<p class="description">This Section should be visible only in Customizer</p>', 'greek'), array('p' => array('class' => array()))),
                'customizer_only'   => true,
                'fields'    => array(
                    array(
                        'id'        => 'opt-customizer-only',
                        'type'      => 'select',
                        'title'     => esc_html__('Customizer Only Option', 'greek'),
                        'subtitle'  => esc_html__('The subtitle is NOT visible in customizer', 'greek'),
                        'desc'      => esc_html__('The field desc is NOT visible in customizer.', 'greek'),
                        'customizer_only'   => true,

                        //Must provide key => value pairs for select options
                        'options'   => array(
                            '1' => 'Opt 1',
                            '2' => 'Opt 2',
                            '3' => 'Opt 3'
						),
                        'default'   => '2'
					),
				)
			);            
            
            $this->sections[] = array(
                'title'     => esc_html__('Import / Export', 'greek'),
                'desc'      => esc_html__('Import and Export your Redux Framework settings from file, text or URL.', 'greek'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
					),
				),
			);

            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => esc_html__('Theme Information', 'greek'),
                //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed</p>', 'greek'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
					)
				),
			);
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => esc_html__('Theme Information 1', 'greek'),
                'content'   => wp_kses(__('<p>This is the tab content, HTML is allowed.</p>', 'greek'), array('p' => array()))
			);

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => esc_html__('Theme Information 2', 'greek'),
                'content'   => wp_kses(__('<p>This is the tab content, HTML is allowed.</p>', 'greek'), array('p' => array()))
			);

            // Set the help sidebar
            $this->args['help_sidebar'] = wp_kses(__('<p>This is the sidebar content, HTML is allowed.</p>', 'greek'), array('p' => array()));
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'greek_options',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => esc_html__('Theme Options', 'greek'),
                'page_title'        => esc_html__('Theme Options', 'greek'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' 	=> '', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => true,                    // Use a asynchronous font on the front end or font string
                //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => true,                    // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => '_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'          => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'       => false, // REMOVE

                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
					),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
					),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
						),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
						),
					),
				)
			);


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon'  => 'el-icon-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
			);
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon'  => 'el-icon-facebook'
			);
            $this->args['share_icons'][] = array(
                'url'   => 'http://twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
			);
            $this->args['share_icons'][] = array(
                'url'   => 'http://www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon'  => 'el-icon-linkedin'
			);

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
                //$this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'greek'), $v);
            } else {
                //$this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'greek');
            }

            // Add content after the form.
            //$this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'greek');
        }

    }
    
    global $reduxConfig;
    $reduxConfig = new greek_theme_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
