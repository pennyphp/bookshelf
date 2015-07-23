module.exports = function ( grunt ) {
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-watch');

  var taskConfig = {
    clean: [
      'public/vendor',
    ],
    copy: {
      dev_js: {
        files: [
          {
            src: [
             'bower_components/jquery/dist/jquery.js',
             'bower_components/bootstrap/dist/js/bootstrap.js'
            ],
            dest: 'public/vendor/js/',
            cwd: '.',
          }
       ]
      },
      dev_assets: {
        files: [
          {
            src: [],
            dest: 'public/vendor/assets/',
            cwd: '.',
          }
       ]
      },
      dev_css: {
        files: [
          {
            src: [
             'bower_components/bootstrap/dist/css/bootstrap.css'
            ],
            dest: './public/vendor/css/',
            cwd: '.',
          }
       ]
      },
    },
    delta: {
      options: {
        livereload: true
      },
      public: {
        files: [
          'public/*/**'
        ],
        tasks: [ 'dev' ]
      },
    }
  };

  grunt.initConfig(taskConfig);
  grunt.registerTask('watch', ['delta']);
  grunt.registerTask('dev', ["clean", "copy:dev_assets","copy:dev_css", "copy:dev_js"]);
};
