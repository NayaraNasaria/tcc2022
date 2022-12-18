$(document).on('click', '#perfil', function () {
    document.getElementById('perfil').click();
});


var redimensionar = $('#preview').croppie({
    //Renderizar corretamente a imagem
    enableExif: true, 
    enableOrientation: true,

    viewport: {width: '100%', height: 500, type: 'square'},

    boundary: { width: 300, height: 300 },
});

//executa quando o usuário selecionar imagem
$('#perfil').on('change', function(){
    // FileReader é para ler o conteúdo dos arquivos
   var reader = new FileReader();

   //executar após ler
   reader.onload = function(e){
    redimensionar.croppie('bind', {
        url: e.target.result
    });
   }

//ler se é blob ou file
   reader.readAsDataURL(this.files[0]);
   
});


// function abrirModal(carregarModal){
//    let modal = document.getElementById(carregarModal);

//    modal.style.display = 'block';

//    document.body.style.overflow = 'hidden';
// }

function fecharModal(fecharModal){
    let modal = document.getElementById(fecharModal);

    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

