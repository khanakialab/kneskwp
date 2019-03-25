const path = require("path");
const webpack = require("webpack");
const HtmlWebpackPlugin = require("html-webpack-plugin");
const ExtractTextPlugin = require("extract-text-webpack-plugin");
var WebpackBuildNotifierPlugin = require('webpack-build-notifier');

console.log(`Running in ${process.env.NODE_ENV || "production"} mode`);

const ExtractNormalCSS = new ExtractTextPlugin("main.css")
const ExtractVendorCss = new ExtractTextPlugin("vendor.css")
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const config = {


    entry: {
        main: ['./index.js'],
        vendor: ['axios'],
    },

    devtool: "source-map",


    output: {
        filename: '[name].js',
        path: path.resolve(__dirname, "./dist"),
        // chunkFilename: '[name].[chunkhash].bundle.js',
        // publicPath: '/',
    },


    optimization: {
        // runtimeChunk: 'single',
   
        minimize: false,
   
        splitChunks: {
            cacheGroups: {
                // commons: {
                //     chunks: "initial",
                //     minChunks: 0,
                //     maxInitialRequests: 5, // The default limit is too small to showcase the effect
                //     minSize: 0 // This is example is too small to create commons chunks
                // },
                vendor: {
                    test: /node_modules/,
                    chunks: "initial",
                    name: "vendor",
                    priority: 10,
                    enforce: true
                }
            }
        }
    },

    watchOptions: {
        ignored: [
            path.resolve(__dirname, "./node_modules"),
            path.resolve(__dirname, "./demos"),
            path.resolve(__dirname, "./build"),
            path.resolve(__dirname, "./cache"),
            path.resolve(__dirname, "./dist"),
            path.resolve(__dirname, "./bin"),
        ],
    },


    module: {
        
        rules: [
            // { test: require.resolve("jquery"), loader: "expose-loader?$!expose-loader?jQuery" },
            // { test: require.resolve("toastr"), loader: "expose-loader?toastr" },
            
            {
                test: /\.(jpg|jpeg|png|gif)$/,
                use: "url-loader?limit=1000",
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
                    { loader: 'css-loader', options: { 
                        importLoaders: 1,
                        //  minimize: false || {
                        //     discardComments: {
                        //         removeAll: true,
                        //     },
                        // }
                    } },
                    // 'css-loader',
                    "sass-loader",
                    // "postcss-loader"
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
        ],
    },



    plugins: [
        new webpack.IgnorePlugin(/^jquery/),

        new MiniCssExtractPlugin({
            filename: "[name].css",
            chunkFilename: "[name].css"
        }),
        new webpack.ProvidePlugin({
            Popper: ['popper.js', 'default'],
        //   $: 'jquery',
        //   jQuery: 'jquery',
          // 'window.toastr' : 'toastr',
          // 'window.jQuery': 'jquery'
        })
    ],
};

module.exports = config;
