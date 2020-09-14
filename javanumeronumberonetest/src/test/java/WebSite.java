import com.gargoylesoftware.htmlunit.BrowserVersion;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.htmlunit.HtmlUnitDriver;

import java.lang.ref.Reference;
import java.util.HashMap;
import java.util.Map;
import java.util.concurrent.TimeUnit;
import java.util.logging.Level;

public class WebSite {
    private static HtmlUnitDriver driver;
    private static Map<String, Object> vars;
    private static JavascriptExecutor js;
    private static HtmlUnitDriver secondDriver;

    static final boolean DEBUG = false;

    public static HtmlUnitDriver getDriver(){
        java.util.logging.Logger.getLogger("com.gargoylesoftware.htmlunit").setLevel(Level.OFF);
        if (driver == null) {
            driver = new HtmlUnitDriver(true);
            driver.setJavascriptEnabled(false);
        }
        return driver;
    }

    public static HtmlUnitDriver getSecondDriver(){
        return secondDriver;
    }

    public static void endDriver() {
        if (driver != null){
            driver.quit();
            driver = null;
        }
    }

    public static void newSecondDriver() {
        secondDriver = new HtmlUnitDriver(BrowserVersion.INTERNET_EXPLORER_11,true);
    }

    public static void getDriverWithJS() {
        driver = new HtmlUnitDriver(BrowserVersion.INTERNET_EXPLORER_11, true);
    }
}
