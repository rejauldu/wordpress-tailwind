const path = require('path');
// const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
// const glob = require('glob-all');
require('dotenv').config();
// const PurgecssPlugin = require('purgecss-webpack-plugin');

// const PATHS = {
//     scripts: path.join(__dirname, 'src/scripts'),
//     reactScripts: path.join(__dirname, 'lib'),
//     php: __dirname
// };

/**
 * Webpack configuration function
 * @param {any} env
 * @param {any} options
 * @returns {any}
 */
const config = (env, options) => {
    /**
     * Scss loader for webpack
     * @returns {{loader: string}}
     */
    const scssLoader = () => {
        if (options.mode === 'production') {
            return {
                loader: MiniCssExtractPlugin.loader
            };
        } else {
            return {
                loader: 'style-loader'
            };
        }
    };

    /**
     * Required plugins for webpack
     * @returns {[MiniCssExtractPlugin]|[BrowserSyncPlugin]}
     */
    const plugins = () => {
        if (options.mode === 'production') {
            return [
                // new PurgecssPlugin({
                //     paths: glob.sync(
                //         [`${PATHS.scripts}/**/*.ts`, `${PATHS.reactScripts}/**/*`, `${PATHS.php}/**/*.php`],
                //         {
                //             nodir: true
                //         }
                //     )
                // }),
                new MiniCssExtractPlugin({
                    filename: 'styles/[name].min.css'
                })
            ];
        } else {
            return [
                // new BrowserSyncPlugin({
                //     host: 'localhost',
                //     port: 3000,
                //     injectChanges: true,
                //     watch: true,
                //     reloadOnRestart: true,
                //     files: ['./**/*.html', './**/*.php', './**/*.scss', './**/*.css', , './**/*.ts', './**/*.tsx'],
                //     watchEvents: ['change', 'add', 'unlink', 'addDir', 'unlinkDir'],
                //     proxy: 'http://localhost:10019/'
                // })
            ];
        }
    };

    return {
        mode: options.mode,
        entry: {
            main: {
                import: path.resolve(__dirname, 'src/scripts/index.ts'),
                filename: options.mode === 'production' ? 'scripts/[name].min.js' : 'scripts/[name].js'
            }
        },
        output: {
            path: path.resolve(__dirname, 'build/')
        },
        module: {
            rules: [
                {
                    test: /\.(js|jsx|ts|tsx)$/,
                    exclude: /(node_modules|bower_components)/,
                    loader: 'babel-loader'
                },
                {
                    test: /.s?css$/,
                    use: [
                        scssLoader(),
                        {
                            loader: 'css-loader',
                            options: {
                                sourceMap: true,
                                url: true
                            }
                        },
                        {
                            loader: 'postcss-loader',
                            options: {
                                postcssOptions: {
                                    plugins: [['postcss-preset-env']]
                                }
                            }
                        },
                        {
                            loader: 'sass-loader',
                            options: {
                                sourceMap: true
                            }
                        }
                    ]
                }
            ]
        },
        resolve: {
            extensions: ['.ts', '.js']
        },
        target: 'web',
        plugins: plugins(),
        devtool: options.mode !== 'production' && 'source-map',
        watch: options.mode === 'development' && true,
        watchOptions: {
            ignored: ['node_modules/**']
        }
    };
};

module.exports = config;
