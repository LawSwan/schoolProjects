//
//  main.c
//  2.7
//
//  Created by Amber  on 5/19/24.
//
#include <stdio.h>
#include "employmentService.h"

int main(void) {
    int years;

    // Prompt the user to enter the number of years of employment service
    printf("Enter the number of years of employment: ");
    scanf("%d", &years);

    // Determine and print the reward based on years of service
    determineReward(years);

    return 0;
}
