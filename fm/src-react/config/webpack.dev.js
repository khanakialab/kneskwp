var path = require('path')
var webpack = require('webpack')
const env = process.env.NODE_ENV
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const glob = require('glob');

let twigJsFiles = glob.sync(path.resolve(__dirname,'../../../app/components/**/index.js'));
let twigCssFiles = glob.sync(path.resolve(__dirname,'../../../app/components/**/index.scss'));
var config = {
    mode: env || 'development',
    entry: {
        // main: [path.resolve(__dirname, '../../www/browser.js')],
        // m_default: path.resolve(__dirname, '../../module/default/index.js'),
        main: [path.resolve(__dirname, '../../../index.js'), ...twigJsFiles, ...twigCssFiles],
      
    },
    output: {
        path: path.resolve(__dirname, '../../../dist'),
        // publicPath: '/dist/',
        filename: '[name].js',
        // libraryTarget: "umd",
        // library: 'Sapp'

    },

    optimization: {
        runtimeChunk: false,
        minimize: false,
        splitChunks: {
            cacheGroups: {
                vendor: {
                    test: path.resolve(__dirname, "../../../node_modules/"),
                    chunks: "initial",
                    name: "vendor",
                    priority: -10,
                    enforce: true,
                    reuseExistingChunk: true,
                },

                // If enabled then it will merge all the async chungs into one all.js and include all.js file before main.js script tag in server_static.js
                // default: {
                //     chunks: "async",
                //     name: "all",
                //     priority: -12,
                //     enforce: true,
                //     reuseExistingChunk: true,
                // },
            }
        }
    },

    module: {
        rules: [{
            test: /\.(js)$/,
            exclude: /node_modules/, // add this line

            use: [{
                loader: 'babel-loader',
                options: {
                // babelrcRoots: ['.', './src'],
                  presets: [
                    ["@babel/preset-env", {
                        modules: 'umd'
                    }],
                    "@babel/preset-react",
                    // "@babel/preset-stage-0",
                  ],
                  plugins: [
                    // Stage 0
                    require('babel-plugin-add-module-exports'),
                    "@babel/plugin-transform-runtime",
                    "@babel/plugin-proposal-function-bind",
                    ["@babel/plugin-proposal-decorators", { "legacy": true }],
                    ["@babel/plugin-proposal-class-properties", { "loose": true }],
                    "@babel/plugin-syntax-dynamic-import",
                    require('babel-plugin-transform-do-expressions'),

                    // DISABLE CODE SPLITTING https://gist.github.com/jcenturion/892c718abce234243a156255f8f52468
                    'dynamic-import-webpack',
                    'remove-webpack'
                  ]
                }
            }]
        }, 


        {
            test: /\.(jpg|jpeg|png|gif)$/,
            use: "url-loader?limit=1000",
        },

        {
            test: /\.(woff|woff2|eot|otf|ttf|svg)$/,
            use: "file-loader",
        },

        {
            test: /\.(scss|css)$/,
            use: [
                MiniCssExtractPlugin.loader,
                // 'style-loader',
                {
                    loader: 'css-loader',
                    options: {
                        importLoaders: 1,
                        //  minimize: false || {
                        //     discardComments: {
                        //         removeAll: true,
                        //     },
                        // }
                    }
                },
                // 'css-loader',
                "sass-loader",
                // "postcss-loader"
                // { loader: "resolve-url-loader", options: { sourceMap: true } },
                {
                    loader: "postcss-loader",
                    options: {
                        config: {
                            path: path.resolve(__dirname, 'postcss.config.js'),
                        },
                        sourceMap: true,
                        // plugins: [
                        //   require('cssnano')(),
                        // ]
                    }
                },
            ]
        }
        ]
    },

    resolve: {
        alias: {
       
        }
    },

    plugins: [
        new webpack.ContextReplacementPlugin(/moment[\/\\]locale$/, /en/),

        new MiniCssExtractPlugin({
            filename: "[name].css",
            chunkFilename: "[name].css"
        }),

        new webpack.DefinePlugin({
            __isBrowser__: "true"
        }),
    ]
}

module.exports = [config]