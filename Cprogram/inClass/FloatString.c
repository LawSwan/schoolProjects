// Amber Lawson
//FloatString.c
// CIS126 1.6
//5/10/24.
#include <stdio.h>

int main() {
    char CharValue;
    float FloatValue;

    printf("Enter a character: ");
    scanf(" %c", &CharValue);  // The space before %c helps to clear the buffer

    printf("Please enter a Float value (decimals): ");
    scanf("%f", &FloatValue);

    printf("The character you entered is: %c and the Float value you entered is: %.2f\n", CharValue, FloatValue);

    return 0;
}


#include <stdio.h>
