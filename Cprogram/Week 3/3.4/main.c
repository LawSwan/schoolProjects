//
//  main.c
//  3.4
//
//  Created by Amber  on 5/23/24.
//

#include <stdio.h>
#include "math_functions.h"

void calculateSquareRoot(float number) {
    printf("The square root of %.0f is: %.2f\n", number, sqrt(number));
}

void calculateCubedRoot(float number) {
    printf("The cubed root of %.0f is: %.2f\n", number, cbrt(number));
}

int main(void)
{
    float number;

    printf("Enter a number: ");
    scanf("%f", &number);

    calculateSquareRoot(number);  // Call the function to calculate square root
    calculateCubedRoot(number);   // Call the function to calculate cubed root

    return 0;
}
