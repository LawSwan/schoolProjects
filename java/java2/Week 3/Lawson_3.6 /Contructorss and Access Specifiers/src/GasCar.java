public class GasCar extends Car {

    public GasCar(String fuel, String engine) {
        super(fuel, engine);
    }

    public GasCar(String engine) {
        super("Gasoline", engine);
    }

    public void updateFuel(String newFuel) {
        setFuel(newFuel);
    }
}
