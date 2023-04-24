/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './assets/**/*.js',
    './templates/**/*.html.twig',
    './node_modules/flowbite/**/*.js' // set up the path to the flowbite package
  ],
  theme: {
    extend: {
      backgroundColor: {
        'off-white': '#F5F5F5', //blanc cassé.
      },
      textColor: {
        'primary': {
          500: '#5F93A5',
        },
      }
    },
    plugins: [
      require('tw-elements/dist/plugin'),
      require('flowbite/plugin') // add the flowbite plugin
    ],
  }
}
