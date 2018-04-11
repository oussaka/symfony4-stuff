let Encore = require("@symfony/webpack-encore");
let CompressionPlugin = require('compression-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');

Encore
    // the project directory where compiled assets will be store
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())

    .addEntry('app', './assets/js/main.js')
    .addStyleEntry('global', './assets/css/main.css')

    // .createSharedEntry('vendor', [
    //     'jquery'
    // ])

    .enableSassLoader()
    .autoProvidejQuery()

    .addPlugin(new CopyWebpackPlugin([
        { from: './assets/images', to: 'images' }
    ]))

    .addPlugin(new CompressionPlugin({
        asset: "[path].gz[query]",
        algorithm: "gzip",
        test: /\.(css|js)$/,
        threshold: 10240,
        minRatio: 0.8
    }))
;

// Use polling instead of inotify
const config = Encore.getWebpackConfig();
config.watchOptions = {
    poll: true,
};

// export the final configuration
module.exports = Encore.getWebpackConfig();
module.exports = config;