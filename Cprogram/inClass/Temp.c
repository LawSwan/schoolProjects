//
//  Temp.c
//  Addtion
//
//  Created by Amber  on 5/13/24.

#include <stdio.h>

int main(void)
{
    int tempCount = 0;
    int sum = 0;
    int temp;
    int average;

    while (tempCount < 5) {
        printf("What is today's temp in Virginia Beach? ");
        scanf("%d", &temp);
        sum += temp;
        tempCount++;
    }

    average = sum / tempCount;
    printf("The average temp is: %d\n", average);

    return 0;
}
