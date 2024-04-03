wp.blocks.registerBlockType('mibluelodge/officer',{
	title: 'MI Blue Lodge: Officer',
	icon: 'universal-access-alt',
	category: 'common',
	attributes: {
		office: {
			type: 'string',
			default: 'master'
		},
		email: { type: 'string' }
	},
	edit: function(props) {},
	save: function(){
		return null;
	}
})