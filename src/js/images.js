    function requireAll(r) {
        r.keys().forEach(r);
    }
      
    requireAll(require.context('../images/', true, /\.(gif|png|jpe?g)$/));