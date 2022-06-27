<?php
/**
 * Foundation Icons
 *
 * @package Icon_Picker
 * @author  Dzikri Aziz <kvcrvt@gmail.com>
 */
class Icon_Picker_Type_Foundation extends Icon_Picker_Type_Font {

	/**
	 * Icon type ID
	 *
	 * @since  0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $id = 'foundation-icons';

	/**
	 * Icon type name
	 *
	 * @since  0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $name = 'Foundation';

	/**
	 * Icon type version
	 *
	 * @since  0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $version = '3.0';


	/**
	 * Get icon groups
	 *
	 * @since  0.1.0
	 * @return array
	 */
	public function get_groups() {
		$groups = array(
			array(
				'id'   => 'accessibility',
				'name' => 'Accessibility',
			),
			array(
				'id'   => 'arrows',
				'name' => 'Arrows',
			),
			array(
				'id'   => 'devices',
				'name' => 'Devices',
			),
			array(
				'id'   => 'ecommerce',
				'name' => 'Ecommerce',
			),
			array(
				'id'   => 'editor',
				'name' => 'Editor',
			),
			array(
				'id'   => 'file-types',
				'name' => 'File Types',
			),
			array(
				'id'   => 'general',
				'name' => 'General',
			),
			array(
				'id'   => 'media-control',
				'name' => 'Media Controls',
			),
			array(
				'id'   => 'misc',
				'name' => 'Miscellaneous',
			),
			array(
				'id'   => 'people',
				'name' => 'People',
			),
			array(
				'id'   => 'social',
				'name' => 'Social/Brand',
			),
		);
		/**
		 * Filter genericon groups
		 *
		 * @since 0.1.0
		 * @param array $groups Icon groups.
		 */
		$groups = apply_filters( 'icon_picker_foundations_groups', $groups );

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
				'group' => 'accessibility',
				'id'    => 'fi-asl',
				'name'  => 'ASL',
			),
			array(
				'group' => 'accessibility',
				'id'    => 'fi-blind',
				'name'  => 'Blind',
			),
			array(
				'group' => 'accessibility',
				'id'    => 'fi-braille',
				'name'  => 'Braille',
			),
			array(
				'group' => 'accessibility',
				'id'    => 'fi-closed-caption',
				'name'  => 'Closed Caption',
			),
			array(
				'group' => 'accessibility',
				'id'    => 'fi-elevator',
				'name'  => 'Elevator',
			),
			array(
				'group' => 'accessibility',
				'id'    => 'fi-guide-dog',
				'name'  => 'Guide Dog',
			),
			array(
				'group' => 'accessibility',
				'id'    => 'fi-hearing-aid',
				'name'  => 'Hearing Aid',
			),
			array(
				'group' => 'accessibility',
				'id'    => 'fi-universal-access',
				'name'  => 'Universal Access',
			),
			array(
				'group' => 'accessibility',
				'id'    => 'fi-male',
				'name'  => 'Male',
			),
			array(
				'group' => 'accessibility',
				'id'    => 'fi-female',
				'name'  => 'Female',
			),
			array(
				'group' => 'accessibility',
				'id'    => 'fi-male-female',
				'name'  => 'Male & Female',
			),
			array(
				'group' => 'accessibility',
				'id'    => 'fi-male-symbol',
				'name'  => 'Male Symbol',
			),
			array(
				'group' => 'accessibility',
				'id'    => 'fi-female-symbol',
				'name'  => 'Female Symbol',
			),
			array(
				'group' => 'accessibility',
				'id'    => 'fi-wheelchair',
				'name'  => 'Wheelchair',
			),
			array(
				'group' => 'arrows',
				'id'    => 'fi-arrow-up',
				'name'  => 'Arrow: Up',
			),
			array(
				'group' => 'arrows',
				'id'    => 'fi-arrow-down',
				'name'  => 'Arrow: Down',
			),
			array(
				'group' => 'arrows',
				'id'    => 'fi-arrow-left',
				'name'  => 'Arrow: Left',
			),
			array(
				'group' => 'arrows',
				'id'    => 'fi-arrow-right',
				'name'  => 'Arrow: Right',
			),
			array(
				'group' => 'arrows',
				'id'    => 'fi-arrows-out',
				'name'  => 'Arrows: Out',
			),
			array(
				'group' => 'arrows',
				'id'    => 'fi-arrows-in',
				'name'  => 'Arrows: In',
			),
			array(
				'group' => 'arrows',
				'id'    => 'fi-arrows-expand',
				'name'  => 'Arrows: Expand',
			),
			array(
				'group' => 'arrows',
				'id'    => 'fi-arrows-compress',
				'name'  => 'Arrows: Compress',
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-bluetooth',
				'name'  => 'Bluetooth',
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-camera',
				'name'  => 'Camera',
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-compass',
				'name'  => 'Compass',
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-laptop',
				'name'  => 'Laptop',
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-megaphone',
				'name'  => 'Megaphone',
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-microphone',
				'name'  => 'Microphone',
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-mobile',
				'name'  => 'Mobile',
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-mobile-signal',
				'name'  => 'Mobile Signal',
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-monitor',
				'name'  => 'Monitor',
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-tablet-portrait',
				'name'  => 'Tablet: Portrait',
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-tablet-landscape',
				'name'  => 'Tablet: Landscape',
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-telephone',
				'name'  => 'Telephone',
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-usb',
				'name'  => 'USB',
			),
			array(
				'group' => 'devices',
				'id'    => 'fi-video',
				'name'  => 'Video',
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-bitcoin',
				'name'  => 'Bitcoin',
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-bitcoin-circle',
				'name'  => 'Bitcoin',
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-dollar',
				'name'  => 'Dollar',
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-euro',
				'name'  => 'EURO',
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-pound',
				'name'  => 'Pound',
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-yen',
				'name'  => 'Yen',
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-burst',
				'name'  => 'Burst',
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-burst-new',
				'name'  => 'Burst: New',
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-burst-sale',
				'name'  => 'Burst: Sale',
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-credit-card',
				'name'  => 'Credit Card',
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-dollar-bill',
				'name'  => 'Dollar Bill',
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-paypal',
				'name'  => 'PayPal',
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-price-tag',
				'name'  => 'Price Tag',
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-pricetag-multiple',
				'name'  => 'Price Tag: Multiple',
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-shopping-bag',
				'name'  => 'Shopping Bag',
			),
			array(
				'group' => 'ecommerce',
				'id'    => 'fi-shopping-cart',
				'name'  => 'Shopping Cart',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-bold',
				'name'  => 'Bold',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-italic',
				'name'  => 'Italic',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-underline',
				'name'  => 'Underline',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-strikethrough',
				'name'  => 'Strikethrough',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-text-color',
				'name'  => 'Text Color',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-background-color',
				'name'  => 'Background Color',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-superscript',
				'name'  => 'Superscript',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-subscript',
				'name'  => 'Subscript',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-align-left',
				'name'  => 'Align Left',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-align-center',
				'name'  => 'Align Center',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-align-right',
				'name'  => 'Align Right',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-align-justify',
				'name'  => 'Justify',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-list-number',
				'name'  => 'List: Number',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-list-bullet',
				'name'  => 'List: Bullet',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-indent-more',
				'name'  => 'Indent',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-indent-less',
				'name'  => 'Outdent',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-page-add',
				'name'  => 'Add Page',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-page-copy',
				'name'  => 'Copy Page',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-page-multiple',
				'name'  => 'Duplicate Page',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-page-delete',
				'name'  => 'Delete Page',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-page-remove',
				'name'  => 'Remove Page',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-page-edit',
				'name'  => 'Edit Page',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-page-export',
				'name'  => 'Export',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-page-export-csv',
				'name'  => 'Export to CSV',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-page-export-pdf',
				'name'  => 'Export to PDF',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-page-filled',
				'name'  => 'Fill Page',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-crop',
				'name'  => 'Crop',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-filter',
				'name'  => 'Filter',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-paint-bucket',
				'name'  => 'Paint Bucket',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-photo',
				'name'  => 'Photo',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-print',
				'name'  => 'Print',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-save',
				'name'  => 'Save',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-link',
				'name'  => 'Link',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-unlink',
				'name'  => 'Unlink',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-quote',
				'name'  => 'Quote',
			),
			array(
				'group' => 'editor',
				'id'    => 'fi-page-search',
				'name'  => 'Search in Page',
			),
			array(
				'group' => 'file-types',
				'id'    => 'fi-page',
				'name'  => 'File',
			),
			array(
				'group' => 'file-types',
				'id'    => 'fi-page-csv',
				'name'  => 'CSV',
			),
			array(
				'group' => 'file-types',
				'id'    => 'fi-page-doc',
				'name'  => 'Doc',
			),
			array(
				'group' => 'file-types',
				'id'    => 'fi-page-pdf',
				'name'  => 'PDF',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-address-book',
				'name'  => 'Addressbook',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-alert',
				'name'  => 'Alert',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-annotate',
				'name'  => 'Annotate',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-archive',
				'name'  => 'Archive',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-bookmark',
				'name'  => 'Bookmark',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-calendar',
				'name'  => 'Calendar',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-clock',
				'name'  => 'Clock',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-cloud',
				'name'  => 'Cloud',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-comment',
				'name'  => 'Comment',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-comment-minus',
				'name'  => 'Comment: Minus',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-comment-quotes',
				'name'  => 'Comment: Quotes',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-comment-video',
				'name'  => 'Comment: Video',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-comments',
				'name'  => 'Comments',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-contrast',
				'name'  => 'Contrast',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-database',
				'name'  => 'Database',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-folder',
				'name'  => 'Folder',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-folder-add',
				'name'  => 'Folder: Add',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-folder-lock',
				'name'  => 'Folder: Lock',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-eye',
				'name'  => 'Eye',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-heart',
				'name'  => 'Heart',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-plus',
				'name'  => 'Plus',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-minus',
				'name'  => 'Minus',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-minus-circle',
				'name'  => 'Minus',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-x',
				'name'  => 'X',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-x-circle',
				'name'  => 'X',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-check',
				'name'  => 'Check',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-checkbox',
				'name'  => 'Check',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-download',
				'name'  => 'Download',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-upload',
				'name'  => 'Upload',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-upload-cloud',
				'name'  => 'Upload to Cloud',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-flag',
				'name'  => 'Flag',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-foundation',
				'name'  => 'Foundation',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-graph-bar',
				'name'  => 'Graph: Bar',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-graph-horizontal',
				'name'  => 'Graph: Horizontal',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-graph-pie',
				'name'  => 'Graph: Pie',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-graph-trend',
				'name'  => 'Graph: Trend',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-home',
				'name'  => 'Home',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-layout',
				'name'  => 'Layout',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-like',
				'name'  => 'Like',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-dislike',
				'name'  => 'Dislike',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-list',
				'name'  => 'List',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-list-thumbnails',
				'name'  => 'List: Thumbnails',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-lock',
				'name'  => 'Lock',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-unlock',
				'name'  => 'Unlock',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-marker',
				'name'  => 'Marker',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-magnifying-glass',
				'name'  => 'Magnifying Glass',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-refresh',
				'name'  => 'Refresh',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-paperclip',
				'name'  => 'Paperclip',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-pencil',
				'name'  => 'Pencil',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-play-video',
				'name'  => 'Play Video',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-results',
				'name'  => 'Results',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-results-demographics',
				'name'  => 'Results: Demographics',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-rss',
				'name'  => 'RSS',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-share',
				'name'  => 'Share',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-sound',
				'name'  => 'Sound',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-star',
				'name'  => 'Star',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-thumbnails',
				'name'  => 'Thumbnails',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-trash',
				'name'  => 'Trash',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-web',
				'name'  => 'Web',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-widget',
				'name'  => 'Widget',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-wrench',
				'name'  => 'Wrench',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-zoom-out',
				'name'  => 'Zoom Out',
			),
			array(
				'group' => 'general',
				'id'    => 'fi-zoom-in',
				'name'  => 'Zoom In',
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-record',
				'name'  => 'Record',
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-play-circle',
				'name'  => 'Play',
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-play',
				'name'  => 'Play',
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-pause',
				'name'  => 'Pause',
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-stop',
				'name'  => 'Stop',
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-previous',
				'name'  => 'Previous',
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-rewind',
				'name'  => 'Rewind',
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-fast-forward',
				'name'  => 'Fast Forward',
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-next',
				'name'  => 'Next',
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-volume',
				'name'  => 'Volume',
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-volume-none',
				'name'  => 'Volume: Low',
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-volume-strike',
				'name'  => 'Volume: Mute',
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-loop',
				'name'  => 'Loop',
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-shuffle',
				'name'  => 'Shuffle',
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-eject',
				'name'  => 'Eject',
			),
			array(
				'group' => 'media-control',
				'id'    => 'fi-rewind-ten',
				'name'  => 'Rewind 10',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-anchor',
				'name'  => 'Anchor',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-asterisk',
				'name'  => 'Asterisk',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-at-sign',
				'name'  => '@',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-battery-full',
				'name'  => 'Battery: Full',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-battery-half',
				'name'  => 'Battery: Half',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-battery-empty',
				'name'  => 'Battery: Empty',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-book',
				'name'  => 'Book',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-book-bookmark',
				'name'  => 'Bookmark',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-clipboard',
				'name'  => 'Clipboard',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-clipboard-pencil',
				'name'  => 'Clipboard: Pencil',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-clipboard-notes',
				'name'  => 'Clipboard: Notes',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-crown',
				'name'  => 'Crown',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-die-one',
				'name'  => 'Dice: 1',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-die-two',
				'name'  => 'Dice: 2',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-die-three',
				'name'  => 'Dice: 3',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-die-four',
				'name'  => 'Dice: 4',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-die-five',
				'name'  => 'Dice: 5',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-die-six',
				'name'  => 'Dice: 6',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-safety-cone',
				'name'  => 'Cone',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-first-aid',
				'name'  => 'Firs Aid',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-foot',
				'name'  => 'Foot',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-info',
				'name'  => 'Info',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-key',
				'name'  => 'Key',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-lightbulb',
				'name'  => 'Lightbulb',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-map',
				'name'  => 'Map',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-mountains',
				'name'  => 'Mountains',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-music',
				'name'  => 'Music',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-no-dogs',
				'name'  => 'No Dogs',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-no-smoking',
				'name'  => 'No Smoking',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-paw',
				'name'  => 'Paw',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-power',
				'name'  => 'Power',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-prohibited',
				'name'  => 'Prohibited',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-projection-screen',
				'name'  => 'Projection Screen',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-puzzle',
				'name'  => 'Puzzle',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-sheriff-badge',
				'name'  => 'Sheriff Badge',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-shield',
				'name'  => 'Shield',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-skull',
				'name'  => 'Skull',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-target',
				'name'  => 'Target',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-target-two',
				'name'  => 'Target',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-ticket',
				'name'  => 'Ticket',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-trees',
				'name'  => 'Trees',
			),
			array(
				'group' => 'misc',
				'id'    => 'fi-trophy',
				'name'  => 'Trophy',
			),
			array(
				'group' => 'people',
				'id'    => 'fi-torso',
				'name'  => 'Torso',
			),
			array(
				'group' => 'people',
				'id'    => 'fi-torso-business',
				'name'  => 'Torso: Business',
			),
			array(
				'group' => 'people',
				'id'    => 'fi-torso-female',
				'name'  => 'Torso: Female',
			),
			array(
				'group' => 'people',
				'id'    => 'fi-torsos',
				'name'  => 'Torsos',
			),
			array(
				'group' => 'people',
				'id'    => 'fi-torsos-all',
				'name'  => 'Torsos: All',
			),
			array(
				'group' => 'people',
				'id'    => 'fi-torsos-all-female',
				'name'  => 'Torsos: All Female',
			),
			array(
				'group' => 'people',
				'id'    => 'fi-torsos-male-female',
				'name'  => 'Torsos: Male & Female',
			),
			array(
				'group' => 'people',
				'id'    => 'fi-torsos-female-male',
				'name'  => 'Torsos: Female & Male',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-500px',
				'name'  => '500px',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-adobe',
				'name'  => 'Adobe',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-amazon',
				'name'  => 'Amazon',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-android',
				'name'  => 'Android',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-apple',
				'name'  => 'Apple',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-behance',
				'name'  => 'Behance',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-bing',
				'name'  => 'bing',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-blogger',
				'name'  => 'Blogger',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-css3',
				'name'  => 'CSS3',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-delicious',
				'name'  => 'Delicious',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-designer-news',
				'name'  => 'Designer News',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-deviant-art',
				'name'  => 'deviantArt',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-digg',
				'name'  => 'Digg',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-dribbble',
				'name'  => 'dribbble',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-drive',
				'name'  => 'Drive',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-dropbox',
				'name'  => 'DropBox',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-evernote',
				'name'  => 'Evernote',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-facebook',
				'name'  => 'Facebook',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-flickr',
				'name'  => 'flickr',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-forrst',
				'name'  => 'forrst',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-foursquare',
				'name'  => 'Foursquare',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-game-center',
				'name'  => 'Game Center',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-github',
				'name'  => 'GitHub',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-google-plus',
				'name'  => 'Google+',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-hacker-news',
				'name'  => 'Hacker News',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-hi5',
				'name'  => 'hi5',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-html5',
				'name'  => 'HTML5',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-instagram',
				'name'  => 'Instagram',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-joomla',
				'name'  => 'Joomla!',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-lastfm',
				'name'  => 'last.fm',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-linkedin',
				'name'  => 'LinkedIn',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-medium',
				'name'  => 'Medium',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-myspace',
				'name'  => 'My Space',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-orkut',
				'name'  => 'Orkut',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-path',
				'name'  => 'path',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-picasa',
				'name'  => 'Picasa',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-pinterest',
				'name'  => 'Pinterest',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-rdio',
				'name'  => 'rdio',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-reddit',
				'name'  => 'reddit',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-skype',
				'name'  => 'Skype',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-skillshare',
				'name'  => 'SkillShare',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-smashing-mag',
				'name'  => 'Smashing Mag.',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-snapchat',
				'name'  => 'Snapchat',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-spotify',
				'name'  => 'Spotify',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-squidoo',
				'name'  => 'Squidoo',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-stack-overflow',
				'name'  => 'StackOverflow',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-steam',
				'name'  => 'Steam',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-stumbleupon',
				'name'  => 'StumbleUpon',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-treehouse',
				'name'  => 'TreeHouse',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-tumblr',
				'name'  => 'Tumblr',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-twitter',
				'name'  => 'Twitter',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-windows',
				'name'  => 'Windows',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-xbox',
				'name'  => 'XBox',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-yahoo',
				'name'  => 'Yahoo!',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-yelp',
				'name'  => 'Yelp',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-youtube',
				'name'  => 'YouTube',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-zerply',
				'name'  => 'Zerply',
			),
			array(
				'group' => 'social',
				'id'    => 'fi-social-zurb',
				'name'  => 'Zurb',
			),
		);

		/**
		 * Filter genericon items
		 *
		 * @since 0.1.0
		 * @param array $items Icon names.
		 */
		$items = apply_filters( 'icon_picker_foundations_items', $items );

		return $items;
	}
}
