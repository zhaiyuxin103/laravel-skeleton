/**
 * @filename: lint-staged.config.mts
 * @type {import('lint-staged').Configuration}
 */
export default {
    "*.php": ["composer lint"],
}