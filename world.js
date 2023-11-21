window.onload = function() {
    var countryLookupButton = document.querySelector('#lookup');
    var cityLookupButton = document.querySelector('#lookupCities'); // New button for city lookup

    function fetchData(url) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);
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
    }

    countryLookupButton.onclick = function() {
        var countryField = document.querySelector('#country');
        var queryParam = countryField ? encodeURIComponent(countryField.value) : '';
        fetchData('http://localhost/info2180-lab5/world.php?country=' + queryParam);
    };

    cityLookupButton.onclick = function() {
        var countryField = document.querySelector('#country');
        var queryParam = countryField ? encodeURIComponent(countryField.value) : '';
        fetchData('http://localhost/info2180-lab5/world.php?country=' + queryParam + '&lookup=cities');
    };
};