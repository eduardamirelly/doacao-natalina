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

        $nome_completo = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $qtd_roupas = $_POST['roupas'];
        $qtd_alimentos = $_POST['alimentos'];
        $valor = $_POST['valor'];

        $doacoes_categorias_not = 0;

        if($qtd_roupas == null and $qtd_alimentos == null and $valor == null){
            $qtd_roupas = 0;
            $qtd_alimentos = 0;
            $valor = 0;
            $doacoes_categorias_not = 3;
        }
        
        if($doacoes_categorias_not == 0){
            //Tratamento de Files
            $arquivo_foto_nome = $_FILES['imagem']['name'];
            $arquivo_endereco_tmp = $_FILES['imagem']['tmp_name'];
            $raiz = getcwd();
            $arquivo_endereco_destino = $raiz . DIRECTORY_SEPARATOR . "imgs_doacoes" . DIRECTORY_SEPARATOR . $arquivo_foto_nome;
            move_uploaded_file($arquivo_endereco_tmp, $arquivo_endereco_destino);

            //Lendo o que já está gravado
            $doacoes_roupas = fopen("doacoes_roupas.txt", "r");
            $roupas_total = fread($doacoes_roupas, filesize("doacoes_roupas.txt"));
            fclose($doacoes_roupas);

            $doacoes_alimentos = fopen("doacoes_alimentos.txt", "r");
            $alimentos_total = fread($doacoes_alimentos, filesize("doacoes_alimentos.txt"));
            fclose($doacoes_alimentos);

            $doacoes_valores = fopen("doacoes_valores.txt", "r");
            $valores_total = fread($doacoes_valores, filesize("doacoes_valores.txt"));
            fclose($doacoes_valores);

            //Adicionando
            $doacoes_roupas = fopen("doacoes_roupas.txt", "w+");
            fwrite($doacoes_roupas, strval(intval($roupas_total)+$qtd_roupas));
            fclose($doacoes_roupas);

            $doacoes_alimentos = fopen("doacoes_alimentos.txt", "w+");
            fwrite($doacoes_alimentos, strval(intval($alimentos_total)+$qtd_alimentos));
            fclose($doacoes_alimentos);

            $doacoes_valores = fopen("doacoes_valores.txt", "w+");
            fwrite($doacoes_valores, strval(intval($valores_total)+$valor));
            fclose($doacoes_valores);
        }
    ?>
    <!-- Recibo da Doação -->
    <section class="container"> 
        <div class="box">
            <?php
                if($doacoes_categorias_not == 3){
                    echo "<h2 class='obg'>Nenhuma doação foi registrada!</h2>";
                }else{
                    echo "<h2 class='obg'>Obrigado por sua doação!</h2>";
                }
            ?>
            <div class="resultado">
                <?php 
                    if($doacoes_categorias_not == 3){
                        if($arquivo_foto_nome != null){
                            echo "<img src='imgs_doacoes/".$arquivo_foto_nome."'>";
                        }else{
                            echo "<img src='imgs/snowball.svg'>";
                        }
                    }else{
                        if($arquivo_foto_nome != null){
                            echo "<img src='imgs_doacoes/".$arquivo_foto_nome."'>";
                        }else{
                            echo "<img src='imgs/snowball.svg'>";
                        }
                    }
                ?>
                <!-- Informações do Doador -->
                <div class="informacoes">
                    <ul>
                        <?php
                            if($doacoes_categorias_not == 3){
                                echo "<li><h4>Dados do Usuário</h4></li>";
                            }else{
                                echo "<li><h4>Dados da Doação</h4></li>";
                            }
                        ?>
                        <li><h6>Nome: <?php echo $nome_completo; ?></h6></li>
                        <li><h6>Telefone: <?php echo $telefone; ?></h6></li>
                        <li><h6>Roupas: <?php echo $qtd_roupas; ?></h6></li>
                        <li><h6>Alimentos: <?php echo $qtd_alimentos; ?></h6></li>
                        <li><h6>Valor Doado: R$<?php echo $valor; ?></h6></li>
                    </ul>
                </div>
            </div>
            <a href="doacoes.php" id="btn_total_doacoes"><img src="imgs/giftbox.svg"> Total de Doações </a>
            <a href="index.html" id="btn_voltar"><img src="imgs/undo-button-black.svg"> Voltar </a>
        </div>
    </section>
</body>
</html>