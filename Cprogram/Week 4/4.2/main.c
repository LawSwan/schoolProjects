// Introduction to Arrays - Initialization, Assigning Values, and User Input
// Amber Lawson
//May 29 2024

#include <stdio.h>

int main(void)
{
    int values[3] = {3, 10, 6};  // array declaration and initialization of values
    int counter;                 // control variable for loop to step through each array element

    for (counter = 0; counter <= 2; counter++)  // loop to step through each array element displaying the values stored in the elements
    {
        printf("The value in element %d of the initialized array is: %d\n", counter, values[counter]);
    }

    values[0] = 15;  // using assignment statements to set values into each array element
    values[1] = 18;
    values[2] = 19;

    printf("\n\n");  // used for formatting purposes

    for (counter = 0; counter <= 2; counter++)  // loop to step through each array element displaying the values stored in the elements
    {
        printf("The value in element %d of the assigned values in the array is: %d\n", counter, values[counter]);
    }

    printf("\n\n");  // used for formatting purpose

    for (counter = 0; counter <= 2; counter++)  // loop to step through each array element allowing the user to enter values
    {
        printf("Enter three values: ");
        scanf("%d", &values[counter]);
    }

    printf("\n\n");  // used for formatting purposes

    for (counter = 0; counter <= 2; counter++)  // loop to step through each array element displaying the values the user entered
    {
        printf("The value in element %d of user input is: %d\n", counter, values[counter]);
    }
}
