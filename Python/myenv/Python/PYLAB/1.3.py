def printheader():
    Name = 'amblaw9047'
    Department = 'Software development'
    Computer = "Macbook Pro"
    DateAndTime = '1/28/2025 10:30am'
    NameOfReport = 'Printing the Corporate Header'

    print('Name: ' + Name)
    print("Department: " + Department)
    print('Computer: ' + Computer)
    print('Date and Time: ' + DateAndTime)
    print("Name of Report: " + NameOfReport)

def printfooter():
    print('(c) www.salbrel189.com     A Great Report      Page 1 of 1')

printheader()
print("\nReport goes here\n")
printfooter()
