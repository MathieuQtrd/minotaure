document.addEventListener('DOMContentLoaded', function () {
    const menu = document.getElementById('menu_front');
    const token = localStorage.getItem('token');

    menu.innerHTML = `
        <li class="nav-item"><a class="nav-link" href="index.php">Boutique</a></li>
        <li class="nav-item"><a class="nav-link" href="panier.php">Panier</a></li>
    `;

    if (!token) {
        menu.innerHTML += `
            <li class="nav-item"><a class="nav-link" href="login.php">Connexion</a></li>
            <li class="nav-item"><a class="nav-link" href="register.php">Inscription</a></li>
        `;
    } else {
        menu.innerHTML += `
            <li class="nav-item"><a class="nav-link" href="profile.php">Profil</a></li>
            <li class="nav-item"><a class="nav-link" href="#"  onclick="logout()" >Déconnexion</a></li>
        `;

        fetch('http://localhost:8000/api/user', {
            headers: { 'Authorization': 'Bearer ' + token }
            // permet d'authentifier l'utilisateur via son token du côté de l'api
            // Bearer est un préfixe standard utilisé dans le modèle d'authentification par Bearer token
        })
            .then(response => response.json())
            .then(user => {
                console.log(user);
                if (user.roles.includes('admin')) {
                    menu.innerHTML += `
                        <li class="nav-item"><a class="nav-link" href="admin/dashboard.php">Dashboard</a></li>
                    `;
                }
            });

    }
    
});

function logout() 
{
    const token = localStorage.getItem('token');
    fetch('http://localhost:8000/api/logout', {
            method: 'POST',
            headers: { 'Authorization': 'Bearer ' + token }           
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.message) {
                    localStorage.removeItem('token');
                    window.location.href = 'login.php';
                }
            });
}