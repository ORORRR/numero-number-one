
import cucumber.api.PendingException;
import cucumber.api.java.fr.Alors;
import cucumber.api.java.fr.Et;
import cucumber.api.java.fr.Quand;

import org.openqa.selenium.*;

import java.util.List;
import java.util.stream.Collectors;

public class MembreFixture {

    @Alors("^le lien d'accès à la page des classements est visible$")
    public void leLienDAccesALaPageDesClassementsEstVisible() {
        List<WebElement> elements = WebSite.getDriver().findElements(By.id("go-to-classement-btn"));
        assert(elements.size() > 0);
    }

    @Alors("^le lien d'accès à la page des classements n'est pas visible$")
    public void leLienDAccesALaPageDesClassementsEstPasVisible() {
        assert  WebSite.getDriver().findElements(By.id("go-to-classement-btn")).isEmpty();
    }

    @Et("^l'utilisateur sur le menu des classements$")
    public void lUtilisateurSurLeMenuDesClassements() {
        WebSite.getDriver().findElement(By.id("go-to-classement-btn")).click();
    }

    @Quand("^l'utilisateur sélectionne la deuxième catégorie$")
    public void lUtilisateurSelectionneLaDeuxiemeCategorie() {
        throw new PendingException();
    }


    @Et("^l'utilisateur va sur le menu des classements$")
    public void lUtilisateurVaSurLeMenuDesClassements() {
        WebSite.getDriver().findElement(By.id("go-to-classement-btn")).click();
    }

    @Et("^sélectionne la catégorie \"([^\"]*)\"$")
    public void selectionneLaCategorie(String arg0) throws Throwable {
        WebSite.getDriver().findElement(By.id("form_nom")).findElements(By.tagName("option"))
                .stream()
                .filter(t -> t.getText().equals(arg0))
                .findFirst()
                .ifPresent(WebElement::click);
        Thread.sleep(500);
    }

    @Alors("^l'oeuvre \"([^\"]*)\" est en position \"([^\"]*)\"$")
    public void lOeuvreEstEnPosition(String arg0, String arg1) throws Throwable {
        List<WebElement> l = WebSite.getDriver().findElements(By.tagName("a"));
        l = l.stream().filter(t -> !t.findElements(By.tagName("h4")).isEmpty()).collect(Collectors.toList());
        assert l.get(Integer.parseInt(arg1)-1).findElement(By.tagName("h4")).getText().equals(arg0);
    }

    @Et("^l'utilisateur valide le classement$")
    public void lUtilisateurValideLeClassement() throws Throwable {
        WebSite.getDriver().findElement(By.id("afficher-classement")).click();
        Thread.sleep(1000);
    }
}
