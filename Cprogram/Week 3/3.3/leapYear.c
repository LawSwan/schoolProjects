//
//  leapYear.c
//  3.3

#include "leapYear.h"


bool IsLeapYear(int year) {  // function definition
    if (year % 4 == 0) {
        if (year % 100 == 0)
        {
            if (year % 400 == 0) {
                return true;  // Leap year
            } else {
                return false; // Not a leap year
            }
        } else {
            return true;  // Leap year
        }
    } else {
        return false; // Not a leap year
    }
}

int main(void)
{
    int year;
    bool isLeap;

    printf("Enter a year: ");
    scanf("%d", &year);

    isLeap = IsLeapYear(year);  // function call

    if (isLeap) {
        printf("%d is a leap year.\n", year);
    } else {
        printf("%d is not a leap year.\n", year);
    }

    return 0;
}
