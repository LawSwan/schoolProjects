/*******************************************************************
 * Name: Amber Lawson
 * Date: 26 November 2025
 * Assignment: Car Inheritance and Composition Example
 * Description: Parking lot containing multiple cars.
 *******************************************************************/

import java.util.ArrayList;

public class ParkingLot {

    private ArrayList<Car> cars = new ArrayList<>();

    public ArrayList<Car> getCars() {
        return cars;
    }

    public void addCar(Car car) {
        cars.add(car);
    }

    public void addCar(GasCar gas1) {
        addCar((Car) gas1);
    }
    public void addCar(ElectricCar electric1) {
        addCar((Car) electric1);
    }
}