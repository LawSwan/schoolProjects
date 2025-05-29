//  Amber Lawson
//  BMI.c
//  Cprogram
//  Created by Amber  on 5/15/24.

#include <stdio.h>

int main(void)
{
    float weightInPounds, heightInInches, bmi;

    printf("Enter your weight in pounds: ");
    scanf("%f", &weightInPounds);

    printf("Enter your height in inches: ");
    scanf("%f", &heightInInches);

    // Calculate BMI
    bmi = (weightInPounds * 703) / (heightInInches * heightInInches);

    // Output BMI
    printf("Your BMI is: %.2f\n", bmi);

    // Determine the BMI category
    if (bmi < 18.5) {
        printf("BMI Category: Underweight\n");
    } else if (bmi >= 18.5 && bmi <= 24.9) {
        printf("BMI Category: Normal\n");
    } else if (bmi >= 25 && bmi < 30) {
        printf("BMI Category: Overweight\n");
    } else {
        printf("BMI Category: Obese\n");
    }

    return 0;
}


