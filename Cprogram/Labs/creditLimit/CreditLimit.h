//
//  CreditLimit.h
//  LabcreditLimit
//
//  Created by Amber  on 5/21/24.
//

#ifndef CreditLimit_h
#define CreditLimit_h

#include <stdio.h>

// Function to check if the credit limit is exceeded
void checkCreditLimit(int accountNumber, float beginningBalance, float charges, float credits, float creditLimit) {
    float newBalance = beginningBalance + charges - credits;

    printf("Account Number: %d\n", accountNumber);
    printf("Credit Limit: %.2f\n", creditLimit);
    printf("New Balance: %.2f\n", newBalance);

    if (newBalance > creditLimit) {
        printf("Credit Limit Exceeded.\n");
    } else {
        printf("Credit Limit Not Exceeded.\n");
    }
    printf("------------------------------\n");
}

#endif //CreditLimit_h //
