//The Importance of Writing Secure Code
//5.1
//Amber Lawson

#include <stdio.h>

int main(void)
{
    char buffer[10];
    // Writing beyond the buffer's limit
    for (int i = 0; i < 11; i++) {
        buffer[i] = 'A';
    }
    printf("Buffer overflow example\n");
    return 0;
}
//Buffer overload can go beyond memory allocations set within the array. Fifteen elements of the array go out of bounds, causing security vulnerabilities.
