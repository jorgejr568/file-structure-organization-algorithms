<!doctype html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CEP SEARCHER</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
    <style type="text/css">
        .table-centered tbody tr td{
            text-align: center;
        }
        .table-centered thead tr th{
            text-align: center;
        }
        #arrayConsultsCollapse{
            display: none;
        }
        #arrayConsultsCollapseAction{
            -webkit-touch-callout: none; /* iOS Safari */
            -webkit-user-select: none; /* Safari */
            -khtml-user-select: none; /* Konqueror HTML */
            -moz-user-select: none; /* Firefox */
            -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none; /* Non-prefixed version, currently supported by Chrome and Opera */
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        use CEPSearcher\Model\Address;
        if($address):?>
            <?php
                $cepFormated=Address::cepHumanFormat($address->cep());
            ?>
            <h1 class="text-success">Resultado para busca do CEP <?= $cepFormated;?></h1>
            <hr>
            <div class="row">
                <div class="col-md-6 col-lg-6 col-lg-offset-3 col-md-offset-3 col-sm-12 col-sm-offset-0">
                    <h3 class="text-success">Informações</h3>
                    <hr>
                    <table class="table table-bordered table-hover table-centered">
                        <tbody>
                            <?php foreach (config("address_template") as $config => $size):?>
                                <?php if($config!="blank_space"):?>

                                    <tr>
                                        <td>
                                            <b><?= strtoupper($config);?></b>
                                        </td>
                                        <td>
                                            <?php printf("%.".$size."s",$address->$config());?>
                                        </td>
                                    </tr>
                                <?php endif;?>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-lg-6 col-lg-offset-3 col-md-offset-3 col-sm-12 col-sm-offset-0">
                    <h4 class="text-success" id="arrayConsultsCollapseAction"><i class="far fa-plus-square"></i> Array consults (<?= count($consults);?>)</h4>
                    <div class="row" id="arrayConsultsCollapse">
                        <div class="col-xs-12">
                            <hr>
                            <table class="table table-bordered table-hover table-centered">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>De</th>
                                    <th>Até</th>
                                    <th>Meio</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if(!function_exists("cepArrayConsultsCheckFind")){
                                        function cepArrayConsultsCheckFind($consult,$cepFormated){
                                            if(strpos($consult,$cepFormated)!==FALSE){
                                                return str_replace($cepFormated,"<b class='text-success'>".$cepFormated."</b>",$consult);
                                            }else return $consult;
                                        }
                                    }
                                ?>
                                <?php foreach ($consults as $i => $consult):?>

                                    <tr>
                                        <td><b><?= ($i+1);?></b></td>
                                        <td>
                                            <?= cepArrayConsultsCheckFind($consult['min'],$cepFormated);?>
                                        </td>
                                        <td>
                                            <?= cepArrayConsultsCheckFind($consult['max'],$cepFormated);?>
                                        </td>
                                        <td>
                                            <?= cepArrayConsultsCheckFind($consult['middle'],$cepFormated);?>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php else:?>
            <div class="row">
                <div class="col-md-6 col-lg-6 col-lg-offset-3 col-md-offset-3 col-sm-12 col-sm-offset-0">
                    <h1 class="text-danger">CEP NÃO ENCONTRADO</h1>
                    <hr>
                </div>
            </div>
        <?php endif;?>
        <a href="cep.php" class="btn btn-danger pull-right">VOLTAR</a>
    </div>

    <script
            src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous"></script>
    <script>
        $('#arrayConsultsCollapseAction').click(function(){
            $i=$(this).find('i');
            $i.toggleClass("fa-plus-square fa-minus-square");
            $('#arrayConsultsCollapse').slideToggle(100);
        });
    </script>
</body>
</html>