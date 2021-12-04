const path = require('path');

module.exports = {
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './resources/js')
        }
    },
    output: {
        chunkFilename: 'js/[name].js?id=[chunkhash]',
    }
};
