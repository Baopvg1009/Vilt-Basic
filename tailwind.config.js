/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "selector", // Enable dark mode
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                Montserrat: ["Montserrat", "sans-serif"],
            },
        },
    },
    plugins: [require("@tailwindcss/forms")],
};
