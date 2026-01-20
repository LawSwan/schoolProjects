import os
import pdfplumber

print("amblaw9047")

def pullpdf(pdf_path):
    if not os.path.exists(pdf_path):
        print(f"File does not exist: {pdf_path}")
        return None
    pdf = pdfplumber.open(pdf_path)
    return pdf

# Use the absolute path to the PDF file
pdf_path = "/Users/amber/VS/myenv/Python/ECPI/Week 3_4/dist/ComplexPDF.pdf"
print(f"Attempting to open PDF file at: {pdf_path}")  # Debug print
pdf = pullpdf(pdf_path)

if pdf:
    def writepdf(pdf):
        with open("Complex_Output.txt", "w", encoding='utf-8') as f:
            for page in pdf.pages:
                f.write(page.extract_text())
                f.write("\n")  # Add a newline after each page

    # Write the PDF content to a text file
    writepdf(pdf)

    # Optional: Print the first few lines of the output for verification
    with open("Complex_Output.txt", "r", encoding='utf-8') as f:
        for i in range(5):  # Print the first 5 lines for verification
            print(f.readline().strip())
else:
    print("Failed to open PDF.")