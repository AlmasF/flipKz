const menuCatalog = document.getElementById("menu-catalog");
const headerCatalog = document.getElementById("catalog");
const closeMenuCatalog = document.getElementById("close-menu-catalog");

function switcherCatalog() {
    console.log(menuCatalog.classList);
    if(menuCatalog.classList.contains("active")) {
        menuCatalog.classList.remove("active");
    }
    else {
        menuCatalog.classList.add("active");
    }
}

headerCatalog.addEventListener("click", switcherCatalog);
closeMenuCatalog.addEventListener("click", switcherCatalog);