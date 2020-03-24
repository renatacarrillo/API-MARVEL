<!-- Nome: Renata Carrillo
    Curso: Sistemas para Internet
    Semestre: 4ºS
    P1 -->

<!DOCTYPE html>
<html lang='pt-BR'>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>API MARVEL</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="jumbotron">
        <div class="container">
            <h1 class="header-main-title">BUSCAR POR PERSONAGENS</h1>
            <form method="POST">
                <div class="form-group">
               <input type="search" name="PERSONAGEM" id="PERSONAGEM" class="form-control character-search-box" placeholder="(Ex: Hulk, Spider-Man, etc...)">
                </div>
            <button class="btn btn-danger mb-2 float-right type="submit">PESQUISAR</button>
            </form>
        </div>
    </div>

    <!-- <script src="js/main.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>


<!-- INICIANDO O PHP -->
<?php

$procura = isset($_POST['PERSONAGEM']) ? $_POST['PERSONAGEM'] : null;

// if(!empty($_POST['PERSONAGEM']))    {
//     if (strlen($_POST['PERSONAGEM']) > 0){
//         $procura = ($_POST['PERSONAGEM']);
//     } 

//     $array = array_filter($jsonMarvel, "validar");
//     pegaPersonagem($personagens);

// }

//criando a função que captura no html o personagem e retorna as informações correspondentes
function pegaPersonagem($procura)   {
    global $arrayMarvel;
    $ts = 1;
    $public_key = 'ee86c6aeb79fca753a17c9a4a12b4276';
    $private_key = 'bf3575c8300fde3be5f6767dcd7365d82e2a2654';
    $hash = md5($ts . $private_key . $public_key);
   
    //trazendo a url dos personagens
    $marvel_url = "https://gateway.marvel.com/v1/public/characters?nameStartsWith=$procura&ts=$ts&apikey=$public_key&hash=$hash";
   
    $json = file_get_contents($marvel_url);//FAZ O PARSING CRIANDO O ARRAY
    $jsonMarvel = json_decode($json);//(curl_exec($ch)); //recebe uma string codificada no formato json e passa para a variável jsonMarvel O SEGUNDO PARÂMETRO DETERMINA O RETORNO
    // print_r ($jsonMarvel);

        if ($jsonMarvel->data->total > 0){
            $total = $jsonMarvel->data->count;
            $arrayMarvel = $jsonMarvel->data->results;
                //  echo "<div class='card-group'>";
                //  echo "<div class='card'>";
                 echo "<div class='container'>";
                 echo "<div class='row d-flex align-items-center'>";
                for ($i=0; $i<$total; $i++){
                    $personagens = $arrayMarvel[$i]->name;
                    $imagem = $arrayMarvel[$i]->thumbnail->path;
                    // $descricao = $arrayMarvel[$i]->description;
                    
                    //IMPRIMINDO O RESULTADO
                    echo "<div class='col-sm-4'>";
                    echo "<br><h2 class='card-title text-white bg-dark'>" .$arrayMarvel[$i]->name ."</h2><br>";
                    echo "<img src='" .$arrayMarvel[$i]->thumbnail->path ."/portrait_uncanny.jpg' width:'100px180'><br>";
                    // echo "<p>" .$arrayMarvel[$i]->description ."</p>";

                    echo "</div>";

                    
                    
                }
                
            }
            // echo "</div>";
            // echo "</div>";
            echo "</div>";
            echo "</div>";
} 

if ($procura !=""){
    pegaPersonagem($procura);

}

// $procura = $_POST['PERSONAGEM'];
// $retornandoPersonagens = array_filter($arrayMarvel);
// pegaPersonagem($retornandoPersonagens);

?>
