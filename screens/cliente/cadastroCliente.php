<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="format-detection" content="telephone=no" />
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="viewport" content="initial-scale=1, width=device-width, viewport-fit=cover" />
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/formulario.css" />
    <link rel="stylesheet" href="../../css/navbar.css" />
    <link href="../../node_modules/jquery/dist/jquery.js" />
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="../../js/function.js"></script>
    <title>Cadastro Cliente</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-faded" style="background-color: #f2f2f2;">
        <div class="container-fluid">
            <a class="navbar-brand">StreamLine</a>
            <button class="navbar-toggler first-button" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <div class="animated-icon1"><span></span><span></span><span></span><span></span></div>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <img class="home" src="../../img/casa.png" alt="home" style="height: 20px; width: 20px; margin-top: 8px" />
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../Home.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-current="page" href="#">Cadastrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="loginCliente.php">Entrar</a>
                    </li>
                    <img class="user" src="../../img/user.svg" alt="vertical-line" style="height: 25px; margin-top: 8px" />
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="card">
            <h3 class="card-title">Cadastre-se como Cliente</h3>
            <p class="card-text">
                Conecte-se gratuitamente com profissionais e contrate seus serviços
            </p>
            <div class="card-body">
                <form method="post" action="../bd_conexao/cadCli.php" id="form" name="form">
                    <div id="etapas">
                        <ul id="progress2">
                            <li class="ativo" id="etapa1"><strong>Informações básicas</strong></li>
                            <li id="etapa2"><strong>Endereço</strong></li>
                        </ul>
                    </div>
                    <fieldset>
                        <div class="form-group">
                            <label class="label" for="Nome">Nome Completo:</label>
                            <input type="text" class="form-control" name="nome" required id="nome" />
                            <div class="erro1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label" for="Email">Email:</label>
                            <input type="email" class="form-control" required name="email" id="email" placeholder="email12345@email.com" />
                            <div class="erro2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label" for="Senha">Senha:</label>
                            <input type="password" class="form-control" required name="senha" id="senha" placeholder="••••••••" />
                            <div class="erro3">
                            <input type="checkbox" onclick="Mostrar()" style="margin-top: 5%;"> Mostrar Senha</input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label" for="Genero">Gênero:</label>
                            <select class="form-select" required name="genero" id="genero">
                                <option>Selecione</option>
                                <option>Feminino</option>
                                <option>Masculino</option>
                                <option>Não-Binário</option>
                                <option>Prefiro não informar</option>
                            </select>
                            <div class="erro4">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label" for="DataNascimento">Data de Nascimento:</label>
                            <input type="date" class="form-control" required name="dataNascimento" id="dataNascimento" />
                            <div class="erro5">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label" for="Telefone">Celular:</label>
                            <input type="tel" class="form-control" required name="telefone" id="telefone" placeholder="(11) 9 9999-9999" />
                            <div class="erro6">
                            </div>
                        </div>
                        <input type="button" id="next1" class="next" name="next3" value="Próximo" style="margin-top: 10%;"/>
                        <p class="texto">Já possui cadastro? <a href="loginCliente.php">Entre na sua conta</a></p>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="label" for="Cep">CEP:</label>
                            <input type="text" class="form-control" name="cep" required id="cep" />
                        </div>
                        <div class="form-grouprow">
                            <div class="form-col" style="width: 65%">
                                <label class="label" for="Cidade">Cidade:</label>
                                <input type="text" class="form-control" name="cidade" readonly required id="cidade" />
                            </div>
                            <div class="form-col1" style="width: 30%">
                                <label class="label" for="Estado">Estado:</label>
                                <input type="text" class="form-control" name="estado" readonly required id="estado" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label" id="Bairro" for="Bairro">Bairro:</label>
                            <input type="text" class="form-control" name="bairro" readonly required id="bairro" />
                        </div>
                        <div class="form-group">
                            <label class="label" for="Rua">Rua:</label>
                            <input type="text" class="form-control" name="rua" readonly required id="rua" />
                        </div>
                        <div class="form-grouprow">
                            <div class="form-col" style="width: 30%;">
                                <label class="label" for="Cidade">N°:</label>
                                <input type="text" class="form-control" name="numero_casa" required id="numero_casa" />
                            </div>
                            <div class="form-col1" style="width: 65%;">
                                <label class="label" for="complemento">Complemento:</label>
                                <input type="text" class="form-control" name="complemento" id="complemento" />
                            </div>
                        </div>
                        <input type="button" id="prev" class="prev" value="Anterior" style="margin-top: 10%;" />
                        <input type="submit" id="next" class="btnPress" value="Cadastrar" style="margin-top: 10%;">
                        </input>
                    </fieldset>
                </form>
                <!-- telefone script configuração -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
                <script type="text/javascript">
                    $("#telefone").mask("(00) 00000-0000");
                </script>

                <!-- adress script configuração -->

                <!-- adress script configuração -->
                <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
                <script type="text/javascript">
                    $("#cep").mask("00000-000");
                </script>
                <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
                <script>
                    // Registra o evento blur do campo "cep", ou seja, a pesquisa será feita
                    // quando o usuário sair do campo "cep"
                    $("#cep").blur(function() {
                        // Remove tudo o que não é número para fazer a pesquisa
                        var cep = this.value.replace(/[^0-9]/, "");

                        // Validação do CEP; caso o CEP não possua 8 números, então cancela
                        // a consulta
                        if (cep.length != 8) {
                            return false;
                        }

                        // A url de pesquisa consiste no endereço do webservice + o cep que
                        // o usuário informou + o tipo de retorno desejado (entre "json",
                        // "jsonp", "xml", "piped" ou "querty")
                        var url = "https://viacep.com.br/ws/" + cep + "/json/";

                        // Faz a pesquisa do CEP, tratando o retorno com try/catch para que
                        // caso ocorra algum erro (o cep pode não existir, por exemplo) a
                        // usabilidade não seja afetada, assim o usuário pode continuar//
                        // preenchendo os campos normalmente
                        $.getJSON(url, function(resposta) {
                            try {
                                // Preenche os campos de acordo com o retorno da pesquisa
                                $("#estado").val(resposta.uf);
                                $("#cidade").val(resposta.localidade);
                                $("#bairro").val(resposta.bairro);
                                $("#rua").val(resposta.logradouro);
                            } catch (ex) {}
                            $("#numero").focus();
                        });
                    });
                </script>

                 <script>
            // Mostrar senha mudando o tipo de password para texto
                function Mostrar() {
                    var senha = document.getElementById("senha");
                    
                    if (senha.type === "password") {
                        senha.type = "text";
                    }
                    else {
                        senha.type = "password";
                    }
                }
                </script>

            </div>
        </div>
    </div>
    <footer>
        <p>© 2022 StreamLine - LMNNY</p>
    </footer>
</body>

</html>
