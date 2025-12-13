/**
 * @filename: lint-staged.config.mts
 * @type {import('lint-staged').Configuration}
 */
export default {
    '*.php': ['composer lint'],
    '*.{js,mjs,ts,tsx,json,css,scss,md,yml,yaml,vue,blade.php}': [
        'pnpm format',
    ],
};
