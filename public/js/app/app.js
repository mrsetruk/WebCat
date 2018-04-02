/**
 * Created by Galbanie on 2018-04-01.
 */
(function(){
    if (!window.location.origin) {
        window.location.origin = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port: '');
    }

    window.App = {
        Models: {},
        Collections: {},
        Views: {}
    };

    window.template = function(id){
        return _.template( $('#' + id).html() );
    };
})();