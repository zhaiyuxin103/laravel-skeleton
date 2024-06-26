export default {
    plugins: ['prettier-plugin-blade', 'prettier-plugin-tailwindcss'],
    singleQuote: true,
    overrides: [
        {
            files: ['*.blade.php'],
            options: {
                parser: 'blade',
            },
        },
    ],
};
