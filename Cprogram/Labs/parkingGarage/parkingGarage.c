//
//  parkingGarage.c
//  Created by Amber  on 5/22/24.

#include "parkingGarage.h"

float calculateCharges(int hours) {
    float charge = 20.00; // Minimum fee for up to three hours

    if (hours > 3) {
        charge += (hours - 3) * 5.00; // Additional $5.00 per hour for hours in excess of three
    }
    
    if (charge > 50.00) {
        charge = 50.00; // Maximum charge for 24-hour period
    }

    return charge;
}
