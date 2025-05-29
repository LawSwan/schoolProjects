//
//  main.c
//  2.4
//
//  Created by Amber  on 5/19/24.
//

#include <stdio.h>
#include "factors.h"

int main(void) {
    int num;

    // Prompt the user to enter a number
    printf("Enter a number: ");
    scanf("%d", &num);

    // Find and print factors of the number
    findAndPrintFactors(num);

    return 0;
}
