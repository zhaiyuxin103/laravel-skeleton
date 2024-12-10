export default {
    '*.php': [
        'vendor/bin/pint --dirty',
        'vendor/bin/phpstan analyse --memory-limit=2G',
    ],
    '*.{js,mjs,jsx,ts,tsx,json,css,scss,md,vue,yml,yaml,blade.php}': [
        'prettier . --write',
    ],
    '*.{js, jsx,ts,tsx}': ['eslint --fix .'],
};
