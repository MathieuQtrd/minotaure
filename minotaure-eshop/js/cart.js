document.addEventListener('DOMContentLoaded', function () {

    const cartContent = document.getElementById('cartContent');
    const cartTotal = document.getElementById('cartTotal');
    const clearCart = document.getElementById('clearCart');
    const payCart = document.getElementById('payCart');

    const token = localStorage.getItem('token');


    let total = 0;

    let cart = [];

    if(JSON.parse(localStorage.getItem('cart'))) {
        cart = JSON.parse(localStorage.getItem('cart'));
    }

    console.log(cart);

    if(cart.length === 0) {
        cartContent.innerHTML = '<p class="alert alert-danger">Votre panier est vide</p>';
    } else {
        cart.forEach(item => {
            fetch('http://localhost:8000/api/products/' + item.id)
            .then(response => response.json())
            .then(data => {
                let unitPrice = data.price;
                let quantityPrice = unitPrice * item.quantity;

                total += quantityPrice;

                let cartItem = `
                    <div class="row border my-3 p-3">
                        <div class="col-sm-2 fw-bold">${data.title}</div>
                        <div class="col-sm-2"><img src="http://localhost:8000/storage/${data.image}" class="img-thumbnail" width="50"></div>
                        <div class="col-sm-2">Prix unitaire : ${data.price} €</div>
                        <div class="col-sm-2">Quantité : ${item.quantity}</div>
                        <div class="col-sm-2">Prix : ${quantityPrice} €</div>
                        <div class="col-sm-2">
                            <span class="btn btn-danger" onclick="removeItem(${item.id})">Retirer</span>
                        </div>
                    </div>
                `;

                cartContent.innerHTML += cartItem;
                cartTotal.innerHTML = 'Prix total : ' + total + ' €';
                
            });
        });

        let buttonClearCart = document.createElement('button');
        buttonClearCart.className = "btn btn-danger";
        buttonClearCart.textContent = "Vider le panier";
        buttonClearCart.addEventListener('click', function () {
            localStorage.removeItem('cart');
            window.location.reload();
        });
        document.getElementById('clearCart').appendChild(buttonClearCart);

        if(token) {
            let buttonPayCart = document.createElement('button');
            buttonPayCart.className = "btn btn-success";
            buttonPayCart.textContent = "Payer le panier";
            buttonPayCart.addEventListener('click', function () {
                alert('Merci pour votre commande');
                // enregistrement de la commande en bdd
                // mise à jour des stock
                localStorage.removeItem('cart');
                window.location.reload();
            });
            document.getElementById('payCart').appendChild(buttonPayCart);

        } else {
            payCart.innerHTML = 'Veuillez vous <a href="login.php">connecter</a> ou vous <a href="register">inscrire</a> afin de payer votre panier';
        }


    }



});

function removeItem(productId) {
    let cart = [];

    if(JSON.parse(localStorage.getItem('cart'))) {
        cart = JSON.parse(localStorage.getItem('cart'));
    }

    let productIndex = cart.findIndex(item => item.id == productId);
    console.log(productIndex);
    console.log(productId);
    console.log(cart);
    if(productIndex !== -1) {
        cart.splice(productIndex, 1);
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    window.location.reload();
}