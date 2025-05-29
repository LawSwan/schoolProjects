//
//  CreditLimit.c
//  LabcreditLimit
//
//  Created by Amber  on 5/21/24.
//

#include "CreditLimit.h"
int main(void)
{
    int accountNumber;
    float beginningBalance, charges, credits, creditLimit;

    while (1) {
        // Prompt user for account number
        printf("Enter account number (-1 to end): ");
        scanf("%d", &accountNumber);

        // Check for sentinel value to end loop
        if (accountNumber == -1) {
            break;
        }

        // Input data for the account
        printf("Enter beginning balance: ");
        scanf("%f", &beginningBalance);
        printf("Enter total charges: ");
        scanf("%f", &charges);
        printf("Enter total credits: ");
        scanf("%f", &credits);
        printf("Enter credit limit: ");
        scanf("%f", &creditLimit);

        // Check if the credit limit is exceeded
        checkCreditLimit(accountNumber, beginningBalance, charges, credits, creditLimit);
    }

    return 0;
}
