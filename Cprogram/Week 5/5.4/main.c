//Checking Passwords Program
// Amber Lawson
// June 3,2024

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <ctype.h>

void password_read(char password[], size_t size);
int password_check(char password[]);

int main(void) {
    char password[100];
    int sum;

    password_read(password, sizeof(password));

    sum = password_check(password);

    if (sum) {
        printf("Your password is correct\n");
    } else {
        printf("Your password is lacking\n");
    }

    return 0;
}

// Function to read the user's input
void password_read(char password[], size_t size) {
    printf("Enter password:\n");
    printf("Password needs to contain at least one uppercase letter, one digit, and the '$' symbol: ");
    fgets(password, size, stdin);
    // Remove the newline character that fgets may store
    password[strcspn(password, "\n")] = 0;
}

// Function to check if the password meets the requirements
int password_check(char password[]) {
    int upper = 0;
    int digit = 0;
    int dollar = 0;
    int i;

    for (i = 0; i < strlen(password); i++) {
        if (isupper(password[i])) {
            upper = 1;
        } else if (isdigit(password[i])) {
            digit = 1;
        } else if (password[i] == '$') {
            dollar = 1;
        }
    }
    return (upper && digit && dollar);
}
