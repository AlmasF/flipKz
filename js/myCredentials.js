let  showed = false;
const credentialsDiv = document.getElementById("credentials");

credentialsDiv.addEventListener("click", switchMyCredentials);

function switchMyCredentials() {
    (showed) ? hideMyCredentials() : showMyCredentials();
}

function hideMyCredentials() {
    showed = false;

    credentialsDiv.style.height = "60px";
    credentialsDiv.style.width = "60px";
    credentialsDiv.style.border = "none";
    credentialsDiv.style['border-radius'] = "50%";
    credentialsDiv.style['background-color'] = '#0a78d6';
    credentialsDiv.style.color = '#fff';
    credentialsDiv.style['line-height'] = '0px';
    credentialsDiv.innerText = '?';
}

function showMyCredentials() {
    showed = true;

    credentialsDiv.style.height = "200px";
    credentialsDiv.style.width = "200px";
    credentialsDiv.style.border = "5px solid #0a78d6";
    credentialsDiv.style['border-radius'] = "0%";
    credentialsDiv.style['background-color'] = '#fff';
    credentialsDiv.style.color = '#000';
    credentialsDiv.style['line-height'] = '28px';
    credentialsDiv.innerText = 'Разработчик: Алмас\nТелеграм: @frontier_tg';
    //console.dir(credentialsDiv.style);
    //console.log("wtf");
}