import cucumber.api.PendingException;
import cucumber.api.java.fr.Alors;
import cucumber.api.java.fr.Et;
import cucumber.api.java.fr.Etantdonné;
import cucumber.api.java.fr.Quand;
import org.openqa.selenium.By;

public class GlobalFixture {
    @Etantdonné("^l'accès au site effectué$")
    public void lAccesAuSiteEffectue() {
        WebSite.endDriver();
        if (WebSite.DEBUG)
            WebSite.getDriver().get("http://localhost:8000/connexion");
        else {
            WebSite.getDriver().get("http://m2gl.deptinfo-st.univ-fcomte.fr/~m2test6/preprod/connexion");
            new ConnexionFixture().lUtilisateurConnecteEnTantQuAdministrateur();
            WebSite.getDriver().get("http://m2gl.deptinfo-st.univ-fcomte.fr/~m2test6/preprod/kill-cache");
            WebSite.getDriver().get("http://m2gl.deptinfo-st.univ-fcomte.fr/~m2test6/preprod/connexion");
            new ConnexionFixture().lUtilisateurSeDeconnecte();
            WebSite.getDriver().get("http://m2gl.deptinfo-st.univ-fcomte.fr/~m2test6/preprod/connexion");
        }
    }

    public void accesSecondDriver() {
        if (WebSite.DEBUG)
            WebSite.getSecondDriver().get("http://localhost:8000/connexion");
        else
            WebSite.getSecondDriver().get("http://m2gl.deptinfo-st.univ-fcomte.fr/~m2test6/preprod/connexion");
    }

    @Alors("^l'utilisateur est redirigé$")
    public void lUtilisateurEstRedirige() {
        //TODO
    }

    @Alors("^le second utilisateur est redirigé$")
    public void leSecondUtilisateurEstRedirige() {
        //TODO
    }

    @Quand("^l'utilisateur accède à la page de connexion$")
    public void lUtilisateurAccedeALaPageDeConnexion() {
        if (WebSite.DEBUG)
            WebSite.getDriver().get("http://localhost:8000/connexion");
        else
            WebSite.getDriver().get("http://m2gl.deptinfo-st.univ-fcomte.fr/~m2test6/preprod/connexion");
    }

    @Et("^l'utilisateur sur la page principale$")
    public void lUtilisateurSurLaPagePrincipale() {
        if (WebSite.DEBUG)
            WebSite.getDriver().get("http://localhost:8000/");
        else
            WebSite.getDriver().get("http://m2gl.deptinfo-st.univ-fcomte.fr/~m2test6/preprod/");
    }

    @Et("^l'utilisateur est sur la page principale$")
    public void lUtilisateurEstSurLaPagePrincipale() {
        if (WebSite.DEBUG)
            assert WebSite.getDriver().getCurrentUrl().equals("http://localhost:8000/");
        else
            assert WebSite.getDriver().getCurrentUrl().equals("http://m2gl.deptinfo-st.univ-fcomte.fr/~m2test6/preprod/");
    }

    @Quand("^l'utilisateur clique sur le bouton de retour à l'acceuil$")
    public void lUtilisateurCliqueSurLeBoutonDeRetourALAcceuil() {
        WebSite.getDriver().findElement(By.id("btn-retour-acceuil")).click();
    }


    @Et("^l'utilisateur est sur la page d'ajout d'une oeuvre$")
    public void lUtilisateurEstSurLaPageDAjoutDUneOeuvre() {
        assert WebSite.getDriver().getCurrentUrl().endsWith("ajout-oeuvre");
    }


    @Etantdonné("^l'accès au site effectué avec JS$")
    public void lAccèsAuSiteEffectuéAvecJS() {
        WebSite.endDriver();
        WebSite.getDriverWithJS();
        if (WebSite.DEBUG)
            WebSite.getDriver().get("http://localhost:8000/connexion");
        else {
            WebSite.getDriver().get("http://m2gl.deptinfo-st.univ-fcomte.fr/~m2test6/preprod/connexion");
            new ConnexionFixture().lUtilisateurConnecteEnTantQuAdministrateur();
            WebSite.getDriver().get("http://m2gl.deptinfo-st.univ-fcomte.fr/~m2test6/preprod/kill-cache");
            WebSite.getDriver().get("http://m2gl.deptinfo-st.univ-fcomte.fr/~m2test6/preprod/connexion");
            new ConnexionFixture().lUtilisateurSeDeconnecte();
            WebSite.getDriver().get("http://m2gl.deptinfo-st.univ-fcomte.fr/~m2test6/preprod/connexion");
        }
    }

    @Quand("^l'utilisateur accède à la page \"([^\"]*)\" par le lien$")
    public void lUtilisateurAccèdeÀLAdministrationParLeLien(String arg0) {
        if (WebSite.DEBUG)
            WebSite.getDriver().get("http://localhost:8000/" + arg0);
        else
            WebSite.getDriver().get("http://m2gl.deptinfo-st.univ-fcomte.fr/~m2test6/preprod/" + arg0);
    }
}
