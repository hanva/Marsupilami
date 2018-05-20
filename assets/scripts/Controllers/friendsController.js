angular.module('Marsupilami').controller('friendsController', ['$scope', '$http', function ($scope, $http) {
    $http.get('/friends').then(function (response) {
        $scope.user = response.data.users;
        $scope.friends = response.data.friends;
        prepareDatalist(response.data.users);
    });
    $scope.addFriend = function () {
        addFriend($scope.username, $http, $scope)
    }
    $scope.removeFriend = function (form) {
        removeFriend(form.friend.name, $http, $scope)
    }
    $scope.registerFriend = function (form) {
        registerFriend(form, $http, $scope)
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
            if (friends === "404") {
                $scope.new = true;
                $scope.name = username;
            }
            else {
                $scope.friends = friends;
            }
        }, function (error) {
            console.log(error.data);
        });
}

function removeFriend(username, $http, $scope) {
    var data = {
        'username': username
    };
    $http({
        method: 'POST',
        url: "/removeFriends",
        data: JSON.stringify(data),
        headers: {
            'Content-Type': "application/json"
        },
    })
        .then(function (response) {
            var friends = response.data;
            $scope.friends = friends;
        }, function (error) {
            console.log(error.data);
        });
}

function registerFriend(form, $http, $scope) {
    var name = form.name;
    var age = form.age;
    var familly = form.familly;
    var race = form.race;
    var food = form.food;
    var password = form.password;
    var user = {
        'name': name,
        'age': age,
        'familly': familly,
        'race': race,
        'food': food,
        'password': password,
    };
    $http({
        method: 'POST',
        url: "/registerFriends",
        data: JSON.stringify(user),
        headers: {
            'Content-Type': "application/json"
        },
    })
        .then(function (response) {
            addFriend(name, $http, $scope);
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