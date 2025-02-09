import datetime

def printheader(Name, Department, Computer, NameOfReport):
    """Prints the report header with user information and formatted date/time."""
    DateAndTime = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")  # Removes decimal seconds
    
    print("\n" + "=" * 40)
    print(f"Name: {Name}")
    print(f"Department: {Department}")
    print(f"Computer you are using: {Computer}")
    print(f"Date and Time: {DateAndTime}")  # Microseconds removed!
    print(f"The name of the report: {NameOfReport}")
    print("=" * 40 + "\n")

def printfooter(NameOfReport, StudentID="Amblaw9047"):
    """Prints the footer with a valid Student ID and Report Name."""
    print(f"(c) www.{StudentID}.com\t\t{NameOfReport}\t\tPage 1 of 1")

# Input Handling
while True:
    InputLine = input("Enter Name, Department, Computer, and Report Name (separate with comma please): ").strip()
    
    if InputLine:
        try:
            Name, Department, Computer, NameOfReport = [x.strip() for x in InputLine.split(",")]
            break  # Valid input, exit loop
        except ValueError:
            print("Error: Please enter exactly four values separated by commas.")
    else:
        print("Try again. Input cannot be empty.")

# Print Header and Footer
printheader(Name, Department, Computer, NameOfReport)
print("\nReport goes here\n")
printfooter(NameOfReport)