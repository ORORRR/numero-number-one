import cucumber.api.PendingException;
import cucumber.api.java.fr.Alors;
import cucumber.api.java.fr.Et;
import cucumber.api.java.fr.Quand;
import org.openqa.selenium.By;
import org.openqa.selenium.NoSuchElementException;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.JavascriptExecutor;

import java.io.*;
import java.net.URL;
import java.util.List;
import java.util.Optional;

import static org.hamcrest.core.Is.is;
import static org.junit.Assert.assertThat;

public class OeuvreFixture {
    @Quand("^l'utilisateur renseigne la chaine de caractère \"([^\"]*)\"$")
    public void lUtilisateurRenseigneLaChaineDeCaractère(String arg0) throws Throwable {
        WebSite.getDriver().findElement(By.id("form_Barre")).sendKeys(arg0);
        WebSite.getDriver().findElement(By.id("form_Rechercher")).click();
    }

    @Quand("^l'utilisateur écrit un commentaire \"([^\"]*)\"$")
    public void lUtilisateurÉcritUnCommentaire(String arg0) throws Throwable {
        WebSite.getDriver().findElement(By.id("input-comment")).sendKeys(arg0);
    }

    @Alors("^l'oeuvre correspondant au nom \"([^\"]*)\" est affichée$")
    public void lOeuvreCorrespondantAuNomEstAffichée(String arg0) throws Throwable {
        List<WebElement> l = WebSite.getDriver().findElements(By.className("list-group-item"));
        assert l.stream().map(f -> f.findElement(By.tagName("h4"))).anyMatch(t -> t.getText().equals(arg0));
    }

    @Quand("^l'utilisateur clique sur l'oeuvre \"([^\"]*)\" dans la liste recherchée$")
    public void lUtilisateurCliqueSurLOeuvreDansLaListeRecherchée(String arg0) throws Throwable {
        List<WebElement> l = WebSite.getDriver().findElements(By.className("list-group-item"));
        l.stream().map(f -> f.findElement(By.tagName("h4"))).filter(t-> t.getText().equals(arg0)).findFirst().ifPresent(WebElement::click);
    }

    @Alors("^l'utilisateur est sur la page de l'oeuvre \"([^\"]*)\"$")
    public void lUtilisateurEstSurLaPageDeLOeuvre(String arg0) throws Throwable {
        assert WebSite.getDriver().findElement(By.id("titre_oeuvre")).getText().equals(arg0);
    }

    @Alors("^l'utilisateur vas à la page de l'oeuvre \"([^\"]*)\"$")
    public void lUtilisateurVasALaPageDeLOeuvre(String arg0) throws Throwable {
        lUtilisateurRenseigneLaChaineDeCaractère(arg0);
        lUtilisateurCliqueSurLOeuvreDansLaListeRecherchée(arg0);
        lUtilisateurEstSurLaPageDeLOeuvre(arg0);
    }


    @Et("^l'utilisateur valide la publication du commentaire$")
    public void lUtilisateurValideLaPublicationDuCommentaire() {
        WebSite.getDriver().findElement(By.id("btn-send-comment")).click();
    }

    @Et("^le commentaire \"([^\"]*)\" apparait sur la page de l'oeuvre \"([^\"]*)\"$")
    public void leCommentaireApparaitSurLaPageDeLOeuvre(String arg0, String arg1) throws Throwable {
        List<WebElement> l = WebSite.getDriver().findElements(By.className("commentaire"));
        assert l.stream().map(WebElement::getText).anyMatch(t -> t.contains(arg0));
    }

    @Alors("^le lien d'accès à la page d'ajout d'oeuvre est visible$")
    public void leLienDAccesALaPageDesClassementsEstVisible() {
        List<WebElement> elements = WebSite.getDriver().findElements(By.id("go-to-ajout-oeuvre-btn"));
        assert(elements.size() > 0);
    }

    @Alors("^le lien d'accès à la page d'ajout d'oeuvre n'est pas visible$")
    public void leLienDAccesALaPageDesClassementsEstPasVisible() {
        assert  WebSite.getDriver().findElements(By.id("go-to-ajout-oeuvre-btn")).isEmpty();
    }

    @Quand("^l'utilisateur clique sur le bouton correspondant à l'ajout d'une oeuvre$")
    public void lUtilisateurCliqueSurBoutonCorrespondantÀLAjoutDUneOeuvre() {
        WebSite.getDriver().findElement(By.id("go-to-ajout-oeuvre-btn")).click();
    }

    @Alors("^l'utilisateur est redirigé vers le formulaire d'ajout$")
    public void lUtilisateurEstRedirigéVersLeFormulaireDAjout() throws InterruptedException {
        assert WebSite.getDriver().getCurrentUrl().endsWith("ajout-oeuvre");
    }

    @Quand("^l'utilisateur saisit le titre \"([^\"]*)\"$")
    public void lUtilisateurSaisitLeTitre(String arg0) throws Throwable {
        rewrite(WebSite.getDriver().findElement(By.id("oeuvre_nom")),arg0);
    }


    @Et("^le descriptif \"([^\"]*)\"$")
    public void leDescriptif(String arg0) throws Throwable {
        rewrite(WebSite.getDriver().findElement(By.id("oeuvre_descriptif")),(arg0));
    }

    @Et("^la catégorie \"([^\"]*)\"$")
    public void laCatégorie(String arg0) throws Throwable {
        List<WebElement> l = WebSite.getDriver().findElement(By.id("oeuvre_categorie")).findElements(By.tagName("option"));
        l.stream().filter(t -> t.getText().equals(arg0)).findFirst().ifPresent(WebElement::click);
    }

    @Et("^l'auteur \"([^\"]*)\"$")
    public void lAuteur(String arg0) throws Throwable {
        rewrite(WebSite.getDriver().findElement(By.id("oeuvre_auteurs")),(arg0));
    }

    @Et("^la date \"([^\"]*)\"$")
    public void laDate(String arg0) throws Throwable {
       rewrite( WebSite.getDriver().findElement(By.id("oeuvre_datePublication")),(arg0));
    }

    @Et("^l'utilisateur appuie sur le bouton de validation de l'ajout$")
    public void lUtilisateurAppuieSurLeBoutonDeValidationDeLAjout() {
        WebSite.getDriver().findElement(By.id("oeuvre_save")).click();
    }

    @Alors("^un message de validation s'affiche$")
    public void unMessageDeValidationSAffiche() {
        assert true;
        //TODO Vérifier ce qu'il se passe ici !

    }

    @Et("^une oeuvre \"([^\"]*)\" créée dans la catégorie \"([^\"]*)\"$")
    public void uneOeuvreCrééeDansLaCatégorie(String arg0, String arg1) throws Throwable {
        try {
            new ConnexionFixture().lUtilisateurSeDeconnecte();
        } catch (NoSuchElementException ignored){}
        new ConnexionFixture().lUtilisateurConnecteEnTantQueMembre();
        lUtilisateurCliqueSurBoutonCorrespondantÀLAjoutDUneOeuvre();
        lUtilisateurSaisitLeTitre(arg0);
        leDescriptif("lorem ipsum");
        laCatégorie(arg1);
        lAuteur("loremipsum");
        laDate("21/12/2012");
        lUtilisateurAppuieSurLeBoutonDeValidationDeLAjout();
        assert WebSite.getDriver().getCurrentUrl().contains("/oeuvre/");
        new ConnexionFixture().lUtilisateurSeDeconnecte();
        new ConnexionFixture().lUtilisateurConnecteEnTantQuAdministrateur();
    }

    @Et("^l'oeuvre \\(\"([^\"]*)\", \"([^\"]*)\", \"([^\"]*)\"\\) n'existe pas$")
    public void lOeuvreNExistePas(String arg0, String arg1, String arg2) throws Throwable {
        new ConnexionFixture().lUtilisateurConnecteEnTantQuAdministrateur();
        new AdministrationFixture().lUtilisateurSurLOngletDeSuppressionDUneOeuvre();
        List<WebElement> l = WebSite.getDriver().findElements(By.className("col-md-6"));
        for (WebElement e : l){
            assert !e.findElement(By.id("oeuvre_nom")).getText().equals(arg0)
                    || !e.findElement(By.id("oeuvre_categorie")).getText().equals(arg1)
                    || !e.findElement(By.id("oeuvre_auteurs")).getText().contains(arg2);
        }
        new ConnexionFixture().lUtilisateurSeDeconnecte();
    }

    @Et("^l'utilisateur est redirigé vers la page de son nouveau post \\(\"([^\"]*)\", \"([^\"]*)\", \"([^\"]*)\"\\)$")
    public void lUtilisateurEstRedirigéVersLaPageDeSonNouveauPost(String arg0, String arg1, String arg2) throws Throwable {
        assert WebSite.getDriver().getCurrentUrl().contains("/oeuvre/");
        assert WebSite.getDriver().findElement(By.id("titre_oeuvre")).getText().equals(arg0);
        assert WebSite.getDriver().findElement(By.id("categorie_oeuvre")).getText().contains(arg1);
        assert WebSite.getDriver().findElement(By.id("auteurs_oeuvre")).getText().contains(arg2);
    }

    @Et("^l'oeuvre \"([^\"]*)\" créée dans la catégorie \"([^\"]*)\"$")
    public void lOeuvreCréée(String arg0, String arg1) throws Throwable {
        new ConnexionFixture().lUtilisateurConnecteEnTantQueMembre();
        lUtilisateurCliqueSurBoutonCorrespondantÀLAjoutDUneOeuvre();
        lUtilisateurSaisitLeTitre(arg0);
        leDescriptif("lorem ipsum");
        laCatégorie(arg1);
        lAuteur("loremipsum");
        laDate("21/12/2012");
        lUtilisateurAppuieSurLeBoutonDeValidationDeLAjout();
        assert WebSite.getDriver().getCurrentUrl().contains("/oeuvre/");
        new ConnexionFixture().lUtilisateurSeDeconnecte();
    }

    @Et("^l'oeuvre \"([^\"]*)\" créée dans la catégorie \"([^\"]*)\" par \"([^\"]*)\"$")
    public void lOeuvreCrééeDansLaCatégoriePar(String arg0, String arg1, String arg2) throws Throwable {
        new ConnexionFixture().lUtilisateurConnecteEnTantQueMembre(arg2);
        lUtilisateurCliqueSurBoutonCorrespondantÀLAjoutDUneOeuvre();
        lUtilisateurSaisitLeTitre(arg0);
        leDescriptif("lorem ipsum");
        laCatégorie(arg1);
        lAuteur("loremipsum");
        laDate("21/12/2012");
        lUtilisateurAppuieSurLeBoutonDeValidationDeLAjout();
        assert WebSite.getDriver().getCurrentUrl().contains("/oeuvre/");
        new ConnexionFixture().lUtilisateurSeDeconnecte();
    }

    @Et("^le commentaire n'a pas été ajouté à l'oeuvre \"([^\"]*)\"$")
    public void leCommentaireNAPasÉtéAjoutéÀLOeuvre(String arg0) throws Throwable {
        assert WebSite.getDriver().findElements(By.className("commentaire")).isEmpty();
    }

    @Et("^l'utilisateur ajoute un fichier avec un format non valide comme illustration principale$")
    public void lUtilisateurAjouteUnFichierAvecUnFormatNonValideCommeIllustrationPrincipale() throws IOException {
        WebSite.getDriver().findElement(By.id("oeuvre_photoPrincipale")).sendKeys(saveImage("http://www.hochmuth.com/mp3/Bloch_Prayer.mp3","image3.mp3"));
    }

    @Et("^l'utilisateur ajoute un fichier avec un format non valide comme illustration secondaire$")
    public void lUtilisateurAjouteUnFichierAvecUnFormatNonValideCommeIllustrationSecondaire() throws IOException {
        //WebSite.getDriver().findElement(By.id("oeuvre_addGroup")).click();
        JavascriptExecutor js = WebSite.getDriver();
        js.executeScript("var script = document.createElement(\"script\");  // create a script DOM node\n" +
                "    script.src = '/~m2test6/preprod/js/loadScript.js';  // set its src to the provided URL\n" +
                "\n" +
                "    document.head.appendChild(script);");
        js.executeScript("var script = document.createElement(\"script\");  // create a script DOM node\n" +
                "script.id = 'depositScript'\n"+
                "    script.src = '/~m2test6/preprod/js/oeuvreDeposit.js';  // set its src to the provided URL\n" +
                "\n" +
                "    document.head.appendChild(script);");
        js.executeScript("var script = document.createElement(\"script\");  // create a script DOM node\n" +
                "script.id = 'editScript'\n"+
                "    script.src = '/~m2test6/preprod/js/oeuvreEdit.js';  // set its src to the provided URL\n" +
                "\n" +
                "    document.head.appendChild(script);");
        WebSite.getDriver().findElement(By.id("oeuvre_addGroup")).sendKeys(saveImage("http://www.hochmuth.com/mp3/Bloch_Prayer.mp3","image4.mp3"));
    }

    @Et("^l'utilisateur ajoute une nouvelle illustrationPrincipale$")
    public void lUtilisateurAjouteUneNouvelleIllustrationPrincipale() throws IOException {
        WebSite.getDriver().findElement(By.id("oeuvre_photoPrincipale")).sendKeys(saveImage("https://upload.wikimedia.org/wikipedia/commons/6/64/Counter-Strike_text_logo.png", "image5.jpg"));
    }

    @Et("^l'utilisateur ajoute une nouvelle illustrationSecondaire$")
    public void lUtilisateurAjouteUneNouvelleIllustrationSecondaire() throws IOException {
        JavascriptExecutor js = WebSite.getDriver();
        js.executeScript("var script = document.createElement(\"script\");  // create a script DOM node\n" +
                "    script.src = '/~m2test6/preprod/js/loadScript.js';  // set its src to the provided URL\n" +
                "\n" +
                "    document.head.appendChild(script);");
        js.executeScript("var script = document.createElement(\"script\");  // create a script DOM node\n" +
                "script.id = 'depositScript'\n"+
                "    script.src = '/~m2test6/preprod/js/oeuvreDeposit.js';  // set its src to the provided URL\n" +
                "\n" +
                "    document.head.appendChild(script);");
        js.executeScript("var script = document.createElement(\"script\");  // create a script DOM node\n" +
                "script.id = 'editScript'\n"+
                "    script.src = '/~m2test6/preprod/js/oeuvreEdit.js';  // set its src to the provided URL\n" +
                "\n" +
                "    document.head.appendChild(script);");
        WebSite.getDriver().findElement(By.id("oeuvre_addGroup")).sendKeys(saveImage("https://upload.wikimedia.org/wikipedia/en/5/5a/Teletubbies_Logo.png", "image6.jpg"));
    }

    @Et("^l'utilisateur supprime l'ilustration principale$")
    public void lUtilisateurSupprimeLIlustrationPrincipale() {
        WebSite.getDriver().findElement(By.id("oeuvre_supprimerPhotoPrincipale")).click();
    }

    @Et("^l'utilisateur ajoute une image principale et une secondaire avec un format valide$")
    public void lUtilisateurAjouteDeuxImagesAvecUnFormatValide() throws IOException {
        JavascriptExecutor js = WebSite.getDriver();
        js.executeScript("var script = document.createElement(\"script\");  // create a script DOM node\n" +
                "    script.src = '/~m2test6/preprod/js/loadScript.js';  // set its src to the provided URL\n" +
                "\n" +
                "    document.head.appendChild(script);");
        js.executeScript("var script = document.createElement(\"script\");  // create a script DOM node\n" +
                "script.id = 'depositScript'\n"+
                "    script.src = '/~m2test6/preprod/js/oeuvreDeposit.js';  // set its src to the provided URL\n" +
                "\n" +
                "    document.head.appendChild(script);");
        js.executeScript("var script = document.createElement(\"script\");  // create a script DOM node\n" +
                "script.id = 'editScript'\n"+
                "    script.src = '/~m2test6/preprod/js/oeuvreEdit.js';  // set its src to the provided URL\n" +
                "\n" +
                "    document.head.appendChild(script);");
        WebSite.getDriver().findElement(By.id("oeuvre_photoPrincipale")).sendKeys(saveImage("https://upload.wikimedia.org/wikipedia/commons/3/38/%27Le_Penseur%27_%28Auguste_Rodin%29_3.jpg", "image1.jpg"));
        WebSite.getDriver().findElement(By.id("oeuvre_addGroup")).sendKeys(saveImage("https://live.staticflickr.com/8220/8375622029_41b8da32f8_b.jpg","image2.jpg"));
    }

    @Et("^une illustration principale est visible$")
    public void uneIllustrationPrincipaleEstVisible() {
        assert !WebSite.getDriver().findElements(By.id("img_oeuvre")).isEmpty();
    }

    @Et("^au moins une illustration secondaire est visible$")
    public void uneIllustrationSecondaireEstVisible() {
        assert !WebSite.getDriver().findElements(By.className("image-secondaire")).isEmpty();
    }

    @Et("^aucune illustration principale n'est renseignée$")
    public void aucuneIllustrationPrincipaleNEstRenseignée() {
        assert WebSite.getDriver().findElements(By.id("img_oeuvre")).isEmpty();
    }

    @Et("^aucune illustration secondaire n'est renseignée$")
    public void aucunePhotoSecondaireNEstRenseignée() {
        assert WebSite.getDriver().findElements(By.className("image-secondaire")).isEmpty();
    }

    @Quand("^l'utilisateur appuie sur le bouton d'édition$")
    public void lUtilisateurAppuieSurLeBoutonDÉdition() {
        WebSite.getDriver().findElement(By.id("modifier_oeuvre")).findElement(By.tagName("a")).click();
    }

    @Alors("^l'utilisateur est redirigé vers le formulaire d'édition$")
    public void lUtilisateurEstRedirigéVersLeFormulaireDÉdition() {
        assert WebSite.getDriver().getCurrentUrl().contains("editerOeuvre");
    }

    @Et("^l'utilisateur appuie sur le bouton de validation de l'édition$")
    public void lUtilisateurAppuieSurLeBoutonDeValidationDeLÉdition() {
        lUtilisateurAppuieSurLeBoutonDeValidationDeLAjout();
    }

    @Et("^l'utilisateur est redirigé vers la page de \"([^\"]*)\" modifiée \\(\"([^\"]*)\",\"([^\"]*)\",\"([^\"]*)\"\\)$")
    public void lUtilisateurEstRedirigéVersLaPageDeModifiée(String arg0, String arg1, String arg2, String arg3) throws Throwable {
        lUtilisateurEstRedirigéVersLaPageDeSonNouveauPost(arg1,arg2,arg3);
    }

    @Et("^le bouton de vote n'est pas disponible$")
    public void leBoutonDeVoteNEstPasDisponible() {
        assert WebSite.getDriver().findElements(By.className("fa-thumbs-up")).isEmpty();
    }

    @Et("^le bouton de vote est disponible$")
    public void leBoutonDeVoteEstDisponible() {
        assert !WebSite.getDriver().findElements(By.className("fa-thumbs-up")).isEmpty();
    }

    @Et("^le bouton d'edition ne s'affiche pas$")
    public void leBoutonDEditionNeSAffichePas() {
        assert WebSite.getDriver().findElements(By.id("modifier_oeuvre")).isEmpty();
    }

    @Et("^le bouton d'edition s'affiche$")
    public void leBoutonDEditionNeAffiche() {
        assert ! WebSite.getDriver().findElements(By.id("modifier_oeuvre")).isEmpty();
    }

    @Et("^l'oeuvre \"([^\"]*)\" créée dans la catégorie \"([^\"]*)\" avec photo$")
    public void lOeuvreCrééeDansLaCatégorieAvecPhoto(String arg0, String arg1) throws Throwable {
        new ConnexionFixture().lUtilisateurConnecteEnTantQueMembre();
        lUtilisateurCliqueSurBoutonCorrespondantÀLAjoutDUneOeuvre();
        lUtilisateurSaisitLeTitre(arg0);
        leDescriptif("lorem ipsum");
        laCatégorie(arg1);
        lAuteur("loremipsum");
        laDate("21/12/2012");
        lUtilisateurAjouteDeuxImagesAvecUnFormatValide();
        lUtilisateurAppuieSurLeBoutonDeValidationDeLAjout();
        assert WebSite.getDriver().getCurrentUrl().contains("/oeuvre/");
        new ConnexionFixture().lUtilisateurSeDeconnecte();
    }

    private void rewrite(WebElement e, String a){
        e.clear();
        e.sendKeys(a);
    }

    @Quand("^l'utilisateur saisit la description \"([^\"]*)\"$")
    public void lUtilisateurSaisitLaDescription(String arg0) throws Throwable {
        leDescriptif(arg0);
    }

    @Quand("^l'utilisateur choisit la catégorie \"([^\"]*)\"$")
    public void lUtilisateurChoisitLaCatégorie(String arg0) throws Throwable {
        laCatégorie(arg0);
    }
    @Quand("^l'utilisateur saisit l'auteur \"([^\"]*)\"$")
    public void lUtilisateurSaisitLAuteur(String arg0) throws Throwable {
        lAuteur(arg0);
    }

    @Et("^l'oeuvre \"([^\"]*)\" n'existe pas$")
    public void lOeuvreNExistePas(String arg0) throws Throwable {
        new ConnexionFixture().lUtilisateurConnecteEnTantQuAdministrateur();
        new AdministrationFixture().lUtilisateurSurLOngletDeSuppressionDUneOeuvre();
        List<WebElement> l = WebSite.getDriver().findElements(By.className("col-md-6"));
        for (WebElement e : l){
            assert !e.findElement(By.id("oeuvre_nom")).getText().equals(arg0);
        }
        new ConnexionFixture().lUtilisateurSeDeconnecte();
    }

    @Alors("^le message \"([^\"]*)\" est affiché$")
    public void leMessageEstAffiché(String arg0) throws Throwable {
       assert WebSite.getDriver().findElements(By.tagName("strong")).stream().anyMatch(t -> t.getText().equals(arg0));
    }

    @Quand("^l'utilisateur vote positivement$")
    public void lUtilisateurVotePositivement() {
        WebSite.getDriver().findElement(By.className("fa-thumbs-up")).click();
    }

    @Quand("^l'utilisateur vote negativement$")
    public void lUtilisateurVoteNegativement() {
        WebSite.getDriver().findElement(By.className("fa-thumbs-down")).click();
    }

    @Quand("^l'utilisateur supprime son vote$")
    public void lUtilisateurSupprimeSonVote() {
        WebSite.getDriver().findElement(By.className("current-vote")).click();
    }

    @Quand("^l'utilisateur vote positivement pour l'oeuvre \"([^\"]*)\"$")
    public void lUtilisateurVotePositivementPourLOeuvre(String arg0) throws Throwable {
        WebSite.getDriver().findElement(By.id("go-to-home-btn")).click();
        lUtilisateurRenseigneLaChaineDeCaractère(arg0);
        lOeuvreCorrespondantAuNomEstAffichée(arg0);
        lUtilisateurCliqueSurLOeuvreDansLaListeRecherchée(arg0);
        lUtilisateurEstSurLaPageDeLOeuvre(arg0);
        lUtilisateurVotePositivement();
        WebSite.getDriver().findElement(By.id("go-to-home-btn")).click();
    }

    @Quand("^l'utilisateur vote négativement pour l'oeuvre \"([^\"]*)\"$")
    public void lUtilisateurVoteNégativementPourLOeuvre(String arg0) throws Throwable {
        WebSite.getDriver().findElement(By.id("go-to-home-btn")).click();
        lUtilisateurRenseigneLaChaineDeCaractère(arg0);
        lOeuvreCorrespondantAuNomEstAffichée(arg0);
        lUtilisateurCliqueSurLOeuvreDansLaListeRecherchée(arg0);
        lUtilisateurEstSurLaPageDeLOeuvre(arg0);
        lUtilisateurVoteNegativement();
        WebSite.getDriver().findElement(By.id("go-to-home-btn")).click();
    }

    @Quand("^l'utilisateur supprime son vote pour l'oeuvre \"([^\"]*)\"$")
    public void lUtilisateurSupprimeSonVotePourLOeuvre(String arg0) throws Throwable {
        WebSite.getDriver().findElement(By.id("go-to-home-btn")).click();
        lUtilisateurRenseigneLaChaineDeCaractère(arg0);
        lOeuvreCorrespondantAuNomEstAffichée(arg0);
        lUtilisateurCliqueSurLOeuvreDansLaListeRecherchée(arg0);
        lUtilisateurEstSurLaPageDeLOeuvre(arg0);
        lUtilisateurSupprimeSonVote();
        WebSite.getDriver().findElement(By.id("go-to-home-btn")).click();
    }

    @Alors("^un message le remercie pour son vote$")
    public void unMessageLeRemerciePourSonVote() {
        assert WebSite.getDriver().findElement(By.className("alert-secondary")).getText().contains("Votre avis a bien été pris en compte");
    }

    @Et("^la page de l'oeuvre \"([^\"]*)\" est reactualisé avec le vote positif pris en compte$")
    public void laPageDeLOeuvreEstReactualiséAvecLeVotePrisEnCompte(String arg0) throws Throwable {
//        assert WebSite.getDriver().findElement(By.id("avis_oeuvre")).getText().contains("1");
//        assert WebSite.getDriver().findElement(By.id("avis_oeuvre")).getText().contains("Très positifs");
        assert ! WebSite.getDriver().findElements(By.cssSelector(".current-vote.fa-thumbs-up")).isEmpty();
    }

    @Et("^la page de l'oeuvre \"([^\"]*)\" est reactualisé avec le vote négatif pris en compte$")
    public void laPageDeLOeuvreEstReactualiséAvecLeVoteNégatifPrisEnCompte(String arg0) throws Throwable {
//        assert WebSite.getDriver().findElement(By.id("avis_oeuvre")).getText().contains("1");
//        assert WebSite.getDriver().findElement(By.id("avis_oeuvre")).getText().contains("Très négatifs");
        assert ! WebSite.getDriver().findElements(By.cssSelector(".current-vote.fa-thumbs-down")).isEmpty();
    }

    @Et("^la page de l'oeuvre \"([^\"]*)\" est reactualisé avec la suppression du vote prise en compte$")
    public void laPageDeLOeuvreEstReactualiséAvecLaSuppressionDuVotePriseEnCompte(String arg0) throws Throwable {
        assert WebSite.getDriver().findElements(By.cssSelector(".current-vote")).isEmpty();
    }

    @Quand("^l'utilisateur sélectionne la catégorie \"([^\"]*)\"$")
    public void lUtilisateurSélectionneLaCatégorie(String arg0) throws Throwable {
        WebSite.getDriver().findElement(By.id("form_nom")).findElements(By.tagName("option"))
                .stream()
                .filter(t -> t.getText().equals(arg0))
                .findFirst()
                .ifPresent(WebElement::click);
    }

    @Et("^l'utilisateur est sur la page des classements pour la catégorie \"([^\"]*)\"$")
    public void lUtilisateurEstSurLaPageDesClassementsPourLaCatégorie(String arg0) throws Throwable {
        assert WebSite.getDriver().findElements(By.className("col-md-6")).stream()
                .map(e -> e.findElement(By.tagName("h6")))
                .allMatch(e -> e.getText().equals(arg0));
    }

    private String saveImage(String from, String to) throws IOException {
        URL url = new URL(from);
        InputStream in = new BufferedInputStream(url.openStream());
        ByteArrayOutputStream out = new ByteArrayOutputStream();
        byte[] buf = new byte[1024];
        int n = 0;
        while (-1!=(n=in.read(buf)))
        {
            out.write(buf, 0, n);
        }
        out.close();
        in.close();
        byte[] response = out.toByteArray();
        File f = new File(to);
        FileOutputStream fos = new FileOutputStream(f);
        fos.write(response);
        fos.close();
        return f.getAbsolutePath();
    }

    @Alors("^le bouton de validation de commentaire n'est pas cliquable$")
    public void leBoutonDeValidationDeCommentaireNEstPasCliquable() {
        assert !WebSite.getDriver().findElement(By.id("btn-send-comment")).isEnabled();
    }

    @Et("^le formulaire de commentaire n'est pas disponible$")
    public void leFormulaireDeCommentaireNEstPasDisponible() {
        assert WebSite.getDriver().findElements(By.id("input-comment")).isEmpty();
        assert WebSite.getDriver().findElements(By.id("btn-send-comment")).isEmpty();
    }

    @Et("^le formulaire de commentaire est disponible$")
    public void leFormulaireDeCommentaireEstDisponible() {
        assert !WebSite.getDriver().findElements(By.id("input-comment")).isEmpty();
        assert !WebSite.getDriver().findElements(By.id("btn-send-comment")).isEmpty();
    }

    @Et("^l'avis affiché est \"([^\"]*)\"$")
    public void lAvisAfficheEst(String arg0) throws Throwable {
        assert WebSite.getDriver().findElement(By.id("avis-oeuvre-text")).getText().contains(arg0);
    }

    @Et("^le nombre d'avis est \"([^\"]*)\"$")
    public void leNombreDAvisEst(String arg0) throws Throwable {
        assert WebSite.getDriver().findElement(By.id("avis-oeuvre-nb")).getText().contains(arg0);
    }

    @Et("^aucun pourcentage n'est affiché dans la barre d'avis$")
    public void aucunPourcentageDansLaBarreDAvis() throws Throwable {
        assert WebSite.getDriver().findElements(By.id("avis_pourcentage")).isEmpty();
    }

    @Et("^le pourcentage \"([^\"]*)\" est affiché dans la barre d'avis$")
    public void lePourcentageEstAfficherDansLaBarreDAvis(String arg0) throws Throwable {
        assert WebSite.getDriver().findElement(By.id("avis_pourcentage")).getText().contains(arg0);
    }

    @Et("^une seule image secondaire est présente$")
    public void uneSeuleImageSecondaireEstPrésente() {
        assert WebSite.getDriver().findElements(By.id("img")).size()==1;
    }

    @Et("^l'utilisateur accède à ses oeuvres$")
    public void lUtilisateurAccèdeÀSesOeuvres() {
        WebSite.getDriver().findElement(By.id("go-to-mes-oeuvre-btn")).click();
    }


    @Alors("^aucune oeuvre n'est listée$")
    public void aucuneOeuvreNEstListée() {
        assert WebSite.getDriver().findElements(By.tagName("strong")).stream().anyMatch(t -> t.getText().equals("Aucune oeuvre trouvée."));
    }

    @Quand("^l'utilisateur crée l'oeuvre \"([^\"]*)\"$")
    public void lUtilisateurCréeLOeuvre(String arg0) throws Throwable {
        lUtilisateurCliqueSurBoutonCorrespondantÀLAjoutDUneOeuvre();
        lUtilisateurSaisitLeTitre(arg0);
        leDescriptif("lorem ipsum");
        laCatégorie("catTest");
        lAuteur("loremipsum");
        laDate("21/12/2012");
        lUtilisateurAppuieSurLeBoutonDeValidationDeLAjout();
    }

    @Alors("^seule l'oeuvre \"([^\"]*)\" est listée$")
    public void seuleLOeuvreEstListée(String arg0) throws Throwable {
        System.out.println(WebSite.getDriver().findElements(By.className("col-md-4")));
        assert WebSite.getDriver().findElements(By.className("col-md-4")).size()==2;
        assert WebSite.getDriver().findElements(By.className("col-md-4")).stream().anyMatch(t -> t.findElement(By.tagName("h4")).getText().equals(arg0));
    }

    @Alors("^les (\\d+) oeuvres \"([^\"]*)\",\"([^\"]*)\" sont listées$")
    public void lesOeuvresSontListées(int arg0, String arg1, String arg2) throws Throwable {
        assert WebSite.getDriver().findElements(By.className("col-md-4")).size()==2*arg0;
        assert WebSite.getDriver().findElements(By.className("col-md-4")).stream().anyMatch(t -> t.getText().contains(arg1));
        assert WebSite.getDriver().findElements(By.className("col-md-4")).stream().anyMatch(t -> t.getText().contains(arg2));

    }

    @Quand("^l'utilisateur va sur la page d'édition de l'oeuvre actuelle$")
    public void lUtilisateurVaSurLaPageDÉditionDeLOeuvreActuelle() {
        WebSite.getDriver().get(WebSite.getDriver().getCurrentUrl().replace("oeuvre","editerOeuvre"));
    }

    @Et("^l'utilisateur clique sur l'oeuvre \"([^\"]*)\" dans la liste des oeuvres disponibles$")
    public void lUtilisateurCliqueSurLOeuvreDansLaListeDesOeuvresDisponibles(String arg0) throws Throwable {
        List<WebElement> l = WebSite.getDriver().findElements(By.className("col-md-6"));
        Optional<WebElement> r = l.stream().filter(t -> t.findElement(By.tagName("h4")).getText().equals(arg0)).findFirst();
        r.ifPresent(WebElement::click);
    }

    @Et("^l'utilisateur clique sur l'oeuvre \"([^\"]*)\" dans la liste de ses oeuvres$")
    public void lUtilisateurCliqueSurLOeuvreDansLaListeDeSesOeuvres(String arg0) throws Throwable {
        List<WebElement> l = WebSite.getDriver().findElements(By.className("list-group-item"));
        Optional<WebElement> r = l.stream().filter(t -> t.findElement(By.tagName("h4")).getText().equals(arg0)).findFirst();
        r.ifPresent(WebElement::click);
    }

    @Et("^l'utilisateur clique sur l'oeuvre \"([^\"]*)\" dans le classement$")
    public void lUtilisateurCliqueSurLOeuvreDansLeClassement(String arg0) throws Throwable {
        List<WebElement> l = WebSite.getDriver().findElements(By.tagName("a"));
        l.forEach(t -> System.out.println(t.getText()));
        System.out.println(l);
        l.stream()
                .filter(t -> t.findElements(By.tagName("h4")).stream().anyMatch(g -> g.getText().equals(arg0)))
                .findFirst()
                .ifPresent(v -> {System.out.println(v);v.click();});
    }
}
