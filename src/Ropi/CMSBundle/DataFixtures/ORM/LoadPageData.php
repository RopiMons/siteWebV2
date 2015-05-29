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
            array(3, "L'équipe", 1, new DateTime("2015-05-27T23:34:52+02:00"), new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_2"), "<h1>L\'&eacute;quipe</h1>
<p>L\'asbl fonctionne actuellement avec 100% de b&eacute;n&eacute;voles, qu\'ils soient administrateurs, ambassadeurs ou aides ponctuelles tr&egrave;s pr&eacute;cieuses.</p>
<p>&nbsp;</p>
<h2>Les administrateurs</h2>
<p>(par ordre alphab&eacute;tique)</p>
<h3>Alexandre Bertrand - tr&eacute;sorier</h3>
<p><img src=\"../../../../../source/Membre_AlexandreBertrand.JPG\" alt=\"Alexandre Bertrand\" width=\"100\" height=\"129\" /></p>
<h3><br />Laurent Cardon -&nbsp; secr&eacute;taire</h3>
<p><img src=\"../../../../../source/Membre_LaurentCardon.png\" alt=\"Laurent Cardon\" width=\"130\" /></p>
<p>Je suis ing&eacute;nieur civil en informatique, gestion et math&eacute;matique op&eacute;rationnel. Je suis montois d\'adoption et tr&egrave;s impliqu&eacute; dans ma r&eacute;gion. Je travail dans une organisation de jeunesses ayant pour but d\'&eacute;veiller les enfants de notre r&eacute;gion aux sciences et technologies dans le cadre extra-scolaire sans aucune forme d\'&eacute;litisme. Je suis <strong>administrateur et co-s&eacute;cr&eacute;taire de l\'ASBL Ropi</strong> et m\'occupe principalement de la comptabilit&eacute; de l\'association, des questions juridiques et du d\'&eacute;veloppement et l\'entretient du site Internet. N\'h&eacute;sitez pas me contacter via laurent.cardon@ropi.be</p>
<h3>Fabian Dortu -&nbsp; secr&eacute;taire</h3>
<p><img src=\"../../../../../source/Membre_FabianDortu.JPG\" alt=\"Fabian Dortu\" width=\"100\" /></p>
<p>Ing&eacute;nieur civil physicien et docteur en sciences appliqu&eacute;es , je travaille aujourd\'hui comme chercheur dans un centre de recherche Montois dans le domaine de la photonique appliqu&eacute;e au diagnostic biom&eacute;dical et environnemental. Je consacre une bonne partie de mon temps libre comme b&eacute;n&eacute;vole dans des associations qui s\'activent &agrave; la r&eacute;appropritation des biens communs, qu\'il s\'agisse de terres pour l\'agriculture paysanne ou le b&acirc;ti, ou la monnaie bien s&ucirc;r. L\'intelligence collective globale, pr&eacute;alable &agrave; l\'&eacute;mergence d\'une v&eacute;ritable d\'&eacute;mocratie directe participative, fait partie de mes nouveaux chantiers. Initiateur du projet Ropi, je suis aujourd\'hui <strong>administrateur et co-s&eacute;cr&eacute;taire de l\'ASBL </strong>et m\'occupe principalement des contenus et relations ext&eacute;rieures. N\'h&eacute;sitez pas me contacter via fabian.dortu@ropi.be</p>
<h3>Jacqueline Hanneuse - tr&eacute;sori&egrave;re</h3>
<p>todo</p>
<p>&nbsp;</p>
<h2>Les ambassadeurs</h2>
<p>(par ordre alphab&eacute;tique)</p>
<h3>Jo&euml;lle Bierna</h3>
<p><img src=\"../../../../../source/Membre_Ropieur.JPG\" alt=\"Jo&euml;lle Bierna\" width=\"100\" height=\"114\" /></p>
<h3>Luca Cimino</h3>
<h3>Adrien Huygens</h3>
<p><img src=\"../../../../../source/Membre_AdrienHuygens.JPG\" alt=\"Adrien Huygens\" width=\"100\" /></p>
<p>Je suis &eacute;tudiant en informatique &agrave; Mons en T&eacute;l&eacute;comunication et r&eacute;seau. Je suis tr&egrave;s impliqu&eacute; dans ma r&eacute;gion. Je suis b&eacute;n&eacute;vole dans l\'organisation de diff&eacute;rents &eacute;venements, et volontaire dans une association de jeunesse qui a pour but la promotion des sciences. Pour le Ropi je m\'occupe principalement du site internet.</p>
<h3>Pierre Maurage</h3>
<h3>Fran&ccedil;oise Meuleman</h3>
<p>&nbsp;</p>
<p>&nbsp;</p>
<h3>&nbsp;</h3>
<p>&nbsp;</p>
<p>&nbsp;</p>"),
            array(1, "Accueil", 1, new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_1"), "<p>&nbsp;</p>
<p><img src=\"../../../../../source/ROPI_Depliant_illustration_notext.png\" alt=\"Sch&eacute;ma circulation du\" width=\"836\" height=\"528\" />&nbsp;</p>
<p><em>[todo: int&eacute;grer le javascript - text mouse over]</em></p>
<p>&nbsp;</p>
<p><strong>Retrouvez toutes les info d\'utilisation du Ropi:&nbsp;<a href=\"../../../../../page/RopiPratique.php\">Le Ropi, en pratique</a></strong></p>
<p>&nbsp;</p>
<h1><strong>Les derni&egrave;res nouvelles</strong></h1>
<p>Ici blabla</p>
<p>&nbsp;</p>
<p>----------------------</p>
<p>&nbsp;</p>
<p>Plus de Babla</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>----------------------</p>
<p>&nbsp;</p>
<p>Encore du blabla</p>"),
            array(1, "En pratique", 1, new DateTime("2015-05-28T23:41:04+02:00"), new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_2"), "<h1>Le Ropi, la monnaie compl&eacute;mentaire de Mons et ses environs</h1>
<h2><br />Le Ropi ne remplace pas l\'Euro, il le compl&eacute;mente!</h2>
<p>Il circule en parall&egrave;le &agrave; l\'euro, et par facilit&eacute;, il partage la m&ecirc;me &eacute;chelle de valeur, &agrave; savoir</p>
<p>&nbsp;</p>
<p style=\"padding-left: 30px; text-align: center;\">&nbsp;<img src=\"../../../../../source/component_parite.png\" alt=\"1 Ropi = 1 Euro + &eacute;nergie positive!\" width=\"200\" height=\"76\" /></p>
<p style=\"padding-left: 30px;\">&nbsp;</p>
<h2>Mais alors pourquoi passer par le Ropi?</h2>
<p>Sa sp&eacute;cificit&eacute; par rapport &agrave; l\'Euro est de <strong>n\'avoir court qu\'au sein d\'une r&eacute;gion limit&eacute;e</strong>, Mons-Borinage, et par cons&eacute;quent de favoriser l\'<strong>&eacute;conomie locale</strong> et les <strong>circuits de distribution courts</strong> (consultez <a href=\"../../../../../page/Documents/Documents fondateurs\">nos documents fondateurs</a>).</p>
<h2>&nbsp;</h2>
<h2>Pour mieux comprendre son utilit&eacute; et son usage, suivons le chemin d\'un Ropi</h2>
<p>&nbsp;</p>
<table>
<tbody>
<tr>
<td><img src=\"../../../../../source/component_comptoir.png\" alt=\"Comptoir d\'&eacute;change\" width=\"50\" height=\"50\" /></td>
<td><strong>Un citoyen consom\'acteur d&eacute;cide de se procurer des Ropi</strong></td>
</tr>
</tbody>
</table>
<p>Il existe diff&eacute;rentes fa&ccedil;ons pour lui de <strong>se procurer des Ropi</strong></p>
<p style=\"padding-left: 30px;\">Se rendre chez un <strong><a href=\"../../../../../source/cartecomptoir.php\">comptoir de change</a></strong>, et acheter des Ropi dans la limite de disponibilit&eacute; des stocks.</p>
<p style=\"padding-left: 30px;\">Il est fortement conseill&eacute; de <strong>commander ses Ropi <a href=\"../../../../../source/FormulaireAchatRopi.php\">par internet</a></strong> (paiement par virement bancaire ou paypal), et de <strong>se les faire livrer au comptoir de change de son choix ou &agrave; domicile</strong> (livraison par un b&eacute;n&eacute;vole, le coursier montois ou par la poste).</p>
<p style=\"padding-left: 30px;\">Se rendre chez un <a href=\"../../../../../source/cartecommerces.php\"><strong>commer&ccedil;ant</strong> <strong>acceptant des Ropi</strong></a>, et lui demander s\'il peut &eacute;changer des Ropi contre des Euro. Attention, cette m&eacute;thode n\'est pas infaillible car rien ne garantit que le commer&ccedil;ant aura des Ropi en stock.</p>
<p>&nbsp;</p>
<table>
<tbody>
<tr>
<td><img src=\"../../../../../source/component_commercant.png\" alt=\"Commer&ccedil;ant\" width=\"50\" height=\"50\" /></td>
<td><strong>Le citoyen se rend chez un prestataire</strong> <strong>acceptant le Ropi</strong></td>
</tr>
</tbody>
</table>
<p style=\"padding-left: 30px;\">La <strong>liste des prestataires</strong> (commercants, artisants, agriculteurs, prestataires de services, ...) est consultable via <a href=\"../../../../../source/FormulaireRecherche.php\"><strong>la carte et l\'outils de recherche</strong> </a><strong><a href=\"../../../../../source/FormulaireRecherche.php\">des commerces</a></strong>.</p>
<p style=\"padding-left: 30px;\">Le plus souvent, les commer&ccedil;ants arboreront aussi un <strong>autocollant en vitrine ou &agrave; l\'int&eacute;rieur du magasin</strong> indiquant qu\'ils acceptent le Ropi.</p>
<p style=\"text-align: right;\">&nbsp;<img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"../../../../../source/autocollant.png\" alt=\"autocollant\" width=\"100\" height=\"100\" /></p>
<p style=\"text-align: right;\">&nbsp;</p>
<table>
<tbody>
<tr>
<td><strong><img src=\"../../../../../source/component_producteur.png\" alt=\"Producteurqs\" width=\"50\" height=\"50\" /></strong></td>
<td><strong>Les prestataires qui disposent de Ropi ont deux choix possibles</strong></td>
</tr>
</tbody>
</table>
<p style=\"padding-left: 30px;\"><strong>Reconvertir les Ropi contre des Euro</strong>, en s\'acquittant d\'une <strong>taxe de 5%</strong>. La reconversion n\'est possible que pour les membres prestataires, en contactant l\'asbl via <a href=\"mailto:support@ropi.be\">support@ropi.be</a> ou en compl&eacute;tant le <a href=\"../../../../../sources/formreconversion.php\">formulaire de reconversion</a>.</p>
<p style=\"padding-left: 30px;\">Ou bien, et c\'est bien l&agrave; le but recherch&eacute;,</p>
<p style=\"padding-left: 30px;\"><strong>poursuivre la spirale vertueuse de la relocalisation de l\'&eacute;conomie</strong>, en trouvant d\'autres prestataires et producteurs locaux qui acceptent le Ropi. C\'est facile gr&acirc;ce &agrave; l\'<a href=\"../../../../../source/FormulaireRecherche.php\">outils de recherche</a> des commer&ccedil;ants et producteurs.</p>
<p style=\"padding-left: 30px;\">S\'il n\'existe pas de prestataire local ad&eacute;quat, les ambassadeurs se feront un plaisir de rechercher <strong>le maillon manquant</strong>. Contactez-nous via <a href=\"mailto:support@ropi.be\">support@ropi.be</a> ou compl&eacute;tez le <a href=\"../../../../../sources/formnouveauprestaire.php\">formulaire de proposition d\'un nouveau prestataire</a>.</p>
<p style=\"padding-left: 30px;\">Vous l\'aurez compris, ce n\'est pas du tout le but poursuivi de reconvertir ses Ropi en Euro, et c\'est pour cela qu\'une taxe de reconversion de 5% est appliqu&eacute;e. Le but recherch&eacute; est au contraire d\'<strong>agrandir le r&eacute;seau des prestataires afin que le Ropi puisse circuler de prestataires en prestataires</strong> sans jamais rester bloqu&eacute; chez un prestataire qui ne touverait pas de fili&egrave;re d\'approvisionnement locale.</p>
<p>&nbsp;</p>
<h2><strong>En conclusion</strong></h2>
<p>Ce sont des <strong>consommateurs</strong>, engag&eacute;s pour le devenir de leur cit&eacute;, qui <strong>injectent des Ropi dans l\'&eacute;conomie locale</strong>, en achetant des Ropi et <strong>en s\'approvisionnant chez les prestataires locaux</strong> qui acceptent les Ropi.</p>
<p>Ce sont des <strong>prestataires</strong>, engag&eacute;s pour le devenir de leur cit&eacute;, qui acceptent les Ropi, et font la d&eacute;marche de s\'approvisioner dans l\'&eacute;conomie locale, voir de <strong>trouver de nouvelles fili&egrave;res d\'approvisonnement</strong>.</p>
<p><strong>Ce sont les consommateurs ET les prestataires, qui ENSEMBLE, avec l\'aide du Ropi comme vecteur d\'&eacute;change, contribuent ainsi &agrave; relocaliser et circulariser l\'&eacute;conomie.</strong></p>
<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"../../../../../source/component_circulation.png\" alt=\"\" width=\"400\" /></p>
<p style=\"text-align: center;\">Le fonctionnement du Ropi est d&eacute;taill&eacute; dans le <a href=\"../../../../../source/RopiROI.pdf\">R&egrave;glement d\'Ordre d\'Int&eacute;rieur</a>.</p>
<p>&nbsp;</p>"),
            array(2, "Adhérer à l'asbl", 1, new DateTime("2015-05-28T17:30:53+02:00"), new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_2"), "<h1>Adh&eacute;rer &agrave; l\'asbl</h1>
<h2>Les membres, pour une gouvernance d&eacute;mocratique</h2>
<p>L\'asbl Ropi tend &agrave; appliquer une gouvernance la plus d&eacute;mocratique possible via son Assembl&eacute;e G&eacute;n&eacute;rale (AG) des citoyens et par des outils de d&eacute;mocratie directe et participative qui seront progressivement mis en place (ex: sondage via internet).</p>
<p>En effet, nous consid&eacute;rons que la monnaie devrait &ecirc;tre un outil au service du citoyen, et non l\'inverse comme c\'est le cas avec les monnaies dominantes (l\'euro chez nous). Cet outil ne pourra v&eacute;ritablement assumer son r&ocirc;le de servitude que si le plus grand nombre de citoyens participe &agrave; sa politique dans le sens le plus noble du terme.</p>
<h3>Les deux types de membre de l\'asbl Ropi</h3>
<ul>
<li>les <strong>membres effectifs</strong>, qui s&rsquo;engagent &agrave; respecter les statuts et la charte de l&rsquo;association et le cas &eacute;ch&eacute;ant le r&egrave;glement d&rsquo;ordre int&eacute;rieur. Ils s\'engagent &eacute;galement &agrave; payer leur cotisation.</li>
<li>les <strong>membres sympathisants</strong>, qui, sans se faire membre de l&rsquo;association, d&eacute;sirent marquer leur encouragement &agrave; la d&eacute;marche.</li>
</ul>
<p>&nbsp;</p>
<h3>Les <strong>membres effectifs</strong> se r&eacute;partissent en trois coll&egrave;ges</h3>
<ul>
<li>le coll&egrave;ge des <strong>prestataires</strong>&nbsp; <img src=\"../../../../../source/component_commercant.png\" alt=\"\" width=\"50\" height=\"50\" /><img src=\"../../../../../source/component_producteur.png\" alt=\"\" width=\"50\" height=\"50\" /><br />(commerces, producteurs, tout prestataire de biens et services en g&eacute;n&eacute;ral)<br /><br /></li>
<li>le coll&egrave;ge des <strong>usagers individuels&nbsp; </strong><img src=\"../../../../../source/component_citoyen.png\" alt=\"\" width=\"50\" height=\"50\" /><br /><br /></li>
<li>le coll&egrave;ge des <strong>associations et institutions</strong>&nbsp; <img src=\"../../../../../source/component_associations.png\" alt=\"\" width=\"50\" height=\"50\" /><br /><br /></li>
</ul>
<h2><strong>Avantages des membres effectifs<br /></strong></h2>
<p>La premi&egrave;re raison d\'adh&eacute;rer &agrave; l\'asbl est de disposer du droit de vote &agrave; l\'AG et ainsi d\'influencer le devenir du Ropi. Nous visons un syst&egrave;me de gouvernance le plus d&eacute;mocratique possible o&ugrave; chaque coll&egrave;ge dispose d\'un tiers du droit de vote &agrave; l\'AG. <strong>Faites entendre votre voix!</strong></p>
<p>Si vous &ecirc;tes un <strong>prestataire</strong> ou une <strong>association</strong>, l\'adh&eacute;sion vous permettra</p>
<ul>
<ul>
<li>de r&eacute;&eacute;changer vos Ropi contre des Euro (avec taxe de 5%). Certains prestataires &agrave; but non lucratif peuvent b&eacute;n&eacute;ficier d\'un taux de reconversion de 0% s\'ils en font la demande &agrave; l\'asbl et sur approbation de l\'AG.</li>
<li>de b&eacute;n&eacute;ficier d\'une visibilit&eacute; sur la page d\'accueil du Ropi (bandeau d\'affichage du logo et page de pr&eacute;sentation)</li>
<li>d\'&ecirc;tre r&eacute;f&eacute;renc&eacute; dans l\'annuaire du Ropi permettant une recherche par activit&eacute;, produits, localisation, ...</li>
<li>de b&eacute;n&eacute;ficier des &eacute;ventuels b&eacute;n&eacute;fices de l\'asbl Ropi, affect&eacute;s &agrave; des pr&ecirc;ts &agrave; 0% ou &agrave; des subsides aux membres prestataires ou associatifs qui en font la demande et sur approbation de l\'AG.</li>
</ul>
</ul>
<h2>Comment adh&eacute;rer?</h2>
<p>Pour devenir membre, enregistrez-vous via le&nbsp;<a href=\"../../../../../source/FormulaireAdhesion.php\">formulaire en ligne</a> ou en nous envoyant un email &agrave;&nbsp;<a href=\"mailto:info@ropi.be\">info@ropi.be</a>.</p>
<p>Vous pouvez &eacute;galement vous rendre &agrave; un comptoir de change et y compl&eacute;ter un formulaire d\'inscription papier. Nous vous contacterons ensuite par couriel ou par la poste.</p>
<p>Vous serez ensuite invit&eacute; &agrave; r&eacute;gler votre cotisation de 20 Euro (BEXX XXXX XXXX XXXX) ou de 15 Ropi (si inscription via un commer&ccedil;ant ou lors d\'&eacute;v&eacute;nements promotionnels, ou encore par votre compte Ropi en ligne, d&egrave;s que la version &eacute;lectronique sera pr&ecirc;te).</p>
<p>&nbsp;</p>"),
            array(1, "Visuels", 1, new DateTime("2015-05-27T21:50:09+02:00"), new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_4"), "<h1>Les visuels de communication</h1>
<p>Sur cette page, vous trouverez tous nos visuels de communication (logo, d&eacute;pliant, autocollants, ...) que vous pouvez utiliser pour faire la promotion du Ropi.</p>
<p>Vous pouvez les imprimez vous m&ecirc;me ou les commandez les via le <a href=\"../../../../../source/FormulaireVisuel.php\">formulaire de commande des visuels</a>.</p>
<p>&nbsp;</p>
<h2>Les logo Ropi</h2>
<p>&nbsp;</p>
<p><img src=\"../../../../../source/ROPI_Logo-1l.png\" alt=\"Logo Ropi &quot;R&quot;\" width=\"100\" height=\"100\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <img src=\"../../../../../source/ROPI_Logo_4l.png\" alt=\"Logo Ropi &quot;ROPI&quot;\" width=\"200\" height=\"80\" /></p>
<p>&nbsp;</p>
<h2>Le d&eacute;pliant (triptyque)</h2>
<p>&nbsp;</p>
<p>&nbsp;<img src=\"../../../../../source/ROPI_Depliant_recto.jpg\" alt=\"D&eacute;pliant triptyque Ropi recto\" width=\"300\" /></p>
<p><img src=\"../../../../../source/ROPI_Depliant_verso.jpg\" alt=\"D&eacute;pliant triptyque Ropi verso\" width=\"300\" /></p>
<p><a title=\"D&eacute;plian Ropi tryptique\" href=\"../../../../../source/ROPI_Depliant.pdf\">[T&eacute;l&eacute;chargement pdf]</a></p>
<p>&nbsp;</p>
<h2>L\'autocollant &agrave; apposer en vitrine</h2>
<p>&nbsp;<img src=\"../../../../../source/autocollant.png\" alt=\"Autocollant - accepte le Ropi\" width=\"200\" /></p>
<p><a href=\"../../../../../source/autocollant.png\">[T&eacute;l&eacute;chargement pdf]</a></p>
<p>&nbsp;</p>
<h2>Les cartes de visites</h2>
<p>&nbsp;Vous voulez <a href=\"../../../../../pages/aider.php\">devenir ambassadeur du Ropi</a>?</p>
<p><img src=\"../../../../../source/Carte_visite_ROPI_specimen_recto.png\" alt=\"Carte de visite recto\" width=\"200\" /></p>
<p>&nbsp;</p>
<p><img src=\"../../../../../source/Carte_visite_ROPI_specimen_verso.png\" alt=\"Carte de visite verso\" width=\"200\" /></p>
<p>A commander sur mesure via le <a href=\"../../../../../source/FormulaireCommandeCom.php\">formulaire de commande</a>.</p>
<p>&nbsp;</p>
<p>Retrouvez la gallerie compl&egrave;te des visuels sous ce <a href=\"https://www.behance.net/gallery/26077637/ROPI-Monnaie-alternative-de-la-ville-de-Mons\">lien</a>.</p>"),
            
            array(2, "Documents fondateurs", 1, new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_4"), "<h1>Les documents fondateurs</h1>
<h2>Statuts</h2>
<p>L\'association a pour objet, en dehors de tout but de lucre</p>
<ul>
<li>de promouvoir des activit&eacute;s visant &agrave; am&eacute;liorer l\'autonomie &eacute;conomique locale, et ce particuli&egrave;rement en assurant la cr&eacute;ation, la promotion et la gestion d\'une monnaie locale compl&eacute;mentaire &agrave; l\'euro: le Ropi. Cette monnaie circulera entre les citoyens, des artisans, des agriculteurs, des entreprises, des commerces, des associations, institutions souhaitant retrouver la ma&icirc;trise de l\'usage local des moyens d\'&eacute;change.</li>
<li>d\'informer les citoyens sur les fondements et r&eacute;alit&eacute;s du syst&egrave;me mon&eacute;taire et &eacute;conomique en cours dans notre soci&eacute;t&eacute;, et des injustices qui en d&eacute;coulent.</li>
<li>d\'agir en tant que groupe local du R&eacute;seau Financit&eacute;, afin de promouvoir une finance responsable et solidaire et de favoriser un autre rapport &agrave; l\'argent.</li>
</ul>
<p>D&eacute;couvrez les&nbsp;<a href=\"http://www.ejustice.just.fgov.be/cgi_tsv/tsv_rech.pl?language=fr&amp;amp;btw=0506894878&amp;amp;liste\">statuts complets de l\'ASBL Ropi au moniteur</a>.</p>
<h2>&nbsp;</h2>
<h2>La Charte</h2>
<p>Emanant d\'actions men&eacute;es par des citoyens montois pour la promotion d\'une &eacute;conomie socialement et environnementalement soutenable, le projet vise &agrave; mettre en place une <strong>monnaie compl&eacute;mentaire &agrave; l\'euro</strong> dans la<strong> r&eacute;gion de Mons-Borinage</strong>.</p>
<h3>Un triple objectif</h3>
<ul>
<li>Relocaliser l\'&eacute;conomie afin de se pr&eacute;parer aux d&eacute;fis environnementaux et &agrave; la fin du pr&eacute;trole bon march&eacute; (pic p&eacute;trolier).</li>
<li>remettre le citoyen au coeur des d&eacute;bats et prises de d&eacute;cisions, notamment &agrave; propos des questions financi&egrave;res, mon&eacute;taires et des processus de production.</li>
<li>proposer une alternative &agrave; la monnaie dominante bas&eacute;e sur les revenus du capital et g&eacute;n&eacute;ratrice d\'in&eacute;galit&eacute;s sociales.</li>
</ul>
<p>La monnaie compl&eacute;mentaire mise en place - le Ropi - entend r&eacute;aliser ces objectifs par le soutien qu\'elle apporte aux <strong>petites structures </strong>et <strong>commerces de proximit&eacute;</strong>, face &agrave; la grande distribution, les multinationales, et les franchises.</p>
<h3>Engagement</h3>
<p>En tant que prestataire de biens de services (distributeurs, fournisseurs, transformateurs ou producteurs), nous adh&eacute;rons par cette charte au projet Ropi mis en place par l\'asbl Ropi.</p>
<p>Nous nous engageons &agrave; <strong>promouvoir le Ropi</strong> et les <strong>valeurs &eacute;thiques</strong> qu\'il sous-tend</p>
<ul>
<li>en acceptant le Ropi comme moyen de paiement.</li>
<li>en sensibilisant les citoyens &agrave; ce nouveau moyen d\'&eacute;change porteur de valeurs.</li>
</ul>
<p>[<a href=\"../../../../../source/RopiCharte.pdf\">T&eacute;l&eacute;chargement pdf</a>]</p>
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
            array(5, "Les billets", 1, new DateTime("2015-05-27T23:51:28+02:00"), new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_2"), "<h1>Pr&eacute;sentation des billets</h1>
<h2>L\'&eacute;dition 2015</h2>
<p>En 2015, le Ropi se dote de nouveaux billets reprenant des monuments montois charg&eacute;s d\'histoire.</p>
<p>Ces billets peuvent-&ecirc;tre command&eacute;s en ligne via ce&nbsp;<a href=\"../../../../../page/ForumulaireCommandeRopi.php\">formulaire</a> ou chez les commer&ccedil;ants membres (sous r&eacute;serve de disponibilit&eacute;).</p>
<p>&nbsp;</p>
<p><img src=\"../../../../../source/billets2015.jpg\" alt=\"Les quatre nouveaux billets de 2015\" width=\"400\" height=\"435\" /></p>
<p>&nbsp;</p>
<h2>L\'&eacute;dition 2011</h2>
<p>Cette &eacute;dition a &eacute;t&eacute; tir&eacute;e lors de la cr&eacute;ation du projet Ropi. Les &eacute;l&eacute;ments grapiques ont &eacute;t&eacute; d&eacute;termin&eacute;s sur base d\'un concours de dessin au sein de l\'&eacute;cole Le Nursing. Ces billets sont toujours valides aujourd\'hui mais ne sont plus mis en vente. Ils seront progressivement retir&eacute;s de la circulation.</p>
<p><img src=\"../../../../../source/billets2011.jpg\" alt=\"Billets 2011\" width=\"300\" height=\"296\" /></p>
<p>&nbsp;</p>"),
            array(6, "La monnaie électronique", 1, new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_2"), "<h1>La monnaie &eacute;lectronique</h1>
<p>Une version &eacute;lectronique du Ropi sera bient&ocirc;t disponible, en plus de la version papier.</p>
<p>Chaque membre de l\'asbl disposera d\'un (ou plusieurs) compte virtuel accessible par internet (Ropi banking). Ce compte pourra &ecirc;tre cr&eacute;dit&eacute; en Ropi par virement bancaire en Euro. Des op&eacute;rations de transfert entre les comptes pourront &ecirc;tre effectu&eacute;es par internet mais &eacute;galement par SMS sans aucun co&ucirc;t pour l\'utilisateur. Ce syst&egrave;me permettra notamment de faire des paiements chez le commer&ccedil;ants.</p>
<p>&nbsp;</p>"),
            array(4, "Nous aider", 1, new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_2"), "<h1>Comment nous aider?</h1>
<h2>Devenir b&eacute;n&eacute;vole</h2>
<p><br /> Une organisation comme le Ropi ne peut fonctionner sans ses nombreux b&eacute;n&eacute;voles, qui constituent la cheville ouvri&egrave;re de l\'asbl.</p>
<p>Il existe de nombreux postes &agrave; renforcer ou &agrave; pourvoir au sein de l\'asbl Ropi, notamment:</p>
<ul>
<li>des ambassadeurs pour le d&eacute;marchage de commer&ccedil;ants, la communication aux citoyens ou aux media,</li>
<li>des transporteurs pour la livraison des Ropi aux comptoirs de change ou &agrave; domicile,</li>
<li>des administrateurs de l\'asbl,&nbsp;</li>
<li>des d&eacute;veloppeurs pour le site web et la monnaie &eacute;lectronique,</li>
<li>des infographistes et web designers,</li>
<li>des r&eacute;dacteurs pour la mise &agrave; jour du contenu du site web (blog, agenda, point presse) et des outils de communications en g&eacute;n&eacute;ral,</li>
<li>des comptables (professionalisation de la comptabilit&eacute; et contr&ocirc;les),</li>
<li>des juristes (mise &agrave; jour des statuts, communication avec la banque nationale de belgique, FSMA, ...),</li>
<li>des organisateurs d\'&eacute;v&eacute;nements (f&ecirc;tes, projection cin&eacute;ma, conf&eacute;rence, ...),</li>
<li>...</li>
</ul>
<p><br /> Pour nous proposer votre aide, inscrivez-vous via le&nbsp;<a href=\"../../../../../page/FormulaireAide\">formulaire en ligne</a> ou via <a href=\"mailto:info@ropi.be\">info@ropi.be</a><br /> <br /> Nous invitons &eacute;galement tous les b&eacute;n&eacute;voles &agrave; <a href=\"../../../../../page/adherer.php\">devenir membre de l\'asbl</a>.</p>
<h2><br /> Devenir membre de l\'asbl</h2>
<p><br /> Les membres, de par leur apports (avis, id&eacute;es, propositions, critiques, votes, ...) &agrave; l\'Assembl&eacute;e G&eacute;n&eacute;rale ou leur participation aux ateliers pratiques (r&eacute;unions de travail, brainstorming, ...) sont indsipensables &agrave; la vie de l\'asbl. De plus, par leurs contributions financi&egrave;res via les cotisations, les membres assurent la p&eacute;rennit&eacute; de l\'asbl (<a href=\"../../../../../page/adherer\">devenir membre</a>).</p>"),
            array(3, "Documents opérationnels", 1, new DateTime("2015-05-28T00:05:09+02:00"), new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_4"), "<h1>Documents op&eacute;rationnels</h1>
<h2>R&eacute;glement d\'ordre int&eacute;rieur (ROI)</h2>
<p>Le r&eacute;glement d\'ordre int&eacute;rieur est le document de r&eacute;f&eacute;rence d&eacute;crivant les r&egrave;gles de fonctionnement du Ropi.</p>
<p>[<a href=\"../../../../../source/RopiROI.pdf\">T&eacute;l&eacute;chargement pdf</a>]</p>
<h2>Compte rendus des r&eacute;unions (CA et AG)</h2>
<p>L\'asbl souhaite offrir un maximum de transparence sur ses activit&eacute;s. C\'est pourquoi les comptes rendus des r&eacute;unions du Conseil d\'Administration et de l\'Assembl&eacute;e G&eacute;n&eacute;rale sont publics.</p>
<p>[Consulter les comptes rendus]</p>
<h2>Comptabilit&eacute;</h2>
<p>[Consultez les comptes annuels et les budgets pr&eacute;visionnels]</p>")
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
