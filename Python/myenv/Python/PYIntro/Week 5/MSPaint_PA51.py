import os
import subprocess

print("Student ID: Amblaw9047")

# Get the image 
image_file = input("Enter the image file name (with path if not in the same directory): ")

# Check if the file exists
if not os.path.isfile(image_file):
    print(f"File not found: {image_file}")
else:
    # Open the image in Preview
    subprocess.run(["open", image_file])