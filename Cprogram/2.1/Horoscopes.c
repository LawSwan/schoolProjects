//
//  Horoscope.c
//  Cprogram
//
//  Created by Amber  on 5/20/24.
//

#include "Horoscopes.h"

#include <stdio.h>
#include <string.h>

int main(void) {
    // Declare arrays for zodiac signs and their corresponding horoscopes
    char *zodiacSigns[] = {
        "Aries", "Taurus", "Gemini", "Cancer",
        "Leo", "Virgo", "Libra", "Scorpio",
        "Sagittarius", "Capricorn", "Aquarius", "Pisces"
    };

    char *horoscopes[] = {
        "Today is a great day for Aries.",
        "Patience is key for Taurus.",
        "Gemini, embrace your creativity today.",
        "Cancer, take some time for self-care.",
        "Leo, your confidence will lead you to success.",
        "Virgo, focus on the details in your work.",
        "Libra, balance is essential today.",
        "Scorpio, trust your instincts.",
        "Sagittarius, adventure is on the horizon.",
        "Capricorn, hard work will pay off.",
        "Aquarius, your innovative ideas will shine.",
        "Pisces, listen to your intuition."
    };

    // Declare variables
    char userSign[20];
    int found = 0;

    // Prompt the user to enter their zodiac sign
    printf("Enter your zodiac sign: ");
    scanf("%19s", userSign);

    // Loop through the zodiac signs array to find a match
    for (int i = 0; i < 12; i++) {  // Loop starts with i=0, runs while i<12, increments i by 1 each time
        if (strcmp(zodiacSigns[i], userSign) == 0) {  // Check if the current zodiac sign matches the user input
            // If a match is found, print the corresponding horoscope
            printf("%s\n", horoscopes[i]);
            found = 1;  // Set found to 1 to indicate that a match was found
            break;  // Exit the loop since a match has been found
        }
    }

    // If no match is found, print an error message
    if (!found) {  // If found is still 0, no match was found
        printf("Invalid zodiac sign.\n");
    }

    return 0;
}
