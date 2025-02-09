import requests
from bs4 import BeautifulSoup
from PAfunctions import DaysTillGrad, CheckRange, GoodbyeWorld

def readwebpage():
    url = "https://quotes.toscrape.com/page/2/"
    response = requests.get(url)
    return response.text

def parsedata(webpage_data):
    soup = BeautifulSoup(webpage_data, "html.parser")
    quotes = soup.find_all("span", class_="text")
    authors = soup.find_all("small", class_="author")
    return [(quote.text, author.text) for quote, author in zip(quotes, authors)]

def outputdata(quotes_and_authors):
    for quote, author in quotes_and_authors:
        print(f"'{quote}' - {author}")

def main():
    print("Student ID: Amblaw9047")
    
    # Call functions from PAfunctions.py
    DaysTillGrad()
    CheckRange()
    GoodbyeWorld()

    # Read, parse, and output webpage data
    webpage_data = readwebpage()
    quotes_and_authors = parsedata(webpage_data)
    outputdata(quotes_and_authors)

if __name__ == "__main__":
    main()