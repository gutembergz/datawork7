<?php
session_start();
require_once '../../init.php';
require '../../check.php';
$pageTitle = 'Novo Cliente';
$parentPage = 'Clientes';

// recebemos o nome da empresa ao adicionar um novo cliente
if (isset($_GET['empresa']) && !empty($_GET['empresa'])) {
    $novaEmpresa = $_GET['empresa'];
    $novaEmpresa = strtoupper($novaEmpresa);
} else {
    $novaEmpresa = "";
}

include (HEADER_TEMPLATE); ?>

<div class="container-fluid">

    <?php 
    require '../../classes/clientes.class.php';
    $c = new Clientes();

    if (isset($_POST['empresa']) && !empty($_POST['empresa'])) {        

        $empresa = addslashes($_POST['empresa']);
        $razaoSocial = addslashes($_POST['razaoSocial']);
        $autorizante = addslashes($_POST['autorizante']);
        $anunciante = addslashes($_POST['anunciante']);
        $endereco = addslashes($_POST['endereco']);
        $numero = addslashes($_POST['numero']);
        $complemento = addslashes($_POST['complemento']);
        $cidade = addslashes($_POST['cidade']);
        $uf = addslashes($_POST['uf']);
        $bairro = addslashes($_POST['bairro']);
        $cep = addslashes($_POST['cep']);
        $telefone = addslashes($_POST['telefone']);
        $celular = addslashes($_POST['celular']);
        $email = addslashes($_POST['email']);
        $website = addslashes($_POST['website']);
        $cnpj = addslashes($_POST['cnpj']);
        $cpf = addslashes($_POST['cpf']);
        $tipoCliente = addslashes($_POST['tipoCliente']);      
        $obs = addslashes($_POST['obs']);
        $dataRegistro = date("Y-m-d H:i:s"); // equivale à função now() em SQL
        $idUser = addslashes($idUser = $_SESSION['user_id']);

        $c->addCliente($empresa, $razaoSocial, $autorizante, $anunciante, $endereco, $numero, $complemento, $cidade, $uf, $bairro, $cep, $telefone, $celular, $email, $website, $cnpj, $cpf, $tipoCliente, $obs, $dataRegistro, $idUser);
        ?>
            <div class="alert alert-success">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Cliente adicionado com sucesso! Redirecionando...
                <script type="text/javascript">
                    setTimeout(function(){
                        window.location.href ='form-edit.php?id=<?php echo $lastId;?>';
                     }, 3000);
                </script>
            </div>
        <?php 
    }
    ?>

    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <i class="fa fa-info-circle"></i> Para adicionar mais dados do cliente, salve-o primeiro.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <ul class="nav nav-tabs mb-3" id="tabDadosCliente" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="principal-tab" data-toggle="tab" href="#principal" role="tab" aria-controls="principal" aria-selected="true">Dados Cadastrais</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled">Perfil do Cliente</a>
        </li>

        <li class="nav-item">
            <a class="nav-link disabled">Redes Sociais</a>
        </li>

        <li class="nav-item">
            <a class="nav-link disabled">Contratos</a>
        </li>
    </ul>

    <div class="tab-content" id="tabDadosClienteConteudo">
        
        <div class="tab-pane fade show active" id="principal" role="tabpanel" aria-labelledby="principal-tab">
          
            <form method="POST" autocomplete="off">

                <ul class="errorMessages fade show"></ul>  

                <div class="form-group">
                    <label for="empresa">Empresa (Nome Fantasia)</label>
                    <input class="form-control" type="text" name="empresa" id="empresa" value="<?php echo $novaEmpresa; ?>" required>
                    <small class="form-text text-muted">Preencha o nome da empresa sem as siglas de razão social.</small>
                </div>

                <div class="form-group">
                    <label for="razaoSocial">Razão Social</label>
                    <input class="form-control" type="text" name="razaoSocial" id="razaoSocial" required>
                </div>
                
                <div class="form-group">
                    <label for="autorizante">Autorizante</label>
                    <input class="form-control" type="text" name="autorizante" id="autorizante" required>
                </div>
                
                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="cep">CEP </label><i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Digite o CEP e pressione a tecla TAB para preencher os campos automaticamente."></i>
                        <input class="form-control" type="text" name="cep" id="cep" placeholder="00000-000" required>
                        <small id="cepHelp" class="form-text text-muted"><a target="_blank" href="http://www.buscacep.correios.com.br/sistemas/buscacep/">Não sei o CEP</a> <i class="fas fa-external-link-alt" title="Abre em uma nova janela."></i></small>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="endereco">Endereço</label>
                        <input class="form-control" type="text" name="endereco" id="endereco" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="numero">Número</label>
                        <input class="form-control" type="text" name="numero" id="numero" maxlength="15" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="complemento">Complemento</label>
                        <input class="form-control" type="text" name="complemento" id="complemento" maxlength="35">
                    </div>
                    
                </div>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="bairro">Bairro</label>
                        <input class="form-control" type="text" name="bairro" id="bairro" required>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="cidade">Cidade</label>
                        <input class="form-control" type="text" name="cidade" id="cidade" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="uf">Estado</label>
                        <select class="form-control" name="uf" id="uf">
                            <option value="">Selecionar Estado</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                    </div>                    

                </div>

                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="telefone">Telefone</label>
                        <input class="form-control" type="text" name="telefone" id="telefone" placeholder="(00) 0000-0000">                    
                    </div>

                    <div class="form-group col-md-2">
                        <label for="celular">Celular</label>
                        <input class="form-control" type="text" name="celular" id="celular" placeholder="(00) 00000-0000">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="email">E-mail</label> <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="No momento, é permitido cadastrar apenas um e-mail."></i>
                        <input class="form-control" type="email" name="email" id="email" required onkeydown="lowerCase(this);">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="website">Website</label> <i class="fa fa-question-circle text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="É necessário incluir o protocolo antes da URL."></i>
                        <input class="form-control" type="url" name="website" id="website" placeholder="http://" onkeydown="lowerCase(this);">                          
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="anunciante">Cliente já Anunciante?</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="anunciante" id="anunciante-nao" value="0" checked>
                            <label class="custom-control-label" for="anunciante-nao">Não Anunciante</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="anunciante" id="anunciante-sim" value="1">
                            <label class="custom-control-label" for="anunciante-sim">Anunciante</label>                        
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="tipoCliente">Tipo de Cliente</label><br>  
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="tipoCliente" id="p-juridica" value="1" onclick="removeCampo();" checked="checked">
                            <label class="custom-control-label" for="p-juridica">Pessoa Jurídica</label>                        
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="tipoCliente" id="p-fisica" value="0" onclick="removeCampo();" >
                            <label class="custom-control-label" for="p-fisica">Pessoa Física</label>
                        </div>
                    </div>

                    <div class="form-group col-md-4" id="div-pj" style="display: block;">
                        <label for="cnpj">CNPJ</label>
                        <input class="form-control" type="text" name="cnpj" id="cnpj" placeholder="99.999.999/9999-99">
                    </div>

                    <div class="form-group col-md-4" id="div-pf" style="display: none;">
                        <label for="cpf">CPF</label>
                        <input class="form-control" type="text" name="cpf" id="cpf" placeholder="999.999.999-99">
                    </div>                      
                </div>

                <div class="form-row">   
                    <div class="form-group col-md-12"> 
                        <label for="obs">Observações</label>
                        <textarea class="form-control" name="obs" id="obs"></textarea>
                    </div>
                </div>

                <!-- dados de registro e alteração -->
                <div class="form-row">
                    <div class="form-group col-lg-3 col-md-6">
                        <label for="name"><small>Registrado por</small></label>
                        <input class="form-control form-control-sm" type="text" name="name" id="name" value="<?php echo $_SESSION['user_name']; ?>" readonly>
                    </div>
                    <div class="form-group col-lg-3 col-md-6"> 
                        <label for="dataRegistro"><small>Data de Registro</small></label>
                        <input class="form-control form-control-sm" type="text" name="dataRegistro" id="dataRegistro" value="Aguardando Dados" readonly>
                    </div>
                    <div class="form-group col-lg-3 col-md-6">
                        <label for="userAlteracao"><small>Alterado por</small></label>
                        <input class="form-control form-control-sm" type="text" name="userAlteracao" id="userAlteracao" value="Aguardando Dados" readonly>
                    </div>
                    <div class="form-group col-lg-3 col-md-6"> 
                        <label for="dataAlteracao"><small>Data de Alteração</small></label>
                        <input class="form-control form-control-sm" type="text" name="dataAlteracao" id="dataAlteracao" value="Aguardando Dados" readonly>
                    </div>
                </div>

                <!-- botões -->
                <input class="btn btn-primary" type="submit" value="Cadastrar">

            </form>

        </div>

    </div>

</div>

<?php include (FOOTER_TEMPLATE);?>

<script type="text/javascript" src="https://static.safetymails.com/assets/js/safetyoptin_v3.0.min.js"></script>
<script type="text/javascript">
__safetyObj__ = {
    api_key:'f4f8ed239f3371e4dc19c16036f46f736eb53b0e',
    ticket_origem:'cbabff15c0d1732fb9d6bf950ad9444789d4ed7b',
    field_email: "#email",
    button_id: "#saveButtonNull",  // somente para evitar o bloqueio do botão salvar  
    accept_status: "undefined,PENDENTE,INCERTO,DESCONHECIDO,SCRAPED,JUNK",
    message_public_domain: "Ops! Parece que este e-mail é inválido. Digite novamente.",
    message_invalid: "Ops! Parece que este e-mail é inválido. Digite novamente.",
    message_valid: "OK! Este e-mail é valido.",
    tmp_delay: "1000",
    block_public_domain: false,
};
SafetyApi.init();
</script>



