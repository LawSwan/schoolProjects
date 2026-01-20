print("AmbLaw9047")

try:
    num = int(input("Enter a number:"))
    if num % 2:
        print("Number is Odd")
    else:
        print("Number is Even")
except ValueError:
    print("Please enter a valid integer.")