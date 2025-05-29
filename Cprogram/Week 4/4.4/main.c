// Passing an array to a function to compute the average
// Amber Lawson
// May 29,2024

#include<stdio.h>

// Function prototype
float averageScores(float scores[5]);

int main(void)
{
    // Character array declaration storing a string
    char name[] = "ECPI University";
    
    // Array declaration and initialization
    float scores[5] = {78.7, 98.4, 83.7, 85.3, 97.2};
    
    // Variable to store the result
    float result;
    
    // Calling the function to compute the average
    result = averageScores(scores);
    
    // Printing the result
    printf("\nAt %s, your class average is: %.2f.", name, result);
    
    return 0;
}

// Function definition computing and displaying the average
float averageScores(float scores[5]) {
    // Initialize variables
    float average = 0.0;
    float total = 0.0;
    int counter;
    
    // Loop to compute the total score
    for(counter = 0; counter < 5; counter++) {
        printf("The score in element %d is: %.2f\n", counter, scores[counter]);
        total += scores[counter];  // Accumulating total
    }
    
    // Printing the total
    printf("Total = %.2f\n", total);
    
    // Compute the average
    average = total / 5;
    
    // Return the computed average
    return average;
}
