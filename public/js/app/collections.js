/**
 * Created by Galbanie on 2018-04-01.
 */

(function(){
    App.Collections.Catalogs = Backbone.Collection.extend({
        model: App.Models.Catalog,
        url: window.location.origin + '/api/catalog/'
    });
})();