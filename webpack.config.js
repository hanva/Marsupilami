// webpack.config.js
var Encore = require('@symfony/webpack-encore');

Encore
// the project directory where all compiled assets will be stored
    .setOutputPath('public/build/')

    /* the public path used by the web server to access the previous directory*/
    .setPublicPath('/build')

    // will create public/build/app.js and public/build/app.css
    .addEntry('app', './assets/scripts/app.js')
    .addEntry('controllers/profileController', './assets/scripts/Controllers/profileController.js')
    .addEntry('controllers/friendsController', './assets/scripts/Controllers/friendsController.js')


    // allow legacy applications to use $/jQuery as a global variable
    .autoProvidejQuery()
    .autoProvideVariables({
        $: 'jquery',
        jQuery: 'jquery',
        'window.jQuery': 'jquery',
    })

    // enable source maps during development
    .enableSourceMaps(!Encore.isProduction())

    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()

    // show OS notifications when builds finish/fail
    //  .enableBuildNotifications()

    // create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning()

    // allow sass/scss files to be processed
    .enableSassLoader(function (sassOptions) {
    }, {
        resolveUrlLoader: false
    })
;

// export the final configuration
module.exports = Encore.getWebpackConfig();