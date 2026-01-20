import requests
from bs4 import BeautifulSoup


def readwebpage():
    """Fetches the webpage content."""
    url = "https://quotes.toscrape.com/page/2/"
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
    html_content = readwebpage()
    if html_content:
        quotes_data = parse_data(html_content)
        output_quotes(quotes_data, student_id)

if __name__ == "__main__":
    main()
