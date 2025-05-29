//  Amber Lawson
//  Grades.c
//  CIS126 1.9
//  5/12/24.
//

#include "Grades.h"
#include <stdio.h>

int main() {
    float grade1 = 84, grade2 = 98, grade3 = 73; // Assigning grades
    float average; // Variable for average

    // Calculate the average of three grades
    average = (grade1 + grade2 + grade3) / 3;
    printf("The average grade is: %.2f\n", average); // Display the average

    // Check if the average grade is greater than 65
    if (average > 65) {
        printf("The student has passed.\n");
    }

    return 0;
}
