# Function to get user input with validation
def get_input(prompt):
    while True:
        value = input(prompt).strip()  # Get input and remove leading/trailing spaces
        if value:  # Ensure it's not blank
            return value
        print("Error: Input cannot be blank. Please try again.")

# Function to print the report header
def printheader(name, department, computer, date_and_time, report_name):
    print("\n" + "="*40)
    print(f'Name: {name}')
    print(f'Department: {department}')
    print(f'Computer: {computer}')
    print(f'Date and Time: {date_and_time}')
    print(f'Name of Report: {report_name}')
    print("="*40 + "\n")

# Function to print the report footer
def printfooter(website):
    print("="*40)
    print(f'(c) {website}     A Great Report      Page 1 of 1')
    print("="*40 + "\n")

# Get user inputs for report details
name = get_input("Enter your name: ")
department = get_input("Enter your department: ")
computer = get_input("Enter your computer model: ")
date_and_time = get_input("Enter the date and time (e.g., 6/19/2022 11:30am): ")
report_name = get_input("Enter the name of the report: ")
website = get_input("Enter your company website: ")

# Print the report using user-provided data
printheader(name, department, computer, date_and_time, report_name)
print("\nReport goes here\n")
printfooter(website)