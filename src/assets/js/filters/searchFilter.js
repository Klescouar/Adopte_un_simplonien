app.filter('filterBy', function() {
    return function(array, query) {

        var parts = query && query.trim().split(/\s+/),
            keys = Object.keys(array[0]);

        if (!parts || !parts.length) return array;

        return array.filter(function(obj) {
            return parts.every(function(part) {
                return keys.some(function(key) {
                    return String(obj[key]).toLowerCase().indexOf(part.toLowerCase()) > -1;
                });
            });
        });
    };
});
