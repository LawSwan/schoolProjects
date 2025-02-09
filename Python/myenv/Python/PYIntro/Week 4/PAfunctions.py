#amblaw9047

import requests
from bs4 import BeautifulSoup
import PyPDF2

def GoodbyeWorld():
    print("Goodbye World")

def CheckRange():
    number = int(input("Enter a number: "))
    if number >= 100:
        print(f"You entered the number {number}, and your entry is greater than or equal to 100.")
    else:
        print(f"You entered the number {number}, and your entry is less than 100.")

from datetime import datetime

def DaysTillGrad():
    while True:
        try:
            graduation_date_str = input("Enter your Graduation Date (YYYY-MM-DD): ")
            graduation_date = datetime.strptime(graduation_date_str, "%Y-%m-%d")
            break
        except ValueError:
            print("Incorrect format. Please enter the date in YYYY-MM-DD format.")
    
    current_date = datetime.now()
    days_until_graduation = (graduation_date - current_date).days
    print(f"It is currently {current_date}")
    print(f"There are {days_until_graduation} days until your graduation.")

def ReadWeb():
    url = "https://quotes.toscrape.com/page/3/"
    response = requests.get(url)
    soup = BeautifulSoup(response.text, "html.parser")
    quotes = soup.find_all("span", class_="text")
    authors = soup.find_all("small", class_="author")
    for quote, author in zip(quotes, authors):
        print(f"'{quote.text}' - {author.text}")

def ReadPDF():
    pdf_path = "/Users/amber/VS/myenv/Python/ECPI/Week 4/SmallPDF.pdf"
    with open(pdf_path, "rb") as pdf_file:
        reader = PyPDF2.PdfReader(pdf_file)
        num_pages = len(reader.pages)
        for page_num in range(num_pages):
            page = reader.pages[page_num]
            print(page.extract_text())