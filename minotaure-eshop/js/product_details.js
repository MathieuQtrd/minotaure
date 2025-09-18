document.addEventListener('DOMContentLoaded', function() {
    const productId = new URLSearchParams(window.location.search).get('id');

    const productImage = document.getElementById('productImage');
    const productInfos = document.getElementById('productInfos');

    fetch('http://localhost:8000/api/products/' + productId)
    .then(response => response.json())
    .then(data => {
        console.log(data);

        let stock = '';
        if(data.stock < 1) {
            stock = '<span class="text-danger">Rupture de stock pour ce produit</span>';
        } else if(data.stock < 10) {
            stock = '<span class="text-warning">Stock faible</span>';
        } else {
            stock = '<span class="text-success">En stock</span>';
        }

        productImage.src = 'http://localhost:8000/storage/' + data.image;
        productImage.alt = 'Image du produit : ' + data.title;

        productInfos.innerHTML = `
            <p><b>Titre : </b> ${data.title}</p>
            <p><b>Catégorie : </b> ${data.category_id}</p>
            <p><b>Prix : </b> ${data.price} €</p>
            <p><b>Disponibilité : </b> ${stock}</p>
            <p><b>Description : </b><br> ${data.description}</p>
            <hr>
        `;

        if(data.stock > 0) {
            if(data.stock > 10) {
                maxQuantity = 10;
            } else {
                maxQuantity = data.stock;
            }
            productInfos.innerHTML += `
            <form id="formAddToCart" class="row row-cols-lg-auto g-3 align-items-center">
                <div><label>Quantité</label></div>
                <div><input type="number" min="1" max="${maxQuantity}" id="quantity" class="form-control" value="1"></div>
                <div><button class="btn btn-success" id="addToCart" type="submit">Ajouter au panier</button></div>   
            </form>
        `;
        }

        document.getElementById('formAddToCart').addEventListener('submit', function (e) {
            e.preventDefault();

            let cart = [];
            let productQuantity = document.getElementById('quantity').value;

            if(JSON.parse(localStorage.getItem('cart'))) {
                cart = JSON.parse(localStorage.getItem('cart'));
            }
            console.log(cart);

            let productIndex = cart.findIndex(item => item.id === productId);

            if(productIndex === -1) {
                cart.push({id: productId, quantity: parseInt(productQuantity)});
            } else {
                cart[productIndex].quantity += parseInt(productQuantity);
            }

            localStorage.setItem('cart', JSON.stringify(cart));

            alert('Produit ajouté à votre panier');
            console.log(cart);
        });



    });

});