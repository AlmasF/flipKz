const goodsItemsDiv = document.getElementById("goods-items");
const goodsTitleDiv = document.getElementById("goods-title");
const mainGridDiv = document.getElementById("main-grid");
const giftsDiv = document.getElementById("gifts");
let inProgress = false;
let inProgressCategory = false;
let page = 0;

function getGoods(category_id) {
    inProgress = true;
    axios.get(`${base_url}/api/good/list.php?page=${page}`).then(res => {
        console.log(res.data);
        showGoods(res.data);
        inProgress = false;
    })
}

function showGoods(goods) {
    console.log(goods);

    let goodsHtml = '';

    for(let i = 0; i < goods.length; i++) {
        goodsHtml += `
        <div class="goods-item">
            <div class="item-img-box">
                <img src="${base_url}/${goods[i].image}" alt="" class="item-img">
            </div>
            <a href="good-info-page?id=${goods[i].id}">
                <p class="item-title">${goods[i].name}</p>
            </a>
            <a href='index?company=${goods[i].company}'>
                <p class="item-company">${goods[i].company}</p>
            </a>
            <span>
                <p class="item-price">${goods[i].price} тг</p>
                <p class="item-date">${goods[i].date.substring(0, 10)}</p>
            </span>
            <p class="good-item-buy" onclick='addToCart(${goods[i].id})'>
                В КОРЗИНУ
            </p>
        </div>
        `
    }

    if (goods.length > 0) goodsItemsDiv.innerHTML += goodsHtml;
}

getGoods(0);

window.onscroll = function() {
    // console.log(window.innerHeight, document.documentElement.scrollHeight, window.pageYOffset);
    // console.dir(window);

    if (window.innerHeight + window.pageYOffset >= document.documentElement.scrollHeight - 2 && !inProgress) {
        page++;
        getGoods();
    }
}