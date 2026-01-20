/*******************************************************************
 * Name: Amber Lawson
 * Date: 26 November 2025
 * Assignment: Car Inheritance and Composition Example
 * Description: Main application demonstrating the Car hierarchy.
 *******************************************************************/

public class App {
    public static void main(String[] args) {

        System.out.println("Amber Lawson Week 3 Car Inheritance Assessment");
        System.out.println();

        GasCar gas1 = new GasCar("V6");
        GasCar gas2 = new GasCar("V8");
        ElectricCar electric1 = new ElectricCar();

        gas2.updateFuel("Premium Gas");

        ParkingLot lot = new ParkingLot();
        lot.addCar(gas1);
        lot.addCar(gas2);
        lot.addCar(electric1);

        System.out.println("Parking Lot Cars:");
        System.out.println();

        for (Car car : lot.getCars()) {
            System.out.println(car);
            System.out.println();
        }
    }
}