/*******************************************************************
 * Name: Amber Lawson
 * Date: 11 December 2025
 * Assignment: SDC330 Final Practical Exam
 * Description: Kitchen class.
 * Concepts: Use of Constructors, Encapsulation, Access Specifiers
 ******************************************************************/

public class Kitchen {

    // Private fields show encapsulation
    private String style;
    private String applianceBrand;

    // Constructor
    public Kitchen(String style, String applianceBrand) {
        this.style = style;
        this.applianceBrand = applianceBrand;
    }

    public String getStyle() {
        return style;
    }

    public String getApplianceBrand() {
        return applianceBrand;
    }

    @Override
    public String toString() {
        return style + " styled kitchen with " + applianceBrand + " appliances.";
    }
}