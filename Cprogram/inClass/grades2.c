//
//  grades2.c
//  Addtion
//
//  Created by Amber  on 5/13/24.
//

#include <stdio.h>

#include <stdio.h>

int main(void) {
    int gradeCount = 0;
    int sum = 0;
    int grade;
    float average;

    // Number of grades to process
    int totalGrades = 5;

    printf("Enter %d grades:\n", totalGrades);

    while (gradeCount < totalGrades) {
        printf("Enter grade %d: ", gradeCount + 1);
        scanf("%d", &grade);
        sum += grade;
        gradeCount++;
    }

    if (gradeCount > 0) {
        average = (float)sum / gradeCount;
        printf("The average grade is: %.2f\n", average);
    } else {
        printf("No grades were entered.\n");
    }

    return 0;
}
