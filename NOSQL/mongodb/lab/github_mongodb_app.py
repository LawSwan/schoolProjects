"""
GitHub Archive MongoDB CRUD Application
Main Streamlit application with modular architecture
"""

import streamlit as st
from database import init_mongodb, load_json_data, import_data_to_mongo, get_database_stats
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

# Page configuration
st.set_page_config(
    page_title="GitHub Archive MongoDB CRUD",
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
    /* Center metric labels */
    [data-testid="stMetricLabel"] {
        justify-content: center;
        font-size: 0.9rem;
    }
    [data-testid="stMetricValue"] {
        font-size: 1.5rem;
        justify-content: center;
    }
    /* Button styling */
    .stButton > button {
        font-size: 1.1rem;
        font-weight: 600;
        padding: 0.75rem 2rem;
        border-radius: 8px;
    }
    /* Input fields */
    .stTextInput > div > div > input {
        font-size: 1rem;
    }
    /* Selectbox */
    .stSelectbox > div > div {
        font-size: 0.95rem;
    }
    /* Download button */
    .stDownloadButton > button {
        background-color: #28a745;
        color: white;
        font-weight: 600;
    }
    /* Table header */
    h3 {
        color: #2c3e50;
    }
    </style>
""", unsafe_allow_html=True)


def render_import_page(collection):
    """Render the import data page"""
    st.markdown('<div class="section-header">📥 Import GitHub Archive Data</div>', unsafe_allow_html=True)
    st.markdown("---")
    st.markdown("<br>", unsafe_allow_html=True)

    # Center content with columns
    col_left, col_center, col_right = st.columns([1, 2, 1])

    with col_center:
        # Database Status Card
        count = get_repository_count(collection)

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

        # Available Datasets Section
        st.markdown("### 📂 Available Datasets")

        datasets = {
            "Sample Repositories (22MB) - Recommended": "GitHubArchive-Dataset/Sample_Repos.json",
            "Sample Commits (78MB)": "GitHubArchive-Dataset/Sample_Commits.json",
            "Sample Files (4.5MB)": "GitHubArchive-Dataset/Sample_Files.json",
        }

        selected_dataset = st.selectbox(
            "Choose dataset to import",
            list(datasets.keys()),
            label_visibility="collapsed"
        )

        st.markdown("<br>", unsafe_allow_html=True)

        # Centered Import Button
        if st.button("📥 Load Data into MongoDB", type="primary", use_container_width=True):
            with st.spinner("🔄 Loading data from file..."):
                data, error = load_json_data(datasets[selected_dataset])

                if error:
                    st.error(f"❌ Error loading file: {error}")
                    return

                st.info(f"✅ Loaded {len(data):,} records from file")

                with st.spinner("🔄 Importing to MongoDB..."):
                    success, result = import_data_to_mongo(collection, data)

                    if success:
                        st.success(f"✅ Successfully imported {result:,} records!")
                        st.balloons()
                        st.rerun()
                    else:
                        st.error(f"❌ Import failed: {result}")

        st.markdown("<br>", unsafe_allow_html=True)

        # Quick Tips
        with st.expander("💡 Tips"):
            st.markdown("""
            - **Recommended**: Start with Sample Repositories (22MB)
            - Import time: ~5-10 seconds for 400K records
            - Data will replace any existing records
            - Use **View Data** page after import to explore
            """)

    st.markdown("<br><br>", unsafe_allow_html=True)


def render_view_page(collection):
    """Render the view data page"""
    st.markdown('<div class="section-header">📊 View Repository Data</div>', unsafe_allow_html=True)
    st.markdown("---")
    st.markdown("<br>", unsafe_allow_html=True)

    # Quick Stats at Top
    total_count = get_repository_count(collection)

    if total_count == 0:
        st.warning("⚠️ No data in database. Please import data first.")
        st.markdown("<br>", unsafe_allow_html=True)
        st.info("👈 Navigate to **Import Data** page to load GitHub Archive datasets")
        return

    col1, col2, col3 = st.columns(3)
    with col1:
        st.metric("Total Records", f"{total_count:,}")
    with col2:
        st.metric("Database", "github_archive")
    with col3:
        st.metric("Collection", "repositories")

    st.markdown("<br>", unsafe_allow_html=True)
    st.markdown("---")
    st.markdown("<br>", unsafe_allow_html=True)

    # Search and Filter Section
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
            ["watch_count", "repo_name", "_id"],
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

    # Fetch and display data
    sort_direction = -1 if sort_order == "Descending" else 1

    df = read_repositories(
        collection,
        limit=limit,
        search_term=search_term if search_term else None,
        sort_by=sort_by,
        sort_order=sort_direction
    )

    if not df.empty:
        # Results header
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

        # Display table
        display_data_table(df, height=450)

        st.markdown("<br>", unsafe_allow_html=True)

        # Quick stats about results
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


def render_create_page(collection):
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
                    success, message = create_repository(collection, repo_name.strip(), watch_count)
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


def render_update_page(collection):
    """Render the update repository page"""
    st.markdown('<div class="section-header">✏️ Update Repository</div>', unsafe_allow_html=True)
    st.markdown("---")

    # Show existing records for reference
    st.write("### Current Repositories (Top 50)")
    df = read_repositories(collection, limit=50)

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

                # Check if repo exists
                existing_repo = read_repository_by_id(collection, repo_id)

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
                            collection,
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


def render_delete_page(collection):
    """Render the delete repository page"""
    st.markdown('<div class="section-header">🗑️ Delete Repository</div>', unsafe_allow_html=True)
    st.markdown("---")

    # Show existing records
    st.write("### Current Repositories (Top 50)")
    df = read_repositories(collection, limit=50)

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

            # Show preview
            existing_repo = read_repository_by_id(collection, repo_id)
            if existing_repo:
                st.warning(f"⚠️ You are about to delete: **{existing_repo['repo_name']}**")

            col_btn1, col_btn2 = st.columns([1, 1])

            with col_btn1:
                if st.button("🗑️ Delete Repository", type="primary", use_container_width=True):
                    success, message = delete_repository(collection, repo_id)
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


def render_analytics_page(collection):
    """Render the analytics and visualizations page"""
    st.markdown('<div class="section-header">📈 Repository Analytics & Visualizations</div>', unsafe_allow_html=True)
    st.markdown("---")

    # Get statistics
    stats = get_database_stats(collection)

    if stats and stats['total_repos'] > 0:
        # Display summary metrics
        create_stats_summary(stats)

        st.markdown("---")

        # Tabs for different visualizations
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
            fig = create_distribution_histogram(collection)
            if fig:
                st.plotly_chart(fig, use_container_width=True)

        with tab3:
            st.write("### Top Repositories Share")
            fig = create_pie_chart_top_repos(stats['top_repos'], top_n=8)
            if fig:
                st.plotly_chart(fig, use_container_width=True)

        with tab4:
            st.write("### Repository Distribution by Watch Count Ranges")
            fig = create_watch_range_distribution(collection)
            if fig:
                st.plotly_chart(fig, use_container_width=True)

    else:
        st.warning("⚠️ No data available for analytics. Please import data first.")


def main():
    """Main application function"""
    # Header
    st.markdown('<div class="main-header">📊 GitHub Archive MongoDB CRUD Application</div>', unsafe_allow_html=True)

    # Initialize MongoDB
    collection, status = init_mongodb()

    if collection is None:
        st.error(f"❌ **MongoDB Connection Failed**")
        st.error(f"Error: {status}")
        st.info("💡 **How to fix:**")
        st.code("""
# Start MongoDB using Docker Compose:
docker-compose up -d

# Or check if MongoDB is running:
docker ps
        """, language="bash")
        return

    st.success("✅ Connected to MongoDB")

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
            "📈 Analytics"
        ],
        label_visibility="collapsed"
    )

    st.sidebar.markdown("---")

    # Display current database count
    count = get_repository_count(collection)
    st.sidebar.metric("Total Records", f"{count:,}")

    # Render selected page
    if page == "📥 Import Data":
        render_import_page(collection)
    elif page == "📊 View Data":
        render_view_page(collection)
    elif page == "➕ Create":
        render_create_page(collection)
    elif page == "✏️ Update":
        render_update_page(collection)
    elif page == "🗑️ Delete":
        render_delete_page(collection)
    elif page == "📈 Analytics":
        render_analytics_page(collection)

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


if __name__ == "__main__":
    main()
