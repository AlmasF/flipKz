document.getElementById("login-id").addEventListener("mouseover", bright);
document.getElementById("login-id").addEventListener("mouseout", unbright);

let darkBlock = document.getElementById("dark-block-id");

function bright() {
    darkBlock.style.display = "block";
    //console.log("did");
}

function unbright() {
    darkBlock.style.display = "none";
    //console.log("undid");
}