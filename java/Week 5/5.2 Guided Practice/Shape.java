
public class Shape {

    private String color;

    public Shape(String color) {
        this.color = color;
    }

    // public accessors
    public String getColor()        { return color; }
    public void   setColor(String c){ color = c; }

    // display
    public void printShape() {
        System.out.printf("The Shape's color is %s.%n", color);
    }
}