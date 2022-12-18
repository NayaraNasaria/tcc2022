$(document).ready(function () {
    var atual_fs, next_fs, prev_fs;

    //constantes do dados do usuário autônomo etapa 1
    const nome = document.getElementById('nome')
    const email = document.getElementById('email')
    const senha = document.getElementById('senha')
    const genero = document.getElementById('genero')
    const nascimento = document.getElementById('dataNascimento')
    //fim constantes

    //constantes do dados do usuário cliente etapa 1
    const celular = document.getElementById('telefone');
    //fim constantes

    function next(elem) {
        atual_fs = $(elem).parent();
        next_fs = $(elem).parent().next();

        $('#progress li,#progress2 li').eq($('fieldset').index(next_fs)).addClass('ativo');
        atual_fs.hide(800);
        next_fs.show(800);
    }

    $('.prev').click(function () {
        atual_fs = $(this).parent();
        prev_fs = $(this).parent().prev();

        $('#progress li,#progress2 li').eq($('fieldset').index(atual_fs)).removeClass('ativo');
        atual_fs.hide(800);
        prev_fs.show(800);
    });

    $('input[name=next1]').click(function () {
        // Se o valor de todos os objetos for igual ao tamanho do objeto menos 1, significa que tudo foi preenchido
        const pageOne = {
            nome: 0,
            email: 0,
            senha: 0,
            genero: 0,
            nascimento: 0,
        };
        // Essa variável transforma os objetos acima em array, assim podendo usar o método 'array.length'
        const pageOneObjects = Object.keys(pageOne);


        //validação nome
        const noSpecialCharacters = /^[a-zA-Z]+/g;
        if (nome.value == '') {
            //mostrar erro
            $('.erro1').html('<p class="form__claim-error-text">Preencha este campo.</p>');
            //adicionar classe error
            $('input[name=nome]').addClass('form-control error');
            pageOne.nome = 0;
        }
        else if (!nome.value.match(noSpecialCharacters)) {
            $('.erro1').html('<p class="form__claim-error-text2">Este campo não deve conter números e/ou caracteres especiais.</p>');
            $('input[name=nome]').addClass('form-control error');
            pageOne.nome = 0;
        }
        else if (nome.value.match(noSpecialCharacters)) {
            $('.erro1').html('');
            $('input[name=nome]').removeClass('form-control error');
            $('input[name=nome]').addClass('form-control success');
            pageOne.nome = 1;
        }

        //validação email
        const mailRegex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,15}(?:\.[a-z]{2})?)$/i;
        if (email.value == '') {
            //mostrar erro
            $('.erro2').html('<p class="form__claim-error-text">Preencha este campo.</p>');
            //adicionar classe error
            $('input[name=email]').addClass('form-control error');
            pageOne.email = 0;
        }
        else if (!email.value.match(mailRegex)) {
            $('.erro2').html('<p class="form__claim-error-text3">O email não segue o padrão indicado.</p>');
            $('input[name=email]').addClass('form-control error');
            pageOne.email = 0;
        }
        else if (email.value.match(mailRegex)) {
            $('.erro2').html('');
            $('input[name=email]').removeClass('form-control error');
            $('input[name=email]').addClass('form-control success');
            pageOne.email = 1;
        }

        //validação senha
        if (senha.value == '') {
            //mostrar erro
            $('.erro3').html('<p class="form__claim-error-text">Preencha este campo.</p>');
            //adicionar classe error
            $('input[name=senha]').addClass('form-control error');
            pageOne.senha = 0;
        }
        else if (senha.value.length >= 1 && senha.value.length < 6) {
            $('.erro3').html('<p class="form__claim-error-text4">Insira pelo menos 6 caracteres.</p>');
            $('input[name=senha]').addClass('form-control error');
            pageOne.email = 0;
        }
        else if (senha.value.length >= 6) {
            $('.erro3').html('');
            $('input[name=senha]').removeClass('form-control error');
            $('input[name=senha]').addClass('form-control success');
            pageOne.email = 1;
        }

        //validação genero
        if (genero.selectedIndex === 0) {
            //mostrar erro
            $('.erro4').html('<p class="form__claim-error-text5">O gênero não foi selecionado</p>');
            //adicionar classe error
            $('select[name=genero]').addClass('form-control error');
            pageOne.genero = 0;
        } else {
            $('.erro4').html('');
            $('select[name=genero]').removeClass('form-select error');
            $('select[name=genero]').addClass('form-select success');
            pageOne.genero = 1;
        }

        //validação data de nascimento
        if (nascimento.value == '') {
            //mostrar erro
            $('.erro5').html('<p class="form__claim-error-text6">A data de Nascimento não foi selecionada.</p>');
            //adicionar classe error
            $('input[name=dataNascimento]').addClass('form-control error');
            pageOne.nascimento = 0;
        }
        else {

            let hoje = new Date(); //Data Atual
            let dnasc = new Date(nascimento.value);

            let idade = hoje.getFullYear() - dnasc.getFullYear();
            let m = hoje.getMonth() - dnasc.getMonth();

            if (m < 0 || (m === 0 && hoje.getDate() < dnasc.getDate())) {
                idade--;
            }
            if (idade < 18) {
                //mostrar erro
                $('.erro5').html('<p class="form__claim-error-text7">É necessário ter pelo menos 18 anos.</p>');
                //adicionar classe error
                $('input[name=dataNascimento]').addClass('form-control error');
                pageOne.nascimento = 0;
            }
            if (idade >= 18 && idade <= 90) {
                $('.erro5').html('');
                $('input[name=dataNascimento]').removeClass('form-control error');
                $('input[name=dataNascimento]').addClass('form-control success');
                pageOne.nascimento = 1;
            }

            if (idade > 90) {
                //mostrar erro
                $('.erro5').html('<p class="form__claim-error-text8">É necessário ter no máximo 90 anos.</p>');
                //adicionar classe error
                $('input[name=dataNascimento]').addClass('form-control error');
                pageOne.nascimento = 0;
            }
        }
        if ((pageOne.nome + pageOne.email + pageOne.senha + pageOne.genero + pageOne.nascimento) == pageOneObjects.length - 1) {
            next(this);
        }
    });
    $('input[name=next2]').click(function () {
        //constantes do dados do usuário autônomo etapa 2
        const cep = document.getElementById('cep')
        const cidade = document.getElementById('cidade')
        const estado = document.getElementById('estado')
        const bairro = document.getElementById('bairro')
        const rua = document.getElementById('rua')
        const numero = document.getElementById('num_casa')
        const complemento = document.getElementById('complemento')
        //fim constantes

        // Se o valor de todos os objetos for igual ao tamanho do objeto menos 1, significa que tudo foi preenchido
        const pageTwo = {
            cep: 0,
            cidade: 0,
            estado: 0,
            bairro: 0,
            rua: 0,
            numero: 0,
            complemento: 0,
        };
        // Essa variável transforma os objetos acima em array, assim podendo usar o método 'array.length'
        const pageTwoObjects = Object.keys(pageTwo);

        //validando CEP e o conjunto
        if (cep.value == '') {
            //mostrar erro
            $('.erro6').html('<p class="form__claim-error-text">Preencha este campo.</p>');
            //adicionar classe error
            $('input[name=cep]').addClass('form-control error');
            pageTwo.cep = 0;
        }
        else{
            $('.erro6').html('');
            $('input[name=cep]').removeClass('form-control error');
            $('input[name=cep]').addClass('form-control success');
            pageTwo.cep = 1;
        }
        //validando cidade
        if(cidade.value == ''){
            $('input[name=estado]').addClass('form-control error');
            pageTwo.cidade = 0;
        }
        else{
            $('input[name=cidade]').removeClass('form-control error');
            $('input[name=cidade]').addClass('form-control success');
            pageTwo.cidade = 1;
        }
        //validando estado
        if(estado.value == ''){
            $('input[name=cidade]').addClass('form-control error');
            pageTwo.estado = 0;
        }
        else{
            $('input[name=estado]').removeClass('form-control error');
            $('input[name=estado]').addClass('form-control success');
            pageTwo.estado = 1;
        }
        //validando bairro
        if(bairro.value == ''){
            $('input[name=bairro]').addClass('form-control error');
            pageTwo.bairro = 0;
        }
        else{
            $('input[name=bairro]').removeClass('form-control error');
            $('input[name=bairro]').addClass('form-control success');
            pageTwo.bairro = 1;
        }
        //validando rua
        if(rua.value == ''){
            $('input[name=rua]').addClass('form-control error');
            pageTwo.rua = 0;
        }
        else{
            $('input[name=rua]').removeClass('form-control error');
            $('input[name=rua]').addClass('form-control success');
            pageTwo.rua = 1;
        }
        //validando o número da casa
        if (numero.value == '') {
            //mostrar erro
            $('.erro7').html('<p class="form__claim-error-text">Preencha este campo.</p>');
            //adicionar classe error
            $('input[name=num_casa]').addClass('form-control error');
            pageTwo.numero = 0;
        }
        else{
            $('.erro7').html('');
            $('input[name=num_casa]').removeClass('form-control error');
            $('input[name=num_casa]').addClass('form-control success');
            pageTwo.numero = 1;
            pageTwo.complemento = 1;
        }

        if ((pageTwo.cep + pageTwo.cidade + pageTwo.estado + pageTwo.bairro + pageTwo.rua + pageTwo.numero + pageTwo.complemento) == pageTwoObjects.length) {
            next(this);
        }
    });

    //validando cadastro do cliente

    $('input[name=next3]').click(function () {
        // Se o valor de todos os objetos for igual ao tamanho do objeto menos 1, significa que tudo foi preenchido
        const pageThree = {
            nome: 0,
            email: 0,
            senha: 0,
            genero: 0,
            nascimento: 0,
            celular: 0,
        };
        // Essa variável transforma os objetos acima em array, assim podendo usar o método 'array.length'
        const pageThreeObjects = Object.keys(pageThree);


        //validação nome
        const noSpecialCharacters = /^[a-zA-Z]+/g;
        if (nome.value == '') {
            //mostrar erro
            $('.erro1').html('<p class="form__claim-error-text">Preencha este campo.</p>');
            //adicionar classe error
            $('input[name=nome]').addClass('form-control error');
            pageThree.nome = 0;
        }
        else if (!nome.value.match(noSpecialCharacters)) {
            $('.erro1').html('<p class="form__claim-error-text2">Este campo não deve conter números e/ou caracteres especiais.</p>');
            $('input[name=nome]').addClass('form-control error');
            pageThree.nome = 0;
        }
        else if (nome.value.match(noSpecialCharacters)) {
            $('.erro1').html('');
            $('input[name=nome]').removeClass('form-control error');
            $('input[name=nome]').addClass('form-control success');
            pageThree.nome = 1;
        }

        //validação email
        const mailRegex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,15}(?:\.[a-z]{2})?)$/i;
        if (email.value == '') {
            //mostrar erro
            $('.erro2').html('<p class="form__claim-error-text">Preencha este campo.</p>');
            //adicionar classe error
            $('input[name=email]').addClass('form-control error');
            pageThree.email = 0;
        }
        else if (!email.value.match(mailRegex)) {
            $('.erro2').html('<p class="form__claim-error-text3">O email não segue o padrão indicado.</p>');
            $('input[name=email]').addClass('form-control error');
            pageThree.email = 0;
        }
        else if (email.value.match(mailRegex)) {
            $('.erro2').html('');
            $('input[name=email]').removeClass('form-control error');
            $('input[name=email]').addClass('form-control success');
            pageThree.email = 1;
        }

        //validação senha
        if (senha.value == '') {
            //mostrar erro
            $('.erro3').html('<p class="form__claim-error-text">Preencha este campo.</p>');
            //adicionar classe error
            $('input[name=senha]').addClass('form-control error');
            pageThree.senha = 0;
        }
        else if (senha.value.length >= 1 && senha.value.length < 6) {
            $('.erro3').html('<p class="form__claim-error-text4">Insira pelo menos 6 caracteres.</p>');
            $('input[name=senha]').addClass('form-control error');
            pageThree.email = 0;
        }
        else if (senha.value.length >= 6) {
            $('.erro3').html('');
            $('input[name=senha]').removeClass('form-control error');
            $('input[name=senha]').addClass('form-control success');
            pageThree.email = 1;
        }

        //validação genero
        if (genero.selectedIndex === 0) {
            //mostrar erro
            $('.erro4').html('<p class="form__claim-error-text5">O gênero não foi selecionado</p>');
            //adicionar classe error
            $('select[name=genero]').addClass('form-control error');
            pageThree.genero = 0;
        } else {
            $('.erro4').html('');
            $('select[name=genero]').removeClass('form-select error');
            $('select[name=genero]').addClass('form-select success');
            pageThree.genero = 1;
        }

        //validação data de nascimento
        if (nascimento.value == '') {
            //mostrar erro
            $('.erro5').html('<p class="form__claim-error-text6">A data de Nascimento não foi selecionada.</p>');
            //adicionar classe error
            $('input[name=dataNascimento]').addClass('form-control error');
            pageThree.nascimento = 0;
        }
        else {

            let hoje = new Date(); //Data Atual
            let dnasc = new Date(nascimento.value);

            let idade = hoje.getFullYear() - dnasc.getFullYear();
            let m = hoje.getMonth() - dnasc.getMonth();

            if (m < 0 || (m === 0 && hoje.getDate() < dnasc.getDate())) {
                idade--;
            }
            if (idade < 18) {
                //mostrar erro
                $('.erro5').html('<p class="form__claim-error-text7">É necessário ter pelo menos 18 anos.</p>');
                //adicionar classe error
                $('input[name=dataNascimento]').addClass('form-control error');
                pageThree.nascimento = 0;
            }
            if (idade >= 18 && idade <= 90) {
                $('.erro5').html('');
                $('input[name=dataNascimento]').removeClass('form-control error');
                $('input[name=dataNascimento]').addClass('form-control success');
                pageThree.nascimento = 1;
            }

            if (idade > 90) {
                //mostrar erro
                $('.erro5').html('<p class="form__claim-error-text8">É necessário ter no máximo 90 anos.</p>');
                //adicionar classe error
                $('input[name=dataNascimento]').addClass('form-control error');
                pageThree.nascimento = 0;
            }
        }
        if (celular.value == '') {
            //mostrar erro
            $('.erro6').html('<p class="form__claim-error-text">Preencha este campo.</p>');
            //adicionar classe error
            $('input[name=telefone]').addClass('form-control error');
            pageThree.celular = 0;
        }
        else{
            $('.erro6').html('');
            $('input[name=telefone]').removeClass('form-control error');
            $('input[name=telefone]').addClass('form-control success');
            pageThree.celular = 1;
        }
        if ((pageThree.nome + pageThree.email + pageThree.senha + pageThree.genero + pageThree.nascimento + pageThree.celular) == pageThreeObjects.length - 1) {
            next(this);
        }
    });

    //button function

    $('.first-button').on('click', function () {

        $('.animated-icon1').toggleClass('open');
    });

    $('.btnCancelar').on('click', function () {
        window.location.href = 'dadosPessoaisAutonomo.php';
    });
});



