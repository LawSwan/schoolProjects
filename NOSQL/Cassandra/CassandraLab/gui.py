"""
GUI layout and styling
Author: Amber Lawson
Date: 2026-01-13
"""

import tkinter as tk
from tkinter import ttk, messagebox, scrolledtext
import json
import config


class GitHubAnalyzerGUI:
    """Handles all GUI components and layout"""

    def __init__(self, root, app_controller):
        self.root = root
        self.controller = app_controller
        self.setup_window()
        self.setup_ui()

    def setup_window(self):
        """Configure main window"""
        self.root.title(config.WINDOW_TITLE)
        self.root.geometry(config.WINDOW_SIZE)

    def setup_ui(self):
        """Setup the complete UI"""
        # Title
        title = tk.Label(
            self.root,
            text="GitHub Archive Analyzer",
            font=("Arial", 20, "bold"),
            bg="#2c3e50",
            fg="white",
            pady=10
        )
        title.pack(fill=tk.X)

        # Create notebook (tabbed interface)
        self.notebook = ttk.Notebook(self.root)
        self.notebook.pack(fill=tk.BOTH, expand=True, padx=10, pady=10)

        # Create tabs
        self.create_data_import_tab()
        self.create_contributors_tab()
        self.create_languages_tab()
        self.create_topics_tab()

        # Status bar
        self.status_bar = tk.Label(
            self.root,
            text="Ready",
            bd=1,
            relief=tk.SUNKEN,
            anchor=tk.W
        )
        self.status_bar.pack(side=tk.BOTTOM, fill=tk.X)

    def create_data_import_tab(self):
        """Tab for importing GitHub data"""
        tab = ttk.Frame(self.notebook)
        self.notebook.add(tab, text="📥 Import Data")

        # Instructions
        instructions = tk.Label(
            tab,
            text="Import GitHub Archive JSON Data",
            font=("Arial", 14, "bold"),
            pady=10
        )
        instructions.pack()

        # Sample data display
        tk.Label(tab, text="Sample JSON format:", font=("Arial", 10)).pack(pady=5)

        sample_text = scrolledtext.ScrolledText(tab, height=15, width=80)
        sample_text.pack(padx=10, pady=5)
        sample_text.insert(tk.END, self.get_sample_json())
        sample_text.config(state=tk.DISABLED)

        # Import buttons
        btn_frame = tk.Frame(tab)
        btn_frame.pack(pady=10)

        tk.Button(
            btn_frame,
            text="🌐 Fetch Live GitHub Data",
            command=self.controller.load_github_data,
            bg="#691E69",
            fg="white",
            font=("Arial", 12),
            padx=20,
            pady=5
        ).pack(side=tk.LEFT, padx=5)

        tk.Button(
            btn_frame,
            text="Clear All Data",
            command=self.controller.clear_all_data,
            bg="#e74c3c",
            fg="white",
            font=("Arial", 12),
            padx=20,
            pady=5
        ).pack(side=tk.LEFT, padx=5)

    def create_contributors_tab(self):
        """Tab for displaying contributors"""
        tab = ttk.Frame(self.notebook)
        self.notebook.add(tab, text="👥 Contributors")

        tk.Label(
            tab,
            text="Most Active Contributors",
            font=("Arial", 14, "bold"),
            pady=10
        ).pack()

        # Results display
        self.contributors_text = scrolledtext.ScrolledText(tab, height=25, width=100)
        self.contributors_text.pack(padx=10, pady=10)

        # Refresh button
        tk.Button(
            tab,
            text="🔄 Refresh Data",
            command=self.controller.display_contributors,
            bg="#2ecc71",
            fg="white",
            font=("Arial", 12),
            padx=20,
            pady=5
        ).pack(pady=10)

    def create_languages_tab(self):
        """Tab for displaying language statistics"""
        tab = ttk.Frame(self.notebook)
        self.notebook.add(tab, text="💻 Languages")

        tk.Label(
            tab,
            text="Repository Language Statistics",
            font=("Arial", 14, "bold"),
            pady=10
        ).pack()

        # Results display
        self.languages_text = scrolledtext.ScrolledText(tab, height=25, width=100)
        self.languages_text.pack(padx=10, pady=10)

        # Refresh button
        tk.Button(
            tab,
            text="🔄 Refresh Data",
            command=self.controller.display_languages,
            bg="#2ecc71",
            fg="white",
            font=("Arial", 12),
            padx=20,
            pady=5
        ).pack(pady=10)

    def create_topics_tab(self):
        """Tab for displaying trending topics"""
        tab = ttk.Frame(self.notebook)
        self.notebook.add(tab, text="🔥 Trending")

        tk.Label(
            tab,
            text="Trending Topics & Repositories",
            font=("Arial", 14, "bold"),
            pady=10
        ).pack()

        # Results display
        self.topics_text = scrolledtext.ScrolledText(tab, height=25, width=100)
        self.topics_text.pack(padx=10, pady=10)

        # Refresh button
        tk.Button(
            tab,
            text="🔄 Refresh Data",
            command=self.controller.display_topics,
            bg="#2ecc71",
            fg="white",
            font=("Arial", 12),
            padx=20,
            pady=5
        ).pack(pady=10)

    def get_sample_json(self):
        """Return sample JSON format"""
        sample = {
            "repositories": [
                {
                    "repo_name": "python/cpython",
                    "language": "Python",
                    "stars": 45000,
                    "description": "The Python programming language",
                    "topics": ["python", "programming", "interpreter"]
                }
            ],
            "contributors": [
                {
                    "username": "guido",
                    "commits": 1500,
                    "repositories": ["python/cpython", "python/peps"]
                }
            ]
        }
        return json.dumps(sample, indent=2)

    def update_status(self, message):
        """Update status bar message"""
        self.status_bar.config(text=message)
        self.root.update()

    def show_error(self, title, message):
        """Show error message dialog"""
        messagebox.showerror(title, message)

    def show_success(self, title, message):
        """Show success message dialog"""
        messagebox.showinfo(title, message)

    def show_warning(self, title, message):
        """Show warning message dialog"""
        messagebox.showwarning(title, message)

    def display_contributors_data(self, contributors):
        """Display contributors in the text widget"""
        self.contributors_text.config(state=tk.NORMAL)
        self.contributors_text.delete(1.0, tk.END)

        self.contributors_text.insert(tk.END, "=" * 80 + "\n")
        self.contributors_text.insert(tk.END, "MOST ACTIVE CONTRIBUTORS\n")
        self.contributors_text.insert(tk.END, "=" * 80 + "\n\n")

        for i, contrib in enumerate(contributors, 1):
            self.contributors_text.insert(tk.END, f"#{i} {contrib.username}\n")
            self.contributors_text.insert(tk.END, f"   📊 Commits: {contrib.commit_count:,}\n")
            self.contributors_text.insert(tk.END, f"   📁 Repositories: {len(contrib.repositories)}\n")
            self.contributors_text.insert(tk.END, f"   🗓️  Last Active: {contrib.last_active.strftime('%Y-%m-%d')}\n")
            self.contributors_text.insert(tk.END, f"   Repos: {', '.join(list(contrib.repositories)[:3])}\n\n")

        self.contributors_text.config(state=tk.DISABLED)

    def display_languages_data(self, language_stats):
        """Display language statistics"""
        self.languages_text.config(state=tk.NORMAL)
        self.languages_text.delete(1.0, tk.END)

        self.languages_text.insert(tk.END, "=" * 80 + "\n")
        self.languages_text.insert(tk.END, "REPOSITORY LANGUAGE STATISTICS\n")
        self.languages_text.insert(tk.END, "=" * 80 + "\n\n")

        total_repos = sum(stats['count'] for _, stats in language_stats)

        for language, stats in language_stats:
            percentage = (stats['count'] / total_repos) * 100
            avg_stars = stats['total_stars'] / stats['count']

            self.languages_text.insert(tk.END, f"💻 {language}\n")
            self.languages_text.insert(tk.END, f"   Repositories: {stats['count']} ({percentage:.1f}%)\n")
            self.languages_text.insert(tk.END, f"   Total Stars: {stats['total_stars']:,}\n")
            self.languages_text.insert(tk.END, f"   Average Stars: {avg_stars:,.0f}\n")
            self.languages_text.insert(tk.END, f"   Bar: {'█' * int(percentage * 2)}\n")

            # Show top repos
            top_repos = sorted(stats['repos'], key=lambda x: x[1], reverse=True)[:2]
            self.languages_text.insert(tk.END, f"   Top Repos: {', '.join([r[0] for r in top_repos])}\n\n")

        self.languages_text.config(state=tk.DISABLED)

    def display_topics_data(self, topics):
        """Display trending topics"""
        self.topics_text.config(state=tk.NORMAL)
        self.topics_text.delete(1.0, tk.END)

        self.topics_text.insert(tk.END, "=" * 80 + "\n")
        self.topics_text.insert(tk.END, "TRENDING TOPICS & REPOSITORIES\n")
        self.topics_text.insert(tk.END, "=" * 80 + "\n\n")

        for i, topic in enumerate(topics, 1):
            self.topics_text.insert(tk.END, f"#{i} 🔥 {topic.topic.upper()}\n")
            self.topics_text.insert(tk.END, f"   📦 Repositories: {topic.repo_count}\n")
            self.topics_text.insert(tk.END, f"   ⭐ Total Stars: {topic.total_stars:,}\n")
            self.topics_text.insert(tk.END, f"   🔄 Last Updated: {topic.last_updated.strftime('%Y-%m-%d %H:%M')}\n")
            self.topics_text.insert(tk.END, f"   Popularity: {'⭐' * min(topic.repo_count, 10)}\n\n")

        self.topics_text.config(state=tk.DISABLED)
