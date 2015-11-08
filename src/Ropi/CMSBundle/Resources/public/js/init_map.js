// Set up some options objects: 'single_opts' for when a single area is selected, which will show just a border
// 'all_opts' for when all are highlighted, to use a different effect - shaded white with a white border
// 'initial_opts' for general options that apply to the whole mapster. 'initial_opts' also includes callbacks
// onMouseover and onMouseout, which are fired when an area is entered or left. We will use these to show or
// remove the captions, and also set a flag to let the other code know if we're currently in an area.


var inArea,
    map = $('#ropi'),
    captions = {
        equation: ["1 Ropi = 1 Euro + énergie positive", "Le ropi est une monnaie complémentaire à l'euro en parité avec celle-ci. Les citoyens, mais aussi les commerçants, l’utilisent pour s’approvisionner en marchandises exclusivement chez les producteurs et artisans locaux (n'est pas accepté dans les grandes enseignes et les multi-nationales). De plus, le Ropi circule plus rapidement que l'Euro car il n'a pas vocation à être thésaurisé. Cette circulation locale engendre une spirale positive de relocalisation de l’économie."],
        commercants: ["Je suis un commerçant", "J'accepte les Ropi pour le paiement des produits et services que je propose, et je bénéficie des avantages d’un réseau. J'utilise à mon tour mes Ropi pour payer mes charges et producteurs (locaux uniquement), ou pour mes dépenses personnelles. Je contribue ainsi à **poursuivre la boucle** de l'économie circulaire"],
        producteurs: ["Je suis un producteur local", "Situé en fin de chaine, j'accepte les Ropi des commerçants et des usagers individuels. J'utilise à mon tour mes Ropi pour payer mes charges et producteurs (locaux uniquement), ou pour mes dépenses personnelles. Je  réinjecte ainsi les Ropi dans le circuit économique et contribue ainsi **fermer la boucle** de l'économie circulaire,... pour que les suivants, les autres commerçants et producteurs, la poursuive à nouveau."],
        citoyens: ["Je suis un citoyen", "Je souhaite soutenir une économie locale et engagée sur le chemin de la transition (https://fr.wikipedia.org/wiki/Ville_en_transition). Je commande mes Ropi par internet ou en me rendant chez un commerçant. J'achète des produits et services en Ropi chez des commerçants ou producteurs locaux car le Ropi n'est pas accepté à l'extérieur de la région ni par les grandes enseignes. Ce simple geste permet d'**engager la boucle** de l'économie circulaire."],
        circulation: ["Le cercle vertueux de la circularité", "Le Ropi engendre une boucle vertueuse de la relocalisation de l'économie car il n’est pas accepté à l’extérieur de la région ni dans les grandes enseignes. Ce sont les usagers engagés sur le chemin de la transition (https://fr.wikipedia.org/wiki/Ville_en_transition) qui engagent la boucle de la circularité économique en convertissant des Euro en Ropi, et ce sont les commerçants et producteurs locaux qui continuent l'effort et permettent ainsi de fermer la boucle vertueuse"],
        comptoir: ["Les comptoirs de change", "Je commande mes Ropi directement en ligne et me les fais livrer chez un commerçant ou à domicile. Tous les commerçants sont des comptoirs de change car il peuvent vous vendre les Ropi qu'ils ont en caisse"],
        fondsdegarantie: ["Fonds de garantie", "Les Euro échangés contre des Ropi sont épargnés sur un compte dans une banque éthique et constituent le fonds de garantie. Les Ropi peuvent donc être reconvertis en euro à tout instant. Les prestataires peuvent ainsi  convertir sous conditions leurs Ropi excédentaires - ceux qu'ils n'arrivent pas  à écouler dans l’ économie locale - contre des euro en s'acquittant d'une taxe de 5%. Cependant, il existe bien des façons d'écouler ses ropi [voir www.ropi.be/Ropi/En Pratique]. Et la cerise sur le gateau, c'est que le fonds de garantie peut à son tour financer l'économie locale (élargie à la Belgique) via les investissements de la banque éthique. La monnaie sert donc doublement"],
        autreProducteurs: ["Les producteurs externes", "Le Ropi n'est pas accepté dans les grandes enseignes et les multinationnales (voir les conditions sur www.ropi.be/Ropi/Adhérer). Les fuites de monnaies sont donc évitées, et l'argent peut donc continuer à circuler dans l'économie locale."],
        banque: ["Banques externes", "Un Ropi ne peut pas être déposé dans une banque autre que la banque Ropi. Les Euro convertis en Ropi ne peuvent donc plus financer des activités hors de l'économie locale (bien souvent des investissements irresponsables)"]
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
        },
        onClick: function (data) {
            inArea = true;
            $('#ropi-caption-header').text(captions[data.key][0]);
            $('#ropi-caption-text').text(captions[data.key][1]);
        },
        onMouseout: function (data) {
            inArea = false;
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
