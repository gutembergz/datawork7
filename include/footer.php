</main>
            <footer class="py-4 mt-3" style="background-color:#efefef;">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted"><?php echo APPNAME . " &middot; " . APPDATE . " &middot v" . APPVERSION;?> Beta</div>
                        <div>
                            <a href="#" data-toggle="modal" data-target="#sobre">Sobre o Sistema</a>
                            &middot;
                            <a href="https://api.whatsapp.com/send?phone=5521969816002">Suporte</a>                                
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
        
    <div id="sobre" class="modal fade" role="dialog">
		<div class="modal-dialog">			
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><i class="fa fa-info-circle text-secondary"></i> Sobre o DataWork</h4>
					<button class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="text-muted"><?php echo APPNAME;?></div>
					<div class="text-muted">Versão <?php echo APPVERSION . " &middot; Data da Compilação: " . APPDATE;?></div>
					<span class="text-muted">Desenvolvido por Gutemberg Vasconcellos</span>					
				</div>
				<div class="modal-footer">										
					<?php echo APPCLIENTE;?>
				</div>
			</div>
		</div>
	</div>

	<div id="encurtarLink" class="modal fade" role="dialog">
		<div class="modal-dialog">			
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><i class="fa fa-link text-secondary"></i> Encurtar um Link</h4>
					<button class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">					
					<label for="link">Link da Publicação</label>                        
                    <div class="input-group mb-3">
                        <input class="form-control" type="url" name="link" id="link" placeholder="https://">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" onclick="shorten_url('link', 'link_bitly');">Encurtar Link</button>
                        </div>
                    </div>

                    <label for="link_bitly">Link Encurtado</label>                        
                    <div class="input-group mb-3">
                        <input class="form-control" type="url" name="link_bitly" id="link_bitly" placeholder="Link Encurtado bitly">
                    </div>
				</div>				
			</div>
		</div>
	</div>

	<div id="linkWhatsapp" class="modal fade" role="dialog">
		<div class="modal-dialog">			
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><i class="fab fa-whatsapp text-secondary"></i> Gerar Link WhatsApp</h4>
					<button class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">					
					<label for="whatsappLink">Número do Celular WhatsApp</label>                        
                    <div class="input-group mb-3">
                        <input class="form-control" type="text" name="whatsappLink" id="whatsappLink" placeholder="(00) 00000-0000">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" onclick="whatsapp_url('whatsappLink', 'link_whatsapp');">Gerar Link</button>
                        </div>
                    </div>

                    <label for="link_whatsapp">Link Gerado</label>                        
                    <div class="input-group mb-3">
                        <input class="form-control" type="url" name="link_whatsapp" id="link_whatsapp" placeholder="Link Gerado">
                    </div>
				</div>				
			</div>
		</div>
	</div>

	<div id="novoCliente" class="modal fade" role="dialog">
		<div class="modal-dialog modal-dialog-centered">			
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><i class="fas fa-user text-secondary"></i> Novo Cliente</h4>
					<button class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<label for="pesquisarCliente">Pesquisar Cliente</label>					
                    <div class="input-group">
                        <select class="form-control" name="pesquisarCliente" id="pesquisarCliente"></select>
                    </div>
                    <small id="empresaHelp" class="form-text text-muted">Pesquise pelo cliente antes de cadastrá-lo. Clique para abrir o registro.</small>  
				</div>

				<div class="modal-footer">
        			<a class="btn btn-primary" href="<?php echo BASEURL; ?>cadastros/clientes/form-add.php" role="button">Novo Cliente</a>        			
      			</div>
			</div>
		</div>
	</div>

    <script src="<?php echo BASEURL; ?>lib/jquery/jquery.min.js"></script>
    <script src="<?php echo BASEURL; ?>lib/jquery/jquery-ui.min.js"></script>
    <script src="<?php echo BASEURL; ?>lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASEURL; ?>lib/ekko-lightbox/ekko-lightbox.js"></script>
    <script src="<?php echo BASEURL; ?>lib/js/main.js"></script>
    <script src="<?php echo BASEURL; ?>lib/js/jquery.maskedinput.js"></script>
    <script src="<?php echo BASEURL; ?>lib/chart/Chart.min.js"></script>    
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo BASEURL; ?>lib/DataTables/RowGroup-1.1.2/js/dataTables.rowGroup.min.js"></script>
    <script src="<?php echo BASEURL; ?>lib/DataTables/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo BASEURL; ?>lib/js/moment.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo BASEURL; ?>lib/js/datetime-moment.js" crossorigin="anonymous"></script>
    <script src="<?php echo BASEURL; ?>lib/js/google-maps.js"></script>
    <script src="<?php echo BASEURL; ?>lib/js/select2.min.js"></script>
    <script src="<?php echo BASEURL; ?>lib/js/select2.pt-BR.js"></script>

	<?php if (isLoggedIn()): // ativa os scripts para os usuários logados ?>

		<script type="text/javascript"> 
		// Ativa e traduz o DataTables em todas as tabelas

			$.extend( $.fn.dataTable.defaults, {
			language: {				
				url: '<?php echo BASEURL; ?>lib/DataTables/pt_BR.json'
				}
			});
		</script>		
		
		<script type="text/javascript">

			$(document).ready(function() {
				$.fn.dataTable.moment('DD/MM/YYYY HH:mm:ss');
				$.fn.dataTable.moment('DD/MM/YYYY');

				$('#tblRelatorio').DataTable( {
					searching: false
				});

				$('#tblEmailsEnviados').DataTable( {
					"order": [[0, "desc"]]
				});

				$('#tblHistoricoCt').DataTable( {
					"order": [[0, "desc"]]
				});

				$('#tblAdsMateria').DataTable( {
					"searching": false,
					"paging": false,
					"info": false,
        			"ordering": false,
					"order": [1, "desc"],
					"processing": true,
			        "serverSide": true,
			        "ajax": "server_googleads-materias.php?idMateriaContratada=<?php echo $materiaContratada['id'] = isset($materiaContratada['id']) ? $materiaContratada['id'] : null; ?>",

			        "columns": [		 
			            { "data": "titulo1" },			            
			            { "data": "id", render: function (dataField) 
			            	{ return '<button type="button" name="updateAds" id=' + dataField + '" class="btn btn-warning btn-sm updateAds"><i class="far fa-edit"></i> Editar</button>';}
			            },
			            { "data": "id", render: function (dataField) 
			            	{ return '<button type="button" name="deleteAds" id=' + dataField + '" class="btn btn-danger btn-sm deleteAds"><i class="fas fa-trash"></i> Excluir</button>';}
			            }			            		            
		            ],

		            "columnDefs": [ // concatenamos apenas as linhas que precisamos, sem adicionar as colunas. a busca não é funcional.
			            { // The `data` parameter refers to the data for the cell (defined by the `data` option, which defaults to the column being worked with, in this case `data: 0`.
			                "render": function ( data, type, row ) {
			                    return '<p class="font-weight-bold text-primary mb-1">' + data +' | '+ row["titulo2"]+' | '+ row["titulo3"] + ' <small>Mais '+ row["contaTitulos"] + '</small></p> <p class="font-weight-bold text-success mb-1">'+ row["urlVisualizacao"]+'</p> <p class="text-secondary mb-1">'+ row["descricao1"]+ ' &middot; ' + row["descricao2"]+'</p>';
			                },
			                "targets": 0
			            }			            
			        ]

			    });

			    $('#tblAdsMateriaChamadas').DataTable( {
					"searching": false,
					"paging": false,
					"info": false,
        			"ordering": false,
					"order": [1, "desc"],
					"processing": true,
			        "serverSide": true,
			        "ajax": "server_googleadsChamadas-materias.php?idMateriaContratada=<?php echo $materiaContratada['id'] = isset($materiaContratada['id']) ? $materiaContratada['id'] : null; ?>",

			        "columns": [		 
			            { "data": "titulo1Chamada" },			            
			            { "data": "id", render: function (dataField) 
			            	{ return '<button type="button" name="updateAdsChamada" id=' + dataField + '" class="btn btn-warning btn-sm updateAdsChamada"><i class="far fa-edit"></i> Editar</button>';}
			            },
			            { "data": "id", render: function (dataField) 
			            	{ return '<button type="button" name="deleteAdsChamada" id=' + dataField + '" class="btn btn-danger btn-sm deleteAdsChamada"><i class="fas fa-trash"></i> Excluir</button>';}
			            }			            		            
		            ],

		            "columnDefs": [ // concatenamos apenas as linhas que precisamos, sem adicionar as colunas. a busca não é funcional.
			            { // The `data` parameter refers to the data for the cell (defined by the `data` option, which defaults to the column being worked with, in this case `data: 0`.
			                "render": function ( data, type, row ) {
			                    return '<p class="font-weight-bold text-primary mb-1">Ligar para '+ row["numeroTel"]+'</p> <p class="text-secondary mb-1">'+ row["nomeEmpresa"] +' &middot; '+ data +'</p>      <p class="font-weight-bold text-success mb-1">'+ row["urlVisualizacaoChamada"]+'</p> <p class="text-secondary mb-1">'+ row["descricao1Chamada"]+ ' &middot; ' + row["descricao2Chamada"]+'</p>';
			                },
			                "targets": 0
			            }			            
			        ]

			    });

				$('#tblPostagensMateria').DataTable( {
					"order": [1, "asc"],
					"processing": true,
			        "serverSide": true,
			        "ajax": "server_postagens-materias.php?idMateriaContratada=<?php echo $materiaContratada['id'] = isset($materiaContratada['id']) ? $materiaContratada['id'] : null; ?>",
			        "columns": [		 
			            { "data": "titulo" },
			            { "data": "dataPublicacao" },  
			            { "data": "id"},
			            { "data": "idStatus" },
			            { "data": "id", render: function (dataField) 
			            	{ return '<button type="button" name="update" id=' + dataField + '" class="btn btn-warning btn-sm update"><i class="far fa-edit"></i> Editar</button>';}
			            },
			            { "data": "id", render: function (dataField) 
			            	{ return '<button type="button" name="delete" id=' + dataField + '" class="btn btn-danger btn-sm delete"><i class="fas fa-trash"></i> Excluir</button>';}
			            },
		            ],

		            "columnDefs": [ // concatenamos apenas as linhas que precisamos, sem adicionar as colunas. a busca não é funcional.
			            { // The `data` parameter refers to the data for the cell (defined by the `data` option, which defaults to the column being worked with, in this case `data: 0`.
			                "render": function ( data, type, row ) {

								var f = row["urlFacebook"] !== '' ? '<i class="fab fa-facebook text-primary"></i> ' : '<i class="fab fa-facebook text-secondary"></i> ';
								var i = row["urlInstagram"] !== '' ? '<i class="fab fa-instagram text-primary"></i> ' : '<i class="fab fa-instagram text-secondary"></i> ';
								var t = row["urlTwitter"] !== '' ? '<i class="fab fa-twitter text-primary"></i> ' : '<i class="fab fa-twitter text-secondary"></i> ';
								var l = row["urlLinkedin"] !== '' ? '<i class="fab fa-linkedin text-primary"></i> ' : '<i class="fab fa-linkedin text-secondary"></i> ';

								return f + i + t + l;
			                },
			                "targets": 2
			            }

			        ],

		            "rowCallback": function( row, data ) {
	    				if ( data.idStatus == "1" ) {
	      					$('td:eq(3)', row).html( '<span class="badge badge-warning">Aguardando</span>' );
	      				} else {
	      					$('td:eq(3)', row).html( '<span class="badge badge-success">Publicada</span>' );
	      				} 	    				
	  				}
				});

				$('#tblMateriasCt').DataTable( {
					rowGroup: {
			        	dataSrc: 'pacote'
			        },
			        
					"order": [[5, "desc"], [2, "asc"]],
					"processing": true,
			        "serverSide": true,
			        "ajax": "server_materias.php?idContrato=<?php echo $id = isset($id) ? $id : null; ?>",
			        "columns": [		 
			            { "data": "materia" },			            
			            { "data": "dataProducao" },
			            { "data": "dataLimite" },
			            { "data": "dataExpiracao" },
			            { "data": "status" },			            
			            { "data": "pacote" },
			            { "data": "id", render: function (dataField) 
			            	{ return '<a class="btn btn-warning btn-sm" href="materias/form-edit.php?id=' + dataField + '" role="button"><i class="far fa-edit"></i> Editar</a>';} 
			            }
		            ],	        	

		            "rowCallback": function( row, data ) {
	    				if ( data.status == "Expirado" ) {
	      					$('td:eq(4)', row).html( '<span class="badge badge-danger">Expirado</span>' );
	      				} else if ( data.status == "Vigente" ) {
	      					$('td:eq(4)', row).html( '<span class="badge badge-success">Vigente</span>' );
	      				} else if ( data.status == "Concluído" ) {
	      					$('td:eq(4)', row).html( '<span class="badge badge-success">Concluído</span>' );
	      				} else if ( data.status == "Cancelado" ) {
	      					$('td:eq(4)', row).html( '<span class="badge badge-danger">Cancelado</span>' );
	    				} else {
	    					$('td:eq(4)', row).html( '<span class="badge badge-primary">' + data.status + '</span>' );
	    				}

	    				if ( data.dataExpiracao == "31/12/1969" || data.dataExpiracao ==  "30\/11\/-0001") {
	      					$('td:eq(3)', row).html( 'Não Expira' );
	      				}	    				
	  				}
				});

				$('#tblClientes').DataTable( {
					"order": [[8, "desc"]],
					"processing": true,
			        "serverSide": true,
			        "ajax": "server_clientes.php",
			        "columns": [		 
			            { "data": "empresa" },
			            { "data": "razaoSocial" },
			            { "data": "autorizante" },
			            { "data": "email" },
			            { "data": "telefone" },
			            { "data": "celular" },
			            { "data": "cpf" },
			            { "data": "cnpj" },
			            { "data": "dataRegistro" },
			            { "data": "id", render: function (dataField) 
			            	{ return '<a class="btn btn-warning btn-sm" href="form-edit.php?id=' + dataField + '" role="button"><i class="far fa-edit"></i> Editar</a>';}
			            }
		            ],

		            "columnDefs": [	// ocultando colunas
			            {"targets": [ 3 ], "visible": false,},
			            {"targets": [ 4 ], "visible": false},
			            {"targets": [ 5 ], "visible": false},
			            {"targets": [ 6 ], "visible": false},
			            {"targets": [ 7 ], "visible": false}
			        ],

		            "rowCallback": function( row, data ) {
	    				if ( data.razaoSocial == '' ) {
	      					$('td:eq(1)', row).html( 'N/A' );
	      				}

	      				if ( data.email == '' ) {
	      					$('td:eq(2)', row).html( 'N/A' );
	      				}  
	  				}             			        
				});

				
				$('#tblContratos').DataTable( {					
					"order": [[4, "desc"], [0, "asc"]],
					"processing": true,
			        "serverSide": true,
			        "ajax": "server_contratos.php",
			        	        
			        "columns": [		 
			            { "data": "nContrato" },
			            { "data": "empresa" },
			            { "data": "campanha" },
			            { "data": "prazo" },
			            { "data": "dataRegistro" },
			            { "data": "status" },		            
						{ "data": "id", render: function (dataField) 
							{ return '<a class="btn btn-warning btn-sm" href="form-edit.php?id=' + dataField + '" role="button"><i class="far fa-edit"></i> Editar</a>';}
						}
		            ], 

		            "rowCallback": function( row, data ) {
	    				if ( data.status == "Expirado" ) {
	      					$('td:eq(5)', row).html( '<span class="badge badge-warning">Expirado</span>' );
	      				} else if ( data.status == "Vigente" ) {
	      					$('td:eq(5)', row).html( '<span class="badge badge-success">Vigente</span>' );
	      				} else if ( data.status == "Cancelado" ) {
	      					$('td:eq(5)', row).html( '<span class="badge badge-danger">Cancelado</span>' );
	      				} else if ( data.status == "Plano de Acesso" ) {
	      					$('td:eq(5)', row).html( '<span class="badge badge-dark">Plano de Acesso</span>' );
	    				} else {
	    					$('td:eq(5)', row).html( '<span class="badge badge-primary">' + data.status + '</span>' );
	    				}
	  				

	    				if ( data.prazo == "30" ) {
	      					$('td:eq(3)', row).html( '1 Mês' );
	      				} else if ( data.prazo == "60" ) {
	      					$('td:eq(3)', row).html( '2 Meses' );
	      				} else if ( data.prazo == "90" ) {
	      					$('td:eq(3)', row).html( '3 Meses' );
	      				} else if ( data.prazo == "180" ) {
	      					$('td:eq(3)', row).html( '6 Meses' );
	    				} else if ( data.prazo == "365" ) {
	      					$('td:eq(3)', row).html( '1 Ano' );
	    				} else {
	    					$('td:eq(3)', row).html( 'Não Definido' );
	    				}
	  				}

				});

				$('#tblPortal').DataTable( {
					"order": [[3, "desc"]],
					"processing": true,
			        "serverSide": true,
			        "ajax": "server_portal.php",
			        	        
			        "columns": [		 
			            { "data": "nContrato" },
			            { "data": "empresa" },
			            { "data": "dataRegistro" },
			            { "data": "dataExpiracao" },
			            { "data": "nomeUsuario" },
			            { "data": "status" },		            
						{ "data": "id", render: function (dataField) 
							{ return '<a class="btn btn-warning btn-sm" href="form-edit.php?id=' + dataField + '" role="button"><i class="far fa-edit"></i> Editar</a>';}
						}
		            ], 

		            "rowCallback": function( row, data ) {
	    				if ( data.status == "Expirado" ) {
	      					$('td:eq(5)', row).html( '<span class="badge badge-warning">Expirado</span>' );
	      				} else if ( data.status == "Vigente" ) {
	      					$('td:eq(5)', row).html( '<span class="badge badge-success">Vigente</span>' );
	      				} else if ( data.status == "Cancelado" ) {
	      					$('td:eq(5)', row).html( '<span class="badge badge-danger">Cancelado</span>' );
	    				} else {
	    					$('td:eq(5)', row).html( '<span class="badge badge-primary">' + data.status + '</span>' );
	    				} 
	  				}

				});			
			});
		// <!-- Todas as funções do Datatables -->
		</script>    
		
		<script>
		// <!-- Função para máscaras de formulário -->
			$(document).ready(function(){	
				$("#cnpj").mask("99.999.999/9999-99");
			});

			$(document).ready(function(){	
				$("#cpf").mask("999.999.999-99");
			});

			$(document).ready(function(){	
				$("#cep").mask("99999-999");
			});

			$(document).ready(function(){	
				$("#telefone").mask("(99) 9999-9999");
			});

			$(document).ready(function(){	
				$("#celular").mask("(99) 99999-9999");
			});

			$(document).ready(function(){	
				$("#whatsapp").mask("(99) 99999-9999");
			});

			$(document).ready(function(){	
				$("#whatsappLink").mask("(99) 99999-9999");
			});			
		</script>
		
		<script>
		// <!-- Função para eliminar erros de navegador -->
		    jQuery.browser = {};
		    (function () {
		        jQuery.browser.msie = false;
		        jQuery.browser.version = 0;
		        if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
		            jQuery.browser.msie = true;
		            jQuery.browser.version = RegExp.$1;
		        }
		    })();
		</script>
		
		<script>
		//<!-- Ativa o tooltip do bootstrap, junto de um toggle=modal, por exemplo -->
			$(function () {
			$('[data-toggle="tooltip"]').tooltip()
			})
		</script>
		
		<script> 
		// <!-- Pesquisa cep através do viacep -->
			$("#cep").focusout(function(){
				//Início do Comando AJAX
				$.ajax({
					//O campo URL diz o caminho de onde virá os dados
					//É importante concatenar o valor digitado no CEP
					url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
					//Aqui você deve preencher o tipo de dados que será lido,
					//no caso, estamos lendo JSON.
					dataType: 'json',
					//SUCESS é referente a função que será executada caso
					//ele consiga ler a fonte de dados com sucesso.
					//O parâmetro dentro da função se refere ao nome da variável
					//que você vai dar para ler esse objeto.
					success: function(resposta){
						//Agora basta definir os valores que você deseja preencher
						//automaticamente nos campos acima.
						$("#endereco").val(resposta.logradouro);
						$("#complemento").val(resposta.complemento);
						$("#bairro").val(resposta.bairro);
						$("#cidade").val(resposta.localidade);
						$("#uf").val(resposta.uf);
						//Vamos incluir para que o Número seja focado automaticamente
						//melhorando a experiência do usuário
						$("#numero").focus();
					}
				});
			});
		</script>

		<script>
		//<!-- Ativa o ekko-lightbox -->
			$(document).on('click', '[data-toggle="lightbox"]', function(event) {
	                event.preventDefault();
	                $(this).ekkoLightbox();
	            });
		</script>

		<script>
		// <!-- Ativa tooltip em multiplos data-toggles -->
		    $("[data-tt=tooltip]").tooltip();
		</script>
		
		<script>
		//<!-- Exibe o menu da página ativa -->
			$(document).ready(function () {    
		    //Get CurrentUrl variable by combining origin with pathname, this ensures that any url appendings (e.g. ?RecordId=100) are removed from the URL
		    var CurrentUrl = window.location.origin+window.location.pathname;
		    //Check which menu item is 'active' and adjust apply 'active' class so the item gets highlighted in the menu
		    //Loop over each <a> element of the NavMenu container
		    $('#NavMenu a').each(function(Key,Value)
		        {
		            //Check if the current url
		            if(Value['href'] === CurrentUrl)
		            {
		                //We have a match, add the 'active' class to the parent item (li element).
		                $(Value).parent().addClass('active');
		            }
		        });
		 });
		</script>
		
		<script>
		// <!-- Exibe os erros em um alert -->
	    	var createAllErrors = function() {
	        var form = $( this ),
	            errorList = $( "ul.errorMessages", form );

	        var showAllErrorMessages = function() {
	            errorList.empty();

	            // Find all invalid fields within the form.
	            var invalidFields = form.find( ":invalid" ).each( function( index, node ) {

	                // Find the field's corresponding label
	                var label = $( "label[for=" + node.id + "] "),
	                    // Opera incorrectly does not fill the validationMessage property.
	                    message = node.validationMessage || 'Invalid value.';

	                errorList
	                    .show()
	                    .append( "<li><span> Campo " + label.html() + ":</span> " + message + "</li>" );
	            });
	        };

	        // Support Safari
	        form.on( "submit", function( event ) {
	            if ( this.checkValidity && !this.checkValidity() ) {
	                $( this ).find( ":invalid" ).first().focus();
	                event.preventDefault();
	            }
	        });

	        $( "input[type=submit], button:not([type=button])", form )
	            .on( "click", showAllErrorMessages);

	        $( "input", form ).on( "keypress", function( event ) {
	            var type = $( this ).attr( "type" );
	            if ( /date|email|month|number|search|tel|text|time|url|week/.test ( type )
	              && event.keyCode == 13 ) {
	                showAllErrorMessages();
	            }
	        });
	    };
	    
	    $( "form" ).each( createAllErrors );
		</script>
		
		<script> 
		//<!-- Transforma o select de pesquisar cliente em select2 -->
			var host = window.location.hostname;
			
		    $(document).ready(function() {		    	

		        $('#pesquisarCliente').select2({
		        	width: '100%',             
		            minimumInputLength: 3,		            	            	
			        language: {                                             
		                noResults: function () {                        
		                    var termoPesquisa = $('.select2-search input').val();
		                    return $("<a href='http://"+host+"/portaldenegocios/manager/cadastros/clientes/form-add.php?empresa="+termoPesquisa+"'>Sem resultados. Adicionar Cliente?</a>");
		                },
		                searching: function () {
		                    return 'Buscando…';
		                },
		                inputTooShort: function (args) {
		                    var remainingChars = args.minimum - args.input.length;
		                    var message = 'Digite ' + remainingChars + ' ou mais caracteres';
		                    return message;
		                },
		            },
		            theme: 'bootstrap4',
		            ajax: {
			            url: "http://"+host+"/portaldenegocios/manager/cadastros/contratos/busca-clientes.php",	            
			            dataType: 'json'		              						
		        	},
		        })
			});
		</script>

		<script> 
		// <!-- Ação ao clicar no select2 -->
		    $('#pesquisarCliente').on('select2:select', function (e) {		    
			    var data = e.params.data;
	    		console.log(data);
	    		var idCliente = data[0];
	    		window.open("http://"+host+"/portaldenegocios/manager/cadastros/clientes/form-edit.php?id="+idCliente,"_self");
		    });
		</script>

	<?php endif; ?>

    </body>
</html>
