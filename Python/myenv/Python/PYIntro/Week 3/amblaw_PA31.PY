import os

def readfile():
    # Print student ID
    print("Student ID: Amblaw9047")

    # Open the file for reading
    with open("dist/names.txt", "r") as file:
        names = file.readlines()

    # Sort the names
    sorted_names = sorted(names)

    # Print the sorted names
    for name in sorted_names:
        print(name.strip())

    return sorted_names

def writefile(sorted_names):
    # Open the file for writing
    with open("dist/sorted_names.txt", "w") as file:
        for name in sorted_names:
            file.write(name)

def appendfile():
    # Open the file for appending
    with open("dist/sorted_names.txt", "a") as file:
        file.write("\nStudent ID: Amblaw9047\n")

def main():
    # Read, sort and print the names
    sorted_names = readfile()

    # Write the sorted names to a new file
    writefile(sorted_names)

    # Append a line with the student ID to the file
    appendfile()

if __name__ == "__main__":
    main()