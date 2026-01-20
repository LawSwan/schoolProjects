#Amber_PA2.PY

def main():
    # Allow  user to enter a number
    num = float(input("Enter a number: "))
    
    # Print out the number multiplied by 2
    multiplied = num * 2
    print(f"{num} multiplied by 2 is {multiplied}")
    
    # Print out the number again divided by 10
    divided = multiplied / 10
    print(f"{multiplied} divided by 10 is {divided}")

if __name__ == "__main__":
    main()

