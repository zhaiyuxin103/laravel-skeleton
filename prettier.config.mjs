/**
 * @filename: prettier.config.mts
 * @see https://prettier.io/docs/configuration
 * @type {import('prettier').Config}
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
    ],
};

export default config;
