const base_url = document.body.dataset.baseurl;
const goodsItems = document.getElementById("goods-items");
const currentUserIdCart = localStorage.getItem("user_id");

function addToCart(good_id) {
    axios.get(base_url + "/api/good/add-to-cart?good_id=" + good_id).then(res => {
        getCartItemsNum(currentUserIdCart);
    }) 
}