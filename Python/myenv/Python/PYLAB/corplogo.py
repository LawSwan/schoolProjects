import os
import datetime
import geocoder
import pandas as pd
import pdfplumber

def printheader(report_name):
    """Prints report header with user details and location."""
    user_name = os.getenv("USER", "Unknown User")
    department = os.getenv("USERDOMAIN", "Unknown Department")
    computer = os.getenv("COMPUTERNAME", "Unknown Computer")
    
    g = geocoder.ip('me')
    location = f"{g.city}, {g.state}" if g.city and g.state else "Location Unknown"

    print(f"\n--- {report_name} ---")
    print(f"User: {user_name} | Dept: {department} | Computer: {computer}")
    print(f"Date: {datetime.datetime.now():%Y-%m-%d %H:%M:%S} | Location: {location}")
    print("-" * 40)

def outputwriteup(file_path):
    """Reads and prints the contents of writeup.txt."""
    try:
        with open(file_path, 'r') as file:
            print("\n--- Writeup Content ---\n" + file.read())
    except FileNotFoundError:
        print("\nError: writeup.txt not found.")

def excelread(file_path):
    """Reads and prints contents of SimpleTest.xlsx."""
    try:
        df = pd.read_excel(file_path)
        print("\n--- Excel Data ---\n", df)
    except Exception as e:
        print("\nError reading Excel file:", e)

def read_pdf(pdf_path):
    """Reads and prints text from a PDF file."""
    print("\n--- PDF Content ---")
    try:
        with pdfplumber.open(pdf_path) as pdf:
            for page in pdf.pages:
                text = page.extract_text()
                if text:
                    print(text)
    except FileNotFoundError:
        print("Error: PDF file not found.")

def printfooter(report_name, student_id):
    """Prints footer with copyright and page number."""
    print(f"\n(c) {datetime.datetime.today().year} www.{student_id}.com | {report_name} | Page 1 of 1")

def run_report(report_name, student_id, writeup_path, SAMPLE_path, pdf_path):
    """Runs the full report: Header, Writeup, Excel, PDF, and Footer."""
    printheader(report_name)
    outputwriteup(writeup_path)
    excelread(SAMPLE_path)
    read_pdf(pdf_path)
    printfooter(report_name, student_id)