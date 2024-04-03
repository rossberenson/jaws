const fs = require('fs');
const path = require('path');

function generateUniqueIdentifier() {
	const timestamp = Date.now();
	const randomNum = Math.floor(Math.random() * 1000000);
	return `${timestamp}-${randomNum}`;
}

class BlockJsonVersionPlugin {
	apply(compiler) {
		// Hook into the 'done' event of Webpack to ensure all compilation is completed.
		compiler.hooks.done.tap('BlockJsonVersionPlugin', () => {
			// Get the absolute path to the '/blocks' directory
			const blocksDirectory = path.resolve(
				__dirname,
				'../../build/blocks'
			);

			// Call the helper function to process block.json files
			this.processBlockJsonFiles(blocksDirectory);
		});
	}

	processBlockJsonFiles(directoryPath) {
		// Read the contents of the directory
		fs.readdirSync(directoryPath).forEach((file) => {
			// Get the full path to the current item (file or subdirectory)
			const itemPath = path.join(directoryPath, file);

			// Check if it is a directory
			if (fs.statSync(itemPath).isDirectory()) {
				// Get the path to the block.json file in the current subdirectory
				const blockJsonPath = path.join(itemPath, 'block.json');

				// Check if the block.json file exists
				if (fs.existsSync(blockJsonPath)) {
					// Read the content of block.json
					const blockJsonContent = fs.readFileSync(
						blockJsonPath,
						'utf8'
					);

					try {
						// Parse the JSON content
						const blockJsonData = JSON.parse(blockJsonContent);

						// Check if "version" property exists in block.json
						if (!blockJsonData.version) {
							// If the "version" property doesn't exist, add it with a unique value.
							const indentifier = generateUniqueIdentifier();

							blockJsonData.version = indentifier;

							// Write the modified JSON content back to the block.json file
							fs.writeFileSync(
								blockJsonPath,
								JSON.stringify(blockJsonData, null, 2)
							);

							// console.log(
							// 	`Added "version" key with value ${indentifier} to ${blockJsonPath}`
							// );
						} else {
							// console.log(
							// 	`Skipping ${blockJsonPath} (version already exists)`
							// );
						}
					} catch (error) {
						console.error(
							`Error parsing JSON in ${blockJsonPath}:`,
							error
						);
					}
				} else {
					// Recursively process subdirectories
					this.processBlockJsonFiles(itemPath);
				}
			}
		});
	}
}

module.exports = BlockJsonVersionPlugin;
