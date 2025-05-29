// string_functions.c
// Name
// Date

#include "string_functions.h"

void displayMessage(void)
{
    puts("What is your favorite movie?");
}

void storeAndCountString(char *movie) 
{
    fgets(movie, 30, stdin);  // stores user textual input

    // Remove newline character if present
    size_t len = strlen(movie);
    if (len > 0 && movie[len - 1] == '\n') {
        movie[len - 1] = '\0';
    }

    printf("\nThere are %lu characters (including spaces) in your movie title.\n", strlen(movie));  // strlen counts the characters stored in the array
}
