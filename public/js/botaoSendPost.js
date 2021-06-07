/* *** função que lê a data e hora atual *** */
function getDateTime() {
    var today = new Date();
    var dia, mes, ano, date, hora, min, seg, time, dateTime;
    // para colocar a data/hora com 2 casas decimais -> ("0" + today.getxxxx()).slice(-2);
    // calcular o DIA -> dd/mm/aa
    dia = ("0" + today.getDate()).slice(-2);
    mes = ("0" + (today.getMonth() + 1)).slice(-2);
    ano = today.getFullYear();
    date = dia + '/' + mes + '/' + ano;

    // calcular HORA -> hh/mm/ss
    hora = ("0" + today.getHours()).slice(-2);
    min = ("0" + today.getMinutes()).slice(-2);
    seg = ("0" + today.getSeconds()).slice(-2);
    time = hora + ':' + min + ':' + seg;
    // dateTime final
    dateTime = date + ' ' + time;

    return dateTime;
}


/* função que lê o valor atual do atuador e altera o mesmo para o 'contrário' do que está */
function setValor(valor) {
    var valorFinal;
    var valorAtual = valor;

    if (valorAtual == '0') {
        // se está fechada, vai abrir
        valorFinal = '1'; 
    } else {
        // se estiver aberta, fecha a porta
        valorFinal = '0';
    }
    return valorFinal;
}


/* ***** POST a partir do botão ***** */

//vai buscar e colocar o caminho/url sem o 'index.php'
var url = window.location.pathname;
var urlDirname = url.slice(0, -10);

//envia POST para a API consuante o atuador 'selecionado/clicado'
function btnEstado(obj) {
    var nomeSensor = obj.name;
    var valorSensor = obj.value;
    //console.log(obj.name, obj.value);

    var api = urlDirname + "/api/api.php"; // url/caminho para a 'api.php'

    $.post(api, { // criação do array para envio POST
        nome: nomeSensor,
        valor: setValor(valorSensor),
        hora: getDateTime()
    },
    function (data, status) { // mostra o array criado do POST
        alert(data + "\nStatus: " + status);
    })
    .done(function() { // confirma caso tenha corrido bem
        alert( "POST realizado com sucesso!" );
    })
    .fail(function() {// caso contrário avisa que ocurreu um erro ao ralizar o POST
        alert( "ERRO na realização do POST" );
    });
}




