angular.module('Marsupilami').controller('profileController', ['$scope', '$http', function ($scope, $http) {
    $http.get('/profile').then(function (response) {
        $scope.user = response.data;
    });
    $scope.editProfile = function (form) {
        editProfile(form, $http, $scope)
    }
}]);

function editProfile(form, $http, $scope) {
    var data = {
        'username': form.user.name,
        'age': form.user.age,
        'familly': form.user.familly,
        'race': form.user.race,
        'food': form.user.food,
    };
    console.log(data);
    $http({
        method: 'POST',
        url: "/editProfile",
        data: JSON.stringify(data),
        headers: {
            'Content-Type': "application/json"
        },
    })
        .then(function (response) {
            window.location = "/#!/profile";
        }, function (error) {
            console.log(error.data);
        });
}