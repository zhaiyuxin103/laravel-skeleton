/**
 * @filename: prettier.config.mts
 * @see https://prettier.io/docs/configuration
 * @type {import('prettier').Config & import('prettier-plugin-tailwindcss').PluginOptions}
 */
const config = {
    singleQuote: true,
    overrides: [
        {
            files: '**/*.yml',
            options: {
                tabWidth: 2,
            },
        },
        {
            files: '*.blade.php',
            options: {
                parser: 'blade',
            },
        },
    ],
    plugins: ['prettier-plugin-blade', 'prettier-plugin-tailwindcss'],
};

export default config;
