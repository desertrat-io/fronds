const cache = {};

/**
 * @see https://webpack.js.org/guides/dependency-management/
 * @param r
 */
function importAll (r) {
    // eslint-disable-next-line no-return-assign
    r.keys().forEach(key => cache[key] = r(key));
}

importAll(require.context('./lib/', true, /\.js$/));