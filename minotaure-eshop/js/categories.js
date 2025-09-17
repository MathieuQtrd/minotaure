document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');

    const categoriesList = document.getElementById('categoriesList');

    const categoryForm = document.getElementById('categoryForm');
    
    if(categoryForm) {
        categoryForm.addEventListener('submit', function(e) {
            e.preventDefault();

            fetch('http://localhost:8000/api/categories', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + token 
                },
                body: JSON.stringify({
                    title: document.getElementById('title').value,
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
                    // window.location.href= 'login.php';
                    window.location.href= 'categories.php';
                }

            });

        });
    }

    fetch('http://localhost:8000/api/categories', {
        headers: { 
            'Content-Type': 'application/json',
        },
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

            for(let index in data.categories) {
                let tr = document.createElement('tr');
                    tr.innerHTML = `
                    <td>${data.categories[index].id}</td>
                    <td>${data.categories[index].title}</td>
                    <td><a href="#" onclick="deleteCategory(event, ${data.categories[index].id})" class="btn  btn-danger">Supprimer</a></td>
                    `;                    
                categoriesList.appendChild(tr)
            }
        }

    });


});
function deleteCategory(e, id)
{
    e.preventDefault;
    const token = localStorage.getItem('token');
    fetch('http://localhost:8000/api/categories/' + id, {
        method: 'DELETE',
        headers: { 
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token 
        },
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
            window.location.href= 'categories.php';

        }

    });
}