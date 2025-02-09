# CallFunctions.py
from functions import (
    HelloWorld, CheckEven, Birthday, Numbersort, pullpdf, writepdf,
    readfile, appendfile
)

if __name__ == "__main__":
    # Test HelloWorld
    HelloWorld()

    # Test CheckEven
    CheckEven()

    # Test Birthday
    Birthday()

    # Test NumberSort
    list = []
    index = 0
    print("Enter 5 numbers:")
    while index < 5:
        try:
            num = int(input(f"Enter number {index + 1}: "))
            list.append(num)
            index += 1
        except ValueError:
            print("Please enter a valid integer.")

    sorted_list = Numbersort(list)
    print("Here are the numbers in order:")
    for num in sorted_list:
        print(num)

    # Test pullpdf and writepdf
    pdf_path = input("Enter the path to the PDF file: ")
    print(f"Attempting to open PDF file at: {pdf_path}")  # Debug print
    pdf = pullpdf(pdf_path)

    if pdf:
        output_path = "Complex_Output.txt"
        writepdf(pdf, output_path)

        # Optional: Print the first few lines of the output for verification
        with open(output_path, "r", encoding='utf-8') as f:
            for i in range(5):
                print(f.readline().strip())
    else:
        print("Failed to open PDF.")

    # Test readfile and appendfile
    names = readfile()
    if names:
        names.sort()
        appendfile("End of file")