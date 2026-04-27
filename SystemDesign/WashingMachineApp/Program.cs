// Program.cs
// Main entry point for the Washing Machine Application
// This class demonstrates the sequence diagram implementation

using System;

namespace WashingMachineApp
{
    public class Program
    {
        public static void Main(string[] args)
        {
            // Assignment Information - Only output from main()
            Console.WriteLine("========================================");
            Console.WriteLine("Assignment: Washing Machine Sequence Diagram");
            Console.WriteLine("Name: Amber Lawson");
            Console.WriteLine("========================================");
            Console.WriteLine();

            // Instantiate WashingMachine with specified parameters: washTime=30, rinseTime=15, spinTime=10
            WashingMachine washingMachine = new WashingMachine(30, 15, 10);

            // Call TurnOn method - starts the washing machine
            washingMachine.TurnOn();

            // Call SetupWaterSensor method with currentLevel=3, desiredLevel=8
            washingMachine.SetupWaterSensor(3, 8);

            // Call StandardWash method - performs wash and rinse cycles
            washingMachine.StandardWash();

            // Call TurnOff method - turns off the washing machine
            // Note: No Spin cycle as per diagram requirements
            washingMachine.TurnOff();
        }
    }
}
