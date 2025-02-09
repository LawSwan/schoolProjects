import turtle

def draw_square(size):
    for _ in range(4):
        turtle.forward(size)
        turtle.right(90)

def draw_circle(radius):
    turtle.circle(radius)

def draw_triangle(size):
    for _ in range(3):
        turtle.forward(size)
        turtle.right(120)

def display_student_id(student_id):
    turtle.penup()
    turtle.goto(0, -200)
    turtle.pendown()
    turtle.write(f"Your student ID is {student_id}", align="center", font=("Arial", 16, "normal"))

def main():
    student_id = input("Enter your student ID: ")
    square_size = int(input("Enter the size of the square: "))
    circle_radius = int(input("Enter the radius of the circle: "))
    triangle_size = int(input("Enter the size of the triangle: "))
    
    display_student_id(student_id)
    
    draw_square(square_size)
    turtle.penup()
    turtle.goto(150, 0)
    turtle.pendown()
    
    draw_circle(circle_radius)
    turtle.penup()
    turtle.goto(-150, 0)
    turtle.pendown()
    
    draw_triangle(triangle_size)
    turtle.done()

if __name__ == "__main__":
    main()