import os
import pdfplumber

def pullpdf(pdf_path):
    if not os.path.exists(pdf_path):
        print(f"File does not exist: {pdf_path}")
        return None
    pdf = pdfplumber.open(pdf_path)
    return pdf

# Use the absolute path to the PDF file
pdf_path = "/Users/amber/VS/myenv/Python/ECPI/Week 3/dist/amblaw9047_UScensus.pdf"
print(f"Attempting to open PDF file at: {pdf_path}")  
pdf = pullpdf(pdf_path)

if pdf:
    # Print the text of the first page to understand the structure
    first_page = pdf.pages[0]
    print(first_page.extract_text())

    # Extract tables from the PDF
    def extract_population_data(pdf):
        population_data = []
        for page in pdf.pages:
            tables = page.extract_tables()
            for table in tables:
                for row in table:
                    population_data.append(row)
        return population_data

    # Extract the population data
    population_data = extract_population_data(pdf)

    # Print the extracted population data
    for row in population_data:
        print(row)

    # Optional: Write the extracted data to a text file
    with open("UScensus_population_data.txt", "w", encoding='utf-8') as f:
        for row in population_data:
            f.write("\t".join(row) + "\n")

else:
    print("Failed to open PDF.")