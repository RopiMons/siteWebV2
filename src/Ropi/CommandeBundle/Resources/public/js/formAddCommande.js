function refreshSousTotal(){
    var montant = parseFloat($("[id='montant_"+$("input:checked").first().val()+"']").val());
    var montantTotal = parseFloat($("[id='montantTotalCommande']").val()) + montant;

    $("div.sousTotalPaiement").html("<p>Sous-total paiement : " + montant.toString() + " €</p>");
    $("[id='totalCommande']").html("<p><strong>Montant total de la commande : " + montantTotal + " €</strong></p>");

}

$(document).ready(function(){
    refreshSousTotal();
    $("[name='moyenDePaiement'").change(function(){
        refreshSousTotal();
    });
});