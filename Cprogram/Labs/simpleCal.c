
//  simpleCal.c
//  Practice
//  Created by Amber  on 5/21/24.

#include "simpleCal.h"

// Function definition
int simpleCal(int num1, int num2) {
    int x, y, add, sub; // Declaration
    x = num1;
    y = num2;
    
    if (x < y) {
        add = x + y;
        return add;
    } else {
        sub = x - y;
        return sub;
    }
}
