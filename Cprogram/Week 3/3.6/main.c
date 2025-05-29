//Amber Lawson
//3.6 dogAge
//May 24, 2024

#include <stdio.h>

// Function prototypes
void displayMessage(void);
int computeHumanYears(int dogAge);

int main(void)
{
    int dogAge;
    
    // Call the function to display message and get dog's age
    displayMessage();
    scanf("%d", &dogAge);
    
    // Call the function to compute and display the dog's age in human years
    int humanYears = computeHumanYears(dogAge);
    printf("Your dog's age in human years is: %d\n", humanYears);
    
    // Display end of program message
    puts("End of Program");
    
    return 0;
}

// Function to display message and prompt user for dog's age
void displayMessage(void)
{
    puts("Please enter your dog's age in years:");
}

// Function to compute and display the dog's age in human years
int computeHumanYears(int dogAge) {
    return dogAge * 7;
}
