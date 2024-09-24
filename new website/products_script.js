
function updateCartCount() {
    $.ajax({
        url: 'carticon.php',
        method: 'GET',
        success: function (data) {
            $('#cart-icon').text(data);
        },
        error: function () {
            console.error('Error fetching cart count');
        }
    });
}
updateCartCount();
document.addEventListener('DOMContentLoaded', function() {
    bindCardEvents();
    bindAddToCartButtons();
    
});

function bindCardEvents() {
    var cards = document.querySelectorAll('.card');
    cards.forEach(function(card) {
        card.addEventListener('click', function(event) {
            if (event.target.classList.contains('quantity') || event.target.classList.contains('add-to-cart')) {
                return;
            }
           
            var productId = card.getAttribute('data-id');
            window.location.href = 'productsdesc.php?id=' + productId;
        });
    });
} 

function bindAddToCartButtons() {
    var addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            //event.stopPropagation();
            var productId = this.getAttribute('data-id');
            var productName = this.getAttribute('data-name');
            var productPrice = this.getAttribute('data-price');
            var productImg = this.getAttribute('data-img');
            var quantityInput = document.querySelector('.quantity[data-id="' + productId + '"]');
            var productQuantity = quantityInput ? quantityInput.value : 1;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Added to cart',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                        } else if (response.status === 'exists') {
                            Swal.fire({
                                text: response.message,
                                icon: "info"
                            });
                        } else {
                            Swal.fire({
                                text: response.message,
                                icon: "error"
                            });
                        }
                        updateCartCount();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to add product to cart'
                        });
                    }
                }
            };
            xhr.open('POST', 'product_add.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            var params = 'action=add' +
                         '&id=' + encodeURIComponent(productId) +
                         '&name=' + encodeURIComponent(productName) +
                         '&price=' + encodeURIComponent(productPrice) +
                         '&img=' + encodeURIComponent(productImg) +
                         '&quantity=' + encodeURIComponent(productQuantity);
            xhr.send(params);
        });
    });
}

function filterProducts(updateURL = true) {
    var category = document.getElementById('categorySelect').value;
    var search = document.getElementById('searchInput').value;

    if (updateURL) {
        var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname + '?category=' + category + '&search=' + search;
        window.history.pushState({ path: newURL }, '', newURL);
    }

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.querySelector('#productDisplay').innerHTML = xhr.responseText;
                bindCardEvents();
                bindAddToCartButtons();
            } else {
                console.error('Error:', xhr.status);
            }
        }
    };
    xhr.open('GET', 'fetch_products.php?category=' + category + '&search=' + search, true);
    xhr.send();
}

document.getElementById('searchButton').addEventListener('click', function() {
    filterProducts();
});

document.addEventListener('DOMContentLoaded', function() {
    var urlParams = new URLSearchParams(window.location.search);
    var category = urlParams.get('category');
    var search = urlParams.get('search');

    if (category) {
        document.getElementById('categorySelect').value = category;
    } else {
        document.getElementById('categorySelect').value = ''; // Select "All" option
    }
    if (search) {
        document.getElementById('searchInput').value = search;
    }

    filterProducts(false); // Call filterProducts without updating the URL
});
