//Math Project/Final
//Amber Lawson
//June 2, 2024

#include <stdio.h>
#include <stdlib.h>
#include <time.h>
#include <ctype.h>
#include <string.h>

// Function declarations
void generateAdditionProblem(float *num1, float *num2);
void generateSubtractionProblem(float *num1, float *num2);
void generateMultiplicationProblem(float *num1, float *num2);
void generateDivisionProblem(float *num1, float *num2);

// Character array for the program's title
char title[] = "Amber Lawson's Math Program Practice Main Menu";

// Global variables for statistics
int correctCount = 0;
int totalCount = 0;

#define MAX_INPUT_SIZE 10 // Define maximum input size for fgets

int main(void) {
    float num1, num2, userAnswer, correctAnswer;
    int sentinelValue;
    char operation[MAX_INPUT_SIZE];
    char input[MAX_INPUT_SIZE];

    // Add the following code for timestamp
    time_t current_time;
    char* c_time_string;

    srand((unsigned int)time(NULL)); // Seed the random number generator with cast to unsigned int

    // Display the program's title
    puts(title);

    // Initialize the sentinelValue
    sentinelValue = 1;

    // While loop continues as long as sentinelValue is not -1
    while (1) {
        // Display menu
        printf("Choose the operation: \n");
        printf("A. Addition\n");
        printf("S. Subtraction\n");
        printf("M. Multiplication\n");
        printf("D. Division\n");
        printf("Enter your choice: ");
        
        if (fgets(input, sizeof(input), stdin) != NULL) {
            input[strcspn(input, "\n")] = '\0'; // Remove the newline character if present
            operation[0] = toupper(input[0]);
        } else {
            printf("Failed to read input\n");
            continue;
        }

        // Obtain current time
        current_time = time(NULL);
        c_time_string = ctime(&current_time);

        // Print current time
        printf("Current time is %s", c_time_string);

        switch (operation[0]) {
            case 'A':
                generateAdditionProblem(&num1, &num2);
                correctAnswer = num1 + num2;
                printf("What is %.2f + %.2f? ", num1, num2);
                break;
            case 'S':
                generateSubtractionProblem(&num1, &num2);
                correctAnswer = num1 - num2;
                printf("What is %.2f - %.2f? ", num1, num2);
                break;
            case 'M':
                generateMultiplicationProblem(&num1, &num2);
                correctAnswer = num1 * num2;
                printf("What is %.2f * %.2f? ", num1, num2);
                break;
            case 'D':
                generateDivisionProblem(&num1, &num2);
                correctAnswer = num1 / num2;
                printf("What is %.2f / %.2f? ", num1, num2);
                break;
            default:
                printf("Invalid choice!\n");
                continue;
        }

        // Get the user's answer
        if (fgets(input, sizeof(input), stdin) != NULL) {
            if (sscanf(input, "%f", &userAnswer) != 1) {
                printf("Invalid input for the answer. Please enter a numeric value.\n");
                continue;
            }
        } else {
            printf("Failed to read input\n");
            continue;
        }

        // Check if the user's answer is correct
        if (userAnswer == correctAnswer) {
            printf("Correct! The answer is %.2f\n", correctAnswer);
            correctCount++;
        } else {
            printf("Incorrect. The correct answer is %.2f\n", correctAnswer);
        }

        // Increment totalCount after the user's answer is processed
        totalCount++;

        // Prompt the user to continue or exit
        printf("Enter any number to continue or enter -1 to exit the program: ");
        
        if (fgets(input, sizeof(input), stdin) != NULL) {
            if (sscanf(input, "%d", &sentinelValue) != 1) {
                printf("Invalid input for continuation. Please enter a numeric value.\n");
                continue;
            }
        } else {
            printf("Failed to read input\n");
            continue;
        }

        if (sentinelValue == -1) {
            break;
        }
    }

    // Display final statistics
    float percentage = ((float)correctCount / totalCount) * 100;
    printf("You have answered %d out of %d problems correctly. (%.2f%%)\n", correctCount, totalCount, percentage);
    printf("Thanks for using the program!\n");

    return 0;
}

// Function definitions
void generateAdditionProblem(float *num1, float *num2) {
    *num1 = (float)(rand() % 20 + 1); // Random number between 1 and 20
    *num2 = (float)(rand() % 20 + 1); // Random number between 1 and 20
}

void generateSubtractionProblem(float *num1, float *num2) {
    *num1 = (float)(rand() % 20 + 1);
    *num2 = (float)(rand() % 20 + 1);
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
