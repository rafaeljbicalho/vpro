<?php

include "dbconfig.php";

// mask número celular
function masc_tel($TEL) {
$tam = strlen(preg_replace("/[^0-9]/", "", $TEL));
    if ($tam == 13) { // COM CÓDIGO DE ÁREA NACIONAL E DO PAIS e 9 dígitos
    return "+".substr($TEL,0,$tam-11)."(".substr($TEL,$tam-11,2).")".substr($TEL,$tam-9,5)."-".substr($TEL,-4);
    }
    if ($tam == 12) { // COM CÓDIGO DE ÁREA NACIONAL E DO PAIS
    return "+".substr($TEL,0,$tam-10)."(".substr($TEL,$tam-10,2).")".substr($TEL,$tam-8,4)."-".substr($TEL,-4);
    }
    if ($tam == 11) { // COM CÓDIGO DE ÁREA NACIONAL e 9 dígitos
    return "(".substr($TEL,0,2).")".substr($TEL,2,5)."-".substr($TEL,7,11);
    }
    if ($tam == 10) { // COM CÓDIGO DE ÁREA NACIONAL
    return "(".substr($TEL,0,2).")".substr($TEL,2,4)."-".substr($TEL,6,10);
    }
    if ($tam <= 9) { // SEM CÓDIGO DE ÁREA
    return substr($TEL,0,$tam-4)."-".substr($TEL,-4);
    }
}

// UPDATE doação
if (isset($_POST['aprovar']) && !empty($_POST['aprovar'])) {

    $qtdAprovar = $_POST['qtdAprovar'];
    
    $itemAprovar = $_POST['itemAprovar'];

    $aprovarId = $_POST['aprovar'];

    $aprovarDoacao = $crud->aprovar_doacao($aprovarId, $qtdAprovar, $itemAprovar);

}

// select produtos
$doacaoArray = $crud->select("SELECT * FROM Doacao WHERE (aprovado = 0 OR aprovado is null)");

// select produtos where aprovados = 1
$doacaoAprovadosArray = $crud->select("SELECT * FROM Doacao WHERE aprovado = 1");

//var_dump($doacaosArray);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>vpro | relatório</title>

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
            <a class="navbar-brand" href="#">VPRO | Relatórios</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="?#doacao">Faça sua doação</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="estoque.php">Estoque VPRO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Faça login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section style="margin-top: 5%;">
        <div class="container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="8" scope="col">Doações recebidas</th>
                    </tr>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Mensagem</th>
                        <th scope="col">Item</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Qtd</th>
                        <th scope="col">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        
                        foreach($doacaoArray as $doacao) : 
                    
                        ?>
                        <form method="POST"> 
                        <input type="hidden" name="qtdAprovar" value="<?= $doacao['Qtd']; ?>">
                        <input type="hidden" name="itemAprovar" value="<?= $doacao['Item']; ?>">
                        <tr>
                            <td><?= $doacao['Nome'];   ?></td>
                            <td><?= $doacao['Email'];  ?></td>
                            <td>
                            <!-- whatsapp link -->
                            WhatsApp link: <a target="_blank" href="https://api.whatsapp.com/send?phone=55<?= $doacao['Telefone']; ?>"><?= masc_tel($doacao['Telefone']); ?></a>
                            </td>
                            <td><?= (!empty($doacao['Mensagem']) ? $doacao['Mensagem'] : '-');  ?></td>
                            <td><?= $doacao['Item'];  ?></td>
                            <td><?= $doacao['DescricaoItem'];  ?></td>
                            <td><?= $doacao['Qtd'];   ?></td>
                            <td><?= (empty($doacao['Aprovado']) ? '<button type="submit" name="aprovar" class="btn btn-outline-success aprovar" value="'.$doacao['DoacaoId'].'">Aprovar</button>' : 'Aprovado'); ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </section>

    <section style="margin-top: 5%;">
        <div class="container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="8" scope="col">Doações aprovadas</th>
                    </tr>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Mensagem</th>
                        <th scope="col">Item</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Qtd</th>
                        <th scope="col">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        
                        foreach($doacaoAprovadosArray as $doacao) : 
                    
                        ?>
                        <tr>
                            <td><?= $doacao['Nome'];   ?></td>
                            <td><?= $doacao['Email'];  ?></td>
                            <td>
                            <!-- whatsapp link -->
                            WhatsApp link: <a target="_blank" href="https://api.whatsapp.com/send?phone=55<?= $doacao['Telefone']; ?>"><?= masc_tel($doacao['Telefone']); ?></a>
                            </td>
                            <td><?= (!empty($doacao['Mensagem']) ? $doacao['Mensagem'] : '-');  ?></td>
                            <td><?= $doacao['Item'];  ?></td>
                            <td><?= $doacao['DescricaoItem'];  ?></td>
                            <td><?= $doacao['Qtd'];   ?></td>
                            <td><?= ($doacao['Aprovado'] == 1 ) ? '<span class="badge bg-success">Aprovado</span>' : 'Aprovado'; ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
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
                $('#dynamic_field').append('<tr id="row'+i+'"><td><div class="form-group"><label for="exampleFormControlSelect1">Selecione o produto</label><select class="form-control" id="exampleFormControlSelect1"  name="alimento[]" required><option selected>Escolha...</option><option value="arroz">Arroz</option><option value="feijão">Feijão</option><option value="sal">Sal</option></select></div></td><td><div class="form-group"><label for="exampleFormControlSelect1">Selecione o tipo</label><select class="form-control" id="exampleFormControlSelect1"  name="tipo[]" required><option selected>Escolha...</option><option value="KG">Kg</option><option value="Qtd">Qtd</option></select></div></td><td><div class="form-group"><label for="exampleFormControlSelect1">Selecione a quantidade</label><select class="form-control" id="exampleFormControlSelect1"  name="qtd[]" required><option selected>Escolha...</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></div></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-outline-danger btn_remove">X</button></td></tr>')
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