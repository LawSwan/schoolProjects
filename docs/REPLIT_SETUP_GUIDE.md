# Replit Setup Guide

This guide walks you through creating embeddable Replit projects for your portfolio.

---

## Step 1: Create a Replit Account

1. Go to [replit.com](https://replit.com)
2. Click **Sign Up** (free account works fine)
3. Complete the registration process

---

## Step 2: Import Projects from GitHub

### Method A: Import Entire Repository

1. Click **Create Repl** (blue button)
2. Select **Import from GitHub**
3. Paste your repository URL:
   ```
   https://github.com/LawSwan/schoolProjects.git
   ```
4. Select the specific branch (e.g., `java`, `Python`)
5. Click **Import from GitHub**

### Method B: Create Individual Repls

For better organization, create separate Repls for each project:

1. Click **Create Repl**
2. Choose the language (Python, Java, etc.)
3. Name it descriptively (e.g., "Bank-Account-System")
4. Copy the code from your GitHub repository

---

## Step 3: Configure Each Project

### For Java Projects

**Bank Account System:**
```bash
# In the .replit file, set:
run = "javac src/*.java -d bin && java -cp bin App"
```

Or use the Shell to compile and run:
```bash
cd src
javac *.java
java App
```

### For Python Projects

**Catch the Turtle:**
```bash
# In the .replit file:
run = "python 'Program Catch_The_Turtle.py'"
```

**Web Scraper:**
```bash
run = "python webscrape.py"
```

**Note:** Install dependencies first:
```bash
pip install requests beautifulsoup4 openpyxl
```

---

## Step 4: Generate Embed Code

1. Open your Repl
2. Click the **Share** button (top right)
3. Select the **Embed** tab
4. Choose your embed options:
   - **Show code**: Display the source code
   - **Show output**: Display the console/result
   - **Show both**: Split view (recommended)
5. Copy the iframe code:

```html
<iframe frameborder="0" width="100%" height="500px"
  src="https://replit.com/@YourUsername/ProjectName?embed=true">
</iframe>
```

---

## Step 5: Customize Embed Settings

### Embed URL Parameters

| Parameter | Values | Description |
|-----------|--------|-------------|
| `embed=true` | Required | Enables embed mode |
| `outputonly=1` | 0 or 1 | Show only output |
| `lite=true` | true | Minimal interface |

**Example with parameters:**
```html
<iframe frameborder="0" width="100%" height="500px"
  src="https://replit.com/@YourUsername/Bank-Account?embed=true&outputonly=1">
</iframe>
```

---

## Recommended Projects to Embed

### Console Applications (Best for Embedding)

| Project | Branch | Repl Language | Notes |
|---------|--------|---------------|-------|
| Bank Account System | java | Java | Great demo of OOP |
| Catch the Turtle | Python | Python (with Pygame) | Visual game |
| Web Scraper | Python | Python | Shows output nicely |
| Number Sort | Python | Python | Simple demo |

### Web Applications (Alternative Approach)

For PHP projects like Digital Products Store:
- Consider hosting on a free PHP host instead
- Or create a simplified JavaScript version for Replit

---

## Troubleshooting

### "Module not found" Errors
```bash
# In the Shell, install missing packages:
pip install requests beautifulsoup4 PyPDF2 openpyxl
```

### Java Compilation Errors
```bash
# Ensure correct directory structure:
mkdir -p src bin
# Compile with proper paths:
javac -d bin src/*.java
java -cp bin App
```

### Turtle Graphics Not Working
Replit supports turtle graphics in Python Repls. Make sure to:
1. Use the **Python (with Turtle)** template
2. Or install: `pip install turtle`

---

## Example Embed Setup for WordPress

After creating your Repls, you'll embed them in WordPress using the HTML block:

```html
<!-- In WordPress, add an HTML block and paste: -->
<div style="margin: 20px 0;">
  <h3>Bank Account System Demo</h3>
  <iframe
    frameborder="0"
    width="100%"
    height="500px"
    src="https://replit.com/@YourUsername/Bank-Account-System?embed=true">
  </iframe>
</div>
```

---

## Quick Reference: Your Projects

Create these Repls for your portfolio:

| Repl Name | Source Files | Language |
|-----------|--------------|----------|
| Bank-Account-System | `java/LAB/Project /src/*.java` | Java |
| Catch-The-Turtle | `Python/.../Week 4/Program Catch_The_Turtle.py` | Python |
| Web-Scraper | `Python/.../Week 3/webscrape.py` | Python |
| Number-Sort | `Python/.../Week 2/NumberSort.py` | Python |

---

## Next Steps

After setting up your Repls:
1. Test each embed works correctly
2. Note the embed URLs
3. See `WORDPRESS_PORTFOLIO_GUIDE.md` for adding them to your site
