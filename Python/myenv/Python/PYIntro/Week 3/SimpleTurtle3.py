import turtle

def square(size):
    for _ in range(4):
        turtle.forward(size)
        turtle.right(90)

def circle(size):
    turtle.circle(size)

def rectangle(sideA, sideB):
    for _ in range(2):
        turtle.forward(sideA)
        turtle.right(90)
        turtle.forward(sideB)
        turtle.right(90)

def anyshape(sides, direction):
    angle = 360 / sides
    size = 900 / sides
    for _ in range(sides):
        turtle.forward(size)
        if direction == 'r':
            turtle.right(angle)
        else:
            turtle.left(angle)

# Main drawing
def main():
    turtle.speed(3)  # Set the speed of drawing (1-10)
    
    # Draw a square
    square(100)
    turtle.penup()
    turtle.forward(150)
    turtle.pendown()

    # Draw a circle
    circle(50)
    turtle.penup()
    turtle.forward(150)
    turtle.pendown()

    # Draw a rectangle
    rectangle(100, 50)
    turtle.penup()
    turtle.forward(200)
    turtle.pendown()

    # Draw any shape
    anyshape(5, 'r')

    # Prevent the window from closing immediately
    turtle.done()

if __name__ == "__main__":
    main()