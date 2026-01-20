import pdfplumber
import xlwings as xw

pdfToString = ""
pdf_path = "/Users/amber/VS/myenv/Python/ECPI/dist/SimplePDF.pdf"

try:
    with pdfplumber.open(pdf_path) as pdf:
        for page in pdf.pages:
            text = page.extract_text()
            if text:
                pdfToString += text

    # Replace non-ASCII characters with spaces
    pdfToString = ''.join([i if ord(i) < 128 else ' ' for i in pdfToString])

    # Write directly to Excel
    wb = xw.Book('/Users/amber/VS/myenv/Python/ECPI/ThirdBook.xlsx')
    sheet = wb.sheets[0]
    lines = pdfToString.split('\n')
    for i, line in enumerate(lines):
        sheet.range(f'A{i+1}').value = line
    wb.save()
    wb.close()
except Exception as e:
    print(f"Error: {e}")