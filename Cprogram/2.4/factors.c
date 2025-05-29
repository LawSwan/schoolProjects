//
//  factors.c
//  Cprogram
//
//  Created by Amber  on 5/17/24.



#include <stdio.h>
#include "factors.h"

void findAndPrintFactors(int num) {
    printf("Factors of %d are: ", num);
    for (int i = 1; i <= num; i++) {
        if (num % i == 0) {
            printf("%d ", i);
        }
    }
    printf("\n");
}
