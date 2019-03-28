module.exports = {
  bundle: {
    vendor: {
			scripts: [
				'frontend/web/assets/google-scripts/loader.js',
        'frontend/web/assets/jquery/dist/jquery.min.js',
        'frontend/web/assets/popper.js/dist/umd/popper.min.js',
        'frontend/web/assets/bootstrap/dist/js/bootstrap.min.js',
        'frontend/web/assets/moment/min/moment.min.js',
        'frontend/web/assets/moment-timezone/builds/moment-timezone-with-data-2012-2022.min.js',
        'frontend/web/assets/underscore/underscore-min.js',
        'frontend/web/assets/clndr/clndr.min.js',
        'frontend/web/assets/nanogallery2/dist/jquery.nanogallery2.min.js'
      ],
      options: {
        maps: false
      }
    }
  }
};