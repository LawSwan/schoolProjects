// forLoops.c
//  Cprogram
//
//  Created by Amber  on 5/18/24.


#include <stdio.h>
#include "sumRange.h"

void calculateSumInRange(int start, int end) {
    int total = 0;

    for (int i = start; i <= end; i++) {
        total += i;
    }

    printf("The grand total of numbers from %d to %d is: %d\n", start, end, total);
}
