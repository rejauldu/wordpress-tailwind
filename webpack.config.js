const path = require('path');
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');

module.exports = (env, argv) => {
  const isDevelopment = argv.mode === 'development';

  return {
    entry: './src/index.ts',
    output: {
      filename: 'scripts/main.min.js',
      path: path.resolve(__dirname, 'build'),
    },
    devtool: isDevelopment ? 'eval-source-map' : false,
    module: {
      rules: [
        {
          test: /\.(ts|js)x?$/,
          exclude: /node_modules/,
          use: {
            loader: 'babel-loader',
          },
        },
        {
          test: /\.s?css$/,
          use: [
            {
              loader: isDevelopment ? 'style-loader' : MiniCssExtractPlugin.loader,
            },
            {
                loader: 'css-loader',
                options: {
                  url: true
                }
            },
            {
                loader: 'postcss-loader'
            },
            {
                loader: 'sass-loader'
            }
          ],
        },
      ],
    },
    plugins: [
      new MiniCssExtractPlugin({
        filename: 'styles/main.min.css',
      }),
    ],
    watch: isDevelopment,
    watchOptions: {
      ignored: ['node_modules/**'],
    },
    optimization: {
      minimizer: [
        new TerserPlugin(),
        new CssMinimizerPlugin(),
      ],
    },
    resolve: {
      extensions: ['.ts', '.tsx', '.js', '.jsx'],
    },
  };
};