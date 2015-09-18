module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        watch: {
            less: {
                files: ['src/wp-content/themes/cti/**/*.less'],
                tasks: ['less'],
                options: {
                    spawn: false
                }
            },
            bower_components: {
                files: [
                    'bower_components/**/*'
                ],
                tasks: ['default'],
            },
        },

        less: {
            development: {
                options: {
                    compress          : true,
                    optimization      : 2,
                    sourceMap         : true,
                    sourceMapFilename: 'src/wp-content/themes/cti/style.css.map',
                    sourceMapURL: 'src/wp-content/themes/cti/style.css.map',
                    sourceMapRootpath: 'src/wp-content/themes/cti/'
                },
 
                files: {
                    'src/wp-content/themes/cti/style.css': 'src/wp-content/themes/cti/less/main.less'
                }
            }
        },

        uglify: {
            vendor: {
                files: {
                    'src/wp-content/themes/cti/js/vendor.js': [
                        'src/wp-content/themes/cti/bower_components/jquery/dist/jquery.js',
                        'src/wp-content/themes/cti/bower_components/bootstrap/dist/js/bootstrap.js',
                    ],
                },
            },
        },
    });

    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-uglify');

    grunt.registerTask('default', ['uglify','watch']);
};
