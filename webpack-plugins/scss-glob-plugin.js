const fs = require('fs');
const path = require('path');
const glob = require('glob');

class ScssGlobPlugin {
	constructor(options = {}) {
		this.options = {
			pattern: 'components/**/*.scss',
			outputFile: 'src/scss/components/_components-auto.scss',
			baseDir: path.resolve(__dirname, '..'),
			...options,
		};
		this.lastGeneratedFiles = null;
		this.isGenerating = false;
	}
	apply(compiler) {
		const pluginName = 'ScssGlobPlugin';

		// Store the output file path for cache invalidation
		const outputPath = path.join(
			this.options.baseDir,
			this.options.outputFile
		);

		// Generate on startup
		compiler.hooks.initialize.tap(pluginName, () => {
			this.generateScssImports();
		});

		// Only regenerate in watch mode when files actually change
		compiler.hooks.watchRun.tapAsync(
			pluginName,
			(watchCompiler, callback) => {
				// Only check for changes, don't always regenerate
				if (this.shouldRegenerate()) {
					this.generateScssImports();
				}
				callback();
			}
		);

		// Hook into the compilation to ensure our generated file is properly tracked
		compiler.hooks.compilation.tap(pluginName, (compilation) => {
			// Add our generated file as a dependency so webpack knows to watch it
			compilation.fileDependencies.add(outputPath);
		});
	}

	shouldRegenerate() {
		if (this.isGenerating) {
			return false;
		}

		const { pattern, baseDir } = this.options;

		try {
			// Debug logging
			// eslint-disable-next-line no-console
			console.log('[ScssGlobPlugin][shouldRegenerate] baseDir:', baseDir);
			// eslint-disable-next-line no-console
			console.log('[ScssGlobPlugin][shouldRegenerate] pattern:', pattern);
			// eslint-disable-next-line no-console
			console.log(
				'[ScssGlobPlugin][shouldRegenerate] fullPattern:',
				pattern
			);

			// Find all SCSS files matching the pattern
			const scssFiles = glob.sync(pattern, {
				cwd: baseDir,
				ignore: ['**/node_modules/**', '**/build/**', '**/vendor/**'],
			});
			// eslint-disable-next-line no-console
			console.log(
				'[ScssGlobPlugin][shouldRegenerate] globbed files:',
				scssFiles
			);

			// Filter out partial files and check existence
			const currentFiles = scssFiles
				.filter((file) => {
					const filename = path.basename(file);
					const exists = fs.existsSync(file);
					return exists && !filename.startsWith('_');
				})
				.sort(); // Sort for consistent comparison

			// eslint-disable-next-line no-console
			console.log(
				'[ScssGlobPlugin][shouldRegenerate] filtered files:',
				currentFiles
			);

			// Compare with last generated files
			const filesChanged =
				!this.lastGeneratedFiles ||
				JSON.stringify(currentFiles) !==
					JSON.stringify(this.lastGeneratedFiles);

			return filesChanged;
		} catch (error) {
			// eslint-disable-next-line no-console
			console.error('Error checking for file changes:', error);
			return true; // Regenerate on error to be safe
		}
	}

	generateScssImports() {
		if (this.isGenerating) {
			return;
		}

		this.isGenerating = true;
		const { pattern, outputFile, baseDir } = this.options;
		const outputPath = path.join(baseDir, outputFile);

		try {
			// Debug logging
			// eslint-disable-next-line no-console
			console.log(
				'[ScssGlobPlugin][generateScssImports] baseDir:',
				baseDir
			);
			// eslint-disable-next-line no-console
			console.log(
				'[ScssGlobPlugin][generateScssImports] pattern:',
				pattern
			);
			// Find all SCSS files matching the pattern
			const scssFiles = glob.sync(pattern, {
				cwd: baseDir,
				ignore: ['**/node_modules/**', '**/build/**', '**/vendor/**'],
			});
			// eslint-disable-next-line no-console
			console.log(
				'[ScssGlobPlugin][generateScssImports] globbed files:',
				scssFiles
			);

			// Filter out partial files (files that start with underscore)
			// and verify that files actually exist
			const filteredFiles = scssFiles.filter((file) => {
				const exists = fs.existsSync(file);
				if (!exists) {
					// eslint-disable-next-line no-console
					console.warn(`SCSS file no longer exists: ${file}`);
					return false;
				}
				const filename = path.basename(file);
				return !filename.startsWith('_');
			});
			// eslint-disable-next-line no-console
			console.log(
				'[ScssGlobPlugin][generateScssImports] filtered files:',
				filteredFiles
			);

			// Store current files for comparison
			this.lastGeneratedFiles = filteredFiles.slice().sort();

			// Generate @use statements
			const imports = filteredFiles
				.map((file) => {
					// Get relative path from the output file to the SCSS file
					const relativePath = path.relative(
						path.dirname(outputPath),
						file
					);
					// Remove .scss extension and convert backslashes to forward slashes
					const importPath = relativePath
						.replace(/\.scss$/, '')
						.replace(/\\/g, '/');
					// Create a namespace from the file path
					const namespace = this.createNamespace(importPath);

					return `@use '${importPath}' as ${namespace};`;
				})
				.join('\n');

			// Add header comment
			const content = `// Auto-generated file - do not edit manually\n// This file is generated by webpack-plugins/scss-glob-plugin.js\n// It automatically imports all SCSS files matching: ${pattern}\n// Generated at: ${new Date().toISOString()}\n\n${imports}\n`;

			// Ensure output directory exists
			const outputDir = path.dirname(outputPath);
			if (!fs.existsSync(outputDir)) {
				fs.mkdirSync(outputDir, { recursive: true });
			}

			// Write the file only if content has changed
			let shouldWrite = true;
			if (fs.existsSync(outputPath)) {
				const existingContent = fs.readFileSync(outputPath, 'utf8');
				shouldWrite = existingContent !== content;
			}

			if (shouldWrite) {
				fs.writeFileSync(outputPath, content, 'utf8');
				// eslint-disable-next-line no-console
				console.log(`Generated SCSS imports: ${outputPath}`);
				// eslint-disable-next-line no-console
				console.log(`Found ${filteredFiles.length} SCSS files`);
			}
		} catch (error) {
			// eslint-disable-next-line no-console
			console.error('Error generating SCSS imports:', error);
		} finally {
			this.isGenerating = false;
		}
	}

	createNamespace(filePath) {
		// Convert file path to a valid SCSS namespace
		// Remove leading dots and slashes, replace special characters
		return filePath
			.replace(/^[./]+/, '')
			.replace(/[^a-zA-Z0-9]/g, '-')
			.replace(/-+/g, '-')
			.replace(/^-|-$/g, '')
			.toLowerCase();
	}
}

module.exports = ScssGlobPlugin;
