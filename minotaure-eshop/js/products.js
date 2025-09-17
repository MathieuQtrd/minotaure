document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');

    const productList = document.getElementById('productList');

    const selectCategory = document.getElementById('category_id');

    const productForm = document.getElementById('productForm');
    if(productForm) {
        productForm.addEventListener('submit', function(e) {
            e.preventDefault();

            let formData = new FormData();
            formData.append('title', document.getElementById('title').value);
            formData.append('description', document.getElementById('description').value);
            formData.append('category_id', document.getElementById('category_id').value);
            formData.append('stock', document.getElementById('stock').value);
            formData.append('price', document.getElementById('price').value);

            const imageField = document.getElementById('image').files[0];
            if(imageField) {
                formData.append('image', imageField);
            }

            fetch('http://localhost:8000/api/products', {
                method: 'POST',
                headers: { 
                    // 'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + token 
                },
                body: formData,
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
                    window.location.href= 'products.php';
                }

            });

        });
    }

    fetch('http://localhost:8000/api/products', {
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

            for(let index in data.products) {
                let tr = document.createElement('tr');
                    tr.innerHTML = `
                    <td>${data.products[index].id}</td>
                    <td>${data.products[index].title}</td>
                    <td>${data.products[index].category.title}</td>
                    <td>${data.products[index].stock}</td>
                    <td>${data.products[index].price}</td>
                    <td><img src="http://localhost:8000/storage/${data.products[index].image}" width="70" class="img-thumbnail"></td>
                    <td><a href="#" onclick="deleteProduct(event, ${data.products[index].id})" class="btn  btn-danger">Supprimer</a></td>
                    `;                    
                productList.appendChild(tr)
            }
        }

    });

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
                let option = document.createElement('option');
                    option.innerHTML = data.categories[index].title;                    
                    option.value = data.categories[index].id;                    
                selectCategory.appendChild(option)
            }
        }

    });


});
function deleteProduct(e, id)
{
    e.preventDefault;
    const token = localStorage.getItem('token');
    fetch('http://localhost:8000/api/products/' + id, {
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
            window.location.href= 'products.php';

        }

    });
}