//
//  addProject.c
//  addProject
//  Created by Amber on 5/21/24.


#include "addProject.h"

// Function to seed the random number generator
void seedRandomNumberGenerator(void)
    srand(time(0)
          

// Function to generate and solve an addition problem
          (void) generateAndSolveAdditionProblem (int *correctCount, int *totalProblems)
        float num1, num2, correctAnswer, userAnswer;
        
        // Generate random numbers for the addition problem
        num1 = (float)(rand() % 1000) / 10.0; // Generates a number between 0.0 and 99.9
        num2 = (float)(rand() % 1000) / 10.0; // Generates a number between 0.0 and 99.9
        correctAnswer = num1 + num2;
        
        // Display the addition problem
        printf("Solve the following addition problem:\n");
        printf("%.2f + %.2f = ?\n", num1, num2);
        
        // Prompt the user for their answer
        printf("Enter your answer: ");
        scanf("%f", &userAnswer);
        
        // Check if the user's answer is correct or incorrect
        if (userAnswer == correctAnswer) {
            printf("Correct! Well done.\n");
            (*correctCount)++;
        } else {
            printf("Incorrect. The correct answer is %.2f.\n", correctAnswer);
        }
        
        (*totalProblems)++;
        
    }
