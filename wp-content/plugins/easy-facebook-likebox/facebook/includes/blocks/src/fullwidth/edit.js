/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { useBlockProps,
	InspectorControls
} from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';
import {
	Button,
	RadioControl,
	PanelBody,
	PanelRow,
	Spinner,
	TextControl,
	ToggleControl,
	SelectControl,
	Notice
} from '@wordpress/components';
import { useState,
	useEffect,
	useRef
} from '@wordpress/element';


/**
 * Internal dependencies
 */
import './editor.scss';
import ConnectAccount from '../components/ConnectAccount';

/**
 * The Edit component for your block.
 *
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @param {Object} props The props object.
 * @param {Object} props.attributes The attributes object.
 * @param {function} props.setAttributes A function to update attributes.
 *
 * @return {WPElement} Element to render.
 */
export default function Edit({ attributes, setAttributes }) {
	// Destructure the fan page id from attributes
	const { fanpage_id: fanPageId, filter, album_id: albumId, type } = attributes;

	// Fetch adminUrl from the global esfFBBlockData
	const adminUrl = esfFBBlockData.adminUrl;

	// Use a state hook to hold the selected page value
	const [selectedPage, setSelectedPage] = useState(fanPageId);
	const [selectedAlbum, setSelectedAlbum] = useState(albumId);
	const [isAlbumChanged, setIsAlbumChanged] = useState(false);

	// Hold the album options
	const [albumOptions, setAlbumOptions] = useState([]);

	useEffect(() => {
		// Function to fetch the albums of the selected fan page
		const fetchAlbums = async () => {
			if (selectedPage && type !== 'group') {
				try {
					const response = await fetch(esfFBBlockData.ajax_url, {
						method: 'POST',
						headers: {
							'Content-Type': 'application/x-www-form-urlencoded',
						},
						body: new URLSearchParams({
							action: 'efbl_get_albums_list',
							page_id: selectedPage,
							efbl_nonce: esfFBBlockData.nonce,
							is_block: true,
						}),
					});

					const { success, data } = await response.json();
					if (success && Array.isArray(data)) {
						setAlbumOptions(
								data.map((album) => ({
									label: album.name,
									value: album.id,
								}))
						);
					} else {
						console.error('Error retrieving album list');
					}
				} catch (error) {
					console.error(error);
				}
			} else {
				setAlbumOptions([]);
			}
		};

		fetchAlbums();
	}, [selectedPage]);


	const handleAlbumChange = (newValue) => {
		setSelectedAlbum(newValue);
		setIsAlbumChanged(true);
		if (newValue === 'none') {
			setAttributes({ album_id: '' });
		} else {
			setAttributes({ album_id: newValue });
		}
	};

	/**
	 * An event handler for radio button selection changes
	 *
	 * @param {string} newValue The new selected value.
	 */
	const handleRadioChange = (newValue) => {
		setSelectedPage(newValue);
	};

	/**
	 * An event handler for the Display button click.
	 *
	 * Updates the fanpage_id attribute with the currently selected page.
	 */
	const handleDisplayButtonClick = () => {
		setAttributes({ fanpage_id: selectedPage, album_id: selectedAlbum });
		setIsAlbumChanged(false);
	};

	// Additional handler for disconnect button
	const handleDisconnectButtonClick = () => {
		setSelectedPage(null);
		setAttributes({ fanpage_id: null, filter: '', album_id: '', type: '' });
	};

	// Compute radio options if esfFBBlockData.pages exists and is an object
	const radioOptions = esfFBBlockData && esfFBBlockData.pages && typeof esfFBBlockData.pages === 'object'
			? Object.entries(esfFBBlockData.pages).map(([id, pageData]) => ({
				label: pageData.name,
				value: id
			}))
			: [];

	// Compute radio options if esfFBBlockData.groups exists and is an object
	const groupsOptions = esfFBBlockData && esfFBBlockData.groups && typeof esfFBBlockData.groups === 'object'
			? Object.entries(esfFBBlockData.groups).map(([id, pageData]) => ({
				label: pageData.name,
				value: id
			}))
			: [];

	// If fan page id is already selected, simply render the block from php
	if ( fanPageId ) {
		let selectedAccountName;
		if( type === 'page' || type === '' ) {
			selectedAccountName = esfFBBlockData.pages[fanPageId].name
		} else {
			selectedAccountName = esfFBBlockData.groups[fanPageId].id;
		}

		return (
				<div { ...useBlockProps() }>
					<InspectorControls>
						<PanelBody title={__('Account Settings', 'easy-facebook-likebox')} initialOpen={true}>
							<PanelRow>
								<span>{ __('Account', 'easy-facebook-likebox') }</span>
								<span>{selectedAccountName}</span>
							</PanelRow>
							<PanelRow>
								<Button
										isSecondary
										onClick={handleDisconnectButtonClick}
								>
									{ __('Reset', 'easy-facebook-likebox') }
								</Button>
							</PanelRow>
						</PanelBody>
						<PanelBody title={__('Display Settings', 'easy-facebook-likebox')} initialOpen={true}>

							{type === 'page' && (
								<SelectControl
										label={__("Filter", "easy-facebook-likebox")}
										value={filter}
										options={[
											{ label: __("None", "easy-facebook-likebox"), value: "" },
											{ label: __("Images", "easy-facebook-likebox"), value: "images" },
											{ label: __("Videos", "easy-facebook-likebox"), value: "videos" },
											{ label: __("Events", "easy-facebook-likebox"), value: "events" },
											{ label: __("Albums", "easy-facebook-likebox"), value: "albums" },
											{ label: __("Mentioned", "easy-facebook-likebox"), value: "mentioned" },
										]}
										onChange={(value) => {
											setAttributes({ filter: value });
										}}
								/>
							)}
							{filter === 'events' && (
									<div>
										<Notice status="info" isDismissible={false}>
											<p>
												{ __("Due to recent changes by Facebook in the API. You need to create your own application in order to display events on your site.", "easy-facebook-likebox") }
											</p>
											<p>
												<a href="https://easysocialfeed.com/custom-facebook-feed/page-token/" target="_blank" rel="noopener noreferrer">
													{ __("Please follow the steps in this guide", "easy-facebook-likebox") }
												</a>
											</p>
											<p>
												{ __(" to create the application. Note: It is required only to display events.", "easy-facebook-likebox") }
											</p>
										</Notice>
										<SelectControl
												label={__("Events Filter", "easy-facebook-likebox")}
												value={attributes.events_filter}
												options={[
													{ label: __("Upcoming", "easy-facebook-likebox"), value: "upcoming" },
													{ label: __("Past", "easy-facebook-likebox"), value: "past" },
													{ label: __("All", "easy-facebook-likebox"), value: "all" },
												]}
												onChange={(value) => {
													setAttributes({ events_filter: value });
												}}
										/>
									</div>
							)}
							{filter === 'albums' && (
									<SelectControl
											label={__("Album", "easy-facebook-likebox")}
											value={selectedAlbum}
											options={[
												{ label: __("None", "easy-facebook-likebox"), value: "none" },
												...albumOptions,
											]}
											onChange={handleAlbumChange}
									/>
							)}
							<TextControl
									label={__('Words Limit', 'easy-facebook-likebox')}
									type="number"
									min="1"
									value={attributes.words_limit || ''}
									onChange={(value) => setAttributes({ words_limit: parseInt(value, 10) })}
							/>
							<ToggleControl
									label={__('Open links in new tab', 'easy-facebook-likebox')}
									checked={attributes.links_new_tab}
									onChange={(value) => setAttributes({ links_new_tab: value ? 1 : 0 })}
							/>
							<TextControl
									label={__('Post Limit', 'easy-facebook-likebox')}
									type="number"
									min="1"
									value={attributes.post_limit || ''}
									onChange={(value) => setAttributes({ post_limit: parseInt(value, 10) })}
							/>
							<TextControl
									label={__('Cache Unit', 'easy-facebook-likebox')}
									type="number"
									min="1"
									value={attributes.cache_unit || ''}
									onChange={(value) => setAttributes({ cache_unit: parseInt(value, 10) })}
							/>
							<SelectControl
									label={__('Cache Duration', 'easy-facebook-likebox')}
									value={attributes.cache_duration}
									options={[
										{ value: 'minutes', label: __('Minutes', 'easy-facebook-likebox') },
										{ value: 'hours', label: __('Hours', 'easy-facebook-likebox') },
										{ value: 'days', label: __('Days', 'easy-facebook-likebox') },
									]}
									onChange={(value) => setAttributes({ cache_duration: value })}
							/>
							{type === 'page' && (
								<ToggleControl
										label={__('Show Likebox', 'easy-facebook-likebox')}
										checked={attributes.show_like_box}
										onChange={(value) => setAttributes({ show_like_box: value ? 1 : 0 })}
								/>
							)}
							<PanelRow>
								<h2>
									{ __("Upgrade to unlock following blocks", "easy-facebook-likebox") }
								</h2>
							</PanelRow>
							<PanelRow>
								<ol>
									<li>
										{ __("Carousel", "easy-facebook-likebox") }
									</li>
									<li>
										{ __("Masonry", "easy-facebook-likebox") }
									</li>
									<li>
										{ __("Grid", "easy-facebook-likebox") }
									</li>
								</ol>
							</PanelRow>
							<PanelRow>
								<a href="/wp-admin/admin.php?page=feed-them-all-pricing" className="button button-primary" target="_blank" rel="noopener noreferrer">
									{ __("Upgrade Now", "easy-facebook-likebox") }
								</a>
							</PanelRow>
						</PanelBody>
					</InspectorControls>
						<ServerSideRender
								block="esf-fb/fullwidth"
								attributes={attributes}
								EmptyResponsePlaceholder={ () => <Spinner /> }
						/>
				</div>
		);
	}
	// Render the block editor interface for selecting a page and displaying the block
	else {
		return (
				<div { ...useBlockProps() }>
					<div className="components-placeholder is-large">
						<div className="components-placeholder__label esf-fb-block-header">
							<span className="dashicon dashicons dashicons-facebook"></span>
							{ __('ESF Facebook Halfwidth', 'easy-facebook-likebox') }
						</div>
						{ esfFBBlockData && ( esfFBBlockData.pages || esfFBBlockData.groups ) ? (

								<fieldset className="components-placeholder__fieldset">
									<div className="esf-fb-select-pages">
										{ type === '' && (
												<RadioControl
														label={ __('Select Type', 'easy-facebook-likebox') }
														selected={type}
														options={[
															{ label: __('Page', 'easy-facebook-likebox'), value: 'page' },
															{ label: __('Group', 'easy-facebook-likebox'), value: 'group' },
														]}
														onChange={(value) => {
															setAttributes({ type: value });
														}}
												/>
										)}

										{ esfFBBlockData.pages && type === 'page' && (
											<RadioControl
													label={ __('Select Page', 'easy-facebook-likebox') }
													selected={selectedPage}
													options={radioOptions}
													onChange={handleRadioChange}
											/>
										)}

										{ esfFBBlockData.groups && type === 'group' && (
												<RadioControl
														label={ __('Select Group', 'easy-facebook-likebox') }
														selected={selectedPage}
														options={groupsOptions}
														onChange={handleRadioChange}
												/>
										)}
										<div>
											<Button
													isPrimary
													onClick={handleDisplayButtonClick}
											>
												{ __('Display', 'easy-facebook-likebox') }
											</Button>
											<Button
													isSecondary
													onClick={handleDisconnectButtonClick}
											>
												{ __('Reset', 'easy-facebook-likebox') }
											</Button>
										</div>

									</div>
								</fieldset>
						) : (
								<ConnectAccount adminUrl={adminUrl} />
						)}
					</div>
				</div>
		);
	}
}
