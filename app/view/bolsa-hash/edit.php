<!doctype html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bolsa família - CRUD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">
    <?php if($BolsaUser):?>
    <h1 class="text-primary text-center">Editar registro - Bolsa Família</h1>
    <hr>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-8 col-md-offset-3 col-sm-offset-2 col-lg-offset-3">

            <?php if(count($errors)> 0) foreach ($errors as $error):?>
                <div class="row">
                    <div class="alert alert-danger">
                        <i class="fa fa-exclamation-triangle fa-fw"></i> <strong><?= $error;?></strong>
                    </div>
                </div>
            <?php endforeach;?>

            <form class="form-horizontal" method="POST" action="bolsa-hash-update.php">
                <input type="hidden" name="offset" value="<?= $offset;?>">
                <input type="hidden" name="length" value="<?= $length;?>">
                <?php foreach ($BT as $config):?>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label for="field<?= md5($config);?>" class="control-label"><?= $config;?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text"
                                       class="form-control"
                                       id="field<?= md5($config);?>"
                                       name="<?= $config;?>"
                                       value="<?= isset($old[$config]) ? $old[$config] : $BolsaUser->{"get".$config}();?>">
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>

                <div class="row" style="margin-top: 20px">
                    <button type="submit" class="btn btn-warning btn-block">
                        <i class="fa fa-pencil-alt fa-lg fa-fw"></i> EDITAR
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php else:?>
        <div class="row">
            <div class="col-md-6 col-lg-6 col-lg-offset-3 col-md-offset-3 col-sm-12 col-sm-offset-0">
                <h1 class="text-danger text-center">REGISTRO NÃO ENCONTRADO</h1>
                <hr>
                <a href="bolsa-hash.php" class="btn btn-danger pull-right">VOLTAR</a>
            </div>
        </div>
    <?php endif;?>
</div>
</body>
</html>