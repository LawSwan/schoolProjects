import requests
from bs4 import BeautifulSoup

def readwebpage(page_number):
    """Fetches the webpage content for a given page number."""
    url = f"https://quotes.toscrape.com/page/{page_number}/"
    response = requests.get(url)
    if response.status_code == 200:
        return response.text
    else:
        print(f"Failed to retrieve the webpage. Status code: {response.status_code}")
        return None

def parse_data(html_content):
    """Parses the HTML content to extract quotes and authors."""
    soup = BeautifulSoup(html_content, 'html.parser')
    quotes_data = []
    quotes = soup.find_all('div', class_='quote')
    for quote in quotes:
        text = quote.find('span', class_='text').get_text()
        author = quote.find('small', class_='author').get_text()
        quotes_data.append((text, author))
    return quotes_data

def output_quotes(quotes_data, student_id):
    """Prints the quotes and their authors."""
    print(f"Student ID: {student_id}")
    for quote, author in quotes_data:
        print(f"{quote} - {author}")

def main():
    student_id = "Amblaw9047"
    try:
        page_number = int(input("Enter a page number (1-10): "))
        if page_number < 1 or page_number > 10:
            print("Page number must be between 1 and 10.")
            return
    except ValueError:
        print("Invalid input. Please enter a number between 1 and 10.")
        return

    html_content = readwebpage(page_number)
    if html_content:
        quotes_data = parse_data(html_content)
        output_quotes(quotes_data, student_id)

if __name__ == "__main__":
    main()