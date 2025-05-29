//Amber Lawson
//  main.c
//  3.1
//
// 5/20/24.
//

#include <stdio.h>

int add(int x, int y);      // function prototype for addition
int subtract(int x, int y); // function prototype for subtraction
int multiply(int x, int y); // function prototype for multiplication

int main(void)
{
    int a, b;
    int sum;  // declares the variables used in the program
    
    printf("Enter the first number: ");  // prompt to input the first number
    scanf("%d", &a);  // stores the first number in variable a
    
    printf("Enter the second number: ");  // prompt to input the second number
    scanf("%d", &b);  // stores the second number in variable b
    
    sum = add(a, b);  // function call to add
   
   
    
    printf("The sum of the two numbers is: %d\n", sum);  // displays the sum after executing add function
  
    
    return 0;
}

int add(int x, int y) {  // function definition for addition
    return x + y;
}

int subtract(int x, int y) {  // function definition for subtraction
    return x - y;
}

int multiply(int x, int y) {  // function definition for multiplication
    return x * y;
}
