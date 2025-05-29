//Amber J Lawson
//3.7 LetterCase
//May 24, 2024



#include <stdio.h>
#include <ctype.h>
#include "letterCase.h"

// Function to prompt the user
void promptUser(void)
{
    puts("Please enter a letter:");
}

// Function to check the case of the letter and display a message
void checkLetterCase(char letter) {
    if (islower(letter)) {
        puts("The letter is lowercase.");
    } else if (isupper(letter)) {
        puts("The letter is uppercase.");
    } else {
        puts("The input is not a letter.");
    }
}

int main(void)
{
    char letter;

    // Prompt the user to enter a letter
    promptUser();
    scanf(" %c", &letter);

    // Check the case of the letter and display appropriate message
    checkLetterCase(letter);

    return 0;
}
