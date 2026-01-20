import turtle
import random
import colorsys

# Set up turtle screen
screen = turtle.Screen()
screen.tracer(0, 0)
screen.setup(600, 600)
screen.title('Catch the Turtle')
screen.bgcolor("#BB71AE")  # hex code purple :D
turtle.hideturtle()

# Initialize list of turtles
n = 200
chasers = []
for i in range(n):
    chasers.append(turtle.Turtle())

# Place the 200 turtles randomly on the screen and assign colors
for i in range(n):
    h = random.random()
    c = colorsys.hsv_to_rgb(h, 1, 0.8)
    chasers[i].color(c)
    chasers[i].up()
    chasers[i].goto(random.uniform(-400, 400), random.uniform(-400, 400))
    if i == n - 1:
        chasers[i].goto(0, -200)
        chasers[i].shape('turtle')
        chasers[i].color('green')
screen.update()

# Function to move turtles towards each other
def MoveTurtle():
    chasers[n-1].left(2)
    chasers[n-1].fd(10)
    for i in range(n-1):
        angle = chasers[i].towards(chasers[i+1])
        chasers[i].seth(angle)
        chasers[i].fd(10)
    screen.update()
    screen.ontimer(MoveTurtle, 1)

# Start the movement
MoveTurtle()

# Run the turtle main loop
turtle.done()