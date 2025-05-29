//
//  employmentService.c
//  Cprogram
//
//  Created by Amber  on 5/17/24.
//



#include <stdio.h>
#include "employmentService.h"

void determineReward(int years) {
    // Determine the reward based on years of service
    if (years >= 25) {
        printf("You receive a gold watch.\n");
    } else if (years >= 15 && years < 25) {
        printf("You receive a silver pen.\n");
    } else if (years >= 5 && years < 15) {
        printf("You receive a bronze pin.\n");
    } else {
        printf("You receive a happy meal!\n");
    }
}
