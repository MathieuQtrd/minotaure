document.addEventListener('DOMContentLoaded', function() {

    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');

    if(registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();

            fetch('http://localhost:8000/api/register', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({
                    name: document.getElementById('name').value,
                    email: document.getElementById('email').value,
                    password: document.getElementById('password').value,
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                if(data.errors) {
                    let messages = [];

                    for(let index in data.errors) {
                        messages.push(...data.errors[index]); // ... opérateur de déstructuration : pour avoir un seul tableau array au lieu d'un tableau contenant des tableau array
                    }
                    alert(messages.join("\n"));
                    console.log(messages);
                } else {
                    window.location.href= 'login.php';
                }

            });

        });
    }

    if(loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();

            fetch('http://localhost:8000/api/login', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({
                    email: document.getElementById('email').value,
                    password: document.getElementById('password').value,
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if(data.errors) {
                    let messages = [];

                    for(let index in data.errors) {
                        messages.push(...data.errors[index]); // ... opérateur de déstructuration : pour avoir un seul tableau array au lieu d'un tableau contenant des tableau array
                    }
                    alert(messages.join("\n"));
                    console.log(messages);
                } else {
                    localStorage.setItem('token', data.token);
                    window.location.href= 'index.php';
                }
            });
        });
    }

});