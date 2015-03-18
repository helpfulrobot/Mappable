module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        concat: {
            css: {
                src: [
                    'css/*'
                ],
                dest: 'combined.css'
            },
            js: {
                src: [
                    'javascript/google/*.js'
                ],
                dest: 'javascript/packaged/google/combined.js'
            }
        },
        cssmin: {
            css: {
                src: 'combined.css',
                dest: 'combined.min.css'
            }
        },
        uglify: {
            js: {
			    files : {
			        'javascript/google/combined.js' : [
			        'javascript/maputil.js',
			        'javascript/FullScreen.js',
			        'javascript/markerclusterer.js'
			        ],

			        'javascript/combined.js' : [
			          'javascript/mapField.js'
			        ]

			    }
			  },
        },
    });
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.registerTask('default', ['concat:css', 'cssmin:css', 'concat:js', 'uglify:js']);
};
