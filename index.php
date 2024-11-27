<?php
session_start();
require 'init.php';
$pageTitle = 'Painel Inicial';
include (HEADER_TEMPLATE);

require 'classes/usuarios.class.php';
require 'classes/clientes.class.php';
require 'classes/contratos.class.php';
require 'classes/emails.class.php';
require 'classes/relatorios.class.php';

$u = new Usuarios();
$c = new Clientes();
$ct = new Contratos();
$ee = new Emails();
$rt = new Relatorios();

$totalUsuarios = $u->getTotalUsuarios();
$totalClientes = $c->getTotalClientes();
$totalContratos = $ct->getTotalContratos();
$totalEmailsEnviados = $ee->getTotalEmailsEnviados(); 
$totalMaterias = $rt->getTotalMaterias();
$materiasMes = $rt->getMateriasMes(); 
$contratosMes = $rt->getContratosMes(); ?>

<div class="container-fluid">
	<div class="row">
		<div class="col p-3">

	    	<?php if (isLoggedIn()): ?>
            <?php 
            require 'classes/logs.class.php';
            $log = new Logs();
            $log->registrarLog("Acessou o Painel Inicial"); ?>

            <div class="card mb-4">
                <div class="card-body">Olá, <?php echo $_SESSION['user_name']; ?>. Seja bem <?php echo ($_SESSION['user_gender'] == 0) ? 'vindo' : 'vinda' ?> novamente.</div>
            </div>

	        <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body"><?php echo number_format($totalClientes, 0, '' , '.');?> Clientes Cadastrados</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="<?php echo BASEURL;?>cadastros/clientes/">Gerenciar Clientes</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body"><?php echo $totalContratos;?> Contratos Vigentes</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="<?php echo BASEURL;?>cadastros/contratos/">Gerenciar Contratos</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body"><?php echo $totalUsuarios;?> Usuários Cadastrados</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="<?php echo BASEURL;?>cadastros/usuarios/">Gerenciar Usuários</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>                    
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body"><?php echo number_format($totalEmailsEnviados, 0, '' , '.'); ?> E-mails Enviados</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="<?php echo BASEURL;?>relatorios/emails-enviados.php">Últimos 100 E-mails Enviados</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header"><i class="fas fa-chart-pie mr-1"></i>Contagem de Matérias </div>
                        <div class="card-body"><canvas id="chartMaterias" width="100%" height="50"></canvas></div>
                        <div class="card-footer small text-muted">Resumo das matérias mais vendidas</div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header"><i class="fas fa-chart-bar mr-1"></i>Contratos Adicionados nos Últimos 12 Meses</div>
                        <div class="card-body"><canvas id="chartContratos" width="100%" height="50"></canvas></div>
                        <div class="card-footer small text-muted">Atualizado em tempo real </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Vendas dos Últimos 12 Meses</div>
                <div class="card-body"><canvas id="chartVendas" width="100%" height="30"></canvas></div>
                <div class="card-footer small text-muted">Atualizado em tempo real</div>
            </div>

		    <?php else: ?>
                <div class="card mb-4">
                    <div class="card-body">Olá, visitante. Efetue <a href="form-login.php">login</a> para acessar o sistema.</div>
                </div>		        
		    <?php endif; ?>
		</div>
	</div>
</div>

<?php include (FOOTER_TEMPLATE);?>

<?php if (isLoggedIn()): ?>

    <?php // relatorio de contagem de matérias

        // zerando as variáveis
        $labels = '';
        $data = '';

        foreach($totalMaterias as $totalMateria) {

            $labels .= '"'. $totalMateria['materia'].'",';
            $data .= $totalMateria['contagem'].',';
        }
            $labels = trim($labels,",");
            $data = trim($data,",");
    ?>  
   
    <script>
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        // Pie Chart Matérias
        var ctx = document.getElementById("chartMaterias");
        var chartMaterias = new Chart(ctx, {
          type: 'pie',          
          data: {
            labels: [<?php echo $labels; ?>],  //labels: ["Plano Light", "Plano Plus", "Plano Premium", "Outros"],
            datasets: [{
              data: [<?php echo $data; ?>], //data: [10, 30, 40, 20], // aqui que obtém o resultado 2
              backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745', '#17A2B8', '#4B0082', '#343A40'],
            }],
          }          
        });        
    </script>

    <?php // relatorio de matérias por mês

        // zerando as variáveis
        $labels = '';
        $data = '';

        foreach($materiasMes as $materiaMes) {

            $labels .= '"'. $materiaMes['MONTH'].'",';
            $data .= $materiaMes['contagem'].',';
        }
            $labels = trim($labels,",");
            $data = trim($data,",");       
    ?>

    <script>
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    // Bar Chart Contratos
    var ctx = document.getElementById("chartContratos");
    var myLineChart = new Chart(ctx, {
      type: 'bar',
      data: {
         labels: [<?php echo $labels; ?>], //labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho"],
        datasets: [{
          label: "Contratos",
          backgroundColor: "rgba(2,117,216,1)",
          borderColor: "rgba(2,117,216,1)",
           data: [<?php echo $data; ?>], //data: [4215, 5312, 6251, 7841, 9821, 14984],
        }],
      },
      options: {
        responsive: true,
        scales: {
          xAxes: [{
            time: {
              unit: 'month'
            },
            gridLines: {
              display: false
            },
            ticks: {
              maxTicksLimit: 6
            }
          }],
          yAxes: [{
            ticks: {
              min: 0,
              max: 50,
              maxTicksLimit: 5
            },
            gridLines: {
              display: true
            }
          }],
        },
        legend: {
          display: false
        }
      }
    });

    </script>

    <?php // relatorio de vendas por mês

        // zerando as variáveis
        $labels = '';
        $data = '';

        foreach($contratosMes as $contratoMes) {

            $labels .= '"'. $contratoMes['MONTH'].'",';
            $data .= $contratoMes['vendasTotais'].',';
        }
            $labels = trim($labels,",");
            $data = trim($data,",");       
    ?>

    <script>
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    // Line Chart Vendas
    var ctx = document.getElementById("chartVendas");
    var myLineChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [<?php echo $labels; ?>], //labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho"],
        datasets: [{
        label: "Vendas",
        lineTension: 0.3,
        backgroundColor: "rgba(2,117,216,0.2)",
        borderColor: "rgba(2,117,216,1)",
        pointRadius: 5,
        pointBackgroundColor: "rgba(2,117,216,1)",
        pointBorderColor: "rgba(255,255,255,0.8)",
        pointHoverRadius: 5,
        pointHoverBackgroundColor: "rgba(2,117,216,1)",
        pointHitRadius: 50,
        pointBorderWidth: 2,
        data: [<?php echo $data; ?>], //data: [4215, 5312, 6251, 7841, 9821, 14984],
        }],
      },
      options: {
        tooltips: {
            callbacks: {
                label: function(tooltipItem, data) {
                return "Vendas: R$ " + tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                },
            }            
        }, 

        scales: {
          xAxes: [{
            time: {
              unit: 'month'
            },
            gridLines: {
              display: true
            },
            ticks: {
              maxTicksLimit: 6
            }
          }],
          yAxes: [{
            ticks: {
              min: 0,
              max: 80000,              
              maxTicksLimit: 5,
              callback: function(value, index) {
                  if(parseInt(value) >= 1000){
                    return 'R$ ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                  } else {
                    return 'R$ ' + value;
                  }
              }           
            },
            gridLines: {
              display: true
            }
          }],
        },
        legend: {
          display: false
        }
      }
    });    

    </script>
    
<?php endif; ?>