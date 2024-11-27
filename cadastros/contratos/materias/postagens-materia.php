<?php
require_once '../../../init.php';
require '../../../check.php';
?>

<div class="form-row mb-2">
    <div class="col">
        <div class="table-responsive">
            <table class="table table-hover" id="tblPostagensMateria" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Título</th>
                        <th scope="col">Data de Publicação</th>
                        <th scope="col">Mídia</th>                
                        <th scope="col">Status</th> 
                        <th scope="col" style="width:10px">Edição</th>
                        <th scope="col" style="width:10px">Exclusão</th>
                    </tr>
                </thead>        
            </table>
        </div>
    </div>
</div>

<!-- o form modal para adição e edição destes posts está no rodapé do form-edit.php -->

<!-- Adicionar data-tt="tooltip" title="Título" para múltiplos data-toggle. Salvo no footer.php -->
<button type="button" id="btPopupPosts1" data-toggle="modal" data-target="#popupPosts" data-tt="tooltip" title="Adicionar Postagem" class="btn float bg-primary text-white">
    <i class="fas fa-plus"></i>
</button>

