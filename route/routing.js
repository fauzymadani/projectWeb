'use strict';
var Router = {
root: '/',
routes: [],
urls: [],
titles: [],
navigate: function() {
    location.hash = this.root;
    return this;
},
add: function(thePath, theUrl, theTitle) {
    this.routes.push(thePath);
    this.urls.push(theUrl);
    this.titles.push(theTitle);
},
loading: function() {
    this.navigate();
    var r = this.routes;
    var u = this.urls;
    window.onload = function() {
        $("#view").load("tpl/home.html");
    };
    window.onhashchange = function() {
        for (var i = 0; i < r.length; i++) {
            if (location.hash == r[i]) {
                $("#view").load(u[i]);
            }
        }
    };
}
};
Router.add("#/home", "./home.html", "Home Page");
Router.add("#/about", "./about.html", "About Page");
Router.add("#/contact", "./contact-form.html", "About Page");
Router.add("#/service", "./service.html", "About Page");
Router.loading();