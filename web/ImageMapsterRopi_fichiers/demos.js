/*global outsharked: true, configure: true, menu: true */
$(document).ready(function () {
    var demos = {};
    demos.configured = false;
    demos.configured_safari = false;
    // use to test whether the page has been reloaded

    demos.usaimg = null;

    configure = function (content, async) {

        var demoPage, i, items, ver,
            browserInfo = navigator.userAgent.split(' '),
            isBadSafari = (navigator.userAgent.indexOf('Safari') >= 0 && navigator.userAgent.indexOf('Version/5.0.5') >= 0),
            confCount = 0;

        isBadSafari = false;

        //alert(navigator.userAgent);
        //        for (i = 0; i < browserInfo.length; i++) {
        //            items = browserInfo[i].split('/');
        //            if (items[0] == 'Version') {
        //                ver = parseFloat(items[1]);

        //            }
        //        }

        content = content || $('body');
        demoPage = content.find('#accordion').length;


        if (!demoPage) {
            return;
        }
        //        if (demos.configured) {
        //            // force full page reload with Safari if we are being reconfigured (e.g. async load). No idea why it broke.
        //            if (isBadSafari) {
        //                // hilariously, this is the only way I can figure to get Mac to load this page properly. It refuses
        //                // to acknowledge that the <map> is part of the same DOM. 
        //                $('body').hide();
        //                window.location.href = window.location.href;
        //            }
        //        }
        // this script is going to run before the stuff is added to the DOM so need to ensure we don't try to configure too soon



        demos.configured = true;

        content.find('#accordion').accordion({
            onNavigate: function () {
                menu.SetNavState();
            }
        });

        function configured() {
            return;
        }


        var commonOpts = {
            safeLoad: isBadSafari
        };

        var opts = $.extend({}, commonOpts, {
            fillOpacity: 0.5,
            configTimeout: 30000,  
            fadeInterval: 50,            
        });



        // ropi demo

        // Set up some options objects: 'single_opts' for when a single area is selected, which will show just a border
        // 'all_opts' for when all are highlighted, to use a different effect - shaded white with a white border
        // 'initial_opts' for general options that apply to the whole mapster. 'initial_opts' also includes callbacks
        // onMouseover and onMouseout, which are fired when an area is entered or left. We will use these to show or
        // remove the captions, and also set a flag to let the other code know if we're currently in an area.


        var inArea,
            map = content.find('#ropi'),
            captions = {
                commercants: ["Je suis un commerçant", "J'accepte les Ropi pour le paiement de produits et services, même si ceux-ci ne sont pas directement produits dans l’économie locale, et je bénéficie des avantages d’un réseau. J'utilise mes Ropi pour payer mes producteurs (locaux uniquement), ou pour mes dépenses personnelles. Je contribue ainsi à la relocalisation de l’ économie car le Ropi n'est pas accepté à l'extérieur de la région ni dans les grandes enseignes. Si je le souhaite je peux toujours convertir mes Ropi excédentaires (ceux que je n'arrive pas à écouler dans l’ économie locale) contre des euro en m'acquittant d'une taxe de 5%. Je peux également les revendre aux citoyens qui souhaitent s'en procurer. Et en plus, Il n'y a aucune différence comptable par rapport à l'Euro, pas besoin de double comptabilité!"],
                producteurs: ["Je suis un producteur local",
                  "J'utilise mes Ropi pour payer mes charges (services locaux uniquement), ou pour mes dépenses personnelles. Je contribue ainsi à la relocalisation de l’ économie car le Ropi n'est pas accepté à l'extérieur de la région ni dans les grandes enseignes. "
                      + "Si je le souhaite je peux toujours convertir mes Ropi excédentaires (ceux que je n'arrive pas à écouler dans l’ économie locale) contre des euro en m'acquittant d'une taxe de 5%. Je peux également les revendre aux citoyens qui souhaitent s'en procurer. "
					  +"Et en plus, Il n'y a aucune différence comptable par rapport à l'Euro, pas besoin de double comptabilité!"],
                citoyens: ["Je suis un citoyen",
                  "Je souhaite soutenir l’économie locale. Je commande mes Ropi par internet ou me rends dans un comptoir de change pour acheter des Ropi (dans la limite de disponibilité des stocks). J'achète des produits et services en Ropi chez des commerçants ou producteurs locaux. "],
                comptoir: ["Les comptoirs de change",
                 "Je commande mes Ropi directement en ligne et me les fais livrer dans un des comptoirs de change ou à domicile. " 
                    + "Tous les commerçants (comptoirs et autres) peuvent aussi vous vendre des Ropi dans la limite de disponibilité des stocks. "
					+ "Le tout est géré par l’asbl Ropi, soutenue par Financité, et composée d’une équipe de citoyens bénévoles issus de tous azimut, qui veulent apporter leur pierre à l'édifice de la transition vers une économie soutenable."],
				fonds: ["Fonds de garantie",
                 "Les Euro échangés contre des Ropi sont épargnés sur un compte dans une banque éthique (TRIODOS) et constituent le fonds de garantie. "
                    + "Les Ropi peuvent donc être reconvertis en euro à tout instant. "
					+ "Le fonds de garantie, peut à son tour financer l'économie soutenable. "
					+ "La monnaie sert donc doublement."],
				banques: ["Banques externes",
                 "Contrairement à l'Euro, le Ropi ne peut pas être déposé dans une banque autre que la banque Ropi. Les Euro convertis en Ropi ne peuvent donc plus financer des activités hors de l'économie locale (bien souvent des investissements irresponsables)"],
				autresprod: ["Les producteurs externes",
                 "Le Ropi n'est pas accepté dans les grandes enseignes et les multinationnales. Les fuites de monnaies sont donc évitées, et l'argent peut donc continuer à circuler dans l'économie locale."],
				RopiEqEuro: ["1 Ropi = 1 Euro + énergie positive",
                 "Le ropi est une monnaie complémentaire à l'euro en parité avec celle-ci. Les citoyens, mais aussi les commerçants, l’utilisent pour s’approvisionner en marchandises exclusivement chez les producteurs et artisans locaux (n'est pas accepté dans les grandes enseignes et les multi-nationales). De plus, le Ropi circule plus rapidement que l'Euro car il n'a pas vocation à être thésaurisé. Cette circulation locale engendre une spirale positive de relocalisation de l’économie."],
				circul: ["Le cercle vertueux de la circularité",
                 "Le Ropi engendre une boucle vertueuse de la relocalisation de l'économie car il n’est pas accepté à l’extérieur de la région ni dans les grandes enseignes."]
            },
            single_opts = {
                fillColor: 'd2d2cd',
                fillOpacity: 0.75,
                stroke: true,
                strokeColor: '5cc133',
                strokeWidth: 2
            },
            all_opts = {
                fillColor: 'd2d2cd',
                fillOpacity: 0.1,
                stroke: false,
				strokeWidth: 0,
                strokeColor: 'ffffff' 
            },
            initial_opts = {
                mapKey: 'data-name',
                isSelectable: false,
                onMouseover: function (data) {
                    inArea = true;
                    $('#ropi-caption-header').text(captions[data.key][0]);
                    $('#ropi-caption-text').text(captions[data.key][1]);
                    $('#ropi-caption').show();
                },
                onMouseout: function (data) {
                    inArea = false;
                    $('#ropi-caption').hide();
                }
            };
        opts = $.extend({}, commonOpts, initial_opts, single_opts);


        // Bind to the image 'mouseover' and 'mouseout' events to activate or deactivate ALL the areas, like the
        // original demo. Check whether an area has been activated with "inArea" - IE&lt;9 fires "onmouseover" 
        // again for the image when entering an area, so all areas would stay highlighted when entering
        // a specific area in those browsers otherwise. It makes no difference for other browsers.

        map.mapster(opts)
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
    };

    configure($('#content'));

});

