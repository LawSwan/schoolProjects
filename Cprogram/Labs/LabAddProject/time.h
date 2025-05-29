//
//  addMenu.h
//  LabAddProject
//

#ifndef addMenu_h
#define addMenu_h

#include <stdio.h>
#include <time.h>



// Function to display the current time
void displayCurrentTime(void)
{
    time_t current_time = time(NULL);
    char* c_time_string = ctime(&current_time);
    printf("Current time is %s", c_time_string);
}

#endif // TIME_DISPLAY_H
