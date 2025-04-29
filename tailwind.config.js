/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#6366f1",
                secondary: "#f43f5e",
                accent: "#10b981",
            },
        },
    },
    plugins: [],
};
