
class gra {
    constructor(src) {
    this.board = [1,2,3,4,5,6,7,8,9,10];
    this.src = src;
    this.score = 0;
    this.poprawna,this.wyższa,this.niższa = undefined;
    this.blokowanie = false;
    this.zakonczenie = false;
    this.src.innerHTML = `
        <div class="hints" style="font-family: sans-serif; font-size: 25px; text-align: center">
        
        </div>
        <div class="board" style="display: grid; background: #cccccc; gap: 10px; padding: 10px; flex-grow: 1; 
        grid-template-columns: repeat(5, 1fr);grid-template-rows: repeat(2, 1fr); font-weight: bold; font-family: sans-serif; font-size: 25px">
            <div class="board__tile" data-index="0">1</div>
            <div class="board__tile" data-index="1">2</div>
            <div class="board__tile" data-index="2">3</div>
            <div class="board__tile" data-index="3">4</div>
            <div class="board__tile" data-index="4">5</div>
            <div class="board__tile" data-index="5">6</div>
            <div class="board__tile" data-index="6">7</div>
            <div class="board__tile" data-index="7">8</div>
            <div class="board__tile" data-index="8">9</div>
            <div class="board__tile" data-index="9">10</div>
        </div>
        <br>
        <button type="button" id="next" class="next" style="margin-left: 36%; font-size: 25px" disabled>Następna gra</button>
        `;
    for(let i=0;i<this.board.length;i++){
        let tile = this.src.querySelector(`.board__tile[data-index="${i}"]`);
        tile.addEventListener("click", () => {
             if(this.blokowanie == false){
             tile.classList.remove("board__tile--win");
             tile.classList.remove("board__tile--lose");
             }
             this.onTileClick(tile.dataset.index);    
            });
        }
        var btn = document.getElementById("next");
        this.button = btn;
    }
    mainlogic(){
        this.poprawna = Math.floor(Math.random() * 10);
        this.wyższa = this.poprawna + Math.floor(Math.random()*3 +2);
        if(this.wyższa<3){
            this.wyższa=3;
        }
        this.niższa = this.wyższa-Math.floor(Math.random()*3+2);
        if(this.niższa>this.poprawna){
            this.niższa = this.niższa-2;
        }
        if(this.niższa<0){
            this.niższa = 0;
        }
        this.TworzenieHintów(this.wyższa,this.niższa);
        this.interval = this.UtwórzInterval();
        
    }
    onTileClick(zaznaczona){
        if(this.blokowanie==false){
        TaGra.updateBoard(zaznaczona);
        this.blokowanie=true;
        if(this.zakonczenie==false){
        this.button.disabled = false;
        }
        clearInterval(this.interval);
    }}
    TworzenieHintów(){
        this.wyższyhint = "Ta liczba jest mniejsza niż <b> " + this.wyższa + " </b>";
        this.niższyhint = "Ta liczba jest większa niż <b>" + this.niższa + " </b>";
        this.src.querySelector(".hints").innerHTML = `${this.wyższyhint}<br>${this.niższyhint}`;
    }

    updateBoard(zaznaczona){
            let tile = undefined;
            for(let j=0;j<10;j++){
                tile = this.src.querySelector(`.board__tile[data-index="${j}"]`); 
                tile.classList.remove("board__tile--win");
                tile.classList.remove("board__tile--lose");
            }
            tile = this.src.querySelector(`.board__tile[data-index="${zaznaczona}"]`);
            if(zaznaczona==this.poprawna){
                tile.classList.add("board__tile--win");
                this.score++;
                this.wyższyhint = "Gratulacje! Zdobywasz punkt!";
                this.niższyhint = "--Kliknij przycisk by grać dalej--";
                this.src.querySelector(".hints").innerHTML = `${this.wyższyhint}<br>${this.niższyhint}`;

            }else{
                tile.classList.add("board__tile--lose"); 
                tile = this.src.querySelector(`.board__tile[data-index="${this.poprawna}"]`)
                tile.classList.add("board__tile--win");
                this.zakonczenie=true;
                this.score=0;
                this.wyższyhint = "Koniec gry! <b> !!Zapisywanie wyniku... </b>";
                this.niższyhint = "--Restartuje...--";
                this.src.querySelector(".hints").innerHTML = `${this.wyższyhint}<br>${this.niższyhint}`;
                setTimeout(() => {
                    this.newgame();    
                }, 1500);
               
    }
    
    
    }
    returnZakonczenie(){
        return this.zakonczenie;
    }
    newgame(){
        window.location.href="/Strona/gry/PTT.php?koniec="+this.zakonczenie +"&wynik=" + this.score;
    };
    UtwórzInterval(){
        var variable = setInterval(() => { 
        if(this.zakonczenie==true){
            delete this;
        }
    }, 1500);
    return variable;
    };
}
const Hrefstring = window.location.search;
const Urlparams = new URLSearchParams(Hrefstring);
let score = Urlparams.get("wynik");
if(score==undefined){
document.getElementById("wynik_ptt").innerHTML = "0";
}else{
document.getElementById("wynik_ptt").innerHTML = score;
}
let TaGra = new gra(document.getElementById("widokgry"));
TaGra.score = score;
let zakonczenie = false;
TaGra.mainlogic();
TaGra.button.onclick = function(){
    TaGra=TaGra.newgame();
};

