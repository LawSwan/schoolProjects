import os
import corplogo

# Set environment variables
os.environ["USER"] = "Amber"
os.environ["USERDOMAIN"] = "Software Department"
os.environ["COMPUTERNAME"] = "Macbook Pro"

# Define file paths
StudentID = "amb947"
ReportName = "5.2 Lab Report"
writeup_path = "/Users/ecpi/schoolProjects/Python/myenv/Python/PYLAB/writeup.txt"
SAMPLE_path = "/Users/ecpi/schoolProjects/Python/myenv/Python/PYLAB/SAMPLE.xlsx"
pdf_path = "/Users/ecpi/schoolProjects/Python/myenv/Python/PYLAB/Ada_Lovelace.pdf"

# Run the full report with a single function call
corplogo.run_report(ReportName, StudentID, writeup_path, SAMPLE_path, pdf_path)