import turtle

def square():
    for _ in range(4):
        turtle.forward(100)
        turtle.right(90)

def circle():
    turtle.circle(50)

def triangle():
    for _ in range(3):
        turtle.forward(100)
        turtle.right(120)

def main():
    print("Student ID: Amblaw9047")
    
    square()
    turtle.penup()
    turtle.goto(150, 0)
    turtle.pendown()
    
    circle()
    turtle.penup()
    turtle.goto(-150, 0)
    turtle.pendown()
    
    triangle()
    turtle.done()

if __name__ == "__main__":
    main()