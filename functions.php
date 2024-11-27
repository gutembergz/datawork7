<?php
  
/**
 * Conecta com o MySQL usando PDO
 */
function db_connect() {
    try {
        $PDO = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        return $PDO;

    } catch (PDOException $e) {

        echo "Houve um erro na conexão: ".$e->getMessage();
    }
}
  
 
/**
 * Converte datas entre os padrões ISO e brasileiro
 * Fonte: http://rberaldo.com.br/php-conversao-de-datas-formato-brasileiro-e-formato-iso/
 */
function dateConvert($date)
{
    if ( ! strstr( $date, '/' ) )
    {
        // $date está no formato ISO (yyyy-mm-dd) e deve ser convertida
        // para dd/mm/yyyy
        sscanf($date, '%d-%d-%d', $y, $m, $d);
        return sprintf('%02d/%02d/%04d', $d, $m, $y);
    }
    else
    {
        // $date está no formato brasileiro e deve ser convertida para ISO
        sscanf($date, '%d/%d/%d', $d, $m, $y);
        return sprintf('%04d-%02d-%02d', $y, $m, $d);
    }
 
    return false;
}
 
 
/**
 * Calcula a idade a partir da data de nascimento
 *
 * Sobre a classe DateTime: http://rberaldo.com.br/php-usando-a-classe-nativa-datetime/
 */
function calculateAge($birthdate)
{
    $now = new DateTime();
    $diff = $now->diff(new DateTime($birthdate));
     
    return $diff->y;
}


/**
 * Cria o hash da senha, usando MD5 e SHA-1
 */
function make_hash($str)
{
    return sha1(md5($str));
}
 
 
/**
 * Verifica se o usuário está logado
 */
function isLoggedIn()
{
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true)
    {
        return false;
    }
 
    return true;
}

/**
 * Função para reduzir o tamanho de strings - exibindo excertos
 */
function substrwords($text, $maxchar, $end='...') {
    if (strlen($text) > $maxchar || $text == '') {
        $words = preg_split('/\s/', $text);      
        $output = '';
        $i      = 0;
        while (1) {
            $length = strlen($output)+strlen($words[$i]);
            if ($length > $maxchar) {
                break;
            } 
            else {
                $output .= " " . $words[$i];
                ++$i;
            }
        }
        $output .= $end;
    } 
    else {
        $output = $text;
    }
    return $output;
}

/**
 * Função para checar o acesso às páginas
 */
function checaAcesso($idPagina){

    $idRole = $_SESSION['user_role'];

    $PDO = db_connect();

    $sql1 = "SELECT * FROM paginasAcessos WHERE idRole = :idRole AND idPagina = :idPagina";
    
    $stmt1 = $PDO->prepare($sql1);
    $stmt1->bindParam(':idRole', $idRole, PDO::PARAM_INT);
    $stmt1->bindParam(':idPagina', $idPagina, PDO::PARAM_INT);
    $stmt1->execute();
    $permissoes = $stmt1->fetch(PDO::FETCH_ASSOC);    
    
    // Receba o resultado e verifique o tipo de acesso.
    if ($permissoes['consultar'] == 0) {
       header("HTTP/1.1 401 Unauthorized");
       header("Location: " . BASEURL . "403.html");
       exit;

    } else {
        global $excluir;
        $excluir = $permissoes['excluir'];

        global $editar;
        $editar = $permissoes['editar'];

    }

}

/**
 * Função para calcular parcelas e exibir na tabela de preços de propostas
 * @param1: Nome do Período
 * @param2: Valor do plano (1000,00)
 * @param3: Desconto em porcentagem (30)
 * @param4: Número de parcelas
 */
function calculaParcelas ($periodo, $valor, $desconto, $parcelas) {
    
    $periodo = $periodo;
    $valor = $valor; // valor original
    $desconto = $desconto; // percentual de desconto
    $percentual = $desconto / 100.0; // cálculo do desconto
    $valor_final = $valor - ($percentual * $valor); // cálculo do desconto 2
    $parcelas = $parcelas; // numero de parcelas
    $valor_parcelas = $valor_final / $parcelas;

    echo "<h3><strong>".$periodo."</strong></h3>";
    if (!$desconto == 0) {
        echo "Valor de Tabela:<br>R$ " . number_format(($valor), 2, ',', '.') . "<br>";
        echo "<em>Valor com desconto de " . $desconto . "%:</em><br>";        
    }    
    echo "<strong>R$ " . number_format((floor($valor_final)), 2, ',', '.') . " </strong><br>";
    if ($parcelas > 1) {
        echo "<strong> ou " . $parcelas . "x de R$ " . number_format((floor($valor_parcelas)), 2, ',', '.') . "</strong><br>";
    }    
}

/**
* Adiciona dias/semanas/meses a uma data em particular
* @param1 yyyy-mm-dd
* @param2 integer
* by Binu V Pillai on 2009-12-17
*/
function addDate($date, $day) {
    $sum = strtotime(date("Y-m-d", strtotime("$date")) . " +$day days"); //add days
    $dateTo=date('d/m/Y',$sum);
    return $dateTo;
}

/**
 * Função para gerar slugs
 */
function slugify($text) {
    
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '-');

  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

/**
 * função para abrir o relatórios gerados em pdf
 */
function viewReport($output, $ext, $filename)
{
    header('Content-Description: application/pdf');
    header('Content-Type: application/pdf; charset:utf-8;');
    header('Content-Disposition:; filename=' . $filename . '.' . $ext);        
    readfile($output . '/' . $filename . '.' . $ext);
    unlink($output . '/' . $filename .  '.'  . $ext);
    flush();
    
    return;
}

function statusColor ($status) {

    switch ($status) {
        case 'Vigente':
            $color = 'success';
            return $color;
            break;

        case 'Expirado':
            $color = 'warning';
            return $color;
            break;

        case 'Cancelado':
            $color = 'danger';
            return $color;
            break;

        case 'Plano de Acesso':
            $color = 'dark';
            return $color;
            break;

        default:
            $color = 'primary';
            return $color;
            break;
    }
} 

/**
 * função para converter JSON para utf8
 */
function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}





function agendaPosts($start_date, $end_date, $diasSemana0, $diasSemana1, $diasSemana2, $diasSemana3, $diasSemana4, $diasSemana5, $diasSemana6) {
    
    $startDate = $start_date;
    $endDate = $end_date;

    // Convert to UNIX timestamps
    $currentTime = strtotime($startDate);
    $endTime = strtotime($endDate) + 12*60*60;  // acrescentamos mais 12 horas para capturar o último dia. será por conta do horário de verão?      
    //$empresa = $contrato['empresa'];

    //echo "<strong>Empresa:</strong> " . $empresa .'<br>';
    $dataInicialTitle = "<strong>Data Inicial:</strong> ".utf8_encode(strftime('%A, %d de %B de %Y', $currentTime)).'<br>';
    $dataFinalTitle = "<strong>Data Final:</strong> ".utf8_encode(strftime('%A, %d de %B de %Y', $endTime)).'<br>';

    // verifica a diferença em segundos entre as duas datas e divide pelo número de segundos que um dia possui
    $qtdDias = ($endTime - $currentTime) /86400;

    //$qtdDias = $qtdDias+1; // adiciona mais um dia para calcular dias inteiros

    // caso a data 2 seja menor que a data 1
    if ($qtdDias < 0) {
        $endTime = $endTime * -1;
    }
    
    $diasSelecionadosTitle = "<strong>Dias Selecionados:</strong> " . round($qtdDias) . " dias.<br><br>";
    
    // efetua o loop até atingir o último dia
    $result = array();

    while ($currentTime <= $endTime) {

        // se alguma das datas conferir com o array do select, adiciona ao array
        if (date('N', $currentTime) == $diasSemana0 || (date('N', $currentTime) == $diasSemana1) || (date('N', $currentTime) == $diasSemana2) || (date('N', $currentTime) == $diasSemana3) || (date('N', $currentTime) == $diasSemana4)  || (date('N', $currentTime) == $diasSemana5) ||  (date('N', $currentTime) == $diasSemana6)) {
            
            // adiciona ao array
            $result[] = array (array(date('Y-m-d', $currentTime), utf8_encode(strftime('%d/%m/%Y (%A)', $currentTime))));
        }

        $currentTime = strtotime('+1 day', $currentTime);               
    }

    // Mostra o resultado
    $arrlength = count($result);

    


    //for($x = 0; $x < $arrlength; $x++) {
        //echo ($x+1) . "ª Publicação: " . $result[$x][0][1] . "<br>";
    //} ?>

    <div class="card mb-2">

        <div class="card-header">
            <strong>Postagens em Redes Sociais (Cliente)</strong>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-4 col-lg-4 mb-1">
                    <?php echo $dataInicialTitle; ?>
                </div>

                <div class="col-md-4 col-lg-4 mb-1">
                    <?php echo $dataFinalTitle; ?>
                </div>

                <div class="col-md-4 col-lg-4 mb-1">
                    <?php echo $diasSelecionadosTitle; ?>
                </div>

            </div>            
            
            <table class="table">
                <tr>
                    <td>Publicação</td>
                    <td>Data</td>                    
                </tr>
                
                <?php   

                for($x = 0; $x < $arrlength; $x++) { ?>
                
                <tr>
                    <td><?php echo ($x+1);?>ª Publicação</td>
                    <td><?php echo $result[$x][0][1]; ?></td>                    
                </tr>

                <?php } ?>
                    
            </table>
        </div>

        <div class="card-footer text-muted">
           <strong>Total de Posts: </strong><?php echo $arrlength; ?>
        </div>

    </div>    

    <?php

        $diasssSelecionados = '';

        for($x = 0; $x < $arrlength; $x++) {
            $diasssSelecionados .=  $result[$x][0][0] . "||";
        };

        echo $diasssSelecionados; 


        


} 



?>


