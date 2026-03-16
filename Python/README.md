# Python Programming Portfolio

![Python](https://img.shields.io/badge/Python-3776AB?style=for-the-badge&logo=python&logoColor=white)

A 5-week Python course covering scripting fundamentals, file operations, web scraping, GUI applications, and graphics programming.

---

## Featured Projects

### Catch the Turtle Game
**Interactive turtle graphics game with 200 animated sprites**

An engaging visual game built with Python's `turtle` module featuring:
- 200 colorful chaser turtles with HSV color generation
- Smooth animation with screen tracer optimization
- Chain-following behavior where each turtle chases the next
- Custom purple background with green target turtle

```python
# Color generation using HSV for rainbow effect
h = random.random()
c = colorsys.hsv_to_rgb(h, 1, 0.8)
```

**Location:** `Week 4/Program Catch_The_Turtle.py`

---

### Web Scraper
**Extract quotes and authors from web pages**

Demonstrates web scraping fundamentals using:
- `requests` library for HTTP requests
- `BeautifulSoup` for HTML parsing
- CSS selectors for data extraction
- Clean function-based architecture

```python
quotes = parsed.find_all("div", class_="quote")
for quote in quotes:
    text = quote.find('span', class_='text').text
    author = quote.find('small', class_='author').text
```

**Location:** `Week 3/webscrape.py`

---

### Excel Automation Suite
**Create and manipulate Excel spreadsheets programmatically**

Three progressively complex Excel automation scripts:
- Create workbooks with `openpyxl`
- Write data and formulas to cells
- Include timestamps with datetime
- Save formatted spreadsheets

**Location:** `Week 5/Excel.py`, `Excel2.py`, `Excel3.py`

---

### PDF Processing Tools
**Extract and manipulate PDF content**

Multiple PDF utilities for:
- Reading PDF content with PyPDF2
- Text extraction from documents
- PDF parsing and processing

**Location:** `Week 3/pullPdf.py`, `midtermPDF.py`, `PULLPDF2.py`

---

### Desktop Application Launchers
**Python scripts that interface with system applications**

- **Notepad.py** - File writing with TextEdit integration
- **MSPaint_PA51.py** - Image viewer with file validation

**Location:** `Week 5/`

---

## Course Structure

| Week | Topics | Key Projects |
|------|--------|--------------|
| Week 2 | Data Sorting | NumberSort.py |
| Week 3 | Web Scraping, PDF, Turtle Graphics | webscrape.py, PDF tools, SimpleTurtle3.py |
| Week 4 | Functions, Games | Catch_The_Turtle.py |
| Week 5 | File Operations, Office Automation | Excel.py, Notepad.py |

---

## Technologies & Libraries

### Core Libraries
- **turtle** - Graphics and animation
- **requests** - HTTP requests for web scraping
- **BeautifulSoup4** - HTML/XML parsing
- **openpyxl** - Excel file manipulation
- **PyPDF2** - PDF processing
- **subprocess** - System process interaction

### Python Concepts
- Function definition and composition
- File I/O operations
- Module imports and organization
- Object-oriented turtle graphics
- List comprehensions and loops

---

## Running the Projects

### Setup Virtual Environment
```bash
cd Python/myenv/Python/PYIntro

# Activate virtual environment
source .venv/bin/activate  # macOS/Linux
# OR
.venv\Scripts\activate     # Windows

# Install dependencies
pip install requests beautifulsoup4 openpyxl PyPDF2
```

### Run Individual Scripts
```bash
# Web scraper
python "Week 3/webscrape.py"

# Catch the Turtle game
python "Week 4/Program Catch_The_Turtle.py"

# Excel automation
python "Week 5/Excel.py"
```

---

## Sample Output

### Web Scraper
```
"The world as we have created it is a process of our thinking..." Albert Einstein
"It is our choices, Harry, that show what we truly are..." J.K. Rowling
"There are only two ways to live your life..." Albert Einstein
```

### Excel Automation
Creates `FirstExcel.xlsx` with:
- Student ID in A1
- Numbers in A2, A3
- Formula `=A2+A3` in A4
- Current timestamp in A5

---

## Skills Demonstrated

- Web scraping and data extraction
- File system operations
- Office document automation
- Graphics programming and animation
- Function-based code organization
- External library integration

---

## Author

**Amber Lawson**
Python Introduction Coursework
