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
    <script type="text/javascript" src="../../js/function.js" defer></script>
    <title>Cadastro Autônomo</title>
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
                        <a class="nav-link active" aria-current="page" href="loginAutonomo.php">Entrar</a>
                    </li>
                    <img class="user" src="../../img/user.svg" alt="vertical-line" style="height: 25px; margin-top: 8px" />
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="card">
            <h3 class="card-title">Cadastre-se como Autônomo</h3>
            <p class="card-text">
                Conecte-se gratuitamente com clientes que contratarão seus serviços
            </p>
            <div class="card-body">
                <form action="../bd_conexao/cadAuto.php" method="post" id="form" name="form">
                    <div id="etapas">
                        <ul id="progress">
                            <li class="ativo" id="etapa1"><strong>Informações básicas</strong></li>
                            <li id="etapa2"><strong>Endereço</strong></li>
                            <li id="etapa3"><strong>Detalhes</strong></li>
                        </ul>
                    </div>
                    <fieldset>
                        <div class="form-group">
                            <label class="label" for="nome">Nome Completo</label>
                            <input type="text" class="form-control" name="nome" required id="nome" />
                            <div class="erro1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label" for="email">Email</label>
                            <input type="email" class="form-control" required name="email" id="email" placeholder="email12345@email.com" />
                            <div class="erro2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label" for="senha">Senha</label>
                            <input type="password" id="senha" class="form-control" required name="senha" id="senha" placeholder="••••••" />
                            <div class="erro3">
                            <input type="checkbox" onclick="Mostrar()" style="margin-top: 5%;"> Mostrar Senha</input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label" for="genero">Gênero</label>
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
                            <label class="label" for="dataNascimento">Data de Nascimento</label>
                            <input type="date" class="form-control" required name="dataNascimento" id="dataNascimento" />
                            <div class="erro5">
                            </div>
                        </div>
                        <input type="button" id="next1" class="next" name="next1" value="Próximo" style="margin-top: 10%;"/>
                        <p class="texto">Já possui cadastro? <a href="loginAutonomo.php">Entre na sua conta</a></p>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="label" for="cep">CEP</label>
                            <input type="text" class="form-control" name="cep" required id="cep" />
                            <div class="erro6">
                            </div>
                        </div>
                        <div class="form-grouprow">
                            <div class="form-col" style="width: 65%">
                                <label class="label" for="cidade">Cidade</label>
                                <input type="text" class="form-control" readonly name="cidade" required id="cidade" />
                            </div>
                            <div class="form-col1" style="width: 30%">
                                <label class="label" for="estado">Estado</label>
                                <input type="text" class="form-control" readonly name="estado" required id="estado" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label" for="bairro">Bairro</label>
                            <input type="text" class="form-control" readonly name="bairro" required id="bairro" />
                        </div>
                        <div class="form-group">
                            <label class="label" for="rua">Rua</label>
                            <input type="text" class="form-control" readonly name="rua" required id="rua" />
                        </div>
                        <div class="form-grouprow">
                            <div class="form-col" style="width: 30%;">
                                <label class="label" for="num_casa">N°</label>
                                <input type="text" class="form-control" name="num_casa" required id="num_casa" />
                                <div class="erro7">
                                </div>
                            </div>
                            <div class="form-col1" style="width: 65%;">
                                <label class="label" for="complemento">Complemento</label>
                                <input type="text" class="form-control" name="complemento" id="complemento" />
                            </div>
                        </div>
                        <input type="button" id="prev" class="prev" value="Anterior" style="margin-top: 10%;" />
                        <input type="button" id="next" class="next" name="next2" value="Próximo" style="margin-top: 10%;" />
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="label" for="celular">Telefone</label>
                            <input type="tel" class="form-control" name="celular" placeholder="(11) 9 9999-9999" required id="celular" />

                        </div>
                        <div class="form-group">
                            <label class="label" for="area">Área de Atuação:</label>
                            <select type="text" class="form-select" name="area" required id="area">
                                <option value="1"> Diarista </option>
                                <option value="2"> Estética </option>
                                <option value="3"> Aulas </option>
                                <option value="4"> Fotografia </option>
                                <option value="5">Babá</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="label" for="esp">Selecionar Especificações:</label>
                            <select type="text" class="select2 form-control" multiple="multiple" name="esp[]" required id="esp"></select>
                            <select class="hidden esp-a1">
                                <option value="Faxina Básica"> Faxina Básica </option>
                                <option value="Faxina Completa"> Faxina Completa </option>
                                <option value="Passar Roupa"> Passar Roupa </option>
                            </select>
                            <select class="hidden esp-a2">
                                <option value="Manicure"> Manicure </option>
                                <option value="Pedicure"> Pedicure </option>
                                <option value="Limpeza de Pele"> Limpeza de Pele </option>
                                <option value="Design de Sobrancelha"> Design de Sobrancelha </option>
                                <option value="Maquiagem Simples"> Maquiagem Simples </option>
                                <option value="Maquiagem Elaborada"> Maquiagem Elaborada </option>
                            </select>
                            <select class="hidden esp-a3">
                                <option value="Humanas"> Humanas </option>
                                <option value="Exatas"> Exatas </option>
                                <option value="Língua Estrangeira"> Língua Estrangeira </option>
                            </select>
                            <select class="hidden esp-a4">
                                <option value="Festa"> Festa </option>
                                <option value="Formatura"> Formatura </option>
                                <option value="Book Gravidez"> Book Gravidez </option>
                            </select>
                            <select class="hidden esp-a5">
                                <option value="Mensal"> Mensal </option>
                                <option value="Temporada"> Temporada </option>
                                <option value="Anual"> Anual </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="label" for="preco">Preço base:</label>
                            <input type="text" class="form-control" name="preco" required id="preco" placeholder="0.00" />
                            <p class="form__claim-error-text10">Números quebrados devem ser separados por ponto (.)</p>
                        </div>
                        <div class="form-grouprow">
                            <div class="form-col" style="width: 65%;">
                                <label class="label" for="tempo">Tempo de Experiência:</label>
                                <input type="text" class="form-control" name="tempo" required id="numero" />
                            </div>
                            <div class="form-col1" style="margin-top: 1.3%; width: 30%; margin-bottom: 3%;">
                                <label class="label" for="espTempo"></label>
                                <select type="text" class="form-control" name="espTempo" required id="espTempo">
                                    <option>Ano(s)</option>
                                    <option>Mês(es)</option>
                                    <option>Dia(s)</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-grouprow">
                            <label class="labelcheckbox" for="checkbox">Concordo com os <a id="termos" href="#" style="text-decoration: none;color: #f2f2f2;font-weight: bold;">termos e política de privacidade</a>.</label>
                            <input type="checkbox" class="checkbox" name="checkbox" required id="checkbox" />
                        </div>
                        <input type="button" id="prev" class="prev" value="Anterior">
                        </input>
                        <input type="submit" id="next" class="btnPress" value="Cadastrar">
                        </input>
                        <p class="texto">Já possui cadastro? <a href="loginAutonomo.php">Entre na sua conta</a></p>
                    </fieldset>
                </form>
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
                <!-- detalhes script configuração -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
                <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />

                <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
                <script type="text/javascript">
                    var SPMaskBehavior = function(val) {
                            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
                        },
                        spOptions = {
                            onKeyPress: function(val, e, field, options) {
                                field.mask(SPMaskBehavior.apply({}, arguments), options);
                            }
                        };

                    $('#celular').mask(SPMaskBehavior, spOptions);
                </script>
                <script>
                    $(function() {
                        $(".hidden").hide();

                        $("select[id=esp]").html($("select.esp-a1").html());

                        $("select[id=area]").change(function() {
                            var id = $("select[id=area]").val();

                            $("select[id=esp]").empty();

                            $("select[id=esp]").html($("select.esp-a" + id).html());
                        });
                        $(".select2").select2();
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
