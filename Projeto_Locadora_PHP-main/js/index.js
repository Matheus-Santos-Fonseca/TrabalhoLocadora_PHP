//if(InformacoesPaises[i]["name"].common.toUpperCase().trim().normalize('NFD').replace(/[\u0300-\u036f]/g, "").includes(pais.toUpperCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").trim()))

/*
let divcarros = get.ElementByClassName('card-item');
let divcatalogo = get.ElementByClassName('catalogo');
let inputpesquisa = get.ElementByClassName('pesquisa');


*/
let n=1;

let ArrayCarros=[];
function ShowHideCards(indicePagina,limite, paginasExistentes) 
{                               
	document.getElementById('catalogo2').style.display='none';
	document.getElementById('catalogo1').style.display='block';

    

    //deixa o indice da pagina atual com borda         
	for (let i = 1; i <=Math.ceil(paginasExistentes); i++) 
	{
		document.getElementById('pag'+i).style.border='none'; //tira a borda de todos indices
	}
	document.getElementById('pag' + indicePagina).style.border = '2px solid black';
	document.getElementById('pag' + indicePagina).style.borderRadius = '10px';


	//esconde todos cards
	for(let i=1;i<=limite;i++)
	{ 
		document.getElementById('Card'+i).style.display='none';
	}

	let iteradorpaginas=indicePagina;
	let iteradorCardsInicio=indicePagina*6 - 5; //seta o inicio da contagem para 5 antes do final
	let iteradorCardsFim=indicePagina*6; //seta o fim da contagem para 6 cards acima do inicial

	//o for é <=, logo o fim é incluso, tecnicamente é uma função do primeiro grau
	// Y=6X-5, tendo por exemplo x=6 ,    y=31
	// pelo fato da contagem do for ser <=, ele teria como respostas 31,32,33,34,35,36
	for(iteradorCardsInicio;iteradorCardsInicio<=iteradorCardsFim;iteradorCardsInicio++)
	{
		document.getElementById('Card'+iteradorCardsInicio).style.display='flex';
		if(iteradorCardsInicio==limite) 
		{
			break;		
		}
	}
	
}


function Pesquisar(limite)
{
	ArrayCarros=[];
	buscaInput=document.getElementById('buscaInput').value;
	

	if(buscaInput=='' || buscaInput==null){
		let numpaginas=limite/6;
		numpaginas=Math.ceil(numpaginas)
		ShowHideCards(1,limite,numpaginas);
	}

	else
	{
	let modelo;
		for(let i=1;i<=limite;i++)
		{ 
			modelo = document.getElementById('modelo'+i).innerHTML; //pega o modelo do carro
			//Se um modelo existente incluir o que estiver escrito na busca, ele adiciona o Card no qual esta este modelo ao array
			if(modelo.toUpperCase().trim().normalize('NFD').replace(/[\u0300-\u036f]/g, "").includes(buscaInput.toUpperCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").trim()))
			{
				ArrayCarros.push(document.getElementById('Card'+i).id);
			}

		}
		CreateNewNav(limite);

	}//fim do else
} //fim da função



function CreateNewNav(limite){

let Npagi=ArrayCarros.length/6;
let lista='';
Npagi=Math.ceil(Npagi); //numero de paginas aqui
document.getElementById('cat2_box').innerHTML='';//limpa a ul com indices


//adicionar as li com os numeros de paginas aqui

for(let iter=1;iter<=Npagi;iter++)
{
	lista+='<li class=\"paginasIndice\" id=\"P'+iter+'\" onclick=SearchShow('+iter+','+limite+')>'+iter+'</li>';
}
	lista+='<li class=\"paginasIndice\" style="border:none;">...</li>';

document.getElementById('cat2_box').innerHTML+=lista;//adiciona a lis na nav



document.getElementById('catalogo1').style.display='none';
document.getElementById('catalogo2').style.display='block';

//Mostrar cards aqui
	SearchShow(1,limite);
}





function SearchShow(indice,limite)
{
for (let i = 1; i <=Math.ceil(ArrayCarros.length/6); i++) 
{
		
	document.getElementById('P'+i).style.border='none'; //tira a borda de todos indices
}
document.getElementById('P'+indice).style.border='1px solid black';//bota a borda no indice atual

for(let n=1;n<=limite;n++)
{
	document.getElementById('Card'+n).style.display='none';
}

let ArrayInicio=(indice-1)*6;
let ArrayFim=indice*6;

//outra conta simples que garante sempre a 6 iterações , e logo mostrar 6 cards
for(ArrayInicio;ArrayInicio<ArrayFim;ArrayInicio++)
{
	if(ArrayInicio==ArrayCarros.length-1) //acredito que este if pode ser removido ao adicionar ArrayFim = Math.min(ArrayFim, ArrayCarros.length) anteriormente ao codigo, fonte gabriel paulo torres
	{
		break;
	}
	document.getElementById(ArrayCarros[ArrayInicio]).style.display='flex';
}
//esconde todos cards



}



/* Modal */
let modal_locacao=document.getElementsByClassName("modal-locacao")[0];
let modal_usuario= document.getElementsByClassName("modal-usuario")[0];
let modal_feedback= document.getElementsByClassName("modal-feedback")[0];
let modal_devolucao= document.getElementsByClassName("modal-devolucao")[0];

// When the user clicks on the button, open the modal
function modalclick_usuario() {
  	modal_usuario.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
function spanclick_usuario() {
  	modal_usuario.style.display = "none";
}

// When the user clicks on the button, open the modal
function modalclick_feedback() {
	modal_feedback.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
function spanclick_feedback() {
	modal_feedback.style.display = "none";
}

function modalclick_devolucao() {
	modal_devolucao.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
function spanclick_devolucao() {
	modal_devolucao.style.display = "none";
}

//Abre o modal de locação e seta o valor do input text no modal com o valor da placa do carro clicado
function modalclick_locacao(placa) //abre o modal
{
modal_locacao.style.display = "block";
  
let valor=placa;
console.log(valor);
document.getElementById("AlugarVeiculo").value=valor;
}

function spanclick_locacao(){
 	modal_locacao.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target == modal_usuario) {
	  modal_usuario.style.display = "none";
	}
	if (event.target == modal_feedback) {
		modal_feedback.style.display = "none";
	}
	if (event.target == modal_locacao){
			modal_locacao.style.display = "none";
	}
	if (event.target == modal_devolucao){
        modal_devolucao.style.display = "none";
    }
}