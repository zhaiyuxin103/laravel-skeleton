import globals from 'globals';
import pluginJs from '@eslint/js';
import tseslint from 'typescript-eslint';

export default [
    {
        languageOptions: {
            globals: {
                ...globals.browser,
                ...globals.node,
            },
        },
    },
    pluginJs.configs.recommended,
    ...tseslint.configs.recommended,
    {
        ignores: [
            'docs/.vitepress/cache',
            'docs/.vitepress/dist',
            'public/build',
            'public/js/filament',
            'public/vendor',
            'vendor',
        ],
    },
];
