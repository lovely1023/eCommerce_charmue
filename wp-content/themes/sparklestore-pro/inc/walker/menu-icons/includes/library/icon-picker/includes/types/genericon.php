<?php
/**
 * Genericons
 *
 * @package Icon_Picker
 * @author  Dzikri Aziz <kvcrvt@gmail.com>
 */
class Icon_Picker_Type_Genericons extends Icon_Picker_Type_Font {

	/**
	 * Icon type ID
	 *
	 * @since  0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $id = 'genericon';

	/**
	 * Icon type name
	 *
	 * @since  0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $name = 'Genericons';

	/**
	 * Icon type version
	 *
	 * @since  0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $version = '3.4';

	/**
	 * Stylesheet ID
	 *
	 * @since  0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $stylesheet_id = 'genericons';


	/**
	 * Get icon groups
	 *
	 * @since  0.1.0
	 * @return array
	 */
	public function get_groups() {
		$groups = array(
			array(
				'id'   => 'actions',
				'name' => 'Actions',
			),
			array(
				'id'   => 'media-player',
				'name' => 'Media Player',
			),
			array(
				'id'   => 'meta',
				'name' => 'Meta',
			),
			array(
				'id'   => 'misc',
				'name' => 'Misc.',
			),
			array(
				'id'   => 'places',
				'name' => 'Places',
			),
			array(
				'id'   => 'post-formats',
				'name' => 'Post Formats',
			),
			array(
				'id'   => 'text-editor',
				'name' => 'Text Editor',
			),
			array(
				'id'   => 'social',
				'name' => 'Social',
			),
		);

		/**
		 * Filter genericon groups
		 *
		 * @since 0.1.0
		 * @param array $groups Icon groups.
		 */
		$groups = apply_filters( 'icon_picker_genericon_groups', $groups );

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
				'group' => 'actions',
				'id'    => 'genericon-checkmark',
				'name'  => 'Checkmark',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-close',
				'name'  => 'Close',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-close-alt',
				'name'  => 'Close',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-dropdown',
				'name'  => 'Dropdown',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-dropdown-left',
				'name'  => 'Dropdown left',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-collapse',
				'name'  => 'Collapse',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-expand',
				'name'  => 'Expand',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-help',
				'name'  => 'Help',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-info',
				'name'  => 'Info',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-lock',
				'name'  => 'Lock',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-maximize',
				'name'  => 'Maximize',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-minimize',
				'name'  => 'Minimize',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-plus',
				'name'  => 'Plus',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-minus',
				'name'  => 'Minus',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-previous',
				'name'  => 'Previous',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-next',
				'name'  => 'Next',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-move',
				'name'  => 'Move',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-hide',
				'name'  => 'Hide',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-show',
				'name'  => 'Show',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-print',
				'name'  => 'Print',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-rating-empty',
				'name'  => 'Rating: Empty',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-rating-half',
				'name'  => 'Rating: Half',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-rating-full',
				'name'  => 'Rating: Full',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-refresh',
				'name'  => 'Refresh',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-reply',
				'name'  => 'Reply',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-reply-alt',
				'name'  => 'Reply alt',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-reply-single',
				'name'  => 'Reply single',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-search',
				'name'  => 'Search',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-send-to-phone',
				'name'  => 'Send to',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-send-to-tablet',
				'name'  => 'Send to',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-share',
				'name'  => 'Share',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-shuffle',
				'name'  => 'Shuffle',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-spam',
				'name'  => 'Spam',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-subscribe',
				'name'  => 'Subscribe',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-subscribed',
				'name'  => 'Subscribed',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-unsubscribe',
				'name'  => 'Unsubscribe',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-top',
				'name'  => 'Top',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-unapprove',
				'name'  => 'Unapprove',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-zoom',
				'name'  => 'Zoom',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-unzoom',
				'name'  => 'Unzoom',
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-xpost',
				'name'  => 'X-Post',
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-skip-back',
				'name'  => 'Skip back',
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-rewind',
				'name'  => 'Rewind',
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-play',
				'name'  => 'Play',
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-pause',
				'name'  => 'Pause',
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-stop',
				'name'  => 'Stop',
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-fastforward',
				'name'  => 'Fast Forward',
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-skip-ahead',
				'name'  => 'Skip ahead',
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-comment',
				'name'  => 'Comment',
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-category',
				'name'  => 'Category',
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-hierarchy',
				'name'  => 'Hierarchy',
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-tag',
				'name'  => 'Tag',
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-time',
				'name'  => 'Time',
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-user',
				'name'  => 'User',
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-day',
				'name'  => 'Day',
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-week',
				'name'  => 'Week',
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-month',
				'name'  => 'Month',
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-pinned',
				'name'  => 'Pinned',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-uparrow',
				'name'  => 'Arrow Up',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-downarrow',
				'name'  => 'Arrow Down',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-leftarrow',
				'name'  => 'Arrow Left',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-rightarrow',
				'name'  => 'Arrow Right',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-activity',
				'name'  => 'Activity',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-bug',
				'name'  => 'Bug',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-book',
				'name'  => 'Book',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-cart',
				'name'  => 'Cart',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-cloud-download',
				'name'  => 'Cloud Download',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-cloud-upload',
				'name'  => 'Cloud Upload',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-cog',
				'name'  => 'Cog',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-document',
				'name'  => 'Document',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-dot',
				'name'  => 'Dot',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-download',
				'name'  => 'Download',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-draggable',
				'name'  => 'Draggable',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-ellipsis',
				'name'  => 'Ellipsis',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-external',
				'name'  => 'External',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-feed',
				'name'  => 'Feed',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-flag',
				'name'  => 'Flag',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-fullscreen',
				'name'  => 'Fullscreen',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-handset',
				'name'  => 'Handset',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-heart',
				'name'  => 'Heart',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-key',
				'name'  => 'Key',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-mail',
				'name'  => 'Mail',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-menu',
				'name'  => 'Menu',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-microphone',
				'name'  => 'Microphone',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-notice',
				'name'  => 'Notice',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-paintbrush',
				'name'  => 'Paint Brush',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-phone',
				'name'  => 'Phone',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-picture',
				'name'  => 'Picture',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-plugin',
				'name'  => 'Plugin',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-portfolio',
				'name'  => 'Portfolio',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-star',
				'name'  => 'Star',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-summary',
				'name'  => 'Summary',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-tablet',
				'name'  => 'Tablet',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-videocamera',
				'name'  => 'Video Camera',
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-warning',
				'name'  => 'Warning',
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-404',
				'name'  => '404',
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-trash',
				'name'  => 'Trash',
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-cloud',
				'name'  => 'Cloud',
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-home',
				'name'  => 'Home',
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-location',
				'name'  => 'Location',
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-sitemap',
				'name'  => 'Sitemap',
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-website',
				'name'  => 'Website',
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-standard',
				'name'  => 'Standard',
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-aside',
				'name'  => 'Aside',
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-image',
				'name'  => 'Image',
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-gallery',
				'name'  => 'Gallery',
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-video',
				'name'  => 'Video',
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-status',
				'name'  => 'Status',
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-quote',
				'name'  => 'Quote',
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-link',
				'name'  => 'Link',
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-chat',
				'name'  => 'Chat',
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-audio',
				'name'  => 'Audio',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'genericon-anchor',
				'name'  => 'Anchor',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'genericon-attachment',
				'name'  => 'Attachment',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'genericon-edit',
				'name'  => 'Edit',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'genericon-code',
				'name'  => 'Code',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'genericon-bold',
				'name'  => 'Bold',
			),
			array(
				'group' => 'text-editor',
				'id'    => 'genericon-italic',
				'name'  => 'Italic',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-codepen',
				'name'  => 'CodePen',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-digg',
				'name'  => 'Digg',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-dribbble',
				'name'  => 'Dribbble',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-dropbox',
				'name'  => 'DropBox',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-facebook',
				'name'  => 'Facebook',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-facebook-alt',
				'name'  => 'Facebook',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-flickr',
				'name'  => 'Flickr',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-foursquare',
				'name'  => 'Foursquare',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-github',
				'name'  => 'GitHub',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-googleplus',
				'name'  => 'Google+',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-googleplus-alt',
				'name'  => 'Google+',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-instagram',
				'name'  => 'Instagram',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-linkedin',
				'name'  => 'LinkedIn',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-linkedin-alt',
				'name'  => 'LinkedIn',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-path',
				'name'  => 'Path',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-pinterest',
				'name'  => 'Pinterest',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-pinterest-alt',
				'name'  => 'Pinterest',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-pocket',
				'name'  => 'Pocket',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-polldaddy',
				'name'  => 'PollDaddy',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-reddit',
				'name'  => 'Reddit',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-skype',
				'name'  => 'Skype',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-spotify',
				'name'  => 'Spotify',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-stumbleupon',
				'name'  => 'StumbleUpon',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-tumblr',
				'name'  => 'Tumblr',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-twitch',
				'name'  => 'Twitch',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-twitter',
				'name'  => 'Twitter',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-vimeo',
				'name'  => 'Vimeo',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-wordpress',
				'name'  => 'WordPress',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-youtube',
				'name'  => 'Youtube',
			),
		);

		/**
		 * Filter genericon items
		 *
		 * @since 0.1.0
		 * @param array $items Icon names.
		 */
		$items = apply_filters( 'icon_picker_genericon_items', $items );

		return $items;
	}
}
