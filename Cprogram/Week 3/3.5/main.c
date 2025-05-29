// main.c
#include "string_functions.h"

void display_string(const char *str) {
    puts(str);
}

void get_string(char *str, int size) {
    printf("What is your favorite movie? ");
    fgets(str, size, stdin);
    str[strcspn(str, "\n")] = '\0';  // Remove the newline character
}

size_t get_length(const char *str) {
    return strlen(str);
}

int main(void)
{
    char input[100];
    get_string(input, sizeof(input));
    
    printf("You entered: ");
    display_string(input);
    
    size_t length = get_length(input);
    printf("The length of the string is (including spaces): %zu\n", length);
    
    return 0;
}
