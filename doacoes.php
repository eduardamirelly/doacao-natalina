<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doação Natalina da Comunidade</title>
    <link rel="icon" type="image/svg" href="imgs/giftbox.svg">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
        $doacoes_roupas = fopen("doacoes_roupas.txt", "r");
        $roupas_total = fread($doacoes_roupas, filesize("doacoes_roupas.txt"));
        fclose($doacoes_roupas);

        $doacoes_alimentos = fopen("doacoes_alimentos.txt", "r");
        $alimentos_total = fread($doacoes_alimentos, filesize("doacoes_alimentos.txt"));
        fclose($doacoes_alimentos);

        $doacoes_valores = fopen("doacoes_valores.txt", "r");
        $valores_total = fread($doacoes_valores, filesize("doacoes_valores.txt"));
        fclose($doacoes_valores);
    ?>
    <section class="container">
        <div class="box">
            <div class="box-row">
                <div class="box">
                    <h1 class="obg">Total de Doações</h1>
                    <div class="resultado space">
                        <div class="informacoes">
                            <?php
                                $meta = "";
                                $roupas = round($roupas_total);
                                $alimentos = round($alimentos_total/3, 2);
                                $valores = round($valores_total/10, 2);
                                
                                $meta_con = 0;
                                
                                if($roupas > 100 and $alimentos > 100 and $valores > 100){
                                    $roupas = 100;
                                    $alimentos = 100;
                                    $valores = 100;
                                    $meta_con = 3;
                                }

                                if($meta_con > 2){
                                    $meta = "(Cumprida)";
                                }
                            ?>
                            <ul>
                                <li><h4>Roupas (unid.): <?php echo $roupas_total." <span>(". $roupas ."%)</span>"; ?></h4></li>
                                <li><h4>Alimentos (kg): <?php echo $alimentos_total." <span>(". $alimentos ."%)</span>"; ?></h4></li>
                                <li><h4>Valor Doado (R$): <?php echo $valores_total." <span>(". $valores ."%)</span>"; ?></h4></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <h1 class="obg">Meta <?php echo $meta; ?></h1>

                    <div class="resultado">
                        <div class="informacoes">
                            <ul>
                                <li><h4>Roupas (unid.): 100</h4></li>
                                <li><h4>Alimentos (kg): 300kg</h4></li>
                                <li><h4>Valor Doado (R$): R$1000</h4></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <a href="index.html" id="btn_voltar"><img src="imgs/undo-button-black.svg"> Voltar </a>
        </div>
    </section>
</body>
</html>