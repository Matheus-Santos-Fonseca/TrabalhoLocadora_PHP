window.onclick = function(event) //fecha o modal com os dados de enviar email pra recuperar a senha
{
    if (event.target == modalUpdateCarro)
    {
        modalUpdateCarro.style.display = "none";
    }
}
 
var span = document.getElementById("close");

function showmodalUp(placa) //abre o modal
{
    let valor=placa;

    document.getElementById('modalUpdateCarro').style.display = "block";
    document.getElementById("Change_id").value=valor;
}

function Close() //fecha o modal ao clicar no x
{
    modalUpdateCarro.style.display = "none";
}