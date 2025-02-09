from openpyxl import Workbook
import datetime

book = Workbook()
sheet = book.active

sheet['A1'] = 'Amblaw'  #student ID
sheet['A2'] =  90  
sheet['A3'] = 47  
sheet['A4'] = '=A2+A3'

now = datetime.datetime.now()
sheet['A5'] = now

book.save("FirstExcel.xlsx")