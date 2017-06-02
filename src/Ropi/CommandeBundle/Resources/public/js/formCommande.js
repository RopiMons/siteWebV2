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

    $(".toUpdate").change(function(){
        var montant = 0;
        $(".toUpdate").each(function(){
            montant += parseInt($(this).val()) * parseFloat($("#prix",$(this).parents("tr")[0]).html());
        });
        $("div#totalArticle").html("<p>Sous Total : " + montant.toString() + " €</p>");
    });



});