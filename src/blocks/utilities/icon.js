/**
 * Icon component that renders an SVG icon from the SVG Sprite.
 * @param {string} name - The name of the icon (should match the SVG ID).
 * @param {number} width - The width of the SVG icon.
 * @param {number} height - The height of the SVG icon.
 * @param {Object} rest - Additional props to be spread on the SVG element.
 */
export function Icon({ name, width, height, ...rest }) {
	return (
		<svg
			{...rest}
			className={`icon ${name}`}
			width={width}
			height={height}
			aria-hidden="true"
			role="img"
		>
			<title id={`title-${name}`}>{name}</title>
			<use href={`#${name}`} />
		</svg>
	);
}
