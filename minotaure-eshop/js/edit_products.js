document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');

    const productId = new URLSearchParams(window.location.search).get('id');
    let productCategoryId = 0;

    const selectCategory = document.getElementById('category_id');

    const UpdateProductForm = document.getElementById('UpdateProductForm');
    if(UpdateProductForm) {
        UpdateProductForm.addEventListener('submit', function(e) {
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

            formData.append('_method', 'PUT');
            
            fetch('http://localhost:8000/api/products/' + productId, {
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
                    //alert(messages.join("\n"));
                    console.log(messages);
                } else {
                    window.location.href= 'products.php';
                }

            });

        });
    }

    fetch('http://localhost:8000/api/products/' + productId, {
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
            productCategoryId =  data.category_id;
            console.log(productCategoryId);

            document.getElementById('title').value = data.title;
            document.getElementById('description').value = data.description;
            document.getElementById('stock').value = data.stock;
            document.getElementById('price').value = data.price;


            document.getElementById('oldImage').src = `http://localhost:8000/storage/${data.image}`;
            document.getElementById('productTitle').textContent = data.title;


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
                    
                    if(data.categories[index].id === productCategoryId) {
                        option.selected = 'selected'; 
                    }
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

