import cucumber.api.CucumberOptions;
import cucumber.api.junit.Cucumber;
import org.junit.Before;
import org.junit.BeforeClass;
import org.junit.runner.RunWith;
import org.openqa.selenium.By;

@RunWith(Cucumber.class)
@CucumberOptions(plugin = {"pretty",  "html:target/test-report",
        "json:target/test-report/numeronumberoneCucumber.json",
        "junit:target/test-report/numeronumberoneCucumber.xml",
},
//        features = "src/test/resources/administration/creationCategorie.feature")
//        features = "src/test/resources/oeuvre/visualiserOeuvre.feature")
        features = "src/test/resources")

public class RunSiteTest {
    @BeforeClass
    public static void init(){
        if (WebSite.DEBUG)
            WebSite.getDriver().get("http://127.0.0.1:8000/inscription");
        else
            WebSite.getDriver().get("http://m2gl.deptinfo-st.univ-fcomte.fr/~m2test6/preprod/inscription");
        WebSite.getDriver().findElement(By.id("app_bundleuser_type_login")).sendKeys("frosqh");
        WebSite.getDriver().findElement(By.id("app_bundleuser_type_plainPassword_first")).sendKeys("1234");
        WebSite.getDriver().findElement(By.id("app_bundleuser_type_plainPassword_second")).sendKeys("1234");
        WebSite.getDriver().findElement(By.id("inscription-submit-btn")).click();
        WebSite.getDriver().quit();
        WebSite.endDriver();
        if (WebSite.DEBUG)
            WebSite.getDriver().get("http://127.0.0.1:8000/inscription");
        else
            WebSite.getDriver().get("http://m2gl.deptinfo-st.univ-fcomte.fr/~m2test6/preprod/inscription");
        WebSite.getDriver().findElement(By.id("app_bundleuser_type_login")).sendKeys("userTest");
        WebSite.getDriver().findElement(By.id("app_bundleuser_type_plainPassword_first")).sendKeys("1234");
        WebSite.getDriver().findElement(By.id("app_bundleuser_type_plainPassword_second")).sendKeys("1234");
        WebSite.getDriver().findElement(By.id("inscription-submit-btn")).click();
        WebSite.getDriver().quit();
    }
}