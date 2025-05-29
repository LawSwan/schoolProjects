//My Friends' Ages Program
//Amber Lawson
// May 29,2024

#include <stdio.h>


int main(void)

{
    // Display message
    char message[] = "My Friends' Ages Program";
    int ages[4];  // Array to store ages

    // Storing ages using assignment statements
    ages[0] = 25;
    ages[1] = 27;
    ages[2] = 24;
    ages[3] = 26;

    // Display the message
    puts(message);

    // Display each age stored in the array
    for (int i = 0; i < 4; i++) {
        printf("Friend %d's age is: %d\n", i + 1, ages[i]);
    }

    return 0;
}
