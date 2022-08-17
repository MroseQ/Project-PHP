class gra {
    constructor(src,prevscore) {
    this.losowanie = ["X","O"]
    this.turn = this.losowanie[Math.floor(Math.random() * 2)];
    this.board = new Array(9).fill(null); 
    this.score = prevscore; 
    this.src = src;
    this.DidScore = false;
    this.blokowanie = false;
    this.zakonczenie = false;
    this.src.innerHTML = `
        <div class="tura" style="font-family: sans-serif; font-size: 25px; text-align: center">
        
        </div>
        <div class="board" style="display: grid; background: #cccccc; gap: 10px; padding: 10px; flex-grow: 1; 
        grid-template-columns: repeat(3, 1fr);grid-template-rows: repeat(3, 1fr); font-weight: bold; font-family: sans-serif; font-size: 25px">
            <div class="board__tile" data-index="0"></div>
            <div class="board__tile" data-index="1"></div>
            <div class="board__tile" data-index="2"></div>
            <div class="board__tile" data-index="3"></div>
            <div class="board__tile" data-index="4">play!</div>
            <div class="board__tile" data-index="5"></div>
            <div class="board__tile" data-index="6"></div>
            <div class="board__tile" data-index="7"></div>
            <div class="board__tile" data-index="8"></div>
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
                 
                 this.onTileClick(tile.dataset.index);    
                 }
                });
    }
    var btn = document.getElementById("next");
        this.button = btn;
    this.bot();
    this.src.querySelector(".tura").textContent = `Tura ${this.turn}`;
}
    kolejnaTura() {
        this.turn = this.turn === "O" ? "X" : "O"
    }

    ruch(k) {
        if (!this.czyTrwa()){
            return;
        }
        
        if (this.board[k]){
            return;
        }
        this.board[k] = this.turn;
        if (!this.wygrywa()){
        this.kolejnaTura();
    }}
    
    wygrywa() {
        const wygrywające = [
            [0,1,2],
            [3,4,5],
            [6,7,8],
            [0,3,6],
            [1,4,7],
            [2,5,8],
            [0,4,8],
            [2,4,6],
        ];

        for (const kombinacja of wygrywające) {
            const [a,b,c] = kombinacja;

            if (this.board[a] && (this.board[a] === this.board[b] && this.board[a] === this.board[c])){
                return kombinacja;
            }
            
        }
        return null;
    }

    czyTrwa() {
        return !this.wygrywa() && this.board.includes(null);
    }

    onTileClick(k){
        this.ruch(k);
        this.bot();
        this.update();
}
    buttonEnable(){
        this.src.querySelector(".next").disabled = false;
    }
    
    update(){
        this.updateTurn();
        this.updateBoard();
    }
    updateTurn(){
        if (this.czyTrwa() == true){
        this.src.querySelector(".tura").textContent = `Tura ${this.turn}`;
    }else{
        const wygrywa = this.wygrywa();
        let endloop = false;
        let wygrany = undefined;
        if (wygrywa){
        for (let j = 0; endloop == false; j++){
            if(wygrywa.includes(j)){
            endloop = true;
            wygrany = this.board[j];
            }   
        }
            if(wygrany == "O"){
                this.src.querySelector(".tura").textContent = `Koniec gry! Zdobyto punkt!`;
                this.buttonEnable();
                this.score++; 
            }else if (wygrany == "X") {
                this.src.querySelector(".tura").textContent = `Koniec gry! Zapisywanie wyniku...`;
                setTimeout(() => {
                    this.zakonczenie = true;
                    this.newgame();
                }, 2000)
                
            }
        }else {
            endloop = true;
            this.src.querySelector(".tura").textContent = `Koniec gry! Remis`;
            this.buttonEnable();
    }}
    }
    updateBoard(){
        const wygrywa = this.wygrywa();

        for (let j = 0; j < this.board.length; j++){
            const tile = this.src.querySelector(`.board__tile[data-index="${j}"]`);
            
            tile.classList.remove("board__tile--win");
            tile.classList.remove("board__tile--lose");  
            tile.textContent = this.board[j];

            if(wygrywa && wygrywa.includes(j)){
               if(tile.textContent == "O"){
                tile.classList.add("board__tile--win"); 
            }else if (tile.textContent == "X"){
                tile.classList.add("board__tile--lose"); 
            }}
        }
    } 
    

     bot(){
        if (this.turn == "X" && this.czyTrwa()){
        setTimeout(() => {
        do{
        let wylosowana = Math.floor(Math.random() * 8.2)
        this.ruch(wylosowana);
        this.updateBoard();
        this.updateTurn();
        }while(this.turn == "X" && this.czyTrwa());
        },500);    
       
    }
}
    newgame(){
         window.location.href="/Strona/gry/TicTacToe.php?koniec="+this.zakonczenie +"&wynik=" + this.score;
    };
}
const Hrefstring = window.location.search;
const Urlparams = new URLSearchParams(Hrefstring);
let score = Urlparams.get("wynik");
let koniec = Urlparams.get("koniec");
if(score==undefined){
document.getElementById("wynik_ttt").innerHTML = 0;
}else{
    if(koniec=="false"){
    document.getElementById("wynik_ttt").innerHTML = score;
    }else{
        document.getElementById("wynik_ttt").innerHTML = 0;
        score = 0;    
    }
}
let TaGra = new gra(document.getElementById("widokgry"),score);
let zakonczenie = false;
TaGra.button.onclick = function(){
    TaGra.newgame();
};







