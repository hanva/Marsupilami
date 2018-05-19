angular.module('Marsupilami').controller('friendsController', ['$scope', '$http', function ($scope, $http) {
    $http.get('/friends').then(function (response) {
        $scope.user = response.data.users;
        $scope.friends = response.data.friends;
        console.log($scope.friends);
        prepareDatalist(response.data.users);
    });
    $scope.addFriend = function () {
        addFriend($scope.username, $http, $scope)
    }
}]);


function addFriend(username, $http, $scope) {
    var data = {
        'username': username
    };
    $http({
        method: 'POST',
        url: "/addFriends",
        data: JSON.stringify(data),
        headers: {
            'Content-Type': "application/json"
        },
    })
        .then(function (response) {
            var friends = response.data;
            $scope.friends = friends;
            $scope.test = "salut";
            return friends;
        }, function (error) {
            console.log(error.data);
        });
}

function prepareDatalist(array) {
    for (var i in array) {
        const currentOption = document.createElement('option');
        currentOption.value = array[i].name;
        document.getElementById('nameList').appendChild(currentOption);
    }
}

function json(response) {
    return response.json()
}