const Path = require('path');
const Webpack = require('webpack');
const { merge } = require('webpack-merge');
const common = require('./webpack.common.js');

module.exports = merge(common, {
    mode: 'development',
    devtool: 'cheap-eval-source-map',
    output: {
        chunkFilename: 'js/[name].chunk.js'
    },
    devServer: {
        https: true,
        port: 3000,
        host: "0.0.0.0",
        inline: true,
        overlay: {
            warnings: true,
            errors: true
        },
        open: "Chrome",
        proxy: [
            {
                context: ['/api', '/data'],
                target: "https://arhaero.1mcg.ru/",
                changeOrigin: true,
                withCredentials: true,
            },
        ],

    },
    plugins: [
        new Webpack.DefinePlugin({
            'process.env.NODE_ENV': JSON.stringify('development')
        })
    ],
    module: {
        rules: [
            //     {
            //         test   : /\.(js|vue)$/,
            //         include: Path.resolve(__dirname, '../src'),
            //         enforce: 'pre',
            //         loader : 'eslint-loader',
            //         exclude: /node_modules/,
            //         options: {
            //             emitWarning: true,
            //         }
            //     },
            {
                test: /\.js$/,
                include: Path.resolve(__dirname, '../src'),
                loader: 'babel-loader'
            },
            {
                test: /\.s?css$/i,
                use: [
                    'style-loader', 'css-loader?sourceMap=true', 'sass-loader'
                ]
            },
        ]
    }
});