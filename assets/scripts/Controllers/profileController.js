angular.module('Marsupilami').controller('profileController', ['$scope', '$http', function ($scope, $http) {
    $http.get('/profile').then(function (response) {
        $scope.user = response.data;
    });

}]);