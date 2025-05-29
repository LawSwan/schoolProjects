//Supermarket_5.5
//Amber Lawson
//June 6, 2024
//

#include <stdio.h>

void Hie(void)
{
    printf("Welcome to Hansen's Discount Suprermarket!\n");
}

float grandTotal(float prices[], int itemCount) {
    float taxIncluded, tax, total = 0, grandTotal;
    int i;
    for (i = 0; i < itemCount; i++) {
        tax = 0.06;
        total += prices[i];
    }
    printf("Your total is: %.2f $\n", total);
    taxIncluded = total * 0.06;
    printf("Tax: %.2f $\n", taxIncluded);
    grandTotal = taxIncluded + total;
    printf("Your grand total is: %.2f $\n", grandTotal);
 
    return grandTotal;
}

int main(void)
{
    Hie();

    int itemCount, i;
    float total = 0;
    
    printf("How many items will you be purchasing with us today? ");
    scanf("%d", &itemCount);

    float prices[itemCount];

    printf("We are sorry the scanner is broke today, Please enter the prices manually\n");
    
    for (i = 0; i < itemCount; i++) {
        printf("Enter price: ");
        scanf("%f", &prices[i]);
        while (prices[i] > 10) {
            printf("Please enter value less than 10$: ");
            scanf("%f", &prices[i]);
        }
        total += prices[i];
    }
    
    grandTotal(prices, itemCount);

    printf("Thank you for shopping with us! Have a nice day!\n");
    return 0;
}
