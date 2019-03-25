const path = require('path');
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");

const CleanWebpackPlugin = require('clean-webpack-plugin');
const webpack = require('webpack');
module.exports = {
    // entry: './index.js',
    entry: [
        './index.js'
    ],
    output: {
        filename: 'main.js',
        path: path.resolve(__dirname, 'dist')
    },

    module: {
        rules: [
            { test: require.resolve("jquery"), loader: "expose-loader?$!expose-loader?jQuery" },
            { test: require.resolve("toastr"), loader: "expose-loader?toastr" },
        	// {
         //        test: /\.(jpg|jpeg|png|gif)$/,
         //        use: "url-loader?limit=1000",
         //    },
            {
                test: /\.(jpg|jpeg|png|gif|woff|woff2)$/,
                use: [
                  {
                    loader: 'url-loader',
                    options: {
                      limit: 800000
                    }
                  }
                ]
            },
            {
                test: /\.(woff|woff2|eot|otf|ttf|svg)$/,
                use: "file-loader",
            },
            {
                test: /\.json$/,
                use: "json-loader",
            },
            {
                test: /\.(js|jsx)$/,
                use: "babel-loader",
                exclude: /(node_modules|bower_components)/,
            },

            {
                test: /\.(scss|css)$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    // 'style-loader',
                    { loader: 'css-loader', options: { importLoaders: 1 } },
                    "sass-loader",
                    { loader: "resolve-url-loader", options: { sourceMap: true } },
                    { loader: "postcss-loader", options: { 
                    	config: {
                            path: path.resolve(__dirname, 'postcss.config.js'),
                        },
                        sourceMap: true ,
                        // plugins: [
                        //   require('cssnano')(),
                        // ]
                    } },
                ]
            },
        ]
    },

    optimization: {
        minimizer: [
            new UglifyJSPlugin({
                cache: true,
                parallel: true,
                sourceMap: true // set to true if you want JS source maps
            }),
            new OptimizeCSSAssetsPlugin({})
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: "[name].css",
            chunkFilename: "[id].css"
        }),
        // new CleanWebpackPlugin(['dist']),
        new UglifyJSPlugin({
            sourceMap: true,

        }),
        new webpack.DefinePlugin({
            'process.env.NODE_ENV': JSON.stringify('production')
        }),

        // new webpack.ProvidePlugin({
        //   $: 'jquery',
        //   jQuery: 'jquery',
        //   // 'window.jQuery': 'jquery'
        // })

    ],
};