import { __ } from '@wordpress/i18n';
import { Button } from '@wordpress/components';

export default function ConnectAccount({ adminUrl }) {
	return (
			<fieldset className="components-placeholder__fieldset">
				<div className="esf-fb-no-pages">
        <span className="block-editor-block-card__description">
          {__('No account found, please connect the Facebook account using the following button', 'easy-facebook-likebox')}
        </span>
					<div>
						<Button
								isPrimary
								target="_blank"
								href={`${adminUrl}admin.php?page=easy-facebook-likebox`}
						>
							{__('Connect', 'easy-facebook-likebox')}
						</Button>
					</div>
				</div>
			</fieldset>
	);
}
