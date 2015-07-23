module.exports = function ( grunt ) {
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-watch');

  var taskConfig = {
    clean: [
      'web/vendor',
    ],
    copy: {
      dev_js: {
        files: [
          {
            src: [
             'bower_components/jquery/dist/jquery.js',
             'bower_components/bootstrap/dist/js/bootstrap.js'
            ],
            dest: 'web/vendor/js/',
            cwd: '.',
          }
       ]
      },
      dev_assets: {
        files: [
          {
            src: [],
            dest: 'web/vendor/assets/',
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
            dest: './web/vendor/css/',
            cwd: '.',
          }
       ]
      },
    },
    delta: {
      options: {
        livereload: true
      },
      web: {
        files: [
          'web/*/**'
        ],
        tasks: [ 'dev' ]
      },
    }
  };

  grunt.initConfig(taskConfig);
  grunt.registerTask('watch', ['delta']);
  grunt.registerTask('dev', ["clean", "copy:dev_assets","copy:dev_css", "copy:dev_js"]);
};
