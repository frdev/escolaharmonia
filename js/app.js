// Inicializa as funções de apoio do App
window.runApp = {};

// FUNÇÕES DE APOIO PARA O JAVASCRIPT

runApp.app = {

    getRandomColor:function() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
          color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    },
    /**
     * Arredonda as casas do valor informado, caso o valor informado seja string é convertido para float
     * @param  Float/String valor [Valor a ser arredondado]
     * @param  int digits         [Digitos a serem arredondados]
     * @return Float              [Valor arrredondado]
     */
     roundFloat:function(valor,digits){
        valor      = (valor != '')? valor : 0;
        var number = (typeof valor == 'string' && valor.indexOf(",") > -1)? parseFloat(valor.replace('.','').replace(',','.')) : parseFloat(valor);
        number     = (typeof digits === 'undefined')? parseFloat(number) : parseFloat(number).toFixed(digits);

        return number;
    },
    /**
     * Converte o valor passado para float
     * @param  int/float/string valor [Valor a ser convertido]
     * @return float                  [Valor convertido em float]
     */
    toFloat:function(valor){
        valor = (valor != '' && valor != null)? valor : 0;
        var number = (typeof valor == 'string' && valor.indexOf(",") > -1)? parseFloat(valor.replace(/[^0-9\,\.]+/i,'').replace('.','').replace(',','.')) : parseFloat(valor);

        return number;
    },
    /**
     * Faz o calculo de (valor * (percentual / 100))
     * @param  float valor      [Valor em reais]
     * @param  float percentual [Percentual a ser calculado]
     * @return float            [Valor calculado]
     */
    valorPercentual:function(valor,percentual){
        var valor      = runApp.app.toFloat(valor);
        var percentual = runApp.app.roundFloat(percentual) / 100;

        return valor * percentual;
    },
    /**
     * Converte o valor para percentual
     * @param  String/int/float valor [Valor a ser convertido]
     * @return float                  [Valor em percentual]
     */
    toPercentual:function(valor){
        valor = runApp.app.toFloat(valor);
        valor = valor / 100;

        return valor;
    },
    /**
     * Adiciona a mask nos campos passados como parametro
     * #Atenção: Para o funcionamento correto, é preciso estar carregado o plugin "jQuery-Mask-Plugin"
     * @param  Element target [Elemento a ser atualizadoi com a mascara]
     * @return void
     */
    realMask:function(target,valor){
        target.val(valor);
        target.mask("#.##0,99", {reverse: true});
    },
    /**
     * Formata o valor para real
     * @param  String/Int valor [Valor numerico ou string a ser convertido]
     * @return string           [Retorna o valor formatado para view em reais]
     */
    toReal:function(valor){
        valor = runApp.app.toFloat(valor);
        valor = runApp.app.numberFormat(valor,2,',','.');

        return valor;
    },
    /**
     * Formatação de moeda, assim como no PHP
     * @param  int/Float number        [Valor a ser formatado]
     * @param  int       decimals      [Quantidade de decimais]
     * @param  String    dec_point     [Separador de decimal]
     * @param  String    thousands_sep [Separador de milhares]
     * @return String                  [Valor formatado]
     */
    numberFormat:function(number, decimals, dec_point, thousands_sep){
        var n = number, prec = decimals;

        var toFixedFix = function (n,prec) {
            var k = Math.pow(10,prec);
            return (Math.round(n*k)/k).toString();
        }

        n = !isFinite(+n) ? 0 : +n;
        prec = !isFinite(+prec) ? 0 : Math.abs(prec);
        var sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep;
        var dec = (typeof dec_point === 'undefined') ? '.' : dec_point;

        var s = (prec > 0) ? toFixedFix(n, prec) : toFixedFix(Math.round(n), prec);
        //fix for IE parseFloat(0.55).toFixed(0) = 0;

        var abs = toFixedFix(Math.abs(n), prec);
        var _, i;

        if (abs >= 1000) {
            _ = abs.split(/\D/);
            i = _[0].length % 3 || 3;

            _[0] = s.slice(0,i + (n < 0)) +
                   _[0].slice(i).replace(/(\d{3})/g, sep+'$1');
            s = _.join(dec);
        } else {
            s = s.replace('.', dec);
        }

        var decPos = s.indexOf(dec);
        if (prec >= 1 && decPos !== -1 && (s.length-decPos-1) < prec) {
            s += new Array(prec-(s.length-decPos-1)).join(0)+'0';
        }
        else if (prec >= 1 && decPos === -1) {
            s += dec+new Array(prec).join(0)+'0';
        }

        return s;
    },
    bytesToSize:function(bytes){
        var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        if (bytes == 0) return '0 Byte';
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return Math.round(bytes / Math.pow(1024, i), 2) + sizes[i];
    },
    /**
     * Converte um valor para boolean
     * @param  {Mixed}        value 
     * @return {Boolean}
     */
    boolean:function(valor){
        var isTrue  = [true,'true',1,'1','on','yes'];
        var isFalse = [false,'false',0,'0','off','no'];
        //Caso o valor seja undefined é false
        if(typeof valor == 'undefined'){
            valor = false;
        }
        //True
        else if($.inArray(valor, isTrue) !== -1){
            valor = true;
        }
        //False
        else if($.inArray(valor, isFalse) !== -1){
            valor = false;
        }
        //Null
        else{
            valor = null;
        }

        return valor;
    }
}