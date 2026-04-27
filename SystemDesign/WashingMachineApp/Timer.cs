// Timer.cs
// Timer class for the Washing Machine Application
// Handles timing operations for wash and rinse cycles

using System;

namespace WashingMachineApp
{
    public class Timer
    {
        // Attributes
        private int value;      // Current timer value
        private int duration;   // Duration for the timer
        private int count;      // Count value

        // Constructor - Creates a new Timer with specified parameters
        public Timer(int initialValue, int initialDuration, int initialCount)
        {
            this.value = initialValue;
            this.duration = initialDuration;
            this.count = initialCount;
        }

        // Methods

        // GetDuration - Returns the current duration
        public int GetDuration()
        {
            return duration;
        }

        // SetDuration - Sets a new duration value
        public void SetDuration(int newDuration)
        {
            Console.WriteLine("    [Timer] Setting duration to: " + newDuration);
            this.duration = newDuration;
        }

        // GetValue - Returns the current value
        public int GetValue()
        {
            return value;
        }

        // SetValue - Sets a new value
        public void SetValue(int newValue)
        {
            this.value = newValue;
        }

        // GetCount - Returns the current count
        public int GetCount()
        {
            return count;
        }

        // SetCount - Sets a new count value
        public void SetCount(int newCount)
        {
            this.count = newCount;
        }

        // Count - Outputs the duration value (simulates counting)
        // This method displays the time that was set for the timer
        public void Count()
        {
            Console.WriteLine("    [Timer] Counting: " + duration + " seconds elapsed.");
        }

        // Start - Starts the timer countdown
        public void Start()
        {
            Console.WriteLine("    [Timer] Timer started for " + duration + " seconds.");
        }
    }
}
