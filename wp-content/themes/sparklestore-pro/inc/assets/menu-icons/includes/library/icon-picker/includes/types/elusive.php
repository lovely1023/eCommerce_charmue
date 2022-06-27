<?php
/**
 * Elusive Icons
 *
 * @package Icon_Picker
 * @author  Dzikri Aziz <kvcrvt@gmail.com>
 */
class Icon_Picker_Type_Elusive extends Icon_Picker_Type_Font {

	/**
	 * Icon type ID
	 *
	 * @since  0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $id = 'elusive';

	/**
	 * Icon type name
	 *
	 * @since  0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $name = 'Elusive';

	/**
	 * Icon type version
	 *
	 * @since  0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $version = '2.0';


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
				'id'   => 'currency',
				'name' => 'Currency',
			),
			array(
				'id'   => 'media',
				'name' => 'Media',
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
				'id'    => 'el-icon-adjust',
				'name'  => 'Adjust',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-adjust-alt',
				'name'  => 'Adjust',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-align-left',
				'name'  => 'Align Left',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-align-center',
				'name'  => 'Align Center',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-align-right',
				'name'  => 'Align Right',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-align-justify',
				'name'  => 'Justify',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-arrow-up',
				'name'  => 'Arrow Up',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-arrow-down',
				'name'  => 'Arrow Down',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-arrow-left',
				'name'  => 'Arrow Left',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-arrow-right',
				'name'  => 'Arrow Right',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-fast-backward',
				'name'  => 'Fast Backward',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-step-backward',
				'name'  => 'Step Backward',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-backward',
				'name'  => 'Backward',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-forward',
				'name'  => 'Forward',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-forward-alt',
				'name'  => 'Forward',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-step-forward',
				'name'  => 'Step Forward',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-fast-forward',
				'name'  => 'Fast Forward',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-bold',
				'name'  => 'Bold',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-italic',
				'name'  => 'Italic',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-link',
				'name'  => 'Link',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-caret-up',
				'name'  => 'Caret Up',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-caret-down',
				'name'  => 'Caret Down',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-caret-left',
				'name'  => 'Caret Left',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-caret-right',
				'name'  => 'Caret Right',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-check',
				'name'  => 'Check',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-check-empty',
				'name'  => 'Check Empty',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-chevron-up',
				'name'  => 'Chevron Up',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-chevron-down',
				'name'  => 'Chevron Down',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-chevron-left',
				'name'  => 'Chevron Left',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-chevron-right',
				'name'  => 'Chevron Right',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-circle-arrow-up',
				'name'  => 'Circle Arrow Up',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-circle-arrow-down',
				'name'  => 'Circle Arrow Down',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-circle-arrow-left',
				'name'  => 'Circle Arrow Left',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-circle-arrow-right',
				'name'  => 'Circle Arrow Right',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-download',
				'name'  => 'Download',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-download-alt',
				'name'  => 'Download',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-edit',
				'name'  => 'Edit',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-eject',
				'name'  => 'Eject',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-file-new',
				'name'  => 'File New',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-file-new-alt',
				'name'  => 'File New',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-file-edit',
				'name'  => 'File Edit',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-file-edit-alt',
				'name'  => 'File Edit',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-fork',
				'name'  => 'Fork',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-fullscreen',
				'name'  => 'Fullscreen',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-indent-left',
				'name'  => 'Indent Left',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-indent-right',
				'name'  => 'Indent Right',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-list',
				'name'  => 'List',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-list-alt',
				'name'  => 'List',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-lock',
				'name'  => 'Lock',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-lock-alt',
				'name'  => 'Lock',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-unlock',
				'name'  => 'Unlock',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-unlock-alt',
				'name'  => 'Unlock',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-map-marker',
				'name'  => 'Map Marker',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-map-marker-alt',
				'name'  => 'Map Marker',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-minus',
				'name'  => 'Minus',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-minus-sign',
				'name'  => 'Minus Sign',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-move',
				'name'  => 'Move',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-off',
				'name'  => 'Off',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-ok',
				'name'  => 'OK',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-ok-circle',
				'name'  => 'OK Circle',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-ok-sign',
				'name'  => 'OK Sign',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-play',
				'name'  => 'Play',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-play-alt',
				'name'  => 'Play',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-pause',
				'name'  => 'Pause',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-pause-alt',
				'name'  => 'Pause',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-stop',
				'name'  => 'Stop',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-stop-alt',
				'name'  => 'Stop',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-plus',
				'name'  => 'Plus',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-plus-sign',
				'name'  => 'Plus Sign',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-print',
				'name'  => 'Print',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-question',
				'name'  => 'Question',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-question-sign',
				'name'  => 'Question Sign',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-record',
				'name'  => 'Record',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-refresh',
				'name'  => 'Refresh',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-remove',
				'name'  => 'Remove',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-repeat',
				'name'  => 'Repeat',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-repeat-alt',
				'name'  => 'Repeat',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-resize-vertical',
				'name'  => 'Resize Vertical',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-resize-horizontal',
				'name'  => 'Resize Horizontal',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-resize-full',
				'name'  => 'Resize Full',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-resize-small',
				'name'  => 'Resize Small',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-return-key',
				'name'  => 'Return',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-retweet',
				'name'  => 'Retweet',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-reverse-alt',
				'name'  => 'Reverse',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-search',
				'name'  => 'Search',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-search-alt',
				'name'  => 'Search',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-share',
				'name'  => 'Share',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-share-alt',
				'name'  => 'Share',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-tag',
				'name'  => 'Tag',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-tasks',
				'name'  => 'Tasks',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-text-height',
				'name'  => 'Text Height',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-text-width',
				'name'  => 'Text Width',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-thumbs-up',
				'name'  => 'Thumbs Up',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-thumbs-down',
				'name'  => 'Thumbs Down',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-tint',
				'name'  => 'Tint',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-trash',
				'name'  => 'Trash',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-trash-alt',
				'name'  => 'Trash',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-upload',
				'name'  => 'Upload',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-view-mode',
				'name'  => 'View Mode',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-volume-up',
				'name'  => 'Volume Up',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-volume-down',
				'name'  => 'Volume Down',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-volume-off',
				'name'  => 'Mute',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-warning-sign',
				'name'  => 'Warning Sign',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-zoom-in',
				'name'  => 'Zoom In',
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-zoom-out',
				'name'  => 'Zoom Out',
			),
			array(
				'group' => 'currency',
				'id'    => 'el-icon-eur',
				'name'  => 'EUR',
			),
			array(
				'group' => 'currency',
				'id'    => 'el-icon-gbp',
				'name'  => 'GBP',
			),
			array(
				'group' => 'currency',
				'id'    => 'el-icon-usd',
				'name'  => 'USD',
			),
			array(
				'group' => 'media',
				'id'    => 'el-icon-video',
				'name'  => 'Video',
			),
			array(
				'group' => 'media',
				'id'    => 'el-icon-video-alt',
				'name'  => 'Video',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-adult',
				'name'  => 'Adult',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-address-book',
				'name'  => 'Address Book',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-address-book-alt',
				'name'  => 'Address Book',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-asl',
				'name'  => 'ASL',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-asterisk',
				'name'  => 'Asterisk',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-ban-circle',
				'name'  => 'Ban Circle',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-barcode',
				'name'  => 'Barcode',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-bell',
				'name'  => 'Bell',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-blind',
				'name'  => 'Blind',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-book',
				'name'  => 'Book',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-braille',
				'name'  => 'Braille',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-briefcase',
				'name'  => 'Briefcase',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-broom',
				'name'  => 'Broom',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-brush',
				'name'  => 'Brush',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-bulb',
				'name'  => 'Bulb',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-bullhorn',
				'name'  => 'Bullhorn',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-calendar',
				'name'  => 'Calendar',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-calendar-sign',
				'name'  => 'Calendar Sign',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-camera',
				'name'  => 'Camera',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-car',
				'name'  => 'Car',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-cc',
				'name'  => 'CC',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-certificate',
				'name'  => 'Certificate',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-child',
				'name'  => 'Child',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-cog',
				'name'  => 'Cog',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-cog-alt',
				'name'  => 'Cog',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-cogs',
				'name'  => 'Cogs',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-comment',
				'name'  => 'Comment',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-comment-alt',
				'name'  => 'Comment',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-compass',
				'name'  => 'Compass',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-compass-alt',
				'name'  => 'Compass',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-credit-card',
				'name'  => 'Credit Card',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-css',
				'name'  => 'CSS',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-envelope',
				'name'  => 'Envelope',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-envelope-alt',
				'name'  => 'Envelope',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-error',
				'name'  => 'Error',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-error-alt',
				'name'  => 'Error',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-exclamation-sign',
				'name'  => 'Exclamation Sign',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-eye-close',
				'name'  => 'Eye Close',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-eye-open',
				'name'  => 'Eye Open',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-male',
				'name'  => 'Male',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-female',
				'name'  => 'Female',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-file',
				'name'  => 'File',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-file-alt',
				'name'  => 'File',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-film',
				'name'  => 'Film',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-filter',
				'name'  => 'Filter',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-fire',
				'name'  => 'Fire',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-flag',
				'name'  => 'Flag',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-flag-alt',
				'name'  => 'Flag',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-folder',
				'name'  => 'Folder',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-folder-open',
				'name'  => 'Folder Open',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-folder-close',
				'name'  => 'Folder Close',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-folder-sign',
				'name'  => 'Folder Sign',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-font',
				'name'  => 'Font',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-fontsize',
				'name'  => 'Font Size',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-gift',
				'name'  => 'Gift',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-glass',
				'name'  => 'Glass',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-glasses',
				'name'  => 'Glasses',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-globe',
				'name'  => 'Globe',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-globe-alt',
				'name'  => 'Globe',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-graph',
				'name'  => 'Graph',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-graph-alt',
				'name'  => 'Graph',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-group',
				'name'  => 'Group',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-group-alt',
				'name'  => 'Group',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-guidedog',
				'name'  => 'Guide Dog',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-hand-up',
				'name'  => 'Hand Up',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-hand-down',
				'name'  => 'Hand Down',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-hand-left',
				'name'  => 'Hand Left',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-hand-right',
				'name'  => 'Hand Right',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-hdd',
				'name'  => 'HDD',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-headphones',
				'name'  => 'Headphones',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-hearing-impaired',
				'name'  => 'Hearing Impaired',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-heart',
				'name'  => 'Heart',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-heart-alt',
				'name'  => 'Heart',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-heart-empty',
				'name'  => 'Heart Empty',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-hourglass',
				'name'  => 'Hourglass',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-idea',
				'name'  => 'Idea',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-idea-alt',
				'name'  => 'Idea',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-inbox',
				'name'  => 'Inbox',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-inbox-alt',
				'name'  => 'Inbox',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-inbox-box',
				'name'  => 'Inbox',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-info-sign',
				'name'  => 'Info',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-key',
				'name'  => 'Key',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-laptop',
				'name'  => 'Laptop',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-laptop-alt',
				'name'  => 'Laptop',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-leaf',
				'name'  => 'Leaf',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-lines',
				'name'  => 'Lines',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-magic',
				'name'  => 'Magic',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-magnet',
				'name'  => 'Magnet',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-mic',
				'name'  => 'Mic',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-music',
				'name'  => 'Music',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-paper-clip',
				'name'  => 'Paper Clip',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-paper-clip-alt',
				'name'  => 'Paper Clip',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-pencil',
				'name'  => 'Pencil',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-pencil-alt',
				'name'  => 'Pencil',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-person',
				'name'  => 'Person',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-phone',
				'name'  => 'Phone',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-phone-alt',
				'name'  => 'Phone',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-photo',
				'name'  => 'Photo',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-photo-alt',
				'name'  => 'Photo',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-picture',
				'name'  => 'Picture',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-plane',
				'name'  => 'Plane',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-podcast',
				'name'  => 'Podcast',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-puzzle',
				'name'  => 'Puzzle',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-qrcode',
				'name'  => 'QR Code',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-quotes',
				'name'  => 'Quotes',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-quotes-alt',
				'name'  => 'Quotes',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-random',
				'name'  => 'Random',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-scissors',
				'name'  => 'Scissors',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-screen',
				'name'  => 'Screen',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-screen-alt',
				'name'  => 'Screen',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-screenshot',
				'name'  => 'Screenshot',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-shopping-cart',
				'name'  => 'Shopping Cart',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-shopping-cart-sign',
				'name'  => 'Shopping Cart Sign',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-signal',
				'name'  => 'Signal',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-smiley',
				'name'  => 'Smiley',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-smiley-alt',
				'name'  => 'Smiley',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-speaker',
				'name'  => 'Speaker',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-user',
				'name'  => 'User',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-th',
				'name'  => 'Thumbnails',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-th-large',
				'name'  => 'Thumbnails (Large)',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-th-list',
				'name'  => 'Thumbnails (List)',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-time',
				'name'  => 'Time',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-time-alt',
				'name'  => 'Time',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-torso',
				'name'  => 'Torso',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-wheelchair',
				'name'  => 'Wheelchair',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-wrench',
				'name'  => 'Wrench',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-wrench-alt',
				'name'  => 'Wrench',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-universal-access',
				'name'  => 'Universal Access',
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-bookmark',
				'name'  => 'Bookmark',
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-bookmark-empty',
				'name'  => 'Bookmark Empty',
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-dashboard',
				'name'  => 'Dashboard',
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-home',
				'name'  => 'Home',
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-home-alt',
				'name'  => 'Home',
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-iphone-home',
				'name'  => 'Home (iPhone)',
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-network',
				'name'  => 'Network',
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-tags',
				'name'  => 'Tags',
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-website',
				'name'  => 'Website',
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-website-alt',
				'name'  => 'Website',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-behance',
				'name'  => 'Behance',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-blogger',
				'name'  => 'Blogger',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-cloud',
				'name'  => 'Cloud',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-cloud-alt',
				'name'  => 'Cloud',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-delicious',
				'name'  => 'Delicious',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-deviantart',
				'name'  => 'DeviantArt',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-digg',
				'name'  => 'Digg',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-dribbble',
				'name'  => 'Dribbble',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-facebook',
				'name'  => 'Facebook',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-facetime-video',
				'name'  => 'Facetime Video',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-flickr',
				'name'  => 'Flickr',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-foursquare',
				'name'  => 'Foursquare',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-friendfeed',
				'name'  => 'FriendFeed',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-friendfeed-rect',
				'name'  => 'FriendFeed',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-github',
				'name'  => 'GitHub',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-github-text',
				'name'  => 'GitHub',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-googleplus',
				'name'  => 'Google+',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-instagram',
				'name'  => 'Instagram',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-lastfm',
				'name'  => 'Last.fm',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-linkedin',
				'name'  => 'LinkedIn',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-livejournal',
				'name'  => 'LiveJournal',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-myspace',
				'name'  => 'MySpace',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-opensource',
				'name'  => 'Open Source',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-path',
				'name'  => 'path',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-picasa',
				'name'  => 'Picasa',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-pinterest',
				'name'  => 'Pinterest',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-rss',
				'name'  => 'RSS',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-reddit',
				'name'  => 'Reddit',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-skype',
				'name'  => 'Skype',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-slideshare',
				'name'  => 'Slideshare',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-soundcloud',
				'name'  => 'SoundCloud',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-spotify',
				'name'  => 'Spotify',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-stackoverflow',
				'name'  => 'Stack Overflow',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-stumbleupon',
				'name'  => 'StumbleUpon',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-twitter',
				'name'  => 'Twitter',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-tumblr',
				'name'  => 'Tumblr',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-viadeo',
				'name'  => 'Viadeo',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-vimeo',
				'name'  => 'Vimeo',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-vkontakte',
				'name'  => 'VKontakte',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-w3c',
				'name'  => 'W3C',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-wordpress',
				'name'  => 'WordPress',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-youtube',
				'name'  => 'YouTube',
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
