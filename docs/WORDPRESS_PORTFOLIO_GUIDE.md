# WordPress Portfolio Setup Guide

This guide helps you create a professional portfolio on your GoDaddy WordPress site at amberjanelle.com.

---

## Portfolio Structure

Create pages in this hierarchy:

```
amberjanelle.com
├── Home
├── About
├── Portfolio (parent page)
│   ├── Web Applications
│   ├── Console Applications
│   ├── Database Projects
│   └── Visual Programming
├── Resume
└── Contact
```

---

## Step 1: Create Portfolio Parent Page

1. In WordPress Admin, go to **Pages > Add New**
2. Title: "Portfolio"
3. Add an introduction paragraph
4. Publish the page

**Sample Content:**
```
Welcome to my software development portfolio. Here you'll find projects
from my computer science education, demonstrating skills in multiple
programming languages, database design, and web development.

Browse by category below to see my work.
```

---

## Step 2: Create Category Pages

For each category, create a child page under Portfolio.

### Web Applications Page

**Page Settings:**
- Title: Web Applications
- Parent: Portfolio

**Content Template:**
```html
<!-- Add this in WordPress using the HTML/Code block -->

<div class="portfolio-intro">
  <p>Full-stack web applications built with PHP and modern MVC architecture.</p>
</div>

<div class="project-card">
  <h3>Digital Products Store</h3>
  <p class="tech-stack">
    <span class="badge">PHP</span>
    <span class="badge">MVC</span>
    <span class="badge">MySQL</span>
  </p>
  <p>A complete e-commerce platform featuring product catalog, shopping cart,
  user sessions, and admin management.</p>

  <h4>Features</h4>
  <ul>
    <li>Product listing with category filtering</li>
    <li>Shopping cart with session persistence</li>
    <li>Related products recommendations</li>
    <li>Admin cleanup utilities</li>
  </ul>

  <p><a href="https://github.com/LawSwan/schoolProjects/tree/server-side-scripting/ServerSideScripting/src/Digital_Products_Store"
     target="_blank">View Source Code on GitHub →</a></p>
</div>
```

### Console Applications Page

**Content with Replit Embed:**
```html
<div class="portfolio-intro">
  <p>Object-oriented applications demonstrating core programming concepts.</p>
</div>

<div class="project-card">
  <h3>Bank Account System</h3>
  <p class="tech-stack">
    <span class="badge">Java</span>
    <span class="badge">OOP</span>
  </p>
  <p>A banking simulation demonstrating inheritance, abstraction, polymorphism,
  and encapsulation through multiple account types.</p>

  <h4>Live Demo</h4>
  <iframe
    frameborder="0"
    width="100%"
    height="500px"
    src="https://replit.com/@YourUsername/Bank-Account-System?embed=true">
  </iframe>

  <h4>Key Concepts</h4>
  <ul>
    <li>Abstract classes and interfaces</li>
    <li>Multiple constructor types</li>
    <li>Protected/private/public access specifiers</li>
    <li>Polymorphism through IAccountActions interface</li>
  </ul>

  <p><a href="https://github.com/LawSwan/schoolProjects/tree/java/java/LAB/Project%20"
     target="_blank">View Source Code →</a></p>
</div>

<hr>

<div class="project-card">
  <h3>Catch the Turtle Game</h3>
  <p class="tech-stack">
    <span class="badge">Python</span>
    <span class="badge">Turtle Graphics</span>
  </p>
  <p>An interactive game with 200 animated turtles using Python's turtle module.</p>

  <h4>Live Demo</h4>
  <iframe
    frameborder="0"
    width="100%"
    height="500px"
    src="https://replit.com/@YourUsername/Catch-The-Turtle?embed=true">
  </iframe>

  <p><a href="https://github.com/LawSwan/schoolProjects/tree/Python"
     target="_blank">View Source Code →</a></p>
</div>
```

### Database Projects Page

```html
<div class="portfolio-intro">
  <p>Database design projects covering both relational SQL and NoSQL paradigms.</p>
</div>

<div class="project-card">
  <h3>Game Store Database</h3>
  <p class="tech-stack">
    <span class="badge">Oracle SQL</span>
    <span class="badge">Database Design</span>
  </p>
  <p>A relational database for a digital game distribution platform with
  user management, product catalog, reviews, and order processing.</p>

  <h4>Schema Diagram</h4>
  <!-- Add an image of your database schema -->
  <img src="your-schema-image-url.png" alt="Game Store Database Schema"
       style="max-width: 100%; border: 1px solid #ddd;">

  <h4>Tables</h4>
  <ul>
    <li><strong>UserBase</strong> - User accounts with wallet funds</li>
    <li><strong>ProductList</strong> - Game catalog with genres</li>
    <li><strong>Orders</strong> - Purchase transaction history</li>
    <li><strong>Reviews</strong> - User ratings and comments</li>
  </ul>

  <p><a href="https://github.com/LawSwan/schoolProjects/tree/sql/sql"
     target="_blank">View SQL Scripts →</a></p>
</div>

<hr>

<div class="project-card">
  <h3>NoSQL Database Suite</h3>
  <p class="tech-stack">
    <span class="badge">MongoDB</span>
    <span class="badge">Redis</span>
    <span class="badge">Cassandra</span>
    <span class="badge">Neo4j</span>
  </p>
  <p>Comprehensive exploration of four NoSQL paradigms with GitHub data integration.</p>

  <h4>Databases Covered</h4>
  <table style="width: 100%; border-collapse: collapse;">
    <tr>
      <th>Database</th>
      <th>Type</th>
      <th>Project</th>
    </tr>
    <tr>
      <td>MongoDB</td>
      <td>Document</td>
      <td>GitHub Activity Logger</td>
    </tr>
    <tr>
      <td>Neo4j</td>
      <td>Graph</td>
      <td>GitHub Analytics Platform with Streamlit UI</td>
    </tr>
    <tr>
      <td>Cassandra</td>
      <td>Wide-Column</td>
      <td>GitHub Archive Analyzer</td>
    </tr>
    <tr>
      <td>Redis</td>
      <td>Key-Value</td>
      <td>CRUD Operations Lab</td>
    </tr>
  </table>

  <p><a href="https://github.com/LawSwan/schoolProjects/tree/NOSQL/NOSQL"
     target="_blank">View All NoSQL Projects →</a></p>
</div>
```

---

## Step 3: Add Custom CSS

In WordPress, go to **Appearance > Customize > Additional CSS** and add:

```css
/* Portfolio Badge Styles */
.badge {
  display: inline-block;
  padding: 4px 8px;
  margin: 2px;
  font-size: 12px;
  font-weight: 600;
  color: white;
  background-color: #0066cc;
  border-radius: 4px;
}

/* Project Card Styles */
.project-card {
  background: #f9f9f9;
  border: 1px solid #e0e0e0;
  border-radius: 8px;
  padding: 24px;
  margin: 20px 0;
}

.project-card h3 {
  margin-top: 0;
  color: #333;
}

.project-card h4 {
  color: #666;
  border-bottom: 1px solid #eee;
  padding-bottom: 8px;
}

.tech-stack {
  margin: 10px 0;
}

/* Responsive iframes */
.project-card iframe {
  max-width: 100%;
  border: 1px solid #ddd;
  border-radius: 4px;
}

/* Portfolio intro */
.portfolio-intro {
  font-size: 18px;
  color: #555;
  margin-bottom: 30px;
}
```

---

## Step 4: Recommended Plugins

Install these plugins for better portfolio display:

1. **Jepack** or **SyntaxHighlighter Evolved**
   - For code syntax highlighting

2. **Portfolio Post Type** (optional)
   - Creates a dedicated portfolio content type

3. **Elementor** (optional)
   - Visual page builder for more design control

---

## Step 5: Add Navigation Menu

1. Go to **Appearance > Menus**
2. Create a new menu or edit existing
3. Add your Portfolio pages:
   - Portfolio (parent)
   - Web Applications
   - Console Applications
   - Database Projects
   - Visual Programming
4. Save the menu

---

## Alternative: Use Block Editor Patterns

In WordPress 6.0+, create a reusable block pattern for project cards:

1. Create a project card layout
2. Select all blocks
3. Click three dots menu > **Create pattern**
4. Name it "Project Card"
5. Reuse across all project pages

---

## Screenshot Guide

For projects that can't be embedded (like PHP apps), capture screenshots:

1. Run the project locally
2. Take screenshots of key screens:
   - Home/landing page
   - Key features in action
   - Any interactive elements
3. Upload to WordPress Media Library
4. Add to project cards

**Recommended screenshot sizes:**
- Full width: 1200px wide
- Half width: 600px wide

---

## Checklist

- [ ] Portfolio parent page created
- [ ] Web Applications page with projects
- [ ] Console Applications page with Replit embeds
- [ ] Database Projects page with schemas
- [ ] Visual Programming page
- [ ] Custom CSS added
- [ ] Navigation menu updated
- [ ] All GitHub links working
- [ ] Mobile responsive (test on phone)

---

## Sample Full Project Card (Copy/Paste Ready)

```html
<div class="project-card">
  <h3>[PROJECT NAME]</h3>

  <p class="tech-stack">
    <span class="badge">[TECH 1]</span>
    <span class="badge">[TECH 2]</span>
  </p>

  <p>[2-3 sentence description of what the project does and demonstrates.]</p>

  <h4>Key Features</h4>
  <ul>
    <li>[Feature 1]</li>
    <li>[Feature 2]</li>
    <li>[Feature 3]</li>
  </ul>

  <h4>Live Demo</h4>
  <iframe
    frameborder="0"
    width="100%"
    height="500px"
    src="[REPLIT_EMBED_URL]">
  </iframe>

  <h4>What I Learned</h4>
  <p>[Brief description of skills demonstrated]</p>

  <p><a href="[GITHUB_URL]" target="_blank">
    View Source Code on GitHub →
  </a></p>
</div>
```

---

## Need Help?

- **GoDaddy Support**: Contact via your GoDaddy dashboard
- **WordPress Documentation**: [wordpress.org/support](https://wordpress.org/support/)
- **Replit Documentation**: [docs.replit.com](https://docs.replit.com/)
