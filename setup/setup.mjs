import inquirer from 'inquirer';
import shell from 'shelljs';

const questions = [
	{
		type: 'input',
		name: 'projectName',
		message: "What's your project's name?",
		default: 'Project Name', // Add default value
	},
	{
		type: 'input',
		name: 'companyName',
		message: "What is the company's name?",
		default: 'Company Name', // Add default value
	},
	{
		type: 'input',
		name: 'textDomain',
		message: 'WordPress Theme Text Domain',
		default: 'jaws', // Add default value
	},
	{
		type: 'input',
		name: 'localUrl',
		message:
			'What is the local URL for this website? (Do not include http:// or https://)',
		default: 'projectname.local',
	},
];

const replaceStrings = (
	projectNameTitleCase,
	projectNameWithDash,
	projectNameWithUnderscore,
	companyNameCamelCase,
	companyNameLowercase,
	textDomainLowercase,
	localUrl
) => {
	const ignoreFiles = [
		'/screenshot.png',
		'/gsap-bonus.tgz',
		'/setup/setup.mjs',
		'/node_modules/',
		'/vendor/',
	];

	const stringsToReplace = [
		{
			find: `, 'text-domain'`,
			replace: `, '${textDomainLowercase}'`,
		},
		{
			find: `Text Domain: text-domain`,
			replace: `Text Domain: ${textDomainLowercase}`,
		},
		{
			find: `"jaws"`,
			replace: `"${projectNameWithUnderscore}"`,
		},
		{
			find: `'jaws'`,
			replace: `'${projectNameWithUnderscore}'`,
		},
		{
			find: 'jaws-wp-starter',
			replace: `${projectNameWithDash}`,
		},
		{
			find: `"justdev/jaws"`,
			replace: `"${companyNameLowercase}/${projectNameWithUnderscore}"`,
		},
		{
			find: `jaws-`,
			replace: `'${projectNameWithDash}-`,
		},
		{
			find: `site-url.local`,
			replace: `${localUrl}`,
		},
		{
			find: /jaws\/blockname/g,
			replace: `${projectNameWithDash}/blockname`,
		},
		{
			find: 'jaws.pot',
			replace: `${projectNameWithDash}.pot`,
		},
	];

	const shouldIgnore = (path) => {
		return ignoreFiles.some((ignore) => path.includes(ignore));
	};

	shell.ls('-Rl', '.').forEach((entry) => {
		const path = `./${entry.name}`; // Construct the full path
		if (entry.isFile() && !shouldIgnore(path)) {
			console.log(`Processing file: ${entry.name}`);
			stringsToReplace.forEach((string) => {
				shell.sed('-i', string.find, string.replace, path);
			});
			console.log(`Replacement done for file: ${entry.name}`);
		}
	});

	console.warn(
		'You will need to manually edit style.css in the root with the correct theme name and description.'
	);
};

const updateFiles = (answers) => {
	const { projectName, companyName, textDomain, localUrl } = answers;

	const projectNameTitleCase = projectName
		.toLowerCase()
		.split(' ')
		.map((word) => word.charAt(0).toUpperCase() + word.slice(1))
		.join(' ');
	const projectNameWithDash = projectName.toLowerCase().replace(/\s/g, '-');
	const projectNameWithUnderscore = projectName
		.toLowerCase()
		.replace(/\s/g, '_');

	const companyNameCamelCase = companyName
		.toLowerCase()
		.replace(/\s/g, '')
		.split(' ')
		.map((word) => word.charAt(0).toUpperCase() + word.slice(1))
		.join('');

	const companyNameLowercase = companyName.toLowerCase().replace(/\s/g, '');

	const textDomainLowercase = textDomain.toLowerCase().replace(/\s/g, '_');

	replaceStrings(
		projectNameTitleCase,
		projectNameWithDash,
		projectNameWithUnderscore,
		companyNameCamelCase,
		companyNameLowercase,
		textDomainLowercase,
		localUrl
	);
};

inquirer
	.prompt(questions)
	.then((answers) => {
		updateFiles(answers);
	})
	.catch((error) => {
		if (error.isTtyError) {
			// Prompt couldn't be rendered in the current environment
		} else {
			// Something else went wrong
		}
	});
