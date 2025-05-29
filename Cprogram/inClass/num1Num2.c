//
//  num1Num2.c
//  CIS126
//
//  Created by Amber  on 5/8/24.
//

#include "num1Num2.h"
#include <stdio.h>

int main() {
    int num1, num2, multiply;

    printf("Enter two numbers: ");
    scanf("%d", &num1);
    scanf("%d", &num2);

    multiply = num1 * num2;

    printf("The numbers multiplied together are: %d\n", multiply);

    return 0;
}
