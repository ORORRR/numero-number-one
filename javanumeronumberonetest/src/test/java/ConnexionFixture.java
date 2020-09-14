import cucumber.api.Pending;
import cucumber.api.PendingException;
import cucumber.api.java.fr.Et;
import cucumber.api.java.fr.Quand;
import org.openqa.selenium.By;
import org.openqa.selenium.Keys;
import org.openqa.selenium.WebElement;

import java.util.List;

public class ConnexionFixture {
    @Et("^l'utilisateur connecté en tant qu'administrateur$")
    public void lUtilisateurConnecteEnTantQuAdministrateur() {
        WebSite.getDriver().findElement(By.id("username")).sendKeys("admin");
        WebSite.getDriver().findElement(By.id("password")).sendKeys("admin");
        WebSite.getDriver().findElement(By.id("password")).sendKeys(Keys.ENTER);
    }

    public void lUtilisateurConnecteAdminSecond(){
        WebSite.getSecondDriver().findElement(By.id("username")).sendKeys("admin");
        WebSite.getSecondDriver().findElement(By.id("password")).sendKeys("admin");
        WebSite.getSecondDriver().findElement(By.id("password")).sendKeys(Keys.ENTER);
    }

    @Quand("^l'utilisateur se déconnecte$")
    public void lUtilisateurSeDeconnecte() {
        WebSite.getDriver().findElement(By.id("logout-btn")).click();
    }

    @Et("^l'utilisateur connecté en tant que membre$")
    public void lUtilisateurConnecteEnTantQueMembre() {
        WebSite.getDriver().findElement(By.id("username")).sendKeys("frosqh");
        WebSite.getDriver().findElement(By.id("password")).sendKeys("1234");
        WebSite.getDriver().findElement(By.id("password")).sendKeys(Keys.ENTER);
    }

    @Quand("^l'utilisateur renseigne le login \"([^\"]*)\"$")
    public void lUtilisateurRenseigneLeLogin(String arg0) throws Throwable {
        WebSite.getDriver().findElement(By.id("username")).sendKeys(arg0);

    }

    @Et("^le mot de passe \"([^\"]*)\"$")
    public void leMotDePasse(String arg0) throws Throwable {
        WebSite.getDriver().findElement(By.id("password")).sendKeys(arg0);
        WebSite.getDriver().findElement(By.id("password")).sendKeys(Keys.ENTER);
    }

    @Et("^l'utilisateur est connecté en tant que \"([^\"]*)\"$")
    public void lUtilisateurEstConnecteEnTantQue(String arg0) throws Throwable {
        assert WebSite.getDriver().findElement(By.id("user-info")).getText().contains(arg0);
    }

    @Et("^le bouton de déconnexion est visible$")
    public void leBoutonDeDeconnexionEstVisible() {
        assert WebSite.getDriver().findElements(By.id("logout-btn")).size()>0;
    }

    @Et("^l'utilisateur n'est pas connecté$")
    public void lUtilisateurNEstPasConnecte() {
        assert WebSite.getDriver().findElements(By.id("user-info")).size() == 0;
    }

    @Et("^l'utilisateur déjà connecté$")
    public void lUtilisateurDejaConnecte() {
        lUtilisateurConnecteEnTantQueMembre();
    }

    @Et("^l'utilisateur est connecté$")
    public void lUtilisateurEstConnecte() {
            assert WebSite.getDriver().findElements(By.id("user-info")).size() > 0;
    }

    @Et("^l'utilisateur \"([^\"]*)\" créé$")
    public void lUtilisateurCree(String arg0) throws Throwable {
        // Write code here that turns the phrase above into concrete actions
        WebSite.getDriver().findElement(By.linkText("Créer un compte")).click();
        WebSite.getDriver().findElement(By.id("app_bundleuser_type_login")).sendKeys(arg0);
        WebSite.getDriver().findElement(By.id("app_bundleuser_type_plainPassword_first")).sendKeys("1234");
        WebSite.getDriver().findElement(By.id("app_bundleuser_type_plainPassword_second")).sendKeys("1234");
        WebSite.getDriver().findElement(By.id("inscription-submit-btn")).click();
        List<WebElement> collection = WebSite.getDriver().findElements(By.cssSelector(".text-danger"));
        if (collection.isEmpty()){
            lUtilisateurSeDeconnecte();
        } else {
            WebSite.getDriver().findElement(By.linkText("Connectez vous")).click();
        }
    }

    @Et("^l'utilisateur sur la page d'inscription$")
    public void lUtilisateurSurLaPageDInscription() {
        WebSite.getDriver().findElement(By.linkText("Créer un compte")).click();
    }

    @Et("^l'utilisateur est sur la page d'inscription$")
    public void lUtilisateurEstSurLaPageDInscription() {
        assert WebSite.getDriver().getCurrentUrl().equals("http://m2gl.deptinfo-st.univ-fcomte.fr/~m2test6/preprod/inscription");
    }

    @Et("^l'utilisateur est sur la page de connexion$")
    public void lUtilisateurEstSurLaPageDeConnexion() {
        assert WebSite.getDriver().getCurrentUrl().endsWith("connexion");
    }

    @Et("^l'utilisateur \"([^\"]*)\", \"([^\"]*)\" inscrit$")
    public void lUtilisateurInscrit(String arg0, String arg1) throws Throwable {
        WebSite.getDriver().findElement(By.linkText("Créer un compte")).click();
        WebSite.getDriver().findElement(By.id("app_bundleuser_type_login")).sendKeys(arg0);
        WebSite.getDriver().findElement(By.id("app_bundleuser_type_plainPassword_first")).sendKeys(arg1);
        WebSite.getDriver().findElement(By.id("app_bundleuser_type_plainPassword_second")).sendKeys(arg1);
        WebSite.getDriver().findElement(By.id("inscription-submit-btn")).click();
        List<WebElement> collection = WebSite.getDriver().findElements(By.cssSelector(".text-danger"));
        if (collection.isEmpty()){
            lUtilisateurSeDeconnecte();
        } else {
            WebSite.getDriver().findElement(By.linkText("Connectez vous")).click();
        };
    }

    @Et("^l'utilisateur connecté avec le compte \"([^\"]*)\", \"([^\"]*)\"$")
    public void lUtilisateurConnecteAvecLeCompte(String arg0, String arg1) throws Throwable {
        lUtilisateurSeDeconnecte();
        WebSite.getDriver().findElement(By.id("username")).sendKeys(arg0);
        WebSite.getDriver().findElement(By.id("password")).sendKeys(arg1);
        WebSite.getDriver().findElement(By.id("password")).sendKeys(Keys.ENTER);
    }

    @Quand("^l'utilisateur renseigne le nom d'utilisateur \"([^\"]*)\"$")
    public void lUtilisateurRenseigneLeNomDUtilisateur(String arg0) throws Throwable {
        WebSite.getDriver().findElement(By.id("app_bundleuser_type_login")).sendKeys(arg0);
    }

    @Et("^les mots de passe \"([^\"]*)\"$")
    public void lesMotsDePasse(String arg0) throws Throwable {
        lesMotsDePasse(arg0,arg0);
    }

    @Et("^les mots de passe \"([^\"]*)\",\"([^\"]*)\"$")
    public void lesMotsDePasse(String arg0, String arg1) throws Throwable {
        WebSite.getDriver().findElement(By.id("app_bundleuser_type_plainPassword_first")).sendKeys(arg0);
        WebSite.getDriver().findElement(By.id("app_bundleuser_type_plainPassword_second")).sendKeys(arg1);
        WebSite.getDriver().findElement(By.id("inscription-submit-btn")).click();
    }

    public void lUtilisateurConnecteEnTantQueMembre(String arg2) {
        WebSite.getDriver().findElement(By.id("username")).sendKeys(arg2);
        WebSite.getDriver().findElement(By.id("password")).sendKeys("1234");
        WebSite.getDriver().findElement(By.id("password")).sendKeys(Keys.ENTER);
    }

    @Quand("^l'utilisateur \"([^\"]*)\" s'inscrit$")
    public void lUtilisateurSInscrit(String arg0) throws Throwable {
        WebSite.getDriver().findElement(By.linkText("Créer un compte")).click();
        WebSite.getDriver().findElement(By.id("app_bundleuser_type_login")).sendKeys(arg0);
        WebSite.getDriver().findElement(By.id("app_bundleuser_type_plainPassword_first")).sendKeys("1234");
        WebSite.getDriver().findElement(By.id("app_bundleuser_type_plainPassword_second")).sendKeys("1234");
        WebSite.getDriver().findElement(By.id("inscription-submit-btn")).click();
    }

    @Et("^l'utilisateur \"([^\"]*)\" n'ayant pas été créé$")
    public void lUtilisateurNAyantPasÉtéCréé(String arg0) throws Throwable {
        lUtilisateurConnecteEnTantQuAdministrateur();
        new AdministrationFixture().lUtilisateurNExistantPas(arg0);
        lUtilisateurSeDeconnecte();
    }
}
