//Amber Lawson
//  Addtion.h
//  addProject
// math_operations.h
//  5/25/24

#include "MathOperations.h"
#include <stdlib.h>
#include <time.h>

void generateAdditionProblem(float *num1, float *num2) {
    *num1 = (float)(rand() % 100 + 1); // Random number between 1 and 100
    *num2 = (float)(rand() % 100 + 1); // Random number between 1 and 100
}

void generateSubtractionProblem(float *num1, float *num2) {
    *num1 = (float)(rand() % 100 + 1);
    *num2 = (float)(rand() % 100 + 1);
    if (*num1 < *num2) {
        float temp = *num1;
        *num1 = *num2;
        *num2 = temp;
    }
}

void generateMultiplicationProblem(float *num1, float *num2) {
    *num1 = (float)(rand() % 20 + 1); // Smaller range to avoid very large numbers
    *num2 = (float)(rand() % 20 + 1);
}

void generateDivisionProblem(float *num1, float *num2) {
    *num1 = (float)(rand() % 100 + 1);
    *num2 = (float)(rand() % 20 + 1); // Avoid division by zero and keep it simpler
    *num1 = *num1 * *num2; // Ensure num1 is a multiple of num2 for an integer result
}
