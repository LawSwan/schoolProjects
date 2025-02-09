def convert_to_celsius(f): return (f - 32) * 5 / 9
def convert_to_fahrenheit(c): return c * 9 / 5 + 32

choice = input("Does your country use (F)ahrenheit or (C)elsius? ").strip().lower()
temp = float(input("What is the temperature outside?: "))

conversions = {
    "c": (convert_to_fahrenheit, "Fahrenheit", "°F"),
    "f": (convert_to_celsius, "Celsius", "°C")
}

if choice in conversions:
    func, name, unit = conversions[choice]
    print(f"Awesome!The temperature in {name} is {func(temp):.2f}{unit}")
else:
    print("Invalid choice. Please enter 'F' or 'C'.")

#Ask if they want to continue and if they do, repeat the process. If they don't, print
again = input("Would you like to convert another temperature? (Y/N): ").strip().lower()
if again == "y":
    exec(open("temp.py").read())
else: print("See ya laters!")




