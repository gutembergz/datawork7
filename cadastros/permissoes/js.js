$(document).ready(function() {

    // Check/Un-check All checkboxes in a User Row
    $(".checkall").click(function(){
        $(this).parents('tr')
               .find(':checkbox')
               .prop('checked', this.checked)
               .change();// trigger change event
});

    // Make AJAX Request to Update User Permission setting in Backend Database
    $(".flipswitch").change(function () {
        var flip = $(this).closest('td');
        console.log("idAcesso="+this.id+"&"+this.name+"="+this.checked);
        $.ajax({
            type: 'POST',
            url: 'update.php',
            data: "idAcesso="+this.id+"&"+this.name+"="+this.checked,
            success: function() {
                flip.effect("highlight", {color:"#12D812"}, 2000)
            }
        });
    });

});       
