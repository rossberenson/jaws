const path = require('path');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const { getWebpackEntryPoints } = require('@wordpress/scripts/utils/config');
const CopyPlugin = require('copy-webpack-plugin');
const SVGSpritemapPlugin = require('svg-spritemap-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const ESLintPlugin = require('eslint-webpack-plugin');
const globImporter = require('node-sass-glob-importer-plus');
const BlockJsonVersionPlugin = require('./config/utils/block-versioning');

// Remove @wordpress/scrips default sass rule. We want globbing so it's easier to remove and to create our own rule vs modifying the default.
defaultConfig.module.rules = defaultConfig.module.rules.map((obj) => {
	// Remove the
	if (obj.test && obj.test.toString() !== '/\\.(sc|sa)ss$/') {
		return obj;
	}
	return null; // If the object is not found
});
const config = {
	...defaultConfig,
	entry: {
		...getWebpackEntryPoints(),
		index: './src/index.js',
		critical: './src/critical.js',
		admin: './src/admin.js',
	},
	module: {
		...defaultConfig.module,
		rules: [
			...defaultConfig.module.rules,
			{
				test: /\.(j|t)sx?$/,
				exclude: /node_modules/,
				use: [
					{
						loader: 'babel-loader',
						options: {
							presets: [
								'@wordpress/babel-preset-default',
								'@babel/preset-react',
								'@babel/preset-env',
							],
						},
					},
				],
			},
			// {
			// 	test: /\.(webp|png|jpe?g|gif)$/,
			// 	type: 'asset/resource',
			// 	generator: {
			// 		filename: 'images/[name][ext]',
			// 	},
			// },
			{
				test: /\.(sc|sa)ss$/,
				exclude: '/node_modules',
				use: [
					MiniCssExtractPlugin.loader,
					'css-loader',
					'postcss-loader',
					'svg-transform-loader/encode-query',
					{
						loader: 'sass-loader',
						options: {
							sourceMap: true,
							sassOptions: {
								importer: globImporter(),
							},
						},
					},
				],
			},
			{
				test: /\.svg$/,
				issuer: /\.(sc|sa|c)ss$/,
				type: 'asset/inline',
				use: 'svg-transform-loader',
			},
			// {
			// 	test: /\.(woff|woff2|eot|ttf|otf)$/,
			// 	type: 'asset/resource',
			// 	generator: {
			// 		filename: 'fonts/[name][ext]',
			// 	},
			// },
		],
	},
	stats: 'minimal',
	plugins: [
		...defaultConfig.plugins,

		new MiniCssExtractPlugin(),

		/**
		 * Copy source files/directories to a build directory.
		 *
		 * @see https://www.npmjs.com/package/copy-webpack-plugin
		 */
		new CopyPlugin({
			patterns: [
				{
					from: '**/*.{jpg,jpeg,png,gif,svg}',
					to: 'images/[path][name][ext]',
					context: path.resolve(process.cwd(), 'src/images'),
					noErrorOnMissing: true,
				},
				{
					from: '*.svg',
					to: 'images/icons/[name][ext]',
					context: path.resolve(process.cwd(), 'src/images/icons'),
					noErrorOnMissing: true,
				},
				{
					from: '**/*.{woff,woff2,eot,ttf,otf}',
					to: 'fonts/[path][name][ext]',
					context: path.resolve(process.cwd(), 'src/fonts'),
					noErrorOnMissing: true,
				},
			],
		}),

		/**
		 * Generate an SVG sprite.
		 *
		 * @see https://github.com/cascornelissen/svg-spritemap-webpack-plugin
		 */
		new SVGSpritemapPlugin('src/images/icons/*.svg', {
			output: {
				filename: 'images/icons/sprite.svg',
			},
			sprite: {
				prefix: false,
			},
		}),

		/**
		 * Clean build directory.
		 *
		 * @see https://www.npmjs.com/package/clean-webpack-plugin
		 */
		// new CleanWebpackPlugin(),

		/**
		 * Report JS warnings and errors to the command line.
		 *
		 * @see https://www.npmjs.com/package/eslint-webpack-plugin
		 */
		new ESLintPlugin(),

		/**
		 * Report css warnings and errors to the command line.
		 *
		 * @see https://www.npmjs.com/package/stylelint-webpack-plugin
		 */
		// new StylelintPlugin(),

		/**
		 * Version blocks for cache busting
		 *
		 */
		new BlockJsonVersionPlugin(),
	],
};

module.exports = config;
