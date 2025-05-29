// Using Character Arrays
// Amber Lawson
// May 31, 2024

#include <stdio.h>

int main(void)
{
    char name[20];                      // array declaration
    char prompt[] = "Enter Your Name: ";  // array declaration and initialization
    char prompt1[] = "Your";            // I had to correct array declaration and initialization of string characters. This simplifies the initialization of the prompt1 array. XCODE will automatically add the null-terminator character \0.

    puts(prompt);                       // displays prompt using pliuts()
    fgets(name, sizeof(name), stdin);   // stores user's name using fgets(), 

    printf("%s", prompt1);              // displays prompt1 using %s and printf()
    printf(" name is: %s", name);       // displays the user's name using %s and printf()

    return 0;
}
