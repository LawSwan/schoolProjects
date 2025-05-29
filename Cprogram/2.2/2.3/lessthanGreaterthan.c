//
//  lessthanGreaterthan.c
//  Cprogram
//
//  Created by Amber  on 5/17/24.
//

#include "lessthanGreaterthan.h"
#include <stdio.h>


void compareNumbers(int num1, int num2) 
{
    if (num1 > num2) {
        printf("%d is greater than %d\n", num1, num2);
    } else if (num1 < num2) {
        printf("%d is less than %d\n", num1, num2);
    } else {
        printf("%d is equal to %d\n", num1, num2);
    }
    
}

