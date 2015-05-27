<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Ropi\CMSBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ropi\CMSBundle\Entity\PageStatique;
USE DateTime;

/**
 * Description of LoadPageData
 *
 * @author Laurent Cardon <laurent.cardon@ropi.be>
 */
class LoadPageData extends AbstractFixture implements OrderedFixtureInterface {

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {

        $tab = array(
            array(3, "L'équipe", true, new \DateTime("2015-05-26 13:48:41"), new \DateTime("2015-05-26 13:48:41"), new \DateTime("2015-01-01 00:00:00"), $this->getReference("CAT_2"), "<h1>L'&eacute;quipe</h1>
<p>L'asbl fonctionne actuellement avec 100% de b&eacute;n&eacute;voles, qu'ils soient administrateurs, ambassadeurs ou aides ponctuelles tr&egrave;s pr&eacute;cieuses.</p>
<p>&nbsp;</p>
<h2>Les administrateurs</h2>
<p>(par ordre alphab&eacute;tique)</p>
<h3>Alexandre Bertrand - tr&eacute;sorier</h3>
<p>todo</p>
<h3><br />Laurent Cardon -&nbsp; secr&eacute;taire</h3>
<p>Je suis ing&eacute;nieur civil en informatique, gestion et math&eacute;matique op&eacute;rationnel. Je suis montois d'adoption et tr&egrave;s impliqu&eacute; dans ma r&eacute;gion. Je travail dans une organisation de jeunesses ayant pour but d'&eacute;veiller les enfants de notre r&eacute;gion aux sciences et technologies dans le cadre extra-scolaire sans aucune forme d'&eacute;litisme. Je suis <strong>administrateur et co-s&eacute;cr&eacute;taire de l'ASBL Ropi</strong> et m'occupe principalement de la comptabilit&eacute; de l'association, des questions juridiques et du d'&eacute;veloppement et l'entretient du site Internet. N'h&eacute;sitez pas me contacter via laurent.cardon@ropi.be</p>
<h3>Fabian Dortu -&nbsp; secr&eacute;taire</h3>
<p>Ing&eacute;nieur civil physicien et docteur en sciences appliqu&eacute;es , je travaille aujourd'hui comme chercheur dans un centre de recherche Montois dans le domaine de la photonique appliqu&eacute;e au diagnostic biom&eacute;dical et environnemental. Je consacre une bonne partie de mon temps libre comme b&eacute;n&eacute;vole dans des associations qui s'activent &agrave; la r&eacute;appropritation des biens communs, qu'il s'agisse de terres pour l'agriculture paysanne ou le b&acirc;ti, ou la monnaie bien s&ucirc;r. L'intelligence collective globale, pr&eacute;alable &agrave; l'&eacute;mergence d'une v&eacute;ritable d'&eacute;mocratie directe participative, fait partie de mes nouveaux chantiers. Initiateur du projet Ropi, je suis aujourd'hui <strong>administrateur et co-s&eacute;cr&eacute;taire de l'ASBL </strong>et m'occupe principalement des contenus et relations ext&eacute;rieures. N'h&eacute;sitez pas me contacter via fabian.dortu@ropi.be</p>
<h3>Jacqueline Hanneuse - tr&eacute;sori&egrave;re</h3>
<p>todo</p>
<p>&nbsp;</p>
<h2>Les ambassadeurs</h2>
<p>(par ordre alphab&eacute;tique)</p>
<h3>Jo&euml;lle Bierna</h3>
<h3>Luca Cimino</h3>
<h3>Adrien Huygens</h3>
<p>Je suis &eacute;tudiant en informatique &agrave; Mons en T&eacute;l&eacute;comunication et r&eacute;seau. Je suis tr&egrave;s impliqu&eacute; dans ma r&eacute;gion. Je suis b&eacute;n&eacute;vole dans l'organisation de diff&eacute;rents &eacute;venements, et volontaire dans une association de jeunesse qui a pour but la promotion des sciences. Pour le Ropi je m'occupe principalement du site internet.</p>
<h3>Pierre Maurage</h3>
<h3>Fran&ccedil;oise Meuleman</h3>
<p>&nbsp;</p>
<p>&nbsp;</p>
<h3>&nbsp;</h3>
<p>&nbsp;</p>
<p>&nbsp;</p>"),
            array(1, "Accueil", 1, new DateTime("2015-05-26T16:55:07+02:00"), new DateTime("2015-05-26T16:55:07+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_1"), "<p>&nbsp;</p>
<h1>todo ajouter image Ropi clickable avec le texe suivant:</h1>
<p><strong>Fonds de garantie</strong>: \"Les Euro sont &eacute;pargn&eacute;s sur un compte dans une banque &eacute;thique. Les Ropi peuvent donc &ecirc;tre reconvertis en euro &agrave; tout instant. Le fonds de garantie, plac&eacute; dans une banque &eacute; thique, peut &agrave; son tour financer l'&eacute;conomie locale. La monnaie sert donc doublement\"</p>
<p><strong>Compoir de change:</strong> \"Je commande mes Ropi directement en ligne et me les fais livrer dans un des comptoirs de change ou &agrave; domicile (lien vers le formulaire). Tous les commer&ccedil;ants (comptoirs et autres) peuvent aussi vous vendre des Ropi (1 Ropi = 1 Euro). Le tout est g&eacute;r&eacute; par l&rsquo;asbl Ropi, soutenue par Financit&eacute;, et compos&eacute;e d&rsquo;une &eacute;quipe de citoyens b&eacute;n&eacute;voles issus de tous azimut, qui veulent apporter leur pierre &agrave; l'&eacute;difice de la transition vers une &eacute;conomie soutenable.\"</p>
<p><strong>Commer&ccedil;ants et </strong><strong><strong>Producteurs locaux</strong>:</strong> \"J'accepte les Ropi pour le paiement de produits et services, m&ecirc;me si ceux-ci ne sont pas directement produits dans l&rsquo;&eacute;conomie locale, et je b&eacute;n&eacute;ficie des avantages d&rsquo;un r&eacute;seau.<br />J'utilise mes Ropi pour payer mes producteurs (locaux uniquement), ou pour mes d&eacute;penses personnelles. Je contribue ainsi &agrave; la relocalisation de l&rsquo; &eacute;conomie car le Ropi n'est pas accept&eacute; &agrave; l'ext&eacute;rieur de la r&eacute;gion ni dans les grandes enseignes.<br />Si je le souhaite je peux toujours convertir mes Ropi exc&eacute;dentaires (ceux que je n'arrive pas &agrave; &eacute;couler dans l&rsquo; &eacute;conomie locale) contre des euro en m'acquittant d'une taxe de 5%. Je peux &eacute;galement les revendre aux citoyens qui souhaitent s'en procurer.</p>
<p>Et en plus, Il n'y a aucune diff&eacute;rence comptable par rapport &agrave; l'Euro, pas besoin de double comptabilit&eacute;!</p>
<p><strong>Citoyens:</strong> \"Je souhaite soutenir l&rsquo;&eacute;conomie locale. Je me rends dans un comptoir de change et je ressors avec mes Ropi. J'ach&egrave;te des produits et services en Ropi chez des commer&ccedil;ants ou producteurs locaux (LIEN carte des commer&ccedil;ants)\"</p>
<p><strong>Fl&egrave;che circulaire centrale / banques / autres producteurs: </strong>Le Ropi engendre une boucle vertueuse de la relocalisation de l'&eacute;conomie car il n&rsquo;est pas accept&eacute; &agrave; l&rsquo;ext&eacute;rieur de la r&eacute;gion ni dans les grandes enseignes.</p>
<p><strong>1R = 1&euro;:&nbsp; </strong>Le ropi est une monnaie compl&eacute;mentaire &agrave; l'euro en parit&eacute; avec celle-ci. Les citoyens, mais aussi les commer&ccedil;ants, l&rsquo;utilisent pour s&rsquo;approvisionner en marchandises exclusivement chez les producteurs et artisans locaux. De plus, le Ropi circule plus rapidement que l'Euro car il n'a pas vocation &agrave; &ecirc;tre th&eacute;sauris&eacute;. Cette circulation locale engendre une spirale positive de relocalisation de l&rsquo;&eacute;conomie.</p>
<p><strong>Retrouvez toutes les info d'utilisation du Ropi sur LIEN--&gt;Le Ropi, en pratique</strong></p>
<p>&nbsp;</p>
<h1><strong>Les derni&egrave;res nouvelles</strong></h1>
<p>todo: blog</p>"),
            array(1, "En pratique", 1, new DateTime("2015-05-26T20:17:34+02:00"), new DateTime("2015-05-26T16:55:07+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_2"), "<h1>Le Ropi, la monnaie compl&eacute;mentaire de Mons et ses environs</h1>
<h2><br />Le Ropi ne remplace pas l'Euro, il le compl&eacute;mente!</h2>
<p>Il circule en parall&egrave;le &agrave; l'euro, et par facilit&eacute;, il partage la m&ecirc;me &eacute;chelle de valeur, &agrave; savoir <strong>1 Ropi = 1 Euro</strong>.</p>
<h2>Mais alors pourquoi passer par le Ropi?</h2>
<p>Sa sp&eacute;cificit&eacute; par rapport &agrave; l'Euro est d'avoir court au sein d'une r&eacute;gion limit&eacute;e, Mons-Borinage, et par cons&eacute;quent de favoriser l'&eacute;conomie locale et les circuits de distribution courts (TODO LIEN: voir les document fondateur de l'asbl Ropi).</p>
<h2>Pour mieux comprendre son utilit&eacute; et son usage, suivons le chemin d'un Ropi</h2>
<p>1. <strong>Un citoyen consom'acteur d&eacute;cide d'&eacute;changer des Ropi contre des Euro (1 Ropi = 1 Euro)</strong>. Il existe diff&eacute;rentes fa&ccedil;ons d'obtenir des Ropi:</p>
<ul>
<li>commander des Ropi via internet et se les faire livrer au comptoir de change de son choix ou &agrave; domicile. Il suffit de remplir le formulaire de commande en ligne --&gt; TODO LIEN et de payer par virement bancaire ou paypal.</li>
<li>se rendre chez un commer&ccedil;ant acceptant des Ropi ou un comptoir de change, et lui demander s'il peut &eacute;changer des Ropi contre des Euro. Attention, cette m&eacute;thode n'est pas infaillible car rien ne garantit que le commer&ccedil;ant aura des Ropi en stock.</li>
</ul>
<p>2. <strong>Le citoyen se rend chez un prestataire</strong> <strong>acceptant le Ropi</strong> - commercants, artisants, agriculteurs, prestataires de services, ... La liste des prestataires est consultable via un outils de recherche d&eacute;di&eacute; (LIEN TODO Les commerces). Le plus souvent, les commer&ccedil;ants arboreront aussi un autocollant en vitrine ou dans leur magasin indiquant qu'ils acceptent le Ropi. TODO IMAGE.</p>
<p><br /><strong>3.&nbsp; Les prestataires qui poss&egrave;dent alors des Ropi ont deux choix qui s'ouvrent &agrave; eux</strong></p>
<ul>
<li>r&eacute;&eacute;changer les Ropi contre des Euro, en s'acquittant d'une taxe de 5% (pour les membres prestataires uniquement, en contactant l'asbl via support@ropi.be).</li>
<li>ou bien, et c'est bien l&agrave; le but recherch&eacute;, poursuivre la spirale vertueuse en trouvant d'autres prestataires et producteurs locaux qui acceptent le Ropi. C'est facile gr&acirc;ce &agrave; l'outils de recherche des commer&ccedil;ants et producteurs --&gt; TODO LIEN. S'il n'existe pas de prestataire local ad&eacute;quat, les ambassadeurs se feront un plaisir de rechercher le maillon manquant (contacter support@ropi.be)</li>
</ul>
<p>Vous l'aurez compris, ce n'est pas du tout le but poursuivi de reconvertir ses Ropi en Euro, et c'est pour cela qu'une taxe de reconversion de 5% est appliqu&eacute;e, afin de d&eacute;courager &agrave; la reconversion.</p>
<h2><strong>En conclusion</strong></h2>
<p>Ce sont des <strong>consommateurs</strong>, engag&eacute;s pour le devenir de leur cit&eacute;, qui injectent des Ropi dans l'&eacute;conomie locale.</p>
<p>Ce sont des <strong>prestataires</strong>, engag&eacute;s pour le devenir de leur cit&eacute;, qui acceptent les Ropi, et font la d&eacute;marche de s'approvisioner dans l'&eacute;conomie locale, voir de trouver de nouvelles fili&egrave;res d'approvisonnement.</p>
<p>Ce sont les consommateurs ET les prestataires, qui ENSEMBLE, avec l'aide du Ropi comme vecteur d'&eacute;change, contribuent ainsi &agrave; relocaliser et circulariser l'&eacute;conomie.</p>
<p>Le fonctionnement du Ropi est d&eacute;taill&eacute; dans le R&egrave;glement d'Ordre d'Int&eacute;rieur [TODO lien]</p>
<p>TODO SCHEMA DEPLIANT statique</p>
<p>&nbsp;</p>"),
            array(2, "Adhérer à l'asbl", 1, new DateTime("2015-05-26T17:36:28+02:00"), new DateTime("2015-05-26T16:55:07+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_2"), "<h1>Adh&eacute;rer &agrave; l'asbl</h1>
<h2>Les membres, pour une gouvernance d&eacute;mocratique en Assembl&eacute; G&eacute;n&eacute;rale</h2>
<p>L'asbl Ropi tend &agrave; appliquer une gouvernance la plus d&eacute;mocratique possible via son Assembl&eacute;e G&eacute;n&eacute;rale (AG) des citoyens et par des outils de d&eacute;mocratie directe et participative qui seront mis progressivement en place (ex: sondage via internet).</p>
<p>En effet, nous consid&eacute;rons que la monnaie devrait &ecirc;tre un outil au service du citoyen, et non l'inverse comme c'est le cas avec les monnaies dominantes (l'euro chez nous). Cet outil ne pourra v&eacute;ritablement assumer son r&ocirc;le de servitude que si le plus grand nombre de citoyens participe &agrave; sa politique dans le sens le plus noble du terme.</p>
<p>Il existe deux types de membre de l'asbl Ropi:</p>
<ul>
<li>les <strong>membres effectifs</strong>, qui ont droit de vote lors de l'Assembl&eacute;e G&eacute;n&eacute;rale (AG),</li>
<li>les <strong>membres sympathisants</strong>, qui soutiennent le Ropi, notamment par le paiement d'une cotisation permettant le fonctionnement de l'asbl.</li>
</ul>
<p>Les <strong>membres effectifs</strong> se r&eacute;partissent en 3 coll&egrave;ges</p>
<ul>
<li>le coll&egrave;ge des <strong>prestataire</strong>s (commerces, producteurs, tout prestataire de biens et services en g&eacute;n&eacute;ral),</li>
<li>le coll&egrave;ge des <strong>usagers individuels</strong>,</li>
<li>le coll&egrave;ge des <strong>associations et institutions</strong>,</li>
</ul>
<h2><strong>Avantages des membres</strong></h2>
<p>La premi&egrave;re raison d'adh&eacute;rer &agrave; l'asbl est de disposer du droit de vote &agrave; l'AG et ainsi d'influencer le devenir du Ropi. Nous visons un syst&egrave;me de gouvernance le plus d&eacute;mocratique possible o&ugrave; chaque coll&egrave;ge dispose d'un tiers du droit de vote &agrave; l'AG. <strong>Faites entendre votre voix!</strong></p>
<p>Autre avantage:</p>
<ul>
<li>Si vous &ecirc;tes un usager individuel, l'adh&eacute;sion vous permettra d'<strong>&eacute;changer des Ropi contre des Euro &agrave; un tarif pr&eacute;f&eacute;rentie</strong>l: 51 Ropi pour 50 Euro, 103 Ropi pour 100 Euro, que vous soyiez membre effectif ou sympathisant.</li>
<li>Si vous &ecirc;tes un <strong>prestataire</strong> ou une <strong>association</strong>, l'adh&eacute;sion vous permettra</li>
<ul>
<li>de r&eacute;&eacute;changer vos Ropi contre des Euro (avec taxe de 5%). Certains prestataires &agrave; but non lucratif peuvent b&eacute;n&eacute;ficier d'un taux de reconversion de 0% s'ils en font la demande &agrave; l'asbl et sur approbation de l'AG.</li>
<li>de b&eacute;n&eacute;ficier d'une visibilit&eacute; sur la page d'accueil du Ropi (bandeau d'affichage du logo et page de pr&eacute;sentation)</li>
<li>d'&ecirc;tre r&eacute;f&eacute;rencer dans l'annuaire du Ropi permettant une recherche par activit&eacute;, produits, localisation, ...</li>
<li>de b&eacute;n&eacute;ficier des &eacute;ventuels b&eacute;n&eacute;fices de l'asbl Ropi, affect&eacute;s &agrave; des pr&ecirc;ts &agrave; 0% ou &agrave; des subsides aux membres prestataires ou associatifs qui en font la demande et sur approbation de l'AG.</li>
</ul>
</ul>
<h2>Comment adh&eacute;rer?</h2>
<p>Pour devenir membre, enregistrez-vous via le formulaire en ligne TODO LIEN FORMULAIRE EN LIGNE ou en nous envoyant un email &agrave; info@ropi.be (+ mod&egrave;le automatique de mail)</p>
<p>Vous pouvez &eacute;galement vous rendre &agrave; un comptoir de change et y compl&eacute;ter un formulaire d'inscription papier. Nous vous contacterons ensuite par couriel ou par la poste.</p>
<p>Vous serez ensuite invit&eacute; &agrave; r&eacute;gler votre cotisation de 15 Ropi (par votre compte Ropi en ligne) ou de 20 Euro (BEXX XXXX XXXX XXXX).</p>"),
            array(1, "Visuels", 1, new DateTime("2015-05-26T15:36:36+02:00"), new DateTime("2015-05-26T15:36:36+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_4"), "<h1>Les visuels de communication</h1>
<p>Sur cette pages, vous trouverez tous nos visuels de communication (logo, d&eacute;pliant, autocollants, ...) que vous pouvez utiliser pour faire la promotion du Ropi. Imprimez les vous m&ecirc;me, ou commandez les via TODO FORMULAIRE DE COMMANDE DES VISUELS</p>
<p>FORMULAIRE</p>
<p>--&gt; se logger (il faut &ecirc;tre membre)</p>
<p>--&gt; cocher le type de visuel et le nombre d'unit&eacute; souhait&eacute;e</p>
<p>&nbsp;</p>
<h2>Le logo Ropi</h2>
<p>&nbsp;</p>
<h2>Le d&eacute;pliant (triptyque)</h2>
<p>&nbsp;</p>
<h2>L'autocollant, \"Ici on accepte le Ropi\"</h2>
<p>&nbsp;</p>
<h2>Les cartes de visites (pour les ambassadeurs, ...)</h2>"),
            array(2, "Documents fondateurs", 1, new DateTime("2015-05-26T16:55:20+02:00"), new DateTime("2015-05-26T16:55:07+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_4"), "<h1>Les documents fondateurs</h1>
<h2>Statuts</h2>
<p>L'association a pour objet, en dehors de tout but de lucre</p>
<ul>
<li>de promouvoir des activit&eacute;s visant &agrave; am&eacute;liorer l'autonomie &eacute;conomique locale, et ce particuli&egrave;rement en assurant la cr&eacute;ation, la promotion et la gestion d'une monnaie locale compl&eacute;mentaire &agrave; l'euro : le Ropi. Cette monnaie circulera entre les citoyens, des artisans, des agriculteurs, des entreprises, des commerces, des associations, institutions souhaitant retrouver la ma&icirc;trise de l'usage local des moyens d'&eacute;change.</li>
<li>d'informer les citoyens sur les fondements et r&eacute;alit&eacute;s du syst&egrave;me mon&eacute;taire et &eacute;conomique en cours dans notre soci&eacute;t&eacute;, et des injustices qui en d&eacute;coulent.</li>
<li>d'agir en tant que groupe local du R&eacute;seau Financit&eacute;, afin de promouvoir une finance responsable et solidaire et de favoriser un autre rapport &agrave; l'argent.</li>
</ul>
<p>D&eacute;couvrez les statuts complets de l'ASBL Ropi au &lt;a href=\"http://www.ejustice.just.fgov.be/cgi_tsv/tsv_rech.pl?language=fr&amp;amp;btw=0506894878&amp;amp;liste=Liste\"&gt;moniteur&lt;/a&gt; et les membres du Conseil d'Administration --&gt; lien ver Ropi/L'&eacute;quipe</p>
<p>&nbsp;</p>
<h2>La Charte</h2>
<p>Emanant d'actions men&eacute;es par des citoyens montois pour la promotion d'une &eacute;conomie socialement et environnementalement soutenable, le projet vise &agrave; mettre en place une <strong>monnaie compl&eacute;mentaire &agrave; l'euro</strong> dans la<strong> r&eacute;gion de Mons-Borinage</strong>.</p>
<h3>Un triple objectif</h3>
<ul>
<li>Relocaliser l'&eacute;conomie afin de se pr&eacute;parer aux d&eacute;fis environnementaux et &agrave; la fin du pr&eacute;trole bon march&eacute; (pic p&eacute;trolier).</li>
<li>remettre le citoyen au coeur des d&eacute;bats et prises de d&eacute;cisions, notamment &agrave; propos des questions financi&egrave;res, mon&eacute;taires et des processus de production.</li>
<li>proposer une alternative &agrave; la monnaie dominante bas&eacute;e sur les revenus du capital et g&eacute;n&eacute;ratrice d'in&eacute;galit&eacute;s sociales.</li>
</ul>
<p>La monnaie compl&eacute;mentaire mise en place - le Ropi - entend r&eacute;aliser ces objectifs par le soutien qu'elle apporte aux <strong>petites structures </strong>et <strong>commerces de proximit&eacute;</strong>, face &agrave; la grande distribution, les multinationales, et les franchises.</p>
<h3>Engagement</h3>
<p>En tant que prestataire de biens de services (distributeurs, fournisseurs, transformateurs ou producteurs), nous adh&eacute;rons par cette charte au projet Ropi mis en place par l'asbl Ropi.</p>
<p>Nous nous engageons &agrave; <strong>promouvoir le Ropi</strong> et les <strong>valeurs &eacute;thiques</strong> qu'il sous-tend</p>
<ul>
<li>en acceptant le Ropi comme moyen de paiement.</li>
<li>en sensibilisant les citoyens &agrave; ce nouveau moyen d'&eacute;change porteur de valeurs.</li>
</ul>
<p>T&eacute;l&eacute;chargez la charte au format pdf --&gt; charte_ropi.pdf</p>
<p>&nbsp;</p>
<p>&nbsp;</p>"),
            array(1, "Les commerces", 1, new DateTime("2015-05-26T20:54:06+02:00"), new DateTime("2015-05-26T20:54:06+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_3"), "<h1>Comment trouver les prestataires membres</h1>
<h2>Cartographie</h2>
<p>mapfaire.com/Ropi</p>
<h2>Logo</h2>
<p>slider avec logo/nom des prestataire.</p>
<p>Les premiers sont les plus r&eacute;cemments inscrits comme membre</p>
<h2>Recherche</h2>
<p>(par commerce / produits / quartier)</p>"),
            array(5, "Les billets", 1, new DateTime("2015-05-26T21:28:27+02:00"), new DateTime("2015-05-26T21:21:39+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_2"), "<h1>Pr&eacute;sentation des billets</h1>
<h2>L'&eacute;dition 2015</h2>
<p>En 2015, le Ropi se dote de nouveaux billets reprenant des monuments montois charg&eacute;s d'histoire</p>
<p>Ces billets peuvent-&ecirc;tre command&eacute;s en ligne via ce formulaire --&gt; TODO, ou chez les commer&ccedil;ants membres (sous r&eacute;serve de disponibilit&eacute;).</p>
<p>TODO montrer les 4 billets verticalement, recto-verso --&gt; avec SPECIMEN en FILIGRAN</p>
<p>&nbsp;https://www.behance.net/gallery/26077637/ROPI-Monnaie-alternative-de-la-ville-de-Mons</p>
<h2>L'&eacute;dition 2011</h2>
<p>Cette &eacute;dition a &eacute;t&eacute; tir&eacute;e lors de la cr&eacute;ation du projet Ropi. Les &eacute;l&eacute;ments grapiques ont &eacute;t&eacute; d&eacute;termin&eacute;s sur base d'un concours de dessin au sein de l'&eacute;cole Le Nursing. Ces billets sont toujours valides aujourd'hui mais ne sont plus mis en vente. Ils seront progressivement retir&eacute;s de la circulation.</p>
<p>TODO montrer les billets de 1 et 5 Ropi, recto verso --&gt; avec SPECIMEN en FILIGRAN</p>
<p>&nbsp;</p>"),
            array(6, "La monnaie électronique", 1, new DateTime("2015-05-26T21:22:03+02:00"), new DateTime("2015-05-26T21:22:03+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_2"), "<h1>La monnaie &eacute;lectronique</h1>
<p>Une version &eacute;lectronique du Ropi sera bient&ocirc;t disponible, en plus de la version papier.</p>
<p>Chaque membre de l'asbl disposera d'un (ou plusieurs) compte virtuel accessible par internet (Ropi banking). Ce compte pourra &ecirc;tre cr&eacute;dit&eacute; en Ropi par virement bancaire en Euro. Des op&eacute;rations de transfert entre les comptes pourront &ecirc;tre effectu&eacute;es par internet mais &eacute;galement par SMS sans aucun co&ucirc;t pour l'utilisateur. Ce syst&egrave;me permettra notamment de faire des paiements chez le commer&ccedil;ants.</p>
<p>&nbsp;</p>"),
            array(4, "Nous aider", 1, new DateTime("2015-05-26T17:18:36+02:00"), new DateTime("2015-05-26T17:14:04+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_2"), "<h1>Comment nous aider?</h1>
<h2>Devenir b&eacute;n&eacute;vole</h2>
<p><br /> Une organisation comme le Ropi ne peut fonctionner sans ses nombreux b&eacute;n&eacute;voles, qui constituent la cheville ouvri&egrave;re de l'abl. Il y a de nombreux postes &agrave; renforcer ou &agrave; pourvoir au sein de l'asbl Ropi, notamment:</p>
<ul>
<li>des ambassadeurs pour le d&eacute;marchage de commer&ccedil;ants, la communication aux citoyens ou aux media</li>
<li>des transporteurs pour la livraison des Ropi aux comptoirs de change ou &agrave; domicile</li>
<li>des administrateurs de l'asbl,&nbsp;</li>
<li>des d&eacute;veloppeurs pour le site web et la monnaie &eacute;lectronique</li>
<li>des infographistes et web designers&nbsp;</li>
<li>des r&eacute;dacteurs pour la mise &agrave; jour du contenu du site web (blog, agenda, point presse) et des outils de communications en g&eacute;n&eacute;ral</li>
<li>des comptables (professionalisation de la comptabilit&eacute; et contr&ocirc;les)</li>
<li>des juristes (mise &agrave; jour des statuts, communication avec la banque nationale de belgique, FSMA, ...)</li>
<li>des organisateurs d'&eacute;v&eacute;nements (f&ecirc;tes, projection cin&eacute;ma, conf&eacute;rence, ...)</li>
</ul>
<p><br /> Pour nous proposer votre aide, inscrivez-vous via le formulaire en ligne --&gt; TODO ou par email via info@ropi.be<br /> <br /> Nous invitons &eacute;galement tous les b&eacute;n&eacute;voles &agrave; devenir membre de l'asbl.</p>
<h2><br /> Devenir membre de l'asbl</h2>
<p><br /> Les membres, de par leur apports (avis, id&eacute;es, propositions, critiques, votes, ...) &agrave; l'Assembl&eacute;e G&eacute;n&eacute;rale ou participation aux ateliers pratiques (r&eacute;unions de travail ou brainstorming) sont indsipensables &agrave; la vie de l'asbl. De par leurs contributions financi&egrave;re via les cotisations, les membres assurent la p&eacute;rennit&eacute; de l'asbl? Consultez la page Ropi / Adh&eacute;rer &agrave; l'asbl pour devenir membre.</p>"),
            array(3, "Documents opérationnels", 1, new DateTime("2015-05-26T20:26:31+02:00"), new DateTime("2015-05-26T20:26:31+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_4"), "<h1>Documents op&eacute;rationnels</h1>
<h2>R&eacute;glement d'ordre int&eacute;rieur (ROI)</h2>
<p>Le r&eacute;glement d'ordre int&eacute;rieur est le document de r&eacute;f&eacute;rence d&eacute;crivant les r&egrave;gles de fonctionnement du Ropi. [RopiROI.pdf].</p>
<p>Pour une description simplifi&eacute;e, consultez Le Ropi / En pratique.</p>
<h2>Mod&egrave;le de conventions avec les prestataires</h2>
<p>N&eacute;cessit&eacute; en plus de la charte</p>
<h2>Compte rendus des r&eacute;unions (CA et AG)</h2>
<p>L'asbl souhaite offrir un maximum de transparence sur ses activit&eacute;s. C'est pourquoi les comptes rendus des r&eacute;unions du Conseil d'Administration et de l'Assembl&eacute;e G&eacute;n&eacute;rale sont publics. [Consulter les comptes rendus]--&gt;TODO liens sur un r&eacute;pertoire</p>
<h2>Comptabilit&eacute;</h2>
<p>Consultez les comptes annuels et les budgets pr&eacute;visionnels --&gt; todo liens sur des r&eacute;pertoires</p>")
        );

        foreach ($tab as $element) {
            $page = new PageStatique();

            $page->setPosition($element[0]);
            $page->setTitreMenu($element[1]);
            $page->setIsActive($element[2]);
            $page->setLastUpdate($element[3]);
            $page->setCreatedAt($element[4]);
            $page->setPublicationDate($element[5]);
            $page->setCategorie($element[6]);
            $page->setContenu($element[7]);

            $manager->persist($page);
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 3; // the order in which fixtures will be loaded
    }

}
