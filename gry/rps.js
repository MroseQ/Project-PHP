let wynik = 0;
const wynik_span = document.getElementById("wynik_rps");
const wynik_div = document.querySelector(".tekst-górny");
const outcome_div = document.querySelector(".outcome > p");
const kamień_id = document.getElementById("kamień");
const papier_id = document.getElementById("papier");
const nożyce_id = document.getElementById("nożyce");
const wybór_przeciwnika_id = document.getElementById("wybór_przeciwnika"); 
let koniec = false;
let wynikphp = 0;
var handlerk = function() {
    ingame("kamień");
};
var handlerp =function() {
    ingame("papier");
};
var handlern = function() {
    ingame("nożyce");
};

function PowiększLiterę(wybór){
    return wybór.charAt(0).toUpperCase() + wybór.slice(1);
}

function losowanie_przeciwnika(){
    const losowanie = ['kamień','papier','nożyce'];
    const wylosowana = Math.floor(Math.random() * 3);
    wybór_przeciwnika_id.src = losowanie[wylosowana] + ".png";
    return losowanie[wylosowana]; 
}

function wygrana(wybór,przeciwnik) {
    wynik++;
    wynik_span.innerHTML = wynik;
    wybór = PowiększLiterę(wybór);
    if (wybór === "Nożyce") {
        outcome_div.innerHTML = "<b>" + wybór + " pokonują " + przeciwnik + ". <br> Zdobywasz punkt!</b>";
    } else {
    outcome_div.innerHTML = "<b>" + wybór + " pokonuje " + przeciwnik + ". <br> Zdobywasz punkt!</b>";
}}

function przegrana(wybór,przeciwnik) {
    wybór = PowiększLiterę(wybór);
    if (wybór === "Nożyce") {
        outcome_div.innerHTML = "<b>" + wybór + " przegrywają z " + przeciwnik + ". <br> Koniec gry!</b>";
    } else {
    outcome_div.innerHTML = "<b>" + wybór + " przegrywa " + przeciwnik + ". <br> Koniec gry!</b>";
    } 
    Zakoncz();
}

function remis(wybór,przeciwnik) {
    wybór = PowiększLiterę(wybór);
    if (wybór === "Nożyce") {
        outcome_div.innerHTML = "<b>" + wybór + " remisują z " + przeciwnik + ".</b>";
    } else {
    outcome_div.innerHTML = "<b>" + wybór + " remisuje z " + przeciwnik + ".</b>";
}}

function ingame(wybór) {
 const przeciwnik = losowanie_przeciwnika();
 switch (wybór + przeciwnik){
    case "kamieńnożyce":
    case "papierkamień":
    case "nożycepapier":
        wygrana(wybór,przeciwnik);    
    break;
    case "kamieńpapier":
    case "nożycekamień":
    case "papiernożyce":
        koniec = true;
        przegrana(wybór,przeciwnik);
    break;
    case "kamieńkamień":
    case "nożycenożyce":
    case "papierpapier":
        remis(wybór,przeciwnik); 
    break;    
 }
}

function main() {
    kamień_id.addEventListener('click', handlerk);
    papier_id.addEventListener('click', handlerp);
    nożyce_id.addEventListener('click', handlern);
    
}

function Zakoncz() {
    wynikphp = wynik;
    wynik = 0;
    kamień_id.removeEventListener('click', handlerk);
    papier_id.removeEventListener('click', handlerp);
    nożyce_id.removeEventListener('click', handlern);
    window.location.href="/Strona/gry/RPS.php?wynik=" + wynikphp +"&src=" + wybór_przeciwnika_id.src;
}

main();


