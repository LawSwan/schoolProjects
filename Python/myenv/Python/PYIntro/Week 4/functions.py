
import os
import pdfplumber
import requests
from bs4 import BeautifulSoup
import datetime

def HelloWorld():
    print("Hello World, my name is Amber Lawson")
    print("I am a software development student at ECPI University")
    print("I have never programmed a computer before")
    print("This is rad!!")

def CheckEven():
    num = input("Enter a number: ")
    try:
        num = int(num)
        if num % 2:
            print("Number is Odd")
        else:
            print("Number is Even")
    except ValueError:
        print("Please enter a valid integer")

def Birthday():
    birthdate = input("What is your birthday (MM/DD/YYYY): ")
    try:
        month, day, year = map(int, birthdate.split("/"))
        bdate = datetime.datetime(year, month, day)
        todays_date = datetime.datetime.now()
        age = todays_date - bdate
        print("You are " + str(age.days // 365.25) + " years old")
    except ValueError:
        print("Please enter a valid date in MM/DD/YYYY format")

def Numbersort(list):
    list.sort()
    return list

def pullpdf(pdf_path):
    if not pdf_path.lower().endswith('.pdf'):
        print("The file is not a PDF.")
        return None
    if not os.path.exists(pdf_path):
        print(f"File does not exist: {pdf_path}")
        return None
    pdf = pdfplumber.open(pdf_path)
    return pdf

def writepdf(pdf, output_path="Complex_Output.txt"):
    with open(output_path, "w", encoding='utf-8') as f:
        for page in pdf.pages:
            f.write(page.extract_text())
            f.write("\n")

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

def appendfile(line):
    path = "/Users/amber/VS/myenv/Python/ECPI/Week 3/dist/sorted_names.txt"
    
    try:
        with open(path, "a") as fopen:
            fopen.write(line + "\n")
        print(f"Appended line to: {path}")  # Debug print
    except Exception as e:
        print(f"An error occurred: {e}")