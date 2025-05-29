//Amber Lawson
// CIS126 3.2
// Calculator
//



#include <stdio.h>
#include "calculator.h"

// Function to display the initial message and prompt the user
void promptUser(void) 
{
    puts("Please enter two numbers:");
}

// Function to add two numbers and return the result
int addNumbers(int a, int b) {
    return a + b;
}

int main(void)
{
    int num1, num2, result;

    // Prompt the user to enter two numbers
    promptUser();

    // Read the two numbers from the user
    printf("Enter first number: ");
    scanf("%d", &num1);
    printf("Enter second number: ");
    scanf("%d", &num2);

    // Add the two numbers
    result = addNumbers(num1, num2);

    // Display the result
    printf("The sum of %d and %d is: %d\n", num1, num2, result);

    return 0;
}
