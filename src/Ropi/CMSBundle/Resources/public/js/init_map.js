// Set up some options objects: 'single_opts' for when a single area is selected, which will show just a border
// 'all_opts' for when all are highlighted, to use a different effect - shaded white with a white border
// 'initial_opts' for general options that apply to the whole mapster. 'initial_opts' also includes callbacks
// onMouseover and onMouseout, which are fired when an area is entered or left. We will use these to show or
// remove the captions, and also set a flag to let the other code know if we're currently in an area.


var inArea,
    map = $('#ropi'),
    captions = {
        equation: ["1 ropi = 1 euro + énergie positive", "Le ropi est une monnaie complémentaire à l'euro. Citoyens, commerçants et producteurs l’utilisent pour s’approvisionner en marchandises chez des commerçants et producteurs locaux. L'utilisation du ropi engendre une spirale positive de relocalisation de l’économie."],
        commercants: ["Je suis un commerçant", "J'accepte les ropis pour le paiement des produits et services que je propose et je bénéficie des avantages d’un réseau (visibilité). J'utilise à mon tour mes ropis pour m'approvisionner chez des fournisseurs locaux, ou pour régler mes dépenses personnelles. Cette recirculation du ropi contribue à la relocalisation de l'économie."],
        producteurs: ["Je suis un producteur local", "Tout comme les commerçants, j'accepte le ropi pour le paiement des produits et services que je propose. Bien que situé en fin de chaine, j'utilise à mon tour mes ropis pour payer mes charges ou pour mes dépenses personnelles. Je réinjecte ainsi les ropis dans l'économie locale pour permettre au cycle de circulation du ropi de recommencer."],
        citoyens: ["Je suis un citoyen", "Je souhaite soutenir une économie locale et engagée sur le chemin de la transition écologique. Je commande mes ropis par internet ou en me rendant chez un commerçant. J'achète des produits et services en ropis chez des commerçants ou producteurs locaux."],
        circulation: ["Le cercle vertueux de la circularité", "Le ropi engendre une boucle vertueuse de relocalisation de l'économie car il n’est pas accepté à l’extérieur de la région ni par les grandes enseignes. Ce sont des citoyens engagés sur le chemin de la transition écologique qui initient la boucle de relocalisation économique en convertissant des euros en ropis. Puis ce sont des commerçants et producteurs locaux qui continuent l'effort de relocalisation en utilisant les ropis pour payer leurs fournisseurs."],
        comptoir: ["Les comptoirs de change", "Les membres de l'asbl peuvent commander des ropis par internet et se les faire livrer chez un commerçant ou à domicile. Tous les commerçants peuvent aussi revendre les ropis qu'ils possèdent dans leur tiroir caisse."],
        fondsdegarantie: ["Fonds de garantie", "Les euro échangés contre des ropis sont versés sur un compte d'épargne chez une banque éthique et constituent le fonds de garantie. Les ropis peuvent donc être reconvertis en euros à tout instant.  Le fonds de garantie épargné finance l'économie locale via les investissements effectués par la banque éthique. La monnaie sert donc doublement, en ropis pour les transactions locales et en euros pour les investissements locaux)."],
        autreProducteurs: ["Les producteurs externes", "Le ropi n'est pas accepté dans les grandes enseignes et les multinationales. Les fuites de monnaies sont donc éliminées et le ropi continue sa circulation dans l'économie locale."],
        banque: ["Banques externes", "Le fonds de garantie est géré par des banques ou coopératives d'investissement éthiques. Il finance exclusivement des activités socialement et environnementalement responsables."]
    },
    single_opts = {
        fillColor: '000000',
        fillOpacity: 0,
        stroke: true,
        strokeColor: 'ff0000',
        strokeWidth: 2
    },
    all_opts = {
        fillColor: 'ffffff',
        fillOpacity: 0.3,
        stroke: true,
        strokeWidth: 2,
        strokeColor: 'ffffff'
    },
    initial_opts = {
        mapKey: 'data-name',
        isSelectable: false,

        onMouseover: function (data) {
            inArea = true;
            $('#ropi-caption-header').text(captions[data.key][0]);
            $('#ropi-caption-text').text(captions[data.key][1]);
            //$('#carte').hide();
            var loading = document.getElementById ( "legende" ) ;

            loading.style.visibility = "visible" ;
        },
        onMouseout: function (data) {
            inArea = false;
           // $('#carte').show();
            var loading = document.getElementById ( "legende" ) ;

            loading.style.visibility = "hidden" ;
        }
    };
opts = $.extend({}, all_opts, initial_opts, single_opts);


// Bind to the image 'mouseover' and 'mouseout' events to activate or deactivate ALL the areas, like the
// original demo. Check whether an area has been activated with "inArea" - IE<9 fires "onmouseover"
// again for the image when entering an area, so all areas would stay highlighted when entering
// a specific area in those browsers otherwise. It makes no difference for other browsers.

map.mapster('unbind')
    .mapster(opts)
    .bind('mouseover', function () {
        if (!inArea) {
            map.mapster('set_options', all_opts)
                .mapster('set', true, 'all')
                .mapster('set_options', single_opts);
        }
    }).bind('mouseout', function () {
    if (!inArea) {
        map.mapster('set', false, 'all');
    }
});

$('legende').hide();