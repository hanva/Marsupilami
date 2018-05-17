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
            controller: 'mainController'
        }).when('/login/', {
            templateUrl: '/templates/security/login.html',
            controller: 'mainController'
        }).when('/profile/edit', {
            templateUrl: '/templates/profile/profile.html',
            controller: 'mainController'
        }).when('/friends/', {
            templateUrl: '/templates/friends/friends.html',
            controller: 'mainController'
        }).when('/register/', {
            templateUrl: '/templates/registration/register.html',
            controller: 'mainController'
        }).otherwise({
            redirectTo: '/'
        });
    }
])