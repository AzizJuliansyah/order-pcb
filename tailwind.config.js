module.exports = {
	content: [
		"./application/views/**/*.php", // untuk semua view CI3
		"./application/views/*.php", // kalau ada file view langsung di root
		"./application/views/**/*.{html,js}", // kalau ada file HTML/JS juga
	],
	theme: {
		extend: {},
	},
	plugins: [],
};
