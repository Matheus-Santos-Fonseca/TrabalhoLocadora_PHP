const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});


/* Modal */
let modal_senha= document.getElementsByClassName("modal-senha")[0];

// Quando for clicado a div aparece
function modalclick_senha() {
	modal_senha.style.display = "block";
}

// Quando clicar no "X" a div se "fecha"
function spanclick_senha() {
	modal_senha.style.display = "none";
}

// Para quando clicar fora fechar também
window.onclick = function(event) {
	if (event.target == modal_senha) {
		modal_senha.style.display = "none";
	}
}
function fecharMensagem() 
{
const mensagem = document.getElementById('id');
    if (mensagem==true)
	{
        mensagem.style.display = 'none';
    }
}