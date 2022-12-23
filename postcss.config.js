const postcssPlugins = require( '@wordpress/postcss-plugins-preset' );

module.exports = ( ctx ) => {
	const isDevelopment = ( 'development' === ctx.env );
	const isSCSS = ( '.scss' === ctx.file.extname );

	return {
		map: { inline: isDevelopment },
		parser: isSCSS ? 'postcss-scss' : false,
		plugins: [
			...( isSCSS ? [ require( '@csstools/postcss-sass' ) ] : [] ),
			...postcssPlugins
		]
	};
};
