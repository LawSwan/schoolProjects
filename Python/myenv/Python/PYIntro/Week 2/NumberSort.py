#Amber J Lawson
#June 19,2024

list = []
index = 0

def Numbersort(list):
    list.sort()
    return list

print("Enter 5 numbers:")
while index < 5:
    list.append(int(input()))
    index += 1

list = Numbersort(list)

print("Here are the numbers in order")
for num in range(5):
    print(list[num])