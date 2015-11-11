$(document).ready(function(){

    function adresseChange(){
        $.ajax({
            url: Routing.generate("commande_ajax_modeDeLivraison", { idAdresse : $("#adresse option:selected").val() }),
            type: 'GET',
            dataType : 'json',

            success: function(code_html, statut){
                $("#result2").html(code_html);
            }
        });

    }

    $(".jumbotron").click(function(){

        $("#result2").html(" ");

        $.ajax({
            url : Routing.generate("commande_ajax_livraison" , { choixLivraison : this.id } ),
            type: 'GET',
            dataType: 'json',

            success: function(code_html, statut){

                $("#result").html(code_html);

                $("#adresse").change(adresseChange);

                $("#adresse").change();

            }

        });

    });



});