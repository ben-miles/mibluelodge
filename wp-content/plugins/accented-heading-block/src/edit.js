/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit( { attributes, setAttributes } ) {
	const { headingNormal, headingAccented } = attributes;
	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Settings', 'accented-heading-block' ) }>
					<TextControl
						label={ __(
							'Heading Normal',
							'accented-heading-block'
						) }
						value={ headingNormal || '' }
						onChange={ ( value ) =>
							setAttributes( { headingNormal: value } )
						}
					/>
					<TextControl
						label={ __(
							'Heading Accent',
							'accented-heading-block'
						) }
						value={ headingAccented || '' }
						onChange={ ( value ) =>
							setAttributes( { headingAccented: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<h3 { ...useBlockProps() }>{ headingNormal }<em>{ headingAccented }</em></h3>
		</>
	);
}
