<?php
/**
 * Dashicons
 *
 * @package Icon_Picker
 * @author Dzikri Aziz <kvcrvt@gmail.com>
 */


require_once dirname( __FILE__ ) . '/font.php';

/**
 * Icon type: Dashicons
 *
 * @since 0.1.0
 */
class Icon_Picker_Type_Dashicons extends Icon_Picker_Type_Font {

	/**
	 * Icon type ID
	 *
	 * @since  0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $id = 'dashicons';

	/**
	 * Icon type name
	 *
	 * @since  0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $name = 'Dashicons';

	/**
	 * Icon type version
	 *
	 * @since  0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $version = '4.3.1';

	/**
	 * Stylesheet URI
	 *
	 * @since  0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $stylesheet_uri = '';


	/**
	 * Register assets
	 *
	 * @since   0.1.0
	 * @wp_hook action icon_picker_loader_init
	 *
	 * @param  Icon_Picker_Loader  $loader Icon_Picker_Loader instance.
	 *
	 * @return void
	 */
	public function register_assets( Icon_Picker_Loader $loader ) {
		$loader->add_style( $this->stylesheet_id );
	}


	/**
	 * Get icon groups
	 *
	 * @since  0.1.0
	 * @return array
	 */
	public function get_groups() {
		$groups = array(
			array(
				'id'   => 'admin',
				'name' => 'Admin',
			),
			array(
				'id'   => 'post-formats',
				'name' => 'Post Formats',
			),
			array(
				'id'   => 'welcome-screen',
				'name' => 'Welcome Screen',
			),
			array(
				'id'   => 'image-editor',
				'name' => 'Image Editor',
			),
			array(
				'id'   => 'text-editor',
				'name' => 'Text Editor',
			),
			array(
				'id'   => 'post',
				'name' => 'Post',
			),
			array(
				'id'   => 'sorting',
				'name' => 'Sorting',
			),
			array(
				'id'   => 'social',
				'name' => 'Social',
			),
			array(
				'id'   => 'jobs',
				'name' => 'Jobs',
			),
			array(
				'id'   => 'products',
				'name' => 'Internal/Products',
			),
			array(
				'id'   => 'taxonomies',
				'name' => 'Taxonomies',
			),
			array(
				'id'   => 'alerts',
				'name' => 'Alerts/Notifications',
			),
			array(
				'id'   => 'media',
				'name' => 'Media',
			),
			array(
				'id'   => 'misc',
				'name' => 'Misc./Post Types',
			),
		);

		/**
		 * Filter dashicon groups
		 *
		 * @since 0.1.0
		 * @param array $groups Icon groups.
		 */
		$groups = apply_filters( 'icon_picker_dashicons_groups', $groups );

		return $groups;
	}


	/**
	 * Get icon names
	 *
	 * @since  0.1.0
	 * @return array
	 */
	public function get_items() {
		$items = array(
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-appearance',
				'name'  => 'Appearance',
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-collapse',
				'name'  => 'Collapse',
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-comments',
				'name'  => 'Comments',
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-customizer',
				'name'  => 'Customizer',
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-dashboard',
				'name'  => 'Dashboard',
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-generic',
				'name'  => 'Generic',
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-filter',
				'name'  => 'Filter',
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-home',
				'name'  => 'Home',
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-media',
				'name'  => 'Media',
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-menu',
				'name'  => 'Menu',
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-multisite',
				'name'  => 'Multisite',
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-network',
				'name'  => 'Network',
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-page',
				'name'  => 'Page',
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-plugins',
				'name'  => 'Plugins',
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-settings',
				'name'  => 'Settings',
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-site',
				'name'  => 'Site',
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-tools',
				'name'  => 'Tools',
			),
			array(
				'group' => 'admin',
				'id'    => 'dashicons-admin-users',
				'name'  => 'Users',
			),
			array(
				'group' => 'post-formats',
				'id'    => 'dashicons-format-standard',
				'name'  => 'Standard',
			),
			array(
				'group' => 'post-formats',
				'id'    => 'dashicons-format-aside',
				'name'  => 'Aside',
			),
			array(
				'group' => 'post-formats',
				'id'    => 'dashicons-format-image',
				'name'  => 'Image',
			),
			array(
				'group' => 'post-formats',
				'id'    => 'dashicons-format-video',
				'name'  => 'Video',
			),
			array(
				'group' => 'post-formats',
				'id'    => 'dashicons-format-audio',
				'name'  => 'Audio',
			),
			array(
				'group' => 'post-formats',
				'id'    => 'dashicons-format-quote',
				'name'  => 'Quote',
			),
			array(
				'group' => 'post-formats',
				'id'    => 'dashicons-format-gallery',
				'name'  => 'Gallery',
			),
			array(
				'group' => 'post-formats',
				'id'    => 'dashicons-format-links',
				'name'  => 'Links',
			),
			array(
				'group' => 'post-formats',
				'id'    => 'dashicons-format-status',
				'name'  => 'Status',
			),
			array(
				'group' => 'post-formats',
				'id'    => 'dashicons-format-chat',
				'name'  => 'Chat',
			),
			array(
				'group' => 'welcome-screen',
				'id'    => 'dashicons-welcome-add-page',
				'name'  => 'Add page',
			),
			array(
				'group' => 'welcome-screen',
				'id'    => 'dashicons-welcome-comments',
				'name'  => 'Comments',
			),
			array(
				'group' => 'welcome-screen',
				'id'    => 'dashicons-welcome-edit-page',
				'name'  => 'Edit page',
			),
			array(
				'group' => 'welcome-screen',
				'id'    => 'dashicons-welcome-learn-more',
				'name'  => 'Learn More',
			),
			array(
				'group' => 'welcome-screen',
				'id'    => 'dashicons-welcome-view-site',
				'name'  => 'View Site',
			),
			array(
				'group' => 'welcome-screen',
				'id'    => 'dashicons-welcome-widgets-menus',
				'name'  => 'Widgets',
			),
			array(
				'group' => 'welcome-screen',
				'id'    => 'dashicons-welcome-write-blog',
				'name'  => 'Write Blog',
			),
			array(
				'group' => 'image-editor',
				'id'    => 'dashicons-image-crop',
				'name'  => 'Crop',
			),
			array(
				'group' => 'image-editor',
				'id'    => 'dashicons-image-filter',
				'name'  => 'Filter',
			),
			array(
				'group' => 'image-editor',
				'id'    => 'dashicons-image-rotate',
				'name'  => 'Rotate',
			),
			array(
				'group' => 'image-editor',
				'id'    => 'dashicons-image-rotate-left',
				'name'  => 'Rotate Left',
			),
			array(
				'group' => 'image-editor',
				'id'    => 'dashicons-image-rotate-right',
				'name'  => 'Rotate Right',
			),
			array(
				'group' => 'image-editor',
				'id'    => 'dashicons-image-flip-vertical',
				'name'  => 'Flip Vertical',
			),
			array(
				'group' => 'image-editor',
				'id'    => 'dashicons-image-flip-horizontal',
				'name'  => 'Flip Horizontal',
			),
			array(
				'group' => 'image-editor',
				'id'    => 'dashicons-undo',
				'name'  => 'Undo',
			),
			array(
				'group' => 'image-editor',
				'id'    => 'dashicons-redo',
				'name'  => 'Redo',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-bold',
				'name'  => 'Bold',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-italic',
				'name'  => 'Italic',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-ul',
				'name'  => 'Unordered List',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-ol',
				'name'  => 'Ordered List',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-quote',
				'name'  => 'Quote',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-alignleft',
				'name'  => 'Align Left',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-aligncenter',
				'name'  => 'Align Center',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-alignright',
				'name'  => 'Align Right',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-insertmore',
				'name'  => 'Insert More',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-spellcheck',
				'name'  => 'Spell Check',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-distractionfree',
				'name'  => 'Distraction-free',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-kitchensink',
				'name'  => 'Kitchensink',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-underline',
				'name'  => 'Underline',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-justify',
				'name'  => 'Justify',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-textcolor',
				'name'  => 'Text Color',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-paste-word',
				'name'  => 'Paste Word',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-paste-text',
				'name'  => 'Paste Text',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-removeformatting',
				'name'  => 'Clear Formatting',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-video',
				'name'  => 'Video',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-customchar',
				'name'  => 'Custom Characters',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-indent',
				'name'  => 'Indent',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-outdent',
				'name'  => 'Outdent',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-help',
				'name'  => 'Help',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-strikethrough',
				'name'  => 'Strikethrough',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-unlink',
				'name'  => 'Unlink',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'dashicons-editor-rtl',
				'name'  => 'RTL',
			),
			array(
				'group' => 'post',
				'id'    => 'dashicons-align-left',
				'name'  => 'Align Left',
			),
			array(
				'group' => 'post',
				'id'    => 'dashicons-align-right',
				'name'  => 'Align Right',
			),
			array(
				'group' => 'post',
				'id'    => 'dashicons-align-center',
				'name'  => 'Align Center',
			),
			array(
				'group' => 'post',
				'id'    => 'dashicons-align-none',
				'name'  => 'Align None',
			),
			array(
				'group' => 'post',
				'id'    => 'dashicons-lock',
				'name'  => 'Lock',
			),
			array(
				'group' => 'post',
				'id'    => 'dashicons-calendar',
				'name'  => 'Calendar',
			),
			array(
				'group' => 'post',
				'id'    => 'dashicons-calendar-alt',
				'name'  => 'Calendar',
			),
			array(
				'group' => 'post',
				'id'    => 'dashicons-hidden',
				'name'  => 'Hidden',
			),
			array(
				'group' => 'post',
				'id'    => 'dashicons-visibility',
				'name'  => 'Visibility',
			),
			array(
				'group' => 'post',
				'id'    => 'dashicons-post-status',
				'name'  => 'Post Status',
			),
			array(
				'group' => 'post',
				'id'    => 'dashicons-post-trash',
				'name'  => 'Post Trash',
			),
			array(
				'group' => 'post',
				'id'    => 'dashicons-edit',
				'name'  => 'Edit',
			),
			array(
				'group' => 'post',
				'id'    => 'dashicons-trash',
				'name'  => 'Trash',
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-arrow-up',
				'name'  => 'Arrow: Up',
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-arrow-down',
				'name'  => 'Arrow: Down',
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-arrow-left',
				'name'  => 'Arrow: Left',
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-arrow-right',
				'name'  => 'Arrow: Right',
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-arrow-up-alt',
				'name'  => 'Arrow: Up',
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-arrow-down-alt',
				'name'  => 'Arrow: Down',
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-arrow-left-alt',
				'name'  => 'Arrow: Left',
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-arrow-right-alt',
				'name'  => 'Arrow: Right',
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-arrow-up-alt2',
				'name'  => 'Arrow: Up',
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-arrow-down-alt2',
				'name'  => 'Arrow: Down',
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-arrow-left-alt2',
				'name'  => 'Arrow: Left',
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-arrow-right-alt2',
				'name'  => 'Arrow: Right',
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-leftright',
				'name'  => 'Left-Right',
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-sort',
				'name'  => 'Sort',
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-list-view',
				'name'  => 'List View',
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-exerpt-view',
				'name'  => 'Excerpt View',
			),
			array(
				'group' => 'sorting',
				'id'    => 'dashicons-grid-view',
				'name'  => 'Grid View',
			),
			array(
				'group' => 'social',
				'id'    => 'dashicons-share',
				'name'  => 'Share',
			),
			array(
				'group' => 'social',
				'id'    => 'dashicons-share-alt',
				'name'  => 'Share',
			),
			array(
				'group' => 'social',
				'id'    => 'dashicons-share-alt2',
				'name'  => 'Share',
			),
			array(
				'group' => 'social',
				'id'    => 'dashicons-twitter',
				'name'  => 'Twitter',
			),
			array(
				'group' => 'social',
				'id'    => 'dashicons-rss',
				'name'  => 'RSS',
			),
			array(
				'group' => 'social',
				'id'    => 'dashicons-email',
				'name'  => 'Email',
			),
			array(
				'group' => 'social',
				'id'    => 'dashicons-email-alt',
				'name'  => 'Email',
			),
			array(
				'group' => 'social',
				'id'    => 'dashicons-facebook',
				'name'  => 'Facebook',
			),
			array(
				'group' => 'social',
				'id'    => 'dashicons-facebook-alt',
				'name'  => 'Facebook',
			),
			array(
				'group' => 'social',
				'id'    => 'dashicons-googleplus',
				'name'  => 'Google+',
			),
			array(
				'group' => 'social',
				'id'    => 'dashicons-networking',
				'name'  => 'Networking',
			),
			array(
				'group' => 'jobs',
				'id'    => 'dashicons-art',
				'name'  => 'Art',
			),
			array(
				'group' => 'jobs',
				'id'    => 'dashicons-hammer',
				'name'  => 'Hammer',
			),
			array(
				'group' => 'jobs',
				'id'    => 'dashicons-migrate',
				'name'  => 'Migrate',
			),
			array(
				'group' => 'jobs',
				'id'    => 'dashicons-performance',
				'name'  => 'Performance',
			),
			array(
				'group' => 'products',
				'id'    => 'dashicons-wordpress',
				'name'  => 'WordPress',
			),
			array(
				'group' => 'products',
				'id'    => 'dashicons-wordpress-alt',
				'name'  => 'WordPress',
			),
			array(
				'group' => 'products',
				'id'    => 'dashicons-pressthis',
				'name'  => 'PressThis',
			),
			array(
				'group' => 'products',
				'id'    => 'dashicons-update',
				'name'  => 'Update',
			),
			array(
				'group' => 'products',
				'id'    => 'dashicons-screenoptions',
				'name'  => 'Screen Options',
			),
			array(
				'group' => 'products',
				'id'    => 'dashicons-info',
				'name'  => 'Info',
			),
			array(
				'group' => 'products',
				'id'    => 'dashicons-cart',
				'name'  => 'Cart',
			),
			array(
				'group' => 'products',
				'id'    => 'dashicons-feedback',
				'name'  => 'Feedback',
			),
			array(
				'group' => 'products',
				'id'    => 'dashicons-cloud',
				'name'  => 'Cloud',
			),
			array(
				'group' => 'products',
				'id'    => 'dashicons-translation',
				'name'  => 'Translation',
			),
			array(
				'group' => 'taxonomies',
				'id'    => 'dashicons-tag',
				'name'  => 'Tag',
			),
			array(
				'group' => 'taxonomies',
				'id'    => 'dashicons-category',
				'name'  => 'Category',
			),
			array(
				'group' => 'alerts',
				'id'    => 'dashicons-yes',
				'name'  => 'Yes',
			),
			array(
				'group' => 'alerts',
				'id'    => 'dashicons-no',
				'name'  => 'No',
			),
			array(
				'group' => 'alerts',
				'id'    => 'dashicons-no-alt',
				'name'  => 'No',
			),
			array(
				'group' => 'alerts',
				'id'    => 'dashicons-plus',
				'name'  => 'Plus',
			),
			array(
				'group' => 'alerts',
				'id'    => 'dashicons-minus',
				'name'  => 'Minus',
			),
			array(
				'group' => 'alerts',
				'id'    => 'dashicons-dismiss',
				'name'  => 'Dismiss',
			),
			array(
				'group' => 'alerts',
				'id'    => 'dashicons-marker',
				'name'  => 'Marker',
			),
			array(
				'group' => 'alerts',
				'id'    => 'dashicons-star-filled',
				'name'  => 'Star: Filled',
			),
			array(
				'group' => 'alerts',
				'id'    => 'dashicons-star-half',
				'name'  => 'Star: Half',
			),
			array(
				'group' => 'alerts',
				'id'    => 'dashicons-star-empty',
				'name'  => 'Star: Empty',
			),
			array(
				'group' => 'alerts',
				'id'    => 'dashicons-flag',
				'name'  => 'Flag',
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-controls-skipback',
				'name'  => 'Skip Back',
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-controls-back',
				'name'  => 'Back',
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-controls-play',
				'name'  => 'Play',
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-controls-pause',
				'name'  => 'Pause',
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-controls-forward',
				'name'  => 'Forward',
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-controls-skipforward',
				'name'  => 'Skip Forward',
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-controls-repeat',
				'name'  => 'Repeat',
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-controls-volumeon',
				'name'  => 'Volume: On',
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-controls-volumeoff',
				'name'  => 'Volume: Off',
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-media-archive',
				'name'  => 'Archive',
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-media-audio',
				'name'  => 'Audio',
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-media-code',
				'name'  => 'Code',
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-media-default',
				'name'  => 'Default',
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-media-document',
				'name'  => 'Document',
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-media-interactive',
				'name'  => 'Interactive',
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-media-spreadsheet',
				'name'  => 'Spreadsheet',
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-media-text',
				'name'  => 'Text',
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-media-video',
				'name'  => 'Video',
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-playlist-audio',
				'name'  => 'Audio Playlist',
			),
			array(
				'group' => 'media',
				'id'    => 'dashicons-playlist-video',
				'name'  => 'Video Playlist',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-album',
				'name'  => 'Album',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-analytics',
				'name'  => 'Analytics',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-awards',
				'name'  => 'Awards',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-backup',
				'name'  => 'Backup',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-building',
				'name'  => 'Building',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-businessman',
				'name'  => 'Businessman',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-camera',
				'name'  => 'Camera',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-carrot',
				'name'  => 'Carrot',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-chart-pie',
				'name'  => 'Chart: Pie',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-chart-bar',
				'name'  => 'Chart: Bar',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-chart-line',
				'name'  => 'Chart: Line',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-chart-area',
				'name'  => 'Chart: Area',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-desktop',
				'name'  => 'Desktop',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-forms',
				'name'  => 'Forms',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-groups',
				'name'  => 'Groups',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-id',
				'name'  => 'ID',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-id-alt',
				'name'  => 'ID',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-images-alt',
				'name'  => 'Images',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-images-alt2',
				'name'  => 'Images',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-index-card',
				'name'  => 'Index Card',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-layout',
				'name'  => 'Layout',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-location',
				'name'  => 'Location',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-location-alt',
				'name'  => 'Location',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-products',
				'name'  => 'Products',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-portfolio',
				'name'  => 'Portfolio',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-book',
				'name'  => 'Book',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-book-alt',
				'name'  => 'Book',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-download',
				'name'  => 'Download',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-upload',
				'name'  => 'Upload',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-clock',
				'name'  => 'Clock',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-lightbulb',
				'name'  => 'Lightbulb',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-money',
				'name'  => 'Money',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-palmtree',
				'name'  => 'Palm Tree',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-phone',
				'name'  => 'Phone',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-search',
				'name'  => 'Search',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-shield',
				'name'  => 'Shield',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-shield-alt',
				'name'  => 'Shield',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-slides',
				'name'  => 'Slides',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-smartphone',
				'name'  => 'Smartphone',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-smiley',
				'name'  => 'Smiley',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-sos',
				'name'  => 'S.O.S.',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-sticky',
				'name'  => 'Sticky',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-store',
				'name'  => 'Store',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-tablet',
				'name'  => 'Tablet',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-testimonial',
				'name'  => 'Testimonial',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-tickets-alt',
				'name'  => 'Tickets',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-thumbs-up',
				'name'  => 'Thumbs Up',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-thumbs-down',
				'name'  => 'Thumbs Down',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-unlock',
				'name'  => 'Unlock',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-vault',
				'name'  => 'Vault',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-video-alt',
				'name'  => 'Video',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-video-alt2',
				'name'  => 'Video',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-video-alt3',
				'name'  => 'Video',
			),
			array(
				'group' => 'misc',
				'id'    => 'dashicons-warning',
				'name'  => 'Warning',
			),
		);

		/**
		 * Filter dashicon items
		 *
		 * @since 0.1.0
		 * @param array $items Icon names.
		 */
		$items = apply_filters( 'icon_picker_dashicons_items', $items );

		return $items;
	}
}
