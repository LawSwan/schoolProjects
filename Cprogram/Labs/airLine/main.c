#include <stdio.h>

#define CAPACITY 10

void printBoardingPass(int seat, int isFirstClass) {
    printf("Boarding Pass:\n");
    printf("Seat Number: %d\n", seat);
    printf("Section: %s\n", isFirstClass ? "First-Class" : "Economy");
}

int assignSeat(int seats[], int start, int end) {
    for (int i = start; i < end; i++) {
        if (seats[i] == 0) {
            seats[i] = 1;
            return i + 1; // Seat assigned
        }
    }
    return 0; // No seats available
}

int main(void) {
    int seats[CAPACITY] = {0};  // Initialize all seats to 0 (empty)
    int choice;
    int seatAssigned;

    while (1) {
        printf("Please type 1 for \"first-class.\"\n");
        printf("Please type 2 for \"economy.\"\n");
        printf("Enter your choice: ");
        scanf("%d", &choice);

        if (choice == 1) {  // First-Class
            seatAssigned = assignSeat(seats, 0, 5);
            if (seatAssigned == 0) {
                printf("First-class is full. Would you like to be placed in the economy section? (1 for yes, 0 for no): ");
                scanf("%d", &choice);
                if (choice == 1) {
                    seatAssigned = assignSeat(seats, 5, CAPACITY);
                }
            }
        } else if (choice == 2) {  // Economy
            seatAssigned = assignSeat(seats, 5, CAPACITY);
            if (seatAssigned == 0) {
                printf("Economy is full. Would you like to be placed in the first-class section? (1 for yes, 0 for no): ");
                scanf("%d", &choice);
                if (choice == 1) {
                    seatAssigned = assignSeat(seats, 0, 5);
                }
            }
        } else {
            printf("Invalid choice. Please type 1 for \"first-class\" or 2 for \"economy.\"\n");
            continue;
        }

        if (seatAssigned != 0) {
            printBoardingPass(seatAssigned, seatAssigned <= 5);
        } else {
            printf("Next flight leaves in 3 hours.\n");
        }

        // Check if all seats are full
        int full = 1;
        for (int i = 0; i < CAPACITY; i++) {
            if (seats[i] == 0) {
                full = 0;
                break;
            }
        }
        if (full) {
            printf("Flight is full\n");
            break;
        }
    }

    return 0;
}
