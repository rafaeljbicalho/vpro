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

// select produtos where aprovados = 1
$estoqueArray = $crud->select("SELECT * FROM Estoque");


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>vpro | Estoque</title>

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
            <a class="navbar-brand" href="#">VPRO | Estoque</a>
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

    <section style="margin-top: 8%;margin-bottom: 6%;">
        <div class="container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="5" scope="col">Estoque VPRO</th>
                    </tr>
                    <tr>
                        <th scope="col">Item</th>
                        <th scope="col">Qtd disponível</th>
                        <th scope="col">Qtd saída</th>
                        <th scope="col">Destino</th>
                        <th scope="col">Registar saída</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        
                        foreach($estoqueArray as $estoque) : 
                    
                        ?>
                        <form method="POST"> 
                       <tr>
                            <td><?= $estoque['Item'];   ?></td>
                            <td><?= $estoque['Qtd'];  ?></td>
                            <td><?php if ($estoque['Qtd'] != 0) { ?>
                                <div class="form-group">
                                    <select style="margin-left: 22%;width: 60%;" class="form-control">
                                    <option disabled selected>Escolha...</option> 
                                    <?php for ($i=1; $i <= $estoque['Qtd']; $i++) { ?> 
                                        <option value="<?= $i; ?>"><?= $i; ?></option>
                                    <?php } ?>
                                    
                                    </select>
                                </div> 
                                <?php } else {
                                    echo "Não disponível";
                                }
                                ?>  
                            </td>
                            <td>
                                <input type="text" class="form-control" name="destino" placeholder="Digite destino" required>
                            </td>
                            <td><button type="submit" name="registrarSaida" class="btn btn-outline-primary aprovar">Registrar</button></td>
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