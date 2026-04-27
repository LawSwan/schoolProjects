// WaterSensor.cs
// WaterSensor class for the Washing Machine Application
// Monitors and controls water levels in the washing machine

using System;

namespace WashingMachineApp
{
    public class WaterSensor
    {
        // Attributes
        private int currentLevel;   // Current water level
        private int desiredLevel;   // Desired water level

        // Constructor - Creates a WaterSensor with specified levels
        // Parameters: currentLevel=0, desiredLevel=0 initially
        public WaterSensor(int currentLevel, int desiredLevel)
        {
            this.currentLevel = currentLevel;
            this.desiredLevel = desiredLevel;
        }

        // Methods

        // GetCurrentLevel - Returns the current water level
        public int GetCurrentLevel()
        {
            Console.WriteLine("  [WaterSensor] Getting current water level: " + currentLevel);
            return currentLevel;
        }

        // GetDesiredLevel - Returns the desired water level
        public int GetDesiredLevel()
        {
            Console.WriteLine("  [WaterSensor] Getting desired water level: " + desiredLevel);
            return desiredLevel;
        }

        // SetCurrentLevel - Sets a new current water level
        public void SetCurrentLevel(int newCurrentLevel)
        {
            Console.WriteLine("  [WaterSensor] Setting current water level to: " + newCurrentLevel);
            currentLevel = newCurrentLevel;
        }

        // SetDesiredLevel - Sets a new desired water level
        public void SetDesiredLevel(int newDesiredLevel)
        {
            Console.WriteLine("  [WaterSensor] Setting desired water level to: " + newDesiredLevel);
            desiredLevel = newDesiredLevel;
        }
    }
}
