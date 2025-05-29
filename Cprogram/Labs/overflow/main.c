//  BUFFER OVERFLOW 5.2
//  Amber Lawson
//  June 7,2024


#include <stdio.h>
#include <string.h>

#define MAX_SIZE 10 // Define maximum array size using a constant

int main(void)
{
    char data[MAX_SIZE]; // Can store MAX_SIZE - 1 characters. Last cell is for the NULL character \0

    puts("Enter your string: "); // Enter a line of text containing NO spaces

    if (fgets(data, MAX_SIZE, stdin) != NULL) {
        // Remove the newline character if it's there
        size_t len = strlen(data);
        if (len > 0 && data[len - 1] == '\n') {
            data[len - 1] = '\0';
        } else {
            // Clear the remaining characters from the input buffer
            int c;
            while ((c = getchar()) != '\n' && c != EOF);
            printf("Your string is too large for the array size\n");
            return 1;
        }

        puts(data);
    } else {
        printf("Failed to read input\n");
    }

    return 0;
}
