//
//  main.c
//  2.3
//
//  Created by Amber  on 5/19/24.
//

#include <stdio.h>
#include "lessThanGreaterThan.h"

int main(void) {
    int num1, num2;

    // Prompt the user to enter the first number
    printf("Enter the first number: ");
    scanf("%d", &num1);

    // Prompt the user to enter the second number
    printf("Enter the second number: ");
    scanf("%d", &num2);

    // Compare the two numbers and print the appropriate message
    compareNumbers(num1, num2);

    return 0;
}

