document.addEventListener('DOMContentLoaded', function () {
    const token = localStorage.getItem('token');

    if (!token) {
        window.location.href = '../index.php';
    } else {
        fetch('http://localhost:8000/api/user', {
            headers: { 'Authorization': 'Bearer ' + token }
        })
            .then(response => response.json())
            .then(user => {
                console.log(user);
                if (!user.roles.includes('admin')) {
                    window.location.href = '../index.php';
                }
            });

    }
    
});
