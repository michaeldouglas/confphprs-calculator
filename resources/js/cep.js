function BuscaEndereco(cep)
{
    this.cep = cep;
    _URL = "http://viacep.com.br/ws/";
    _TYPE = "/json/";

    this.getURL = function()
    {
        return _URL + this.cep + _TYPE;
    };

    this.requestEndereco = function(tipoDoMetodo, tipoDeRetorno)
    {
        this.request = $.ajax({
            url: this.getURL(),
            method: tipoDoMetodo,
            dataType: tipoDeRetorno
        });
    };

    this.endereco = function()
    {
        this.request.done(function( data ) {
            preencheDadosEnderecoCallBack(data);
        });
    }

    function preencheDadosEnderecoCallBack(data){
        if(!data.erro){
            // Exibe os dados
            $("#exibiEndereco").show();

            //Preenche o form
            $("#logradouro").val(data.logradouro);
            $("#bairro").val(data.bairro);
            $("#localidade").val(data.localidade);
        } else {
            console.error('OPS !');
        }
    }

    this.busca = function()
    {
        this.requestEndereco("GET", "json");
        this.endereco();
    }
}