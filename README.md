# Amber Janelle | Portfolio

[![Live Site](https://img.shields.io/badge/Live%20Site-amberjanelle.com-ec4899?style=for-the-badge)](https://amberjanelle.com)
[![GitHub](https://img.shields.io/badge/GitHub-LawSwan-181717?style=for-the-badge&logo=github)](https://github.com/LawSwan)

A single-page developer portfolio built with vanilla JavaScript and Tailwind CSS. Projects are defined as custom JavaScript objects, serialized with `JSON.stringify()`, stored in `sessionStorage`, and rendered dynamically into the DOM on every page load.

---

## Overview

The portfolio page demonstrates several JavaScript concepts applied in a real project:

- **Custom JS objects** — each project is defined as an object with `title`, `summary`, `image`, and `repo` properties
- **Array iteration** — projects are stored in an array and rendered using `forEach()`
- **sessionStorage** — the project array is serialized and stored on first load; subsequent loads read and parse the stored data
- **Dynamic DOM rendering** — project cards are created entirely in JavaScript using `createElement` and `innerHTML`
- **localStorage** — dark mode preference persists across browser sessions
- **Conditional logic** — featured content section adapts based on project count
- **setTimeout** — used for the delayed notification banner and form submission feedback

---

## Languages & Libraries

| Technology | Purpose |
|---|---|
| HTML5 | Page structure and semantic markup |
| CSS3 | Custom styles (toggle switch, modal, gradient, card hover) |
| JavaScript (ES5/ES6) | All interactivity, DOM manipulation, and data storage |
| [Tailwind CSS](https://tailwindcss.com/) | Utility-first styling via CDN |

---

## Dependencies

All dependencies are loaded via CDN — no build step or package manager required.

| Dependency | Version | CDN |
|---|---|---|
| Tailwind CSS | Latest | `https://cdn.tailwindcss.com` |

No `npm install` or local setup needed.

---

## Running the Page

This is a static site hosted on **GitHub Pages**.

**To view live:** [amberjanelle.com](https://amberjanelle.com)

**To run locally:**
1. Clone the repository:
   ```bash
   git clone https://github.com/LawSwan/amberjanelle.com.git
   ```
2. Open `index.html` in any modern browser — no server required.

---

## Features

- Dark mode toggle with `localStorage` persistence
- Welcome modal on page load
- Skills list generated dynamically from a JavaScript array
- Project cards built from JS objects stored in `sessionStorage`
- Delayed notification banner using `setTimeout`
- Contact form with simulated send and success/reset feedback
- Fully responsive layout via Tailwind CSS grid

---

## Projects Displayed

| Project | Language | Repository |
|---|---|---|
| Bank Account System | Java | [View](https://github.com/LawSwan/schoolProjects/blob/java/java/LAB/Project%20/src/BankAccount.java) |
| Catch the Turtle Game | Python | [View](https://github.com/LawSwan/schoolProjects/blob/Python/Python/myenv/Python/PYIntro/Week%204/Program%20Catch_The_Turtle.py) |
| Digital Products Store | PHP / MVC | [View](https://github.com/LawSwan/schoolProjects/tree/server-side-scripting/ServerSideScripting/src/Digital_Products_Store) |
| Game Store Database | SQL / Oracle | [View](https://github.com/LawSwan/schoolProjects/blob/sql/sql/WEEK%201/Project%20Build%20Script.sql) |
| NoSQL Database Suite | MongoDB / Redis / Cassandra / Neo4j | [View](https://github.com/LawSwan/schoolProjects/tree/NOSQL/NOSQL) |
| JavaScript Portfolio Site | JavaScript / HTML / CSS | [View](https://github.com/LawSwan/amberjanelle.com) |

---

## Contact

- Email: [amberjanelle33@gmail.com](mailto:amberjanelle33@gmail.com)
- GitHub: [@LawSwan](https://github.com/LawSwan)
