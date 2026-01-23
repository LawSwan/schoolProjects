"""
GitHub Archive SQLite CRUD Application
Main Streamlit application with modular architecture
"""

import streamlit as st
from database import init_sqlite, load_json_data, import_data_to_sqlite, get_database_stats
from crud_operations import (
    create_repository,
    read_repositories,
    read_repository_by_id,
    update_repository,
    delete_repository,
    get_repository_count
)
from visualizations import (
    create_top_repos_chart,
    create_distribution_histogram,
    create_pie_chart_top_repos,
    create_watch_range_distribution,
    create_stats_summary,
    display_data_table
)
from github_api import GitHubAPI, import_github_data_to_db, update_repo_from_github
import pandas as pd

# Page configuration
st.set_page_config(
    page_title="GitHub Archive SQLite CRUD",
    page_icon="📊",
    layout="wide"
)

# Custom CSS
st.markdown("""
    <style>
    .main-header {
        font-size: 2.5rem;
        font-weight: bold;
        color: #1f77b4;
        text-align: center;
        margin-bottom: 1rem;
    }
    .section-header {
        font-size: 1.8rem;
        font-weight: bold;
        color: #2c3e50;
        text-align: center;
        margin-top: 1rem;
        margin-bottom: 0.5rem;
    }
    [data-testid="stMetricLabel"] {
        justify-content: center;
        font-size: 0.9rem;
    }
    [data-testid="stMetricValue"] {
        font-size: 1.5rem;
        justify-content: center;
    }
    .stButton > button {
        font-size: 1.1rem;
        font-weight: 600;
        padding: 0.75rem 2rem;
        border-radius: 8px;
    }
    .stTextInput > div > div > input {
        font-size: 1rem;
    }
    .stSelectbox > div > div {
        font-size: 0.95rem;
    }
    .stDownloadButton > button {
        background-color: #28a745;
        color: white;
        font-weight: 600;
    }
    h3 {
        color: #2c3e50;
    }
    </style>
""", unsafe_allow_html=True)


def render_import_page(conn):
    """Render the import data page"""
    st.markdown('<div class="section-header">📥 Import GitHub Archive Data</div>', unsafe_allow_html=True)
    st.markdown("---")
    st.markdown("<br>", unsafe_allow_html=True)

    col_left, col_center, col_right = st.columns([1, 2, 1])

    with col_center:
        count = get_repository_count(conn)

        st.markdown("### 📊 Database Status")

        metric_col1, metric_col2 = st.columns(2)
        with metric_col1:
            st.metric("Current Records", f"{count:,}")
        with metric_col2:
            if count > 0:
                st.metric("Status", "✅ Loaded")
            else:
                st.metric("Status", "⚠️ Empty")

        st.markdown("<br>", unsafe_allow_html=True)
        st.markdown("---")
        st.markdown("<br>", unsafe_allow_html=True)

        st.markdown("### 📂 Available Datasets")

        # Need to check if dataset directory exists relative to this location
        import os

        # Try to find the dataset directory from the MongoDB project
        mongodb_dataset_path = "/Users/ecpi/schoolProjects/NOSQL/mongodb/lab/GitHubArchive-Dataset"

        datasets = {
            "Sample Repositories (22MB) - Recommended": f"{mongodb_dataset_path}/Sample_Repos.json",
            "Sample Commits (78MB)": f"{mongodb_dataset_path}/Sample_Commits.json",
            "Sample Files (4.5MB)": f"{mongodb_dataset_path}/Sample_Files.json",
        }

        selected_dataset = st.selectbox(
            "Choose dataset to import",
            list(datasets.keys()),
            label_visibility="collapsed"
        )

        st.markdown("<br>", unsafe_allow_html=True)

        if st.button("📥 Load Data into SQLite", type="primary", use_container_width=True):
            dataset_path = datasets[selected_dataset]

            if not os.path.exists(dataset_path):
                st.error(f"❌ Dataset not found at: {dataset_path}")
                st.info("💡 Please ensure the GitHubArchive-Dataset folder is available")
                return

            with st.spinner("🔄 Loading data from file..."):
                data, error = load_json_data(dataset_path)

                if error:
                    st.error(f"❌ Error loading file: {error}")
                    return

                st.info(f"✅ Loaded {len(data):,} records from file")

                with st.spinner("🔄 Importing to SQLite..."):
                    success, result = import_data_to_sqlite(conn, data)

                    if success:
                        st.success(f"✅ Successfully imported {result:,} records!")
                        st.balloons()
                        st.rerun()
                    else:
                        st.error(f"❌ Import failed: {result}")

        st.markdown("<br>", unsafe_allow_html=True)

        with st.expander("💡 Tips"):
            st.markdown("""
            - **Recommended**: Start with Sample Repositories (22MB)
            - Import time: ~5-10 seconds for 400K records
            - Data will replace any existing records
            - Use **View Data** page after import to explore
            - SQLite database file: `github_archive.db`
            """)

    st.markdown("<br><br>", unsafe_allow_html=True)


def render_view_page(conn):
    """Render the view data page"""
    st.markdown('<div class="section-header">📊 View Repository Data</div>', unsafe_allow_html=True)
    st.markdown("---")
    st.markdown("<br>", unsafe_allow_html=True)

    total_count = get_repository_count(conn)

    if total_count == 0:
        st.warning("⚠️ No data in database. Please import data first.")
        st.markdown("<br>", unsafe_allow_html=True)
        st.info("👈 Navigate to **Import Data** page to load GitHub Archive datasets")
        return

    col1, col2, col3 = st.columns(3)
    with col1:
        st.metric("Total Records", f"{total_count:,}")
    with col2:
        st.metric("Database", "github_archive.db")
    with col3:
        st.metric("Table", "repositories")

    st.markdown("<br>", unsafe_allow_html=True)
    st.markdown("---")
    st.markdown("<br>", unsafe_allow_html=True)

    st.markdown("### 🔍 Search & Filter")

    col1, col2 = st.columns([3, 1])

    with col1:
        search_term = st.text_input(
            "Search repositories",
            placeholder="e.g., react, python, tensorflow",
            label_visibility="collapsed"
        )

    with col2:
        limit = st.number_input(
            "Rows to show",
            min_value=10,
            max_value=500,
            value=100,
            step=10
        )

    col1, col2, col3 = st.columns([2, 2, 2])

    with col1:
        sort_by = st.selectbox(
            "Sort by",
            ["watch_count", "repo_name", "id"],
            help="Choose field to sort by"
        )

    with col2:
        sort_order = st.selectbox(
            "Order",
            ["Descending", "Ascending"]
        )

    with col3:
        if st.button("🔄 Refresh", use_container_width=True):
            st.rerun()

    st.markdown("<br>", unsafe_allow_html=True)

    # Convert sort order to SQL format
    sort_direction = "DESC" if sort_order == "Descending" else "ASC"

    df = read_repositories(
        conn,
        limit=limit,
        search_term=search_term if search_term else None,
        sort_by=sort_by,
        sort_order=sort_direction
    )

    if not df.empty:
        col1, col2 = st.columns([2, 1])
        with col1:
            st.markdown(f"### 📋 Results: {len(df):,} repositories")
        with col2:
            csv = df.to_csv(index=False)
            st.download_button(
                label="📥 Download CSV",
                data=csv,
                file_name=f"github_repos_{len(df)}.csv",
                mime="text/csv",
                use_container_width=True
            )

        st.markdown("<br>", unsafe_allow_html=True)

        display_data_table(df, height=450)

        st.markdown("<br>", unsafe_allow_html=True)

        with st.expander("📊 View Statistics"):
            stats_col1, stats_col2, stats_col3 = st.columns(3)
            with stats_col1:
                st.metric("Records Shown", f"{len(df):,}")
            with stats_col2:
                if 'watch_count' in df.columns:
                    avg_watches = df['watch_count'].mean()
                    st.metric("Avg Watch Count", f"{avg_watches:,.0f}")
            with stats_col3:
                if 'watch_count' in df.columns:
                    max_watches = df['watch_count'].max()
                    st.metric("Max Watch Count", f"{max_watches:,}")
    else:
        st.info("🔍 No repositories found matching your search criteria")
        st.markdown("**Tips:**")
        st.markdown("- Try a different search term")
        st.markdown("- Check your spelling")
        st.markdown("- Clear the search box to see all records")

    st.markdown("<br><br>", unsafe_allow_html=True)


def render_create_page(conn):
    """Render the create repository page"""
    st.markdown('<div class="section-header">➕ Add New Repository</div>', unsafe_allow_html=True)
    st.markdown("---")

    col1, col2 = st.columns([2, 1])

    with col1:
        with st.form("create_form", clear_on_submit=True):
            st.write("### Repository Details")

            repo_name = st.text_input(
                "Repository Name",
                placeholder="e.g., facebook/react",
                help="Enter the full repository name (owner/repo)"
            )

            watch_count = st.number_input(
                "Watch Count",
                min_value=0,
                value=100,
                step=1,
                help="Number of watchers for this repository"
            )

            submitted = st.form_submit_button("➕ Add Repository", type="primary", use_container_width=True)

            if submitted:
                if repo_name.strip():
                    success, message = create_repository(conn, repo_name.strip(), watch_count)
                    if success:
                        st.success(message)
                        st.rerun()
                    else:
                        st.error(message)
                else:
                    st.error("❌ Please enter a repository name")

    with col2:
        st.info("### 💡 Tips")
        st.markdown("""
        - Use format: `owner/repo`
        - Watch count must be ≥ 0
        - Repository ID will be auto-generated
        - Changes are saved immediately
        """)


def render_update_page(conn):
    """Render the update repository page"""
    st.markdown('<div class="section-header">✏️ Update Repository</div>', unsafe_allow_html=True)
    st.markdown("---")

    st.write("### Current Repositories (Top 50)")
    df = read_repositories(conn, limit=50)

    if not df.empty:
        display_data_table(df, height=250)

        st.markdown("---")
        st.write("### Update Form")

        col1, col2 = st.columns([2, 1])

        with col1:
            with st.form("update_form"):
                repo_id = st.number_input(
                    "Repository ID to Update",
                    min_value=1,
                    value=1,
                    step=1,
                    help="Enter the ID of the repository you want to update"
                )

                existing_repo = read_repository_by_id(conn, repo_id)

                if existing_repo:
                    st.info(f"Current: {existing_repo['repo_name']} (Watches: {existing_repo['watch_count']})")

                new_name = st.text_input(
                    "New Repository Name",
                    placeholder="Leave empty to keep current name"
                )

                new_watch_count = st.number_input(
                    "New Watch Count",
                    min_value=0,
                    value=0,
                    step=1,
                    help="Enter new watch count (must enter a value)"
                )

                submitted = st.form_submit_button("✏️ Update Repository", type="primary", use_container_width=True)

                if submitted:
                    if new_name.strip() or new_watch_count >= 0:
                        success, message = update_repository(
                            conn,
                            repo_id,
                            new_name.strip() if new_name.strip() else None,
                            new_watch_count
                        )
                        if success:
                            st.success(message)
                            st.rerun()
                        else:
                            st.error(message)
                    else:
                        st.error("❌ Please provide at least one field to update")

        with col2:
            st.info("### 💡 Tips")
            st.markdown("""
            - Find ID from table above
            - Leave name empty to keep current
            - Watch count must be specified
            - Changes apply immediately
            """)
    else:
        st.warning("⚠️ No data in database. Please import data first.")


def render_delete_page(conn):
    """Render the delete repository page"""
    st.markdown('<div class="section-header">🗑️ Delete Repository</div>', unsafe_allow_html=True)
    st.markdown("---")

    st.write("### Current Repositories (Top 50)")
    df = read_repositories(conn, limit=50)

    if not df.empty:
        display_data_table(df, height=250)

        st.markdown("---")
        st.write("### Delete Form")

        col1, col2 = st.columns([2, 1])

        with col1:
            repo_id = st.number_input(
                "Repository ID to Delete",
                min_value=1,
                value=1,
                step=1,
                help="Enter the ID of the repository you want to delete"
            )

            existing_repo = read_repository_by_id(conn, repo_id)
            if existing_repo:
                st.warning(f"⚠️ You are about to delete: **{existing_repo['repo_name']}**")

            col_btn1, col_btn2 = st.columns([1, 1])

            with col_btn1:
                if st.button("🗑️ Delete Repository", type="primary", use_container_width=True):
                    success, message = delete_repository(conn, repo_id)
                    if success:
                        st.success(message)
                        st.rerun()
                    else:
                        st.error(message)

        with col2:
            st.error("### ⚠️ Warning")
            st.markdown("""
            - This action is **permanent**
            - Cannot be undone
            - Data will be lost forever
            - Double-check the ID
            """)
    else:
        st.warning("⚠️ No data in database. Please import data first.")


def render_analytics_page(conn):
    """Render the analytics and visualizations page"""
    st.markdown('<div class="section-header">📈 Repository Analytics & Visualizations</div>', unsafe_allow_html=True)
    st.markdown("---")

    stats = get_database_stats(conn)

    if stats and stats['total_repos'] > 0:
        create_stats_summary(stats)

        st.markdown("---")

        tab1, tab2, tab3, tab4 = st.tabs([
            "📊 Top Repositories",
            "📈 Distribution",
            "🥧 Pie Chart",
            "📉 Range Analysis"
        ])

        with tab1:
            st.write("### Top 10 Most Watched Repositories")
            fig = create_top_repos_chart(stats['top_repos'])
            if fig:
                st.plotly_chart(fig, use_container_width=True)

        with tab2:
            st.write("### Watch Count Distribution")
            fig = create_distribution_histogram(conn)
            if fig:
                st.plotly_chart(fig, use_container_width=True)

        with tab3:
            st.write("### Top Repositories Share")
            fig = create_pie_chart_top_repos(stats['top_repos'], top_n=8)
            if fig:
                st.plotly_chart(fig, use_container_width=True)

        with tab4:
            st.write("### Repository Distribution by Watch Count Ranges")
            fig = create_watch_range_distribution(conn)
            if fig:
                st.plotly_chart(fig, use_container_width=True)

    else:
        st.warning("⚠️ No data available for analytics. Please import data first.")


def render_github_api_page(conn):
    """Render the GitHub API integration page"""
    st.markdown('<div class="section-header">🌐 GitHub API - Live Data Integration</div>', unsafe_allow_html=True)
    st.markdown("---")

    # Initialize API client
    if 'github_api' not in st.session_state:
        st.session_state.github_api = GitHubAPI()

    api = st.session_state.github_api

    # Display rate limit info
    st.markdown("### 📊 API Status")
    rate_info = api.get_rate_limit()

    if rate_info:
        col1, col2, col3, col4 = st.columns(4)
        with col1:
            st.metric("Rate Limit", f"{rate_info['limit']}/hour")
        with col2:
            st.metric("Remaining", rate_info['remaining'])
        with col3:
            st.metric("Used", rate_info['used'])
        with col4:
            st.metric("Resets At", rate_info['reset_time'])

        # Warning if low on requests
        if rate_info['remaining'] < 10:
            st.warning(f"⚠️ Low on API requests! Resets at {rate_info['reset_time']}")
    else:
        st.info("ℹ️ GitHub API connection not verified")

    st.markdown("<br>", unsafe_allow_html=True)
    st.markdown("---")

    # Tabs for different API features
    tab1, tab2, tab3, tab4 = st.tabs([
        "🔍 Search Repositories",
        "🔥 Trending",
        "📥 Import to Database",
        "🔄 Update From GitHub"
    ])

    with tab1:
        st.write("### Search GitHub Repositories")
        st.markdown("Search for repositories on GitHub by keyword, language, or topic")

        col1, col2 = st.columns([3, 1])

        with col1:
            search_query = st.text_input(
                "Search Query",
                placeholder="e.g., 'machine learning', 'language:python', 'react hooks'",
                help="Use GitHub search syntax: language:python, stars:>1000, etc."
            )

        with col2:
            max_results = st.number_input(
                "Max Results",
                min_value=5,
                max_value=100,
                value=30,
                step=5
            )

        sort_by = st.selectbox(
            "Sort By",
            ["stars", "forks", "updated"],
            help="Sort results by stars, forks, or last updated"
        )

        if st.button("🔍 Search GitHub", type="primary", use_container_width=True):
            if search_query.strip():
                with st.spinner("🔄 Searching GitHub..."):
                    repos, error = api.search_repositories(search_query, sort=sort_by, max_results=max_results)

                    if error:
                        st.error(f"❌ {error}")
                    elif repos:
                        st.success(f"✅ Found {len(repos)} repositories!")

                        # Convert to DataFrame
                        df = pd.DataFrame(repos)
                        df = df[['repo_name', 'watch_count', 'stars', 'forks', 'language', 'description']]

                        st.dataframe(df, use_container_width=True, height=400)

                        # Option to import results
                        st.markdown("---")
                        if st.button("📥 Import These Results to Database", type="secondary"):
                            success, msg = import_github_data_to_db(conn, repos)
                            if success:
                                st.success(msg)
                                st.rerun()
                            else:
                                st.error(msg)
                    else:
                        st.info("No repositories found")
            else:
                st.warning("⚠️ Please enter a search query")

    with tab2:
        st.write("### Trending Repositories")
        st.markdown("Discover what's trending on GitHub right now")

        col1, col2 = st.columns(2)

        with col1:
            language_filter = st.selectbox(
                "Programming Language",
                ["", "python", "javascript", "java", "go", "rust", "typescript", "c++", "ruby", "php"],
                format_func=lambda x: "All Languages" if x == "" else x.title()
            )

        with col2:
            time_range = st.selectbox(
                "Time Range",
                ["daily", "weekly", "monthly"],
                format_func=lambda x: x.title()
            )

        if st.button("🔥 Get Trending Repos", type="primary", use_container_width=True):
            with st.spinner("🔄 Fetching trending repositories..."):
                repos, error = api.get_trending_repositories(language=language_filter, since=time_range)

                if error:
                    st.error(f"❌ {error}")
                elif repos:
                    st.success(f"✅ Found {len(repos)} trending repositories!")

                    df = pd.DataFrame(repos)
                    df = df[['repo_name', 'watch_count', 'stars', 'forks', 'language', 'description']]

                    st.dataframe(df, use_container_width=True, height=400)

                    # Option to import
                    st.markdown("---")
                    if st.button("📥 Import Trending Repos to Database", type="secondary"):
                        success, msg = import_github_data_to_db(conn, repos)
                        if success:
                            st.success(msg)
                            st.rerun()
                        else:
                            st.error(msg)
                else:
                    st.info("No trending repositories found")

    with tab3:
        st.write("### Import Repositories by Name")
        st.markdown("Fetch specific repositories from GitHub and import to database")

        repo_input = st.text_area(
            "Repository Names (one per line)",
            placeholder="facebook/react\nmicrosoft/vscode\ntensorflow/tensorflow",
            height=150,
            help="Enter full repository names in format: owner/repo"
        )

        if st.button("📥 Fetch and Import", type="primary", use_container_width=True):
            if repo_input.strip():
                repo_names = [line.strip() for line in repo_input.split('\n') if line.strip()]

                with st.spinner(f"🔄 Fetching {len(repo_names)} repositories from GitHub..."):
                    repos, errors = api.batch_get_repositories(repo_names)

                    if repos:
                        st.success(f"✅ Successfully fetched {len(repos)} repositories")

                        # Show fetched data
                        df = pd.DataFrame(repos)
                        df_display = df[['repo_name', 'watch_count', 'stars', 'forks', 'language']]
                        st.dataframe(df_display, use_container_width=True)

                        # Import to database
                        with st.spinner("📥 Importing to database..."):
                            success, msg = import_github_data_to_db(conn, repos)
                            if success:
                                st.success(msg)
                                st.rerun()
                            else:
                                st.error(msg)

                    if errors:
                        st.warning("⚠️ Some repositories had errors:")
                        for error in errors:
                            st.text(f"  • {error}")

                    if not repos and not errors:
                        st.info("No repositories fetched")
            else:
                st.warning("⚠️ Please enter at least one repository name")

    with tab4:
        st.write("### Update Existing Data from GitHub")
        st.markdown("Refresh watch counts for repositories already in your database")

        # Show some existing repos
        st.write("#### Your Repositories (Top 20)")
        df = read_repositories(conn, limit=20)

        if not df.empty:
            st.dataframe(df[['_id', 'repo_name', 'watch_count']], use_container_width=True, height=300)

            st.markdown("---")

            col1, col2 = st.columns([2, 1])

            with col1:
                repo_id = st.number_input(
                    "Repository ID to Update",
                    min_value=1,
                    value=1,
                    step=1,
                    help="Enter the ID from the table above"
                )

            with col2:
                st.write("")  # Spacing
                st.write("")  # Spacing
                if st.button("🔄 Update from GitHub", type="primary", use_container_width=True):
                    with st.spinner("🔄 Fetching latest data from GitHub..."):
                        success, msg = update_repo_from_github(conn, repo_id, api)

                        if success:
                            st.success(msg)
                            st.rerun()
                        else:
                            st.error(msg)

            # Bulk update option
            st.markdown("---")
            st.write("#### Bulk Update")
            st.markdown("Update multiple repositories at once (This will use API rate limit)")

            num_to_update = st.number_input(
                "Number of repositories to update",
                min_value=1,
                max_value=50,
                value=10,
                help="Update the top N repositories from your database"
            )

            if st.button("🔄 Bulk Update Top Repositories", type="secondary", use_container_width=True):
                if rate_info and rate_info['remaining'] < num_to_update:
                    st.error(f"❌ Not enough API requests remaining! You have {rate_info['remaining']} left.")
                else:
                    with st.spinner(f"🔄 Updating {num_to_update} repositories..."):
                        # Get top N repos
                        top_repos = read_repositories(conn, limit=num_to_update)

                        if not top_repos.empty:
                            success_count = 0
                            error_count = 0
                            updates = []

                            progress_bar = st.progress(0)

                            for idx, row in top_repos.iterrows():
                                success, msg = update_repo_from_github(conn, row['_id'], api)

                                if success:
                                    success_count += 1
                                    updates.append(msg)
                                else:
                                    error_count += 1

                                progress_bar.progress((idx + 1) / len(top_repos))

                            st.success(f"✅ Updated {success_count} repositories (Errors: {error_count})")

                            with st.expander("📊 View Update Details"):
                                for update in updates:
                                    st.text(update)

                            st.rerun()
                        else:
                            st.warning("No repositories found in database")
        else:
            st.warning("⚠️ No data in database. Please import data first.")

    # Tips section
    st.markdown("---")
    with st.expander("💡 Tips & Best Practices"):
        st.markdown("""
        ### GitHub API Usage Tips

        **Rate Limits:**
        - Unauthenticated: 60 requests/hour
        - Authenticated: 5,000 requests/hour (requires personal access token)

        **Search Syntax:**
        - `language:python` - Filter by programming language
        - `stars:>1000` - Repositories with more than 1000 stars
        - `created:>2023-01-01` - Recently created repositories
        - `topic:machine-learning` - Filter by topic

        **Best Practices:**
        - Monitor your rate limit usage
        - Use specific search queries to get better results
        - Import data in batches to avoid timeout
        - Update data during off-peak hours

        **Popular Languages:**
        python, javascript, java, go, rust, typescript, c++, ruby, php, swift

        **For Higher Rate Limits:**
        Generate a personal access token at: https://github.com/settings/tokens
        """)


def main():
    """Main application function"""
    st.markdown('<div class="main-header">📊 GitHub Archive SQLite CRUD Application</div>', unsafe_allow_html=True)

    # Initialize SQLite
    conn, status = init_sqlite()

    if conn is None:
        st.error(f"❌ **SQLite Connection Failed**")
        st.error(f"Error: {status}")
        st.info("💡 **How to fix:**")
        st.markdown("- Check file permissions in current directory")
        st.markdown("- Ensure sufficient disk space")
        st.markdown("- Verify Python sqlite3 module is available")
        return

    st.success("✅ Connected to SQLite Database")

    # Sidebar navigation
    st.sidebar.title("🧭 Navigation")
    st.sidebar.markdown("---")

    page = st.sidebar.radio(
        "Select Page",
        [
            "📥 Import Data",
            "📊 View Data",
            "➕ Create",
            "✏️ Update",
            "🗑️ Delete",
            "📈 Analytics",
            "🌐 GitHub API"
        ],
        label_visibility="collapsed"
    )

    st.sidebar.markdown("---")

    count = get_repository_count(conn)
    st.sidebar.metric("Total Records", f"{count:,}")

    # Render selected page
    if page == "📥 Import Data":
        render_import_page(conn)
    elif page == "📊 View Data":
        render_view_page(conn)
    elif page == "➕ Create":
        render_create_page(conn)
    elif page == "✏️ Update":
        render_update_page(conn)
    elif page == "🗑️ Delete":
        render_delete_page(conn)
    elif page == "📈 Analytics":
        render_analytics_page(conn)
    elif page == "🌐 GitHub API":
        render_github_api_page(conn)

    # Footer
    st.sidebar.markdown("---")
    st.sidebar.info("""
    ### 💡 Quick Start
    1. Import data from datasets
    2. View and explore records
    3. Perform CRUD operations
    4. Analyze with charts
    """)

    st.sidebar.markdown("---")
    st.sidebar.caption("ECPI University - NoSQL Database Course")
    st.sidebar.caption("SQLite Implementation")


if __name__ == "__main__":
    main()
