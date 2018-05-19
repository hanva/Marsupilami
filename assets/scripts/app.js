require('../styles/app.css');
require('../styles/global.scss');
const $ = require('jquery');
require('bootstrap-sass');

var app = angular.module('Marsupilami', [
    'ngRoute',
]);

app.config(['$routeProvider',
    function routeProvider($routeProvider) {
        $routeProvider.when('/', {
            template: 'HOME',
            //       controller: 'mainController'
        }).when('/login/', {
            templateUrl: '/templates/security/login.html',
            //        controller: 'mainController'
        }).when('/profile/', {
            templateUrl: '/templates/profile/profile.html',
            controller: 'profileController'
        }).when('/profile/edit', {
            templateUrl: '/templates/profile/editProfile.html',
            controller: 'profileController'
        }).when('/friends/', {
            templateUrl: '/templates/friends/friends.html',
            controller: 'friendsController'
        }).when('/register/', {
            templateUrl: '/templates/registration/register.html',
            //      controller: 'mainController'
        }).otherwise({
            redirectTo: '/'
        });
    }
])