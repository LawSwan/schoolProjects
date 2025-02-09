print("amblaw9047")

def readfile():
    path = "/Users/amber/VS/myenv/Python/ECPI/Week 3/dist/names.txt"
    
    names = []
    
    try:
        with open(path, "r") as fopen:
            print(f"Opened file: {path}")  # Debug print
            for line in fopen:
                line = line.strip()  # strip() removes both leading and trailing whitespace, including newline
                names.append(line)
            print(f"Read lines: {names}")  # Debug print
    except FileNotFoundError:
        print(f"The file at path {path} does not exist.")
    except Exception as e:
        print(f"An error occurred: {e}")
    
    return names

def writefile(names):
    path = "/Users/amber/VS/myenv/Python/ECPI/Week 3_4/dist/sorted_names.txt"
    
    try:
        with open(path, "w") as fopen:
            for line in names:
                fopen.write(line + "\n")
        print(f"Written sorted names to: {path}")  # Debug print
    except Exception as e:
        print(f"An error occurred: {e}")

def appendfile(line):
    path = "/Users/amber/VS/myenv/Python/ECPI/Week 3/dist/sorted_names.txt"
    
    try:
        with open(path, "a") as fopen:
            fopen.write(line + "\n")
        print(f"Appended line to: {path}")  # Debug print
    except Exception as e:
        print(f"An error occurred: {e}")

names = readfile()
if names:
    names.sort()
    writefile(names)
    appendfile("End of file")