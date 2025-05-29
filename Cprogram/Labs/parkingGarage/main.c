// Created by Amber  on 5/22/24
//  main.c
//  parkingGarage
//

#include <stdio.h>
#include "parkingGarage.h"

int main(void)
{
    int hours1, hours2, hours3;
    float charge1, charge2, charge3, totalReceipts;

    // Input hours parked for three customers
    printf("Enter hours parked for customer 1: ");
    scanf("%d", &hours1);
    printf("Enter hours parked for customer 2: ");
    scanf("%d", &hours2);
    printf("Enter hours parked for customer 3: ");
    scanf("%d", &hours3);

    // Calculate charges
    charge1 = calculateCharges(hours1);
    charge2 = calculateCharges(hours2);
    charge3 = calculateCharges(hours3);

    // Calculate total receipts
    totalReceipts = charge1 + charge2 + charge3;

    // Print results in tabular format
    printf("\nParking Charges\n");
    printf("Customer\tHours\tCharge\n");
    printf("1\t\t%d\t$%.2f\n", hours1, charge1);
    printf("2\t\t%d\t$%.2f\n", hours2, charge2);
    printf("3\t\t%d\t$%.2f\n", hours3, charge3);

    // Print total receipts
    printf("\nTotal Receipts: $%.2f\n", totalReceipts);

    return 0;
}

