/**
 * Created by Galbanie on 2018-04-01.
 */

(function(){
    App.Models.Catalog = Backbone.Model.extend({
        defaults: {
            id: -1,
            name: "",
            auth_type: "Public"
        },
        idAttribute: "id",
        initialize: function(){
            // console.log('Catalog has been intialized');
            this.on('change',  function() {
                if(this.hasChanged('id')){
                    // console.log('id has been changed');
                }
                if(this.hasChanged('name')){
                    // console.log('name has been changed');
                }
            });
        },
        constructor: function (attributes, options) {
            // console.log('Catalog\'s constructor had been called');
            Backbone.Model.apply(this, arguments);
        },
        validate: function (attr) {
            if (attr.id <= -1) {
                return "Invalid value for id supplied."
            }
        },
        urlRoot: window.location.origin + '/api/catalog/'
    });
})();
