$(document).ready(function(){



    $(".thumbnail").click(function(){

        $("#result2").html(" ");

        $.ajax({
            url : Routing.generate("commande_ajax_livraison" , { choixLivraison : this.id } ),
            type: 'GET',
            dataType: 'json',

            success: function(code_html, statut){

                $("#result").html(code_html);

            }

        });

    });



});