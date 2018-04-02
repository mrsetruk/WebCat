/**
 * Created by Galbanie on 2018-04-01.
 */

(function(){
    App.Views.CatalogView = Backbone.View.extend({
        tagname: "tr",
        model: App.Models.Catalog,
        initialize: function() {
            this.template = _.template($('#catalog-template').html());
        },
        render: function (){
            this.$el.html(this.template(this.model.attributes));
            console.log( this.$el.html());
            return this;
        }
    });

    App.Views.CatalogListView = Backbone.View.extend({
        model: App.Collections.Catalogs,

        render: function() {
            this.$el.html(); // lets render this view

            var self = this;

            this.model.fetch({
                success: function (catalogs, response) {
                    // fetch successful, lets iterate and update the values here
                    catalogs.each(function (item, index, all) {
                        var catalogView = new App.Views.CatalogView({model: self.model.at(index)});
                        self.$el.append(catalogView.$el);
                        console.log(catalogView.$el);
                        catalogView.render(); // lets render the book
                    });
                }
            });
            return this;
        }
    });
})();