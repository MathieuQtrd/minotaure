document.addEventListener('DOMContentLoaded', function() {

    const productList = document.getElementById('productList');

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
                messages.push(...data.errors[index]);
            }
            alert(messages.join("\n"));
            console.log(messages);
        } else {

            for(let index in data.products) {
                let productBlock = document.createElement('div');
                productBlock.className = "col";
                productBlock.innerHTML = `
                        <div class="card shadow-sm">
                            <img class="card-img-top" role="img" width="100%" src="http://localhost:8000/storage/${data.products[index].image}">
                            <div class="card-body">
                                <p class="card-text">${data.products[index].title}</p>
                                <p class="card-text">Catégorie : ${data.products[index].category.title}</p>
                                <p class="card-text">Prix : ${data.products[index].price} €</p>
                                <a class="btn btn-dark w-100" href="product_details.php?id=${data.products[index].id}">Voir détails</a>
                            </div>
                        </div>
                   `;
                productList.appendChild(productBlock)
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
                
            }
        }

    });


});
