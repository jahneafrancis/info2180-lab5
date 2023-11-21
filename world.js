window.onload = function() {
    var searchButton = document.querySelector('#lookup');

    searchButton.onclick = function() {
        var xhr = new XMLHttpRequest();
        var countryField = document.querySelector('#country');
        var queryParam = countryField ? encodeURIComponent(countryField.value) : '';

        xhr.open('GET', 'http://localhost/info2180-lab5/world.php?country=' + queryParam, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.querySelector('#result').innerHTML = xhr.responseText;
            } else {
                document.querySelector('#result').textContent = 'Error fetching data.';
            }
        };
        xhr.onerror = function() {
            document.querySelector('#result').textContent = 'Request failed.';
        };
        xhr.send();
    };
};
