//Pass an Array to a Function to Compute a Total
//Amber Lawson
// May 29, 2024


#include <stdio.h>


// Function prototype
int computeTotal(int scores[], int size);

int main(void)
{
    int scores[9];  // Declare an array to store 9 values
    int total;      // Variable to store the total score
    
    // Use a for loop to store user-entered scores for all 9 holes
    for (int i = 0; i < 9; i++) {
        printf("Enter score for hole %d: ", i + 1);
        scanf("%d", &scores[i]);
    }

    // Call the computeTotal function and pass the array
    total = computeTotal(scores, 9);

    // Display the overall total score
    printf("The total score is: %d\n", total);

    return 0;
}

// Function to compute the total score
int computeTotal(int scores[], int size) {
    int total = 0;

    // Use a for loop to compute the total score
    for (int i = 0; i < size; i++) {
        total += scores[i];  // Accumulating total statement
    }

    return total;
}
