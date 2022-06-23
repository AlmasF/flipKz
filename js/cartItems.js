const buyButtonCart = document.getElementById("buy-button-cart");

function getCartItems(){
    axios.get(base_url + "/api/good/get-cart-items?user_id=" + currentUserIdCart).then(res => {
        console.log(res.data);
        showCartItems(res.data);
    })
}

function removeFromCart(id_in_cart) {
    axios.get(base_url + "/api/good/remove-from-cart?id=" + id_in_cart).then(res => {
        getCartItems();
        getCartItemsNum(currentUserId);
    })
}

function showCartItems(goods) {
    
    let goodsItemsHtml = '';

    
    for (let i = 0; i < goods.length; i++) {
        goodsItemsHtml += `
            <div class="goods-item cart">
                <div class="item-img-box">
                    <img src="${base_url}/${goods[i].image}" alt="" class="item-img">
                </div>
                <a href="${base_url}/good-info-page?id=${goods[i].id}">
                    <p class="item-title">${goods[i].name}</p>
                </a>
                <a href="">
                    <p class="item-company">${goods[i].company}</p>
                </a>
                <span>
                    <p class="item-price">${goods[i].price} тг</p>
                    <p class="item-date">${goods[i].date}</p>
                </span>
                <p class="good-item-buy remove" onclick='removeFromCart(${goods[i].cart_item_id})'>
                    Убрать из корзины
                </p>
            </div>
        `;
    }

    goodsItems.innerHTML = goodsItemsHtml;
    
    if(goods.length == 0) {
        goodsItems.innerHTML += "Нет товара!";
        buyButtonCart.innerHTML = ``;
    }
    else {
        buyButtonCart.innerHTML = 
        `
            <a href="api/good/buy">
                <button class="blue button">
                    Купить
                </button>
            </a> 
        `;
    }
}

getCartItems();