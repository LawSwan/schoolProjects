//
//  labPractice.c
//  labPractice
//
//  Created by Amber  on 5/21/24.
//// Online C compiler to run C program online

#include simpleCal.h
#include <stdio.h>
 
//prototype
void simpleCal(int x, int y);
 
int main(void)
{
// declaration
int num1, num2;
//assign
printf("Enter value for x : ");
scanf("%d ", &num1);
 
printf("Enter value for y : ");
scanf("%d ", &num2);
 
//call the function and pass signatures
simpleCal(num1,num2);
 
    return 0;
}
