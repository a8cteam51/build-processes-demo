const postcssPlugins = require( '@wordpress/postcss-plugins-preset' );

module.exports = ( ctx ) => {
	const isDevelopment = ( 'development' === ctx.env );
	const isSass = ( '.scss' === ctx.file.extname );
	const devPostcssPlugins = [
		...( isSass ? [ require( '@csstools/postcss-sass' ) ] : [] ),
		...postcssPlugins
	];

	return {
		map: {
			inline: isDevelopment,
			annotation: true
		},
		parser: isSass ? 'postcss-scss' : false,
		plugins: isDevelopment ? devPostcssPlugins : [
			...devPostcssPlugins,
			require( 'cssnano' )( {
				preset: 'default'
			} )
		]
	};
};
