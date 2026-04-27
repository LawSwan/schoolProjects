// WashingMachine.cs
// WashingMachine class for the Washing Machine Application
// Implements the sequence diagram for wash operations

using System;

namespace WashingMachineApp
{
    public class WashingMachine
    {
        // Attributes
        private int washTime;           // Time for wash cycle
        private int rinseTime;          // Time for rinse cycle
        private int spinTime;           // Time for spin cycle
        private WaterSensor waterSensor; // Water sensor object
        private Timer timer;            // Timer object

        // Constructor - Creates WashingMachine with specified times
        // Parameters: washTime=30, rinseTime=15, spinTime=10
        public WashingMachine(int washTime, int rinseTime, int spinTime)
        {
            this.washTime = washTime;
            this.rinseTime = rinseTime;
            this.spinTime = spinTime;
            // Instantiate WaterSensor with currentLevel=0, desiredLevel=0
            this.waterSensor = new WaterSensor(0, 0);
            // Instantiate Timer
            this.timer = new Timer(0, 0, 0);
        }

        // Methods

        // GetCurrentWaterLevel - Gets current water level from sensor
        public int GetCurrentWaterLevel()
        {
            return waterSensor.GetCurrentLevel();
        }

        // GetDesiredWaterLevel - Gets desired water level from sensor
        public int GetDesiredWaterLevel()
        {
            return waterSensor.GetDesiredLevel();
        }

        // SetCurrentWashTime - Sets the wash time on the timer
        private void SetCurrentWashTime()
        {
            Console.WriteLine("  [WashingMachine] Setting current wash time to: " + washTime);
            timer.SetDuration(washTime);
        }

        // SetCurrentRinseTime - Sets the rinse time on the timer
        private void SetCurrentRinseTime()
        {
            Console.WriteLine("  [WashingMachine] Setting current rinse time to: " + rinseTime);
            timer.SetDuration(rinseTime);
        }

        // Wash - Performs the wash operation
        public void Wash()
        {
            Console.WriteLine("  [WashingMachine] Washing clothes...");
            timer.Start();
            timer.Count();
            Console.WriteLine("  [WashingMachine] Wash cycle complete.");
        }

        // Rinse - Performs the rinse operation
        public void Rinse()
        {
            Console.WriteLine("  [WashingMachine] Rinsing clothes...");
            timer.Start();
            timer.Count();
            Console.WriteLine("  [WashingMachine] Rinse cycle complete.");
        }

        // Spin - Spins the drum to remove excess water
        public void Spin()
        {
            Console.WriteLine("  [WashingMachine] Spinning drum to remove excess water...");
        }

        // Fill - Fills the drum with water to desired level
        public void Fill()
        {
            Console.WriteLine("  [WashingMachine] Filling drum with water...");
            int current = waterSensor.GetCurrentLevel();
            int desired = waterSensor.GetDesiredLevel();
            Console.WriteLine("  [WashingMachine] Filling from level " + current + " to level " + desired);
            Console.WriteLine("  [WashingMachine] Drum filled with water.");
        }

        // Empty - Empties water from the drum
        public void Empty()
        {
            Console.WriteLine("  [WashingMachine] Emptying water from drum...");
            Console.WriteLine("  [WashingMachine] Drum emptied.");
        }

        // StandardWash - Performs a standard wash cycle following sequence diagram
        // Sequence: SetCurrentWashTime -> Get water levels -> Fill -> Wash -> Rinse -> Empty
        public void StandardWash()
        {
            Console.WriteLine("[WashingMachine] Starting Standard Wash cycle...");
            Console.WriteLine();

            // Step 1: Set current wash time
            SetCurrentWashTime();

            // Step 2: Get current and desired water levels from WaterSensor
            int currentLevel = waterSensor.GetCurrentLevel();
            int desiredLevel = waterSensor.GetDesiredLevel();

            // Step 3: Fill the drum with water
            Fill();
            Console.WriteLine();

            // Step 4: Perform wash cycle
            Wash();
            Console.WriteLine();

            // Step 5: Set rinse time and perform rinse cycle
            SetCurrentRinseTime();
            Rinse();
            Console.WriteLine();

            // Step 6: Empty the drum
            Empty();

            Console.WriteLine();
            Console.WriteLine("[WashingMachine] Standard Wash cycle completed.");
        }

        // TwiceRinse - Performs two rinse cycles
        public void TwiceRinse()
        {
            Console.WriteLine("[WashingMachine] Performing double rinse cycle...");
            Rinse();
            Rinse();
            Console.WriteLine("[WashingMachine] Double rinse completed.");
        }

        // TurnOn - Turns on the washing machine
        public void TurnOn()
        {
            Console.WriteLine("[WashingMachine] Turning ON...");
            Console.WriteLine("[WashingMachine] Washing machine is now ON and ready.");
            Console.WriteLine();
        }

        // TurnOff - Turns off the washing machine
        public void TurnOff()
        {
            Console.WriteLine("[WashingMachine] Turning OFF...");
            Console.WriteLine("[WashingMachine] Washing machine is now OFF.");
        }

        // SetupWaterSensor - Configures the water sensor with specified levels
        // Parameters: currentLevel=3, desiredLevel=8 (from main)
        public void SetupWaterSensor(int currentLevel, int desiredLevel)
        {
            Console.WriteLine("[WashingMachine] Setting up water sensor...");
            waterSensor.SetCurrentLevel(currentLevel);
            waterSensor.SetDesiredLevel(desiredLevel);
            Console.WriteLine("[WashingMachine] Water sensor configured - Current: " + currentLevel + ", Desired: " + desiredLevel);
            Console.WriteLine();
        }
    }
}
