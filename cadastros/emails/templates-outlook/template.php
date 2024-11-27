<?php
session_start();
require_once '../../../init.php';
require '../../../check.php';
?>

<?php include "variaveis.php"; ?>

<!DOCTYPE html>
<html>

	<head>
	    <meta charset="utf-8">
	    <style type="text/css"></style>	    
	    <title><?php echo $titlemail; ?></title>
	</head>

	<body>
		<table bgcolor="#F6F6F6" border="0" cellpadding="0" cellspacing="0" width="100%" style="width:100% !important;">
	        <tr>
	            <td>
	              <table align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" width="650" style="margin:0 auto !important;">
	                    
	                    <br>
	                    <tr>
	                        <td height="35"></td>
	                    </tr>
	                    <tr>
	                        <td>
	                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="90%" style="width:90% !important;margin:0 auto !important;">
	                            	<tr>
	                                	<td>
	                                    	<div>
	                                    		<a href="https://portaldenegocios.com/" target="_blank"><img src="<?php echo $filename; ?>" width="583" height="275" alt=""/></a>
	                                        </div>
	                                    </td>
	                                </tr>
	                                <tr>
	                                	<td height="5"></td>
	                                </tr>
	                                <tr>
	                                    <td>
	    									<div style="font-family: 'Roboto', Arial, Sans-serif; font-size: 15px; color: #666666;">     										
	        									<!-- metade do arquivo! espaço do texto automático-->
												<h2><?php echo $titlemail;?></h2>

												<p><strong>Empresa: <?php echo $empresa;?></strong><br>
												<?php echo $dadosContrato;?>

												<p>Caro Sr(a) <?php echo $autorizante;?></p>
																				
	                                            <?php include $bodymail; ?>

												<!-- metade do arquivo! espaço do texto automático-->    							         
	    									</div>
											<!-- assinatura-->  
	    									<?php echo $assinatura;?>	                              
	    									<!-- assinatura-->  

	                                    </td>
	                                </tr>

	                                
	                            </table>
	                        </td>
	                    </tr>
	                    <tr>
	                        <td height="10"></td>
	                    </tr>

	                    <tr>
	                        <td height="20" bgcolor="#F6F6F6"></td>
	                    </tr>
	                        <tr>
	                            <td>
	                                
	                            </td>
	                        </tr>
	                        <tr>
	                            <td>
	                                <table align="center" border="0" cellpadding="0" cellspacing="0" width="585px" style="width:585px !important;margin:0 auto !important;">
	                                    <tr>
	                                        <td align="center" style="padding-top:5px;padding-bottom:5px;padding-right:20px;padding-left:20px" valign="top" height="20">
	                                            <strong><p style="font-family: 'Roboto', Arial, Sans-serif; font-size: 15px; color: #666666;">Siga o Portal de Negócios nas Redes Sociais:</p></strong>
	                                        </td>
	                                    </tr>
	                                    
	                                    <tr>
	                                        <td>
	                                            <table width="585" border="0" cellspacing="0" cellpadding="0">
	                                                <tbody>
	                                                    <tr>
	                                                        <td width="40px"><!--facebook-->
	                                                        	<a href="https://facebook.portaldenegocios.com/" target="_blank">
	                                                        		<img alt="Facebook" height="40" src="https://portaldenegocios.com/images/hotlink-ok/emails_2018/icon-facebook.png" 
	                                                        		title="Facebook">
	                                                        	</a>
	                                                        </td>
	                                                        
	                                                        <td align="left" width="146px"><!--facebook-logo-->
                                                                <span style="font-size:12px;font-family:'Roboto', Arial, sans-serif;color:#666666;line-height:18px;padding-left:5px;" >
		                                                        	<a href="https://facebook.portaldenegocios.com/" target="_blank">
		                                                        		<strong>Facebook</strong>
		                                                        	</a> 
	                                                        	</span>
	                                                        </td>
	                                                       
	                                                        <td width="43px"><!--instagram-->
	                                                        	<a href="https://instagram.portaldenegocios.com" target="_blank">
	                                                        		<img alt="Instagram" height="40" src="https://portaldenegocios.com/images/hotlink-ok/emails_2018/icon-instagram.png" 
	                                                        		title="Instagram">
	                                                        	</a>
	                                                        </td>
	                                                       
	                                                        <td align="left" width="146px">
	                                                        	<span style="font-size:12px;font-family:'Roboto', Arial, sans-serif;color:#666666;line-height:18px;padding-left:5px;" > <!--instagram-logo-->
	                                                        		<a href="https://instagram.portaldenegocios.com" target="_blank">
	                                                        			<strong>Instagram</strong>
	                                                        		</a>
	                                                        	</span> 
	                                                        </td>
	                                                        
	                                                        <td width="43px"><!--twitter-->
	                                                        	<a href="https://twitter.portaldenegocios.com" target="_blank">
	                                                        		<img alt="Twitter" height="40" src="https://portaldenegocios.com/images/hotlink-ok/emails_2018/icon-twitter.png" 
	                                                        		title="Twitter">
	                                                        	</a>
	                                                        </td>
	                                                        
	                                                        <td align="left" width="146px">
	                                                        	<span style="font-size:12px;font-family:'Roboto', Arial, sans-serif;color:#666666;line-height:18px;padding-left:5px;" >
		                                                        	 <a href="https://twitter.portaldenegocios.com" target="_blank">
		                                                        	 	<strong>Twitter</strong>
		                                                        	 </a>
	                                                        	</span>
	                                                        </td>
	                                                       	                                                        
	                                                        <td width="43px"> <!--linkedin -->
	                                                        	<a href="https://linkedin.portaldenegocios.com/" target="_blank">
	                                                        		<img alt="Linkedin" height="40" src="https://portaldenegocios.com/images/hotlink-ok/emails_2018/icon-linkedin.png" 
	                                                        		title="Linkedin" width="40px">
	                                                        	</a>
	                                                        </td>
	                                                        
	                                                        <td align="left" width="146px">
	                                                        	<span style="font-size:12px;font-family:'Roboto', Arial, sans-serif;color:#666666;line-height:18px;padding-left:5px;" >
	                                                        		<a href="https://linkedin.portaldenegocios.com/" target="_blank">
	                                                        			<strong>Linkedin</strong>
	                                                        		</a>
	                                                        	</span>
	                                                        </td>
	                                                    </tr>
	                                                </tbody>
	                                            </table>
	                                        </td>
	                                    </tr>
	                                </table>
	                            </td>
	                        </tr>
	                        <tr>
	                            <td height="10"></td>
	                        </tr>
	                      
	                </table>

	            </td>
	        </tr>
	            <tr>
	                <td height="15"></td>
	            </tr>

	            <tr>
	                <td>
	                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="650" style="margin:0 auto !important;text-align:center;">
	                        <tbody>
	                            <tr>
	                                <td style="padding-bottom:20px;padding-right:20px;padding-left:20px" valign="top"> 
	                                    <div>
	                                    	<span style="font-family: Roboto, Arial, Sans-serif; font-size: 13px; color: #666666; padding-bottom:20px;padding-right:20px;padding-left:20px" valign="top">

	                                    		<?php echo "© " . date("Y");  ?> EDKE Marketing Digital | Av. Evandro Lins e Silva, 840 - Sala 1707<br>Barra da Tijuca - Rio de Janeiro - RJ<br>
	                                            (21) 3439-5647 / 3439-5657 | WhatsApp: (21) 99408-7753<br> 
	                                            <strong>
	                                                <a href="https://portaldenegocios.com" target="_blank">www.portaldenegocios.com</a>
	                                            </strong>

	                                        </span>

	                                    </div>
	                                </td>
	                            </tr>
	                        </tbody>
	                    </table>
	                </td>
	            </tr>
	        </table>
	    </body>
</html>