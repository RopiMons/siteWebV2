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
        array(2, "La charte", true, new \DateTime("2015-05-26 13:23:20"), new \DateTime("2015-05-26 13:23:20"), new \DateTime("2015-01-01 00:00:00"), $this->getReference("CAT_2"), "<h1>La Charte</h1>
<p>Emanant d'actions men&eacute;es par des citoyens montois pour la promotion d'une &eacute;conomie socialement et environnementalement soutenable, le projet vise &agrave; mettre en place une <strong>monnaie compl&eacute;mentaire &agrave; l'euro</strong> dans la<strong> r&eacute;gion de Mons-Borinage</strong>.</p>
<h2>Un triple objectif</h2>
<ul>
<li>Relocaliser l'&eacute;conomie afin de se pr&eacute;parer aux d&eacute;fis environnementaux et &agrave; la fin du pr&eacute;trole bon march&eacute; (pic p&eacute;trolier).</li>
<li>remettre le citoyen au coeur des d&eacute;bats et prises de d&eacute;cisions, notamment &agrave; propos des questions financi&egrave;res, mon&eacute;taires et des processus de production.</li>
<li>proposer une alternative &agrave; la monnaie dominante bas&eacute;e sur les revenus du capital et g&eacute;n&eacute;ratrice d'in&eacute;galit&eacute;s sociales.</li>
</ul>
<p>La monnaie compl&eacute;mentaire mise en place - le Ropi - entend r&eacute;aliser ces objectifs par le soutien qu'elle apporte aux <strong>petites structures </strong>et <strong>commerces de proximit&eacute;</strong>, face &agrave; la grande distribution, les multinationales, et les franchises.</p>
<h2>Engagement</h2>
<p>En tant que prestataire de biens de services (distributeurs, fournisseurs, transformateurs ou producteurs), nous adh&eacute;rons par cette charte au projet Ropi mis en place par l'asbl Ropi.</p>
<p>Nous nous engageons &agrave; <strong>promouvoir le Ropi</strong> et les <strong>valeurs &eacute;thiques</strong> qu'il sous-tend</p>
<ul>
<li>en acceptant le Ropi comme moyen de paiement.</li>
<li>en sensibilisant les citoyens &agrave; ce nouveau moyen d'&eacute;change porteur de valeurs.</li>
</ul>
<h2>Document</h2>
<p>T&eacute;l&eacute;chargez la charte au format pdf --&gt; charte_ropi.pdf</p>"),
        array(1, "Accueil", true, new \DateTime("2015-05-26 12:48:27"), new \DateTime("2015-05-26 12:48:27"), new \DateTime("2015-01-01 00:00:00"), $this->getReference("CAT_1"), "<p>&nbsp;</p>
<h1>todo ajouter image Ropi clickable avec le texe suivant:</h1>
<p><strong>Fonds de garantie</strong>: \"Les Euro sont & eacute;
        pargn & eacute;
        s sur un compte dans une banque & eacute;
        thique. Les Ropi peuvent donc & ecirc;
        tre reconvertis en euro & agrave;
        tout instant. Le fonds de garantie, plac & eacute;
        dans une banque & eacute;
        thique, peut & agrave;
        son tour financer l'&eacute;conomie locale. La monnaie sert donc doublement\"</p>
<p><strong>Compoir de change:</strong> \"Je commande mes Ropi directement en ligne et me les fais livrer dans un des comptoir de change ou &agrave; domicile via le coursier montois (lien Le Ropi/en pratique). Tous les commer&ccedil;ants (comptoirs et autres) peuvent aussi vous vendre des Ropi (1 Ropi = 1 Euro). Le tout est g&eacute;r&eacute; par l&rsquo;asbl Ropi, soutenue par Financit&eacute;, et compos&eacute;e d&rsquo;une &eacute;quipe de citoyens b&eacute;n&eacute;voles issus de tous azimut, qui veulent apporter leur pierre &agrave; l' & eacute;
        difice de la transition vers une & eacute;
        conomie soutenable.\"</p>
<p><strong>Commer&ccedil;ants et </strong><strong><strong>Producteurs locaux</strong>:</strong> \"Je suis un commer & ccedil;
        ant ou un producteur local: j'accepte les Ropi pour le paiement de produits et services, m&ecirc;me si ceux-ci ne sont pas directement produits dans l&rsquo;&eacute;conomie locale, et je b&eacute;n&eacute;ficie des avantages d&rsquo;un r&eacute;seau.<br />J'utilise mes Ropi pour payer mes producteurs (locaux uniquement), ou pour mes d & eacute;
        penses personnelles. Je contribue ainsi & agrave;
        la relocalisation de l&rsquo;
        &eacute;
        conomie car le Ropi n & rsquo;
        est pas accept&eacute;
        &agrave;
        l & rsquo;
        ext & eacute;
        rieur de la r & eacute;
        gion ni dans les grandes enseignes.<br />Si je le souhaite je peux toujours convertir mes Ropi exc & eacute;
        dentaires (ceux que je n & rsquo;
        arrive pas &agrave;
        &eacute;
        couler dans l&rsquo;
        &eacute;
        conomie locale) contre des euro en m & rsquo;
        acquittant d & rsquo;
        une taxe de 5%. Je peux & eacute;
        galement les revendre aux citoyens qui souhaitent s'en procurer.</p>
<p>Et en plus, Il n'y a aucune diff&eacute;rence comptable par rapport & agrave;
        l'Euro, pas besoin de double comptabilit&eacute;!</p>
<p><strong>Citoyens:</strong> \"Je suis un citoyen: je souhaite soutenir l&rsquo;&eacute;conomie locale. Je me rends dans un comptoir de change et je ressors avec mes Ropi. J'ach & egrave;
        te des produits et services en Ropi chez des commer & ccedil;
        ants ou producteurs locaux\"</p>
<p><strong>Fl&egrave;che circulaire centrale / banques / autres producteurs: </strong>Le Ropi engendre une boucle vertueuse de la relocalisation de l'&eacute;conomie car il n&rsquo;est pas accept&eacute; &agrave; l&rsquo;ext&eacute;rieur de la r&eacute;gion ni dans les grandes enseignes. </p>
<p><strong>1R = 1&euro;:&nbsp; </strong>Le ropi est une monnaie compl&eacute;mentaire &agrave; l'euro en parit&eacute; avec celle-ci. Les citoyens, mais aussi les commer&ccedil;ants, l&rsquo;utilisent pour s&rsquo;approvisionner en marchandises exclusivement chez les producteurs et artisans locaux. De plus, le Ropi circule plus rapidement que l'Euro car il n'a pas vocation &agrave; &ecirc;tre th&eacute;sauris&eacute;. Cette circulation locale engendre une spirale positive de relocalisation de l&rsquo;&eacute;conomie.</p>
<p><strong>Retrouvez toutes les info d'utilisation du Ropi sur LIEN--&gt;Le Ropi, en pratique</strong></p>
<p>&nbsp;</p>
<h1><strong>Les derni&egrave;res nouvelles</strong></h1>
<p>todo: blog</p>"),
        array(1, "En pratique", true, new \DateTime("2015-05-26 12:00:56"), new \DateTime("2015-05-26 12:00:56"), new \DateTime("2015-01-01 00:00:00"), $this->getReference("CAT_2"), "<h1>Le Ropi, la monnaie compl&eacute;mentaire de Mons et ses environs</h1>
<p><br /><strong>Le Ropi ne remplace pas l'Euro, il le compl&eacute;mente! </strong></p>
<p>Il circule en parall&egrave;le &agrave; l'euro, et par facilit&eacute;, il partage la m&ecirc;me &eacute;chelle de valeur, &agrave; savoir <strong>1 Ropi = 1 Euro</strong>.</p>
<p><strong>Mais alors pourquoi passer par le Ropi?</strong></p>
<p>Sa sp&eacute;cificit&eacute; par rapport &agrave; l'Euro est d'avoir court au sein d'une r&eacute;gion limit&eacute;e, Mons-Borinage, et par cons&eacute;quent de favoriser l'&eacute;conomie locale et les circuits de distribution courts (voir les objectifs de l'abl Ropi).<br /><br /><strong>Pour mieux comprendre son utilit&eacute;, suivons le chemin d'un Ropi</strong></p>
<p>Un citoyen consom'acteur d&eacute;cide d'&eacute;changer des Ropi contre des Euro et se rend pour ce faire dans un comptoir de change, ou en commande via internet (voir les diff&eacute;rents fa&ccedil;ons de se procurer des Ropi).<br />Il re&ccedil;oit, par exemple, 20 Ropi contre 20 Euro, qu'il peut aller d&eacute;penser chez les prestataires acceptant le Ropi- commercants, artisants, agriculteurs, prestataires de services, ... (voir la carte des prestataires).<br /><br /><strong>Les prestataires se retrouvent alors avec des Ropi. Deux choix souvrent &agrave; eux</strong></p>
<ul>
<li>r&eacute;&eacute;changer les Ropi contre des Euro, en s'acquittant d'une taxe de 5% (sur demande &agrave; l'asbl Ropi, pour les membres prestataires uniquement). Vous l'aurez compris, ce n'est pas du tout le but poursuivi de reconvertir ses Ropi en Euro, et c'est pour cela qu'une taxe de reconversion de 5% est appliqu&eacute;e, afin de d&eacute;courager &agrave; la reconversion.</li>
<li>ou bien, et c'est bien l&agrave; le but recherch&eacute;, poursuivre la spirale vertueuse en trouvant d'autres prestataires et producteurs locaux qui acceptent le Ropi.</li>
</ul>
<p><strong>Le prestatiare est donc encourag&eacute; &agrave; trouver de nouvelles fili&egrave;res d'approvisonnement dans l'&eacute;conomie locale. </strong></p>
<p><strong>Il contribue ainsi &agrave; relocaliser et circulariser l'&eacute;conomie.</strong></p>"),
            array(4, "Adhérer à l'asbl", 1, new DateTime("2015-05-26T15:09:44+02:00"), new DateTime("2015-05-26T15:07:02+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_2"), "<h1>Adh&eacute;rer &agrave; l'asbl</h1>
<h2>Les membres, pour une gouvernance d&eacute;mocratique en Assembl&eacute; G&eacute;n&eacute;rale</h2>
<p>L'asbl Ropi tend &agrave; appliquer une gouvernance la plus d&eacute;mocratique possible via son Assembl&eacute;e G&eacute;n&eacute;rale (AG) des citoyens et par des outils de d&eacute;mocratie directe et participative qui seront mis progressivement en place (ex: sondage via internet).</p>
<p>En effet, nous consid&eacute;rons que la monnaie devrait &ecirc;tre un outil au service du citoyen, et non l'inverse comme c'est le cas avec les monnaies dominantes (l'euro chez nous). Cet outil ne pourra v&eacute;ritablement assumer son r&ocirc;le de servitude que si le plus grand nombre de citoyens participe &agrave; sa politique dans le sens le plus noble du terme.</p>
<p>Pour devenir membre, enregistrez-vous via le formulaire en ligne TODO LIEN FORMULAIRE EN LIGNE ou en nous envoyant un email &agrave; info@ropi.be.</p>
<p>Votre seule obligation est d'&ecirc;tre en ordre de cotisation (15 Ropi &agrave; verser via votre compte &eacute;lectronique Ropi ou 20 Euro &agrave; verser sur le compte BEXX XXXX XXXX XXXX).</p>
<p><strong>Faites entendre votre voix!</strong></p>
<h2>Les b&eacute;n&eacute;voles, pour une gestion journali&egrave;re</h2>
<p>Si la d&eacute;mocratie passe par la voix de ses membres lors de l'Assembl&eacute;e G&eacute;n&eacute;rale, l'asbl ne pourrait remplir ses fonctions journali&egrave;res sans l'aide de ses b&eacute;n&eacute;voles, v&eacute;ritables chevilles ouvri&egrave;re de l'organisation. De nombreuses fonctions sont &agrave; pourvoir! Consulter la page Comment nous aider? pour en savoir plus.</p>"),
            
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
            
            array(1, "Documents fondateurs", 1, new DateTime("2015-05-26T16:18:47+02:00"), new DateTime("2015-05-26T16:18:47+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_4"), "<h1>Les documents fondateurs</h1>
<h2>Statuts</h2>
<p>L'association a pour objet, en dehors de tout but de lucre</p>
<ul>
<li>de promouvoir des activit&eacute;s visant &agrave; am&eacute;liorer l'autonomie &eacute;conomique locale, et ce particuli&egrave;rement en assurant la cr&eacute;ation, la promotion et la gestion d'une monnaie locale compl&eacute;mentaire &agrave; l'euro : le Ropi. Cette monnaie circulera entre les citoyens, des artisans, des agriculteurs, des entreprises, des commerces, des associations, institutions souhaitant retrouver la ma&icirc;trise de l'usage local des moyens d'&eacute;change.</li>
<li>d'informer les citoyens sur les fondements et r&eacute;alit&eacute;s du syst&egrave;me mon&eacute;taire et &eacute;conomique en cours dans notre soci&eacute;t&eacute;, et des injustices qui en d&eacute;coulent.</li>
<li>d'agir en tant que groupe local du R&eacute;seau Financit&eacute;, afin de promouvoir une finance responsable et solidaire et de favoriser un autre rapport &agrave; l'argent.</li>
</ul>
<p>D&eacute;couvrez les statuts complets de l'ASBL Ropi au &lt;a href=\"http://www.ejustice.just.fgov.be/cgi_tsv/tsv_rech.pl?language=fr&amp;amp;btw=0506894878&amp;amp;liste=Liste\"&gt;moniteur&lt;/a&gt; et les membres du Conseil d'Administration --&gt; lien ver Ropi/L'&eacute;quipe</p>
<p>&nbsp;</p>
<h2>Charte</h2>
<p>&nbsp;</p>
<p>&nbsp;</p>")
            
            
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
