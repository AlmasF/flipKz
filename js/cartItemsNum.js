const cartItems = document.getElementById("cart-image-items");
const cartText = document.getElementById("cart-image-text");
const base_url_cartItems = document.body.dataset.baseurl;

let currentUserId = localStorage.getItem("user_id");
// console.log(localStorage.getItem("user_id"));
// console.log(currentUserId);

function getCartItemsNum(currentUserId){
    axios.get(base_url_cartItems + "/api/good/get-cart-elements.php?user_id=" + currentUserId).then(res => {
        
        //console.log(res.data);
        showItemsNum(res.data);
    })
}

function showItemsNum(num)
{
    if(Number.isInteger(num) && num != 0) {
        //console.log(num);
        cartItems.innerText = num;
        cartText.innerText = '';
    }
    else if(num == 0){
        //console.log(num, 'in');
        cartItems.innerText = 0;
        cartText.innerHTML = 'Корзина <br> пуста';
        //console.log(cartText.innerText);
    }
}

getCartItemsNum(currentUserId);