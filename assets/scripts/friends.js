function prepareDatalist(array) {
    console.log(array);
    for (var i in array) {
        const currentOption = document.createElement('option');
        //  console.log(array[i]);
        currentOption.value = array[i].name;
        document.getElementById('nameList').appendChild(currentOption);
    }
}

function json(response) {
    return response.json()
}

// AJAX REQUEST
window.onload = function () {
    var url = '/getUsers';

    fetch(url, {
        method: 'get',
        headers: {
            "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
        },
        credentials: 'include'
    })
        .then(json)
        .then(function (data) {
            prepareDatalist(data)
        })
        .catch(function (error) {
            console.log('Request failed', error);
        });
}