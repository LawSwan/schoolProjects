//Secure C Programming
// Amber Lawson
// June 3, 2024

#include <stdio.h>
#include <string.h> // Include string.h for strcmp

int main(void)
{
    char userPass[20];
    int isUserAuth = 0;
    printf("Enter your password: ");
    fgets(userPass, sizeof(userPass), stdin); // Use fgets instead of gets

    // Remove the newline character that fgets may store
    userPass[strcspn(userPass, "\n")] = 0;

    if (strcmp(userPass, "password") == 0) // Fix the strcmp syntax
    {
        printf("correct password\n");
        isUserAuth = 1;
    }
    else
    {
        printf("Wrong password\n");
    }

    if (isUserAuth)
    {
        printf("Root privileges given to user!\n");
    }

    return 0; // Add return 0 to indicate successful program termination
}
