module.exports = {
    entry: {
        app: ['./www/index.js']
    },
    output: {
        path: __dirname + '/www/dist',
        filename: 'app.js',
        publicPath: '/www/dist'
    }
};
