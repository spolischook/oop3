document.addEventListener('DOMContentLoaded', function() {
    var button = document.querySelector('#load-fixtures');

    button.addEventListener('click', function() {
        var request = new XMLHttpRequest();

        request.addEventListener('load', function() {
            button.innerText = 'Update Success';
            document.querySelector('.alert-danger').setAttribute('class', 'alert alert-success');

            var goButton = document.querySelector('.btn-danger');
            goButton.setAttribute('class', 'btn btn-success');
            goButton.textContent = 'Return to the Home Page';
        });

        request.open('POST', 'http://oop.local/load-fixtures');
        request.send();
        button.innerText = 'Loading...';
        button.disabled = true;
    });
});