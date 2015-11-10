$(document).ready(function(){

    $("#modeDeLivraison input").change(function(event){

        $.ajax({
            url : Routing.generate("commande_ajax_livraison" , { idLivraison : $(event.target).val()} ),
            type: 'GET',
            dataType: 'json',

            success: function(code_html, statut){

                $("#result").html(code_html);
            }
    });
    });

});