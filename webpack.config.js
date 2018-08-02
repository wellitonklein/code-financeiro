let webpack = require('webpack')

module.exports = {
    entry: {
        admin: './resources/assets/admin/js/admin.js'
    },
    output : {
        path: __dirname + '/public/build',
        filename: '[name].bundle.js',
        publicPath: '/build/'
    },
    plugins: [
        new webpack.ProvidePlugin({
            'window.$': 'jQuery',
            'window.jQuery': 'jQuery'
        })
    ],
    module: {
        loaders: [
            {
                test: /\.js$/,
                exclude: /(node_modules|bower_components)/,
                loader: 'babel'
            },
            {
                test: /\.vue$/,
                loader: 'vue'
            }
        ]
    }
}