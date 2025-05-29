#include "passCode.h"

void passCode(void)  // Function definition
{
    int userPasscode;
    int attempts = 0;
    int maxAttempts = 3;
    int secretPasscode = 11862;

    while (attempts < maxAttempts) {
        printf("Enter the passcode: ");
        scanf("%d", &userPasscode);

        if (userPasscode == secretPasscode) {
            printf("Correct passcode!\n");
            return;
        } else {
            printf("Try Again\n");
            attempts++;
        }
    }
    printf("Out of attempts\n");
}
