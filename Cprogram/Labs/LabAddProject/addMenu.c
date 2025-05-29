//
//  addMenu.c
//  LabAddProject
//


#include <stdio.h>
#include <time.h>


int main(void)
{
    float num1, num2, correctAnswer, userAnswer;
    int correctCount = 0, totalProblems = 0;
    int choice;

    // random number generator
    rand(time(0));

    // Infinite loop to keep the program running until the user chooses to exit
    while (1) {
        
        // Display the current time
        // Display the menu
        
        
        printf("\nMenu:\n");
        printf("1. Addition\n");
        printf("2. Subtraction\n");
        printf("3. Multiplication\n");
        printf("4. Division\n");
        printf("5. Exit\n");
        printf("Enter your choice: ");
        scanf("%d", &choice);

        // Process the user's choice
        switch (choice) {
            case 1:
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
                    correctCount++;
                } else {
                    printf("Incorrect. The correct answer is %.2f.\n", correctAnswer);
                }
                
                totalProblems++;
                break;
                
            case 2:
                // Placeholder for Subtraction logic
                printf("Subtraction feature is under development.\n");
                break;
                
            case 3:
                // Placeholder for Multiplication logic
                printf("Multiplication feature is under development.\n");
                break;

            case 4:
                // Placeholder for Division logic
                printf("Division feature is under development.\n");
                break;

            case 5:
                // Exit the program
                printf("You answered %d out of %d problems correctly.\n", correctCount, totalProblems);
                printf("Exiting the program.\n");
                             return 0;

                default:
                printf("Invalid choice. Please enter a number between 1 and 5.\n");
                
                     }
                 }

                 return 0;
             }
