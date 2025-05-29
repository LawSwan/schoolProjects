// Buffer Overflow Conditions
// Amber Lawson
// June 3, 2024
#include <stdio.h>


int main(void)
{
    // Declare an array of 10 integers
    int n[10];
    int i, j;

    // Initialize elements of the array
    for (i = 0; i < 10; i++) // Corrected the loop to iterate from 0 to 9
    {
        n[i] = i + 100; // Set element at location i to i + 100
    }

    // Output each array element's value
    for (j = 0; j < 10; j++) // Corrected the loop to iterate from 0 to 9
    {
        printf("Element[%d] = %d\n", j, n[j]);
    }

    // Output the 'tenth' element again
    // Why is it different from the last value?
    printf("Element[%d] = %d\n", 9, n[9]); // Corrected to print the last valid element

    return 0; // Indicate successful program termination
}
