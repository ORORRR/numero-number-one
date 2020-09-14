import cucumber.api.PendingException;
import cucumber.api.java.fr.Alors;
import cucumber.api.java.fr.Et;
import cucumber.api.java.fr.Quand;
import org.openqa.selenium.*;

import java.util.ArrayList;
import java.util.List;
import java.util.stream.Collectors;

public class AdministrationFixture {
    @Et("^l'utilisateur sur l'onglet d'ajout d'une catégorie$")
    public void lUtilisateurSurLOngletDAjoutDUneCategorie() {
        WebSite.getDriver().findElement(By.id("go-to-amdin-btn")).click();
        WebSite.getDriver().findElement(By.id("go-to-admin-categories")).click();
    }

    @Quand("^l'utilisateur renseigne le nom \"([^\"]*)\"$")
    public void lUtilisateurRenseigneLeNom(String arg0) throws Throwable {
        WebSite.getDriver().findElement(By.id("form_login")).sendKeys(arg0);
        WebSite.getDriver().findElement(By.id("form_chercher")).click();
    }

    @Et("^l'utilisateur est sur l'onglet d'ajout d'une catégorie$")
    public void lUtilisateurEstSurLOngletDAjoutDUneCategorie() {
        assert WebSite.getDriver().getCurrentUrl().endsWith("categories");
    }

    @Et("^la catégorie \"([^\"]*)\" n'est pas créée$")
    public void laCategorieNEstPasCreee(String arg0) throws Throwable {
        List<WebElement> l =  WebSite.getDriver().findElements(By.className("text-danger"));
        assert l.stream().noneMatch(t -> t.getText().equals(arg0));
    }

    @Et("^le message d'erreur \"([^\"]*)\" est affiché$")
    public void leMessageDErreurEstAffiche(String arg0) throws Throwable {
        System.out.println("URL : "+WebSite.getDriver().getCurrentUrl());
        WebSite.getDriver().findElements(By.className("text-danger")).forEach(t -> System.out.println(t.getText()));
        List<WebElement> l =  WebSite.getDriver().findElements(By.className("text-danger"));
        assert l.stream().anyMatch(t -> t.getText().equals(arg0));
    }

    @Et("^la catégorie \"([^\"]*)\" est créée$")
    public void laCategorieEstCreee(String arg0) throws Throwable {
        List<WebElement> l = WebSite.getDriver().findElements(By.className("btn-supprimer-categorie"));
        assert l.stream().anyMatch(t -> t.getAttribute("data-cat-name").equals(arg0));
    }

    @Et("^la catégorie \"([^\"]*)\" n'est présente qu'une fois$")
    public void laCategorieNEstPresenteQuUneFois(String arg0) throws Throwable {
        List<WebElement> l = WebSite.getDriver().findElements(By.className("btn-supprimer-categorie"));
        assert l.stream().filter(t -> t.getAttribute("data-cat-name").equals(arg0)).count()==1;
    }

    @Et("^aucun message d'erreur n'est affiché$")
    public void aucunMessageDErreurNEstAffiche() {
        assert WebSite.getDriver().findElements(By.className("text-danger")).isEmpty();
    }

    @Et("^la catégorie \"([^\"]*)\" créée$")
    public void laCategorieCreee(String arg0) throws Throwable {
        lUtilisateurSurLOngletDAjoutDUneCategorie();
        try {
            laCategorieEstCreee(arg0);
        } catch (AssertionError a) {
            lUtilisateurRenseigneLeNomDeCatégorie(arg0);
            laCategorieEstCreee(arg0);
            aucunMessageDErreurNEstAffiche();
        }
    }

    @Quand("^l'utilisateur supprime la catégorie \"([^\"]*)\"$")
    public void lUtilisateurSupprimeLaCategorie(String arg0) throws Throwable {
        JavascriptExecutor js = (JavascriptExecutor) WebSite.getDriver();
        List<WebElement> l = WebSite.getDriver().findElements(By.className("btn-supprimer-categorie"));
        l.stream().filter(t -> t.getAttribute("data-cat-name").equals(arg0)).findFirst().ifPresent(WebElement::click);
        js.executeScript("arguments[0].click();", WebSite.getDriver().findElement(By.id("modale-valider-suppression-btn")));
    }

    @Et("^la catégorie \"([^\"]*)\" est supprimée$")
    public void laCategorieEstSupprimee(String arg0) throws Throwable {
        List<WebElement> l = WebSite.getDriver().findElements(By.className("btn-supprimer-categorie"));
        assert l.stream().noneMatch(t -> t.getAttribute("data-cat-name").equals(arg0));
    }
    

    @Quand("^le second utilisateur supprime la catégorie \"([^\"]*)\"$")
    public void leSecondUtilisateurSupprimeLaCategorie(String arg0) throws Throwable {
        JavascriptExecutor js = (JavascriptExecutor) WebSite.getSecondDriver();
        List<WebElement> l = WebSite.getSecondDriver().findElements(By.className("btn-supprimer-categorie"));
        l.stream().filter(t -> t.getAttribute("data-cat-name").equals(arg0)).findFirst().ifPresent(WebElement::click);
        js.executeScript("arguments[0].click();", WebSite.getSecondDriver().findElement(By.id("modale-valider-suppression-btn")));
        //l.stream().filter(t -> t.getAttribute("data-cat-name").equals(arg0)).findFirst().ifPresent(System.out::println);
    }

    @Et("^la catégorie \"([^\"]*)\" n'est pas supprimée sur la deuxième page$")
    public void laCategorieNEstPasSupprimeeSurLaDeuxiemePage(String arg0) throws Throwable {
        // Write code here that turns the phrase above into concrete actions
        throw new PendingException();
    }

    @Et("^le message d'erreur \"([^\"]*)\" est affiché sur la deuxième page$")
    public void leMessageDErreurEstAfficheSurLaDeuxiemePage(String arg0) throws Throwable {
        assert WebSite.getSecondDriver().findElements(By.className("alert-danger")).stream().anyMatch(t -> t.getText().contains(arg0));
}

    @Et("^l'oeuvre \"([^\"]*)\" est supprimée$")
    public void lOeuvreEstSupprimee(String arg0) throws Throwable {
        List<WebElement> l = WebSite.getDriver().findElements(By.className("btn-supprimer-oeuvre"));
        assert l.stream().noneMatch(t -> t.getAttribute("data-oeuvre-name").equals(arg0));
    }

    @Et("^l'utilisateur est sur l'onglet de suppression d'une catégorie$")
    public void lUtilisateurEstSurLOngletDeSuppressionDUneCategorie() {
        lUtilisateurEstSurLOngletDAjoutDUneCategorie();
    }

    @Et("^l'utilisateur sur l'onglet de suppression d'une catégorie$")
    public void lUtilisateurSurLOngletDeSuppressionDUneCategorie() {
        lUtilisateurSurLOngletDAjoutDUneCategorie();
    }

    @Et("^une nouvelle page ouverte sur l'onglet de suppression d'une catégorie$")
    public void uneNouvellePageOuverteSurLOngletDeSuppressionDUneCategorie() {
        WebSite.newSecondDriver();
        new GlobalFixture().accesSecondDriver();
        new ConnexionFixture().lUtilisateurConnecteAdminSecond();
        WebSite.getSecondDriver().findElement(By.id("go-to-amdin-btn")).click();
        WebSite.getSecondDriver().findElement(By.id("go-to-admin-categories")).click();
    }

    @Et("^le second utilisateur est sur l'onglet de suppression d'une catégorie$")
    public void leSecondUtilisateurEstSurLOngletDeSuppressionDUneCategorie() {
        assert WebSite.getSecondDriver().getCurrentUrl().endsWith("categories");

    }

    @Et("^l'utilisateur est sur l'onglet de suppression d'une oeuvre$")
    public void lUtilisateurEstSurLOngletDeSuppressionDUneOeuvre() {
        assert WebSite.getDriver().getCurrentUrl().endsWith("oeuvres");
    }

    @Quand("^l'utilisateur supprime l'oeuvre \"([^\"]*)\"$")
    public void lUtilisateurSupprimeLOeuvre(String arg0) throws Throwable {
        JavascriptExecutor js = (JavascriptExecutor) WebSite.getDriver();
        List<WebElement> l = WebSite.getDriver().findElements(By.className("btn-supprimer-oeuvre"));
        l.stream().filter(t -> t.getAttribute("data-oeuvre-name").equals(arg0)).findFirst().ifPresent(WebElement::click);
        js.executeScript("arguments[0].click();", WebSite.getDriver().findElement(By.id("modale-valider-suppression-btn")));
    }

    @Alors("^le lien d'accès à la page d'administration est visible$")
    public void leLienDAccesALaPageDAdministrationEstVisible() {
        {
            List<WebElement> elements = WebSite.getDriver().findElements(By.id("go-to-amdin-btn"));
            assert(elements.size() > 0);
        }
    }

    @Alors("^le lien d'accès à la page d'administration n'est plus visible$")
    public void leLienDAccesALaPageDAdministrationNEstPlusVisible() {
        {
            List<WebElement> elements = WebSite.getDriver().findElements(By.id("go-to-amdin-btn"));
            assert(elements.size() == 0);
        }
    }

    @Et("^l'utilisateur sur l'onglet de gestion des utilisateurs$")
    public void lUtilisateurSurLOngletDeGestionDesUtilisateurs() {
        WebSite.getDriver().findElement(By.id("go-to-amdin-btn")).click();
        WebSite.getDriver().findElement(By.id("go-to-admin-utilisateurs")).click();
    }

    @Alors("^la ligne correspondant au nom \"([^\"]*)\" est affichée$")
    public void laLigneCorrespondantAuNomEstAffichee(String arg0) throws Throwable {
        List<WebElement> l = WebSite.getDriver().findElements(By.className("btn-supprimer-utilisateur"));
        assert l.stream().anyMatch(t -> t.getAttribute("data-user-name").equals(arg0));
    }

    @Et("^l'utilisateur \"([^\"]*)\" n'existant pas$")
    public void lUtilisateurNExistantPas(String arg0) throws Throwable {
        List<WebElement> l = WebSite.getDriver().findElements(By.className("btn-supprimer-utilisateur"));
        assert l.stream().noneMatch(t -> t.getAttribute("data-user-name").equals(arg0));
    }

    @Alors("^le message \"([^\"]*)\" s'affiche$")
    public void leMessageSAffiche(String arg0) throws Throwable {
        List<WebElement> l = WebSite.getDriver().findElements(By.tagName("div"));
        assert l.stream().anyMatch(t -> t.getText().contains(arg0));
    }

    @Et("^l'utilisateur est sur l'onglet de gestion des utilisateurs$")
    public void lUtilisateurEstSurLOngletDeGestionDesUtilisateurs() {
        String URL = WebSite.getDriver().getCurrentUrl();
        assert(URL.contains("utilisateurs"));
    }

    @Et("^l'utilisateur \"([^\"]*)\" est supprimé$")
    public void lUtilisateurEstSupprime(String arg0) throws Throwable {
        lUtilisateurNExistantPas(arg0);
    }

    @Quand("^l'utilisateur supprime l'utilisateur \"([^\"]*)\"$")
    public void lUtilisateurSupprimeLUtilisateur(String arg0) throws Throwable {
        WebSite.getDriver().findElements(By.className("btn-supprimer-utilisateur"))
                .stream()
                .filter(t -> t.getAttribute("data-user-name").contains(arg0)).findFirst()
                .ifPresent(WebElement::click);
        JavascriptExecutor js = (JavascriptExecutor) WebSite.getDriver();
        js.executeScript("arguments[0].click();", WebSite.getDriver().findElement(By.id("modale-valider-suppression-btn")));
    }

    @Et("^une nouvelle page ouverte sur l'onglet de gestion des utilisateurs pour supprimer \"([^\"]*)\"$")
    public void uneNouvellePageOuverteSurLOngletDeGestionDesUtilisateurs(String arg0) {
        WebSite.newSecondDriver();
        new GlobalFixture().accesSecondDriver();
        new ConnexionFixture().lUtilisateurConnecteAdminSecond();
        WebSite.getSecondDriver().findElement(By.id("go-to-amdin-btn")).click();
        WebSite.getSecondDriver().findElement(By.id("go-to-admin-utilisateurs")).click();
    }

    @Quand("^le second utilisateur supprime l'utilisateur \"([^\"]*)\"$")
    public void leSecondUtilisateurSupprimeLUtilisateur(String arg0) throws Throwable {
        WebSite.getSecondDriver().findElements(By.className("btn-supprimer-utilisateur"))
                .stream()
                .filter(t -> t.getAttribute("data-user-name").contains(arg0)).findFirst()
                .ifPresent(WebElement::click);
        JavascriptExecutor js = (JavascriptExecutor) WebSite.getSecondDriver();
        js.executeScript("arguments[0].click();", WebSite.getSecondDriver().findElement(By.id("modale-valider-suppression-btn")));
    }

    @Et("^le second utilisateur est sur l'onglet de gestion des utilisateurs$")
    public void leSecondUtilisateurEstSurLOngletDeGestionDesUtilisateurs() {
        String URL = WebSite.getSecondDriver().getCurrentUrl();
        assert(URL.contains("utilisateurs"));
    }

    @Et("^une nouvelle page ouverte sur l'onglet de suppression d'une oeuvre$")
    public void uneNouvellePageOuverteSurLOngletDeSuppressionDUneOeuvre() {
        WebSite.newSecondDriver();
        new GlobalFixture().accesSecondDriver();
        new ConnexionFixture().lUtilisateurConnecteAdminSecond();
        WebSite.getSecondDriver().findElement(By.id("go-to-amdin-btn")).click();
        WebSite.getSecondDriver().findElement(By.id("go-to-admin-oeuvres")).click();
    }

    @Et("^l'utilisateur sur l'onglet de suppression d'une oeuvre$")
    public void lUtilisateurSurLOngletDeSuppressionDUneOeuvre() {
        WebSite.getDriver().findElement(By.id("go-to-amdin-btn")).click();
        WebSite.getDriver().findElement(By.id("go-to-admin-oeuvres")).click();
    }

    @Quand("^le second utilisateur supprime l'oeuvre \"([^\"]*)\"$")
    public void leSecondUtilisateurSupprimeLOeuvre(String arg0) throws Throwable {
        JavascriptExecutor js = (JavascriptExecutor) WebSite.getSecondDriver();
        List<WebElement> l = WebSite.getSecondDriver().findElements(By.className("btn-supprimer-oeuvre"));
        l.stream().filter(t -> t.getAttribute("data-oeuvre-name").equals(arg0)).findFirst().ifPresent(WebElement::click);
        js.executeScript("arguments[0].click();", WebSite.getSecondDriver().findElement(By.id("modale-valider-suppression-btn")));
    }

    @Et("^le second utilisateur est sur l'onglet de suppression d'une oeuvre$")
    public void leSecondUtilisateurEstSurLOngletDeSuppressionDUneOeuvre() {
        assert WebSite.getSecondDriver().getCurrentUrl().endsWith("oeuvres");
    }

    @Quand("^l'utilisateur renseigne le nom de catégorie \"([^\"]*)\"$")
    public void lUtilisateurRenseigneLeNomDeCatégorie(String arg0) throws Throwable {
        WebSite.getDriver().findElement(By.id("form_nom")).sendKeys(arg0);
        WebSite.getDriver().findElement(By.id("ajout-categorie-btn")).click();
    }

    @Et("^la catégorie \"([^\"]*)\" créée préalablement$")
    public void laCatégorieCrééePréalablement(String arg0) throws Throwable {
        new ConnexionFixture().lUtilisateurConnecteEnTantQuAdministrateur();
        laCategorieCreee(arg0);
        new ConnexionFixture().lUtilisateurSeDeconnecte();
    }
}
