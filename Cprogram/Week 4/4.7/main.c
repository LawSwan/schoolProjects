//Character Arrays
//Amber Lawson
// May 29, 2024

#include <stdio.h>
#include <string.h>

int main(void)
{
    // Create two character arrays
    char word1[] = "ECPI";
    char word2[] = {'U', 'n', 'i', 'v', 'e', 'r', 's', 'i', 't', 'y', '\0'};

    // Display the words
    printf("First word: %s\n", word1);
    printf("Second word: %s\n", word2);

    // Display the length of each word
    printf("The length of the first word is: %zu\n", strlen(word1));
    printf("The length of the second word is: %zu\n", strlen(word2));

    return 0;
}
