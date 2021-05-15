<?php

    include "dbconfig.php";

    var_dump($_POST);

    // lets check doacao
    if (isset($_POST['enviarDoacao']) && !empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['telefone'])) { 

        $nome       = $_POST['nome'];
        $email      = $_POST['email'];
        $telefone   = $_POST['telefone'];
        $celular      = str_replace("(", "", $_POST['telefone']);
        $celular2     = str_replace(")", "", $celular);
        $finalCelular = str_replace("-", "", $celular2);
        $texto      = $_POST['texto'];
        $alimento   = $_POST['alimento'];
        $descricao  = $_POST['descricao'];
        $quantidade = $_POST['qtd'];


        for($i = 0; $i < count($alimento); $i++) {
            $cadastrarProduto = $crud->cadastrarProdutos($nome, $email, $finalCelular, $alimento[$i], $descricao[$i], $quantidade[$i], $texto);
        }

    }

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>vpro | página inicial</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/one-page-wonder.min.css" rel="stylesheet">

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">VPRO | Bem-vindo</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="?#doacao">Faça sua doação</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Faça login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="masthead text-center text-white">
        <div class="masthead-content">
            <div class="container">
                <h1 class="masthead-heading mb-0">Unisal</h1>
                <h2 class="masthead-subheading mb-0">ADS - VPRO</h2>
                <a href="?#sobre" class="btn btn-primary btn-xl rounded-pill mt-5">Saiba mais</a>
            </div>
        </div>
        <div class="bg-circle-1 bg-circle"></div>
        <div class="bg-circle-2 bg-circle"></div>
        <div class="bg-circle-3 bg-circle"></div>
        <div class="bg-circle-4 bg-circle"></div>
    </header>



    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="p-5">
                        <img class="img-fluid rounded-circle" src="img/volunteer.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1" id="sobre">
                    <div class="missao p-5">
                        <h2 class="display-4">Missão</h2>
                        Com a desigualdade social e as dificuldades de muitas famílias no mundo todo, foi desenvolvida a Sociedade de São Vicente de Paulo com objetivo de aliviar o sofrimento de pessoas vulneráveis, de modo que ajudasse também a fortalecer a fé de seus membros.
                        O movimento tem origem católica e a maior parte das paróquias do mundo possui membros dos Vicentinos, um apelido carinhoso que o movimento é chamado atualmente. O nosso objetivo é auxiliar os membros dos Vicentinos da Paróquia
                        Santa Bárbara, localizada em Sumaré-SP, com o gerenciamento de beneficiários e de tarefas que hoje são feitas manualmente, onde estão sujeitos a possíveis anotações errôneas e acabam não sendo do alcance de todos.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="p-5">
                        <img class="img-fluid rounded-circle" src="img/volunteer2.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="missao p-5">
                        <h2 class="display-4">Quem somos</h2>
                        Chama-se Sociedade de São Vicente de Paulo (SSVP), também conhecida por Conferências de São Vicente de Paulo ou Conferências Vicentinas, é um movimento católico de leigos que se dedica, sob o influxo da justiça e da caridade, à realização de iniciativas
                        destinadas a aliviar o sofrimento do próximo, em particular dos economicamente mais desfavorecidos, mediante o trabalho coordenado de seus membros. A Sociedade de São Vicente de Paulo foi criada em Paris, no ano de 1833, por um
                        pequeno grupo de estudantes católicos liderados por Frédéric Ozanam. A pequena conferência de caridade atua até os dias de hoje, a sociedade se desenvolveu pelo mundo, realizando assim o desejo de seu fundador. No início do século
                        XIX, Paris estava envolta em agitações sociais e políticas, onde a revolução de julho representou um golpe fatal para a antiga monarquia bubônica. A Sociedade passou por múltiplas provas, uma revolução, três guerras. De 1861 a
                        1870 a circular Persigny ordenava a “dissolução” dos Conselhos resultando em um adormecimento temporário da Sociedade na França. O conflito mundial de 39-45 foi assassino, fazendo desaparecer as conferências. Nela foram expostas
                        as ideologias anticristãs que forçaram os irmãos de alguns países a cessarem suas reuniões, consideradas como subversivas e entrar na clandestinidade. Hoje em dia a sociedade continua sua expansão, principalmente nos países em
                        desenvolvimento, que agora reúnem dois terços das conferências. Esta nova repartição faz da SSVP uma precursora na reflexão e na ação em favor do desenvolvimento com os parceiros do Terceiro-Mundo. Segundo a SSPV Global (2019),
                        800.000 membros no mundo perpetuam o espírito de São Vicente de Paulo e a obra do Bem-aventurado Frédéric Ozanam e de seus amigos, continuando a ajudar os mais desfavorecidos e mantendo sempre viva a mensagem do Cristo.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Doação -->
    <section>
        <div class="container">
            <div class="missao p-5" id="doacao">
                <h2 class="display-4">Faça sua doação</h2>
                <form method="POST">
                <table class="table" id="dynamic_field">
                    <thead>
                        <!-- nome, email e telefone -->
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="nome" placeholder="Digite seu nome" required>
                            </td>
                            <td>
                                <input type="email" class="form-control" name="email" placeholder="Digite seu email" required>
                            </td>
                            <td>
                                <input type="telefone" class="form-control" id="telefone" name="telefone" placeholder="Digite seu telefone" required>
                            </td>
                        </tr>
                        <!-- texto -->
                        <tr>
                            <td colspan="3">
                                <textarea maxlength ="250" placeholder="Envie sua mensagem (máximo de 250 caracteres)" class="form-control" name="texto" rows="4" cols="50"></textarea>
                            </td>
                        </tr>
                        <!-- opções -->
                        <tr>
                            <!-- Produto -->
                            <td>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Selecione o produto</label>
                                    <select class="form-control" id="exampleFormControlSelect1"  name="alimento[]" required>
                                    <option selected>Escolha...</option>
                                    <option value="arroz">Arroz</option>
                                    <option value="feijão">Feijão</option>
                                    <option value="sal">Sal</option>
                                    <option value="oleo">Óleo</option>
                                    <option value="leite">Leite</option>
                                    </select>
                                </div>
                            </td>
                            
                            <!-- Quantidade -->
                            <td>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Selecione a quantidade</label>
                                    <select class="form-control" id="exampleFormControlSelect1"  name="qtd[]" required>
                                    <option selected>Escolha...</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    </select>
                                </div>
                            </td>

                            <!-- Descrição -->
                            <td>
                                <div class="form-group">
                                    <label for="descricao">Descrição</label>
                                    <input id="descricao" maxlength ="50" placeholder="Descreva o produto" class="form-control" name="descricao[]"></input>
                                </div>
                            </td>
                        </tr>

                        <tbody>
                </table>

                <!-- adicionar mais itens -->
                <button type="button" name="add" id="add" class="btn btn-outline-success" style="margin-left: 0%;border-radius: 19px;font-size: 13px;">Adicionar mais item</button>


                <!-- Enviar doação -->
                <div>
                    <button type="submit" name="enviarDoacao" class="btn btn-outline-primary" style="margin-left: 0%;border-radius: 19px;margin-top: 3%;font-size: 13px;">Enviar doação</button>
                </div>
                </form>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="py-5 bg-black">
        <div class="container">
            <p class="m-0 text-center text-white small">Copyright &copy; Your Website 2020</p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- script to add and remove new rows -->
    <script>
        $(document).ready(function() {
            var i = 1;
            $('#add').click(function() {
                i++;
                $('#dynamic_field').append('<tr id="row'+i+'"><td><div class="form-group"><label for="exampleFormControlSelect1">Selecione o produto</label><select class="form-control" id="exampleFormControlSelect1"  name="alimento[]" required><option selected>Escolha...</option><option value="arroz">Arroz</option><option value="feijão">Feijão</option><option value="sal">Sal</option><option value="oleo">Óleo</option><option value="leite">Leite</option></select></div></td><td><div class="form-group"><label for="exampleFormControlSelect1">Selecione a quantidade</label><select class="form-control" id="exampleFormControlSelect1"  name="qtd[]" required><option selected>Escolha...</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></div></td><td><div class="form-group"><label for="descricao">Descrição</label><input id="descricao" maxlength ="50" placeholder="Descreva o produto" class="form-control" name="descricao[]"></input></div></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-outline-danger btn_remove">X</button></td></tr>')
            });
            $(document).click('.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });
        });
    </script>

    <!-- mask -->
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/mask.js"></script>
    <script src="js/mask_2.js"></script>

    <!-- mask telefone -->
    <script type="text/javascript">
    $(document).ready(function(){
        $("#telefone").mask("(99)99999-9999");
    });
    </script>

</body>

</html>