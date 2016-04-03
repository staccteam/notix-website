module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        
        jshint: {
            all: [
                'Gruntfile.js',
                'js/*.js',
                'js/admin/*.js'
            ]
        },

        uglify: {
            build: {
                files: {
                    '/js/build/admin/main.min.js': ['/js/admin/main.js'],
                    '/js/build/admin/plugins.min.js': ['/js/admin/plugins.js'],
                    'js/build/main.min.js': ['js/main.js'],
                    'js/build/plugins.min.js': ['js/plugins.js']
                }
            }
        },

        imagemin: {
            dynamic: {
              files: [{
                expand: true,
                cwd: 'webroot/img/',
                src: [
                    '*.{png,jpg,gif,svg}',
                    '**/*.{png,jpg,gif,svg}'
                ],
                dest: 'webroot/img/'
              }]
            }
        },
        
        sass:{
            dist:{
                options:{
                    style:'compressed'
                },
                files:{
                    'css/build/style.min.css':'css/style.scss',
                    'css/build/admin/style.css':'css/admin/style.scss'
                }
            }
        },

        postcss:{
            options:{
                map:true,
                processors:[
                    require('autoprefixer')({
                        browsers:[
                            'last 2 versions',
                            '> 10%',
                        ]
                    })
                ]
            },
            dist:{
                src: ['css/build/style.css', 'css/build/admin/style.css']
            }
        },

        watch: {
            html: {
                files: ['*.html']
            },
            js: {
                files: [
                    'js/admin/plugins.js',
                    'js/admin/main.js',
                    'js/plugins.js',
                    'js/main.js'
                ],
                tasks: [
                    'jshint', 'uglify'
                ]
            },
            css: {
                files: [
                    'css/admin/style.scss',
                    'css/admin/main.sass',
                    'css/style.scss',
                    'css/main.sass',
                    'css/_animations.sass',
                    'css/_fonts.sass',
                    'css/_bits.sass',
                    'css/_base.sass'
                ],
                tasks: [
                    'sass', 'postcss'
                ]
            },
            options:{
                livereload: true
            }
        },
        
        connect:{
            server:{
                options:{
                    livereload: true
                }
            }
        },
        
        // browser-sync allows you to debug sites on your phone.
        // more info at http://browsersync.io 
        //
        // Below is the dummy browser-sync Grunt task:
        //  browserSync: {
        //     dev: {                
        //         options: {
        //             server: 'localhost/projects/notix-website/'
        //         }
        //     }
        // },
        //
        // ALTERNATIVELY ENTER THIS IN THE PROJECT DIR TERMINAL:
        // browser-sync start --proxy localhost/projects/notix-website/

    });
    require('es6-promise').polyfill();
    
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-connect');
    grunt.loadNpmTasks('grunt-browser-sync');

    grunt.registerTask('default', ['jshint', 'uglify', 'sass', 'postcss']);
    grunt.registerTask('serve', ['connect:server', 'watch']);

    // Uncomment lines below to register browser-sync tasks.
    // grunt.registerTask('bs', 'browserSync');
    // grunt.registerTask('bs-watch', ['browserSync', 'watch']);
};