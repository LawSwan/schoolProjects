"""
Amber Lawson
Streamlit Web Application for GitHub Archive Neo4j Analytics
Provides interactive UI for data loading, CRUD operations, and visualizations
"""

import streamlit as st
import pandas as pd
import plotly.express as px
import plotly.graph_objects as go
from datetime import datetime, timedelta
from github_neo4j_app import GitHubNeo4jApp
from github_archive_loader import GitHubArchiveLoader
from data_integration import DataIntegration


# Page configuration
st.set_page_config(
    page_title="GitHub Archive Analytics",
    page_icon="📊",
    layout="wide",
    initial_sidebar_state="expanded"
)


def initialize_session_state():
    """Initialize all session state variables"""
    if 'neo4j_app' not in st.session_state:
        st.session_state.neo4j_app = None
    if 'archive_loader' not in st.session_state:
        st.session_state.archive_loader = GitHubArchiveLoader()
    if 'integration' not in st.session_state:
        st.session_state.integration = None


def connect_to_neo4j():
    """Connect to Neo4j database"""
    with st.sidebar.expander("⚙️ Database Connection", expanded=True):
        uri = st.text_input("Neo4j URI", value="neo4j://localhost:7687")
        username = st.text_input("Username", value="neo4j")
        password = st.text_input("Password", value="password1", type="password")

        if st.button("Connect"):
            try:
                st.session_state.neo4j_app = GitHubNeo4jApp(uri, username, password)
                st.session_state.integration = DataIntegration(
                    st.session_state.neo4j_app,
                    st.session_state.archive_loader
                )
                st.success("Connected to Neo4j!")
            except Exception as e:
                st.error(f"Connection failed: {e}")

        if st.session_state.neo4j_app:
            st.success("✅ Connected")
        else:
            st.warning("Not connected")


def sidebar_navigation():
    """Sidebar navigation menu"""
    st.sidebar.title("📊 GitHub Archive Analytics")

    connect_to_neo4j()

    st.sidebar.markdown("---")

    page = st.sidebar.radio(
        "Navigation",
        ["🏠 Dashboard", "📥 Data Import", "📝 CRUD Operations", "📈 Analytics", "ℹ️ About"]
    )

    return page


def dashboard_page():
    """Main dashboard page"""
    st.title("🏠 Dashboard")

    if not st.session_state.neo4j_app:
        st.warning("Please connect to Neo4j database first")
        return

    # Get database statistics
    try:
        stats = st.session_state.neo4j_app.get_database_stats()

        # Display metrics in columns
        col1, col2, col3, col4 = st.columns(4)

        with col1:
            st.metric("👥 Users", stats['users'])
        with col2:
            st.metric("📦 Repositories", stats['repositories'])
        with col3:
            st.metric("⚡ Events", stats['events'])
        with col4:
            st.metric("🔗 Relationships", stats['relationships'])

        st.markdown("---")

        # Language statistics chart
        st.subheader("📊 Programming Language Distribution")

        lang_stats = st.session_state.neo4j_app.get_language_statistics()

        if lang_stats:
            df_lang = pd.DataFrame(lang_stats)

            fig = px.bar(
                df_lang,
                x='language',
                y='repo_count',
                title='Repositories by Programming Language',
                labels={'language': 'Programming Language', 'repo_count': 'Number of Repositories'},
                color='repo_count',
                color_continuous_scale='Viridis'
            )

            st.plotly_chart(fig, use_container_width=True)
        else:
            st.info("No language data available yet. Import some data to see statistics.")

    except Exception as e:
        st.error(f"Error loading dashboard: {e}")


def data_import_page():
    """Data import page"""
    st.title("📥 Data Import")

    if not st.session_state.neo4j_app:
        st.warning("Please connect to Neo4j database first")
        return

    st.markdown("### Download GitHub Archive Data")

    col1, col2 = st.columns(2)

    with col1:
        st.markdown("#### Select Date and Time")

        # Date picker
        selected_date = st.date_input(
            "Date",
            value=datetime(2024, 1, 1),
            min_value=datetime(2011, 2, 12),
            max_value=datetime.now()
        )

        # Hour selector
        hour = st.slider("Hour (UTC)", 0, 23, 0)

        # Limit events
        limit = st.number_input("Number of events to import", min_value=10, max_value=10000, value=100, step=10)

    with col2:
        st.markdown("#### Import Information")
        st.info(f"""
        **Selected Date:** {selected_date.strftime('%Y-%m-%d')}
        **Hour:** {hour}:00 UTC
        **Events to import:** {limit}

        GitHub Archive provides hourly snapshots of GitHub activity.
        Each file contains thousands of events (pushes, PRs, issues, etc.)
        """)

    st.markdown("---")

    if st.button("🚀 Download and Import Data", type="primary"):
        with st.spinner("Downloading and importing data..."):
            try:
                # Download and load data
                stats = st.session_state.integration.download_and_load(
                    year=selected_date.year,
                    month=selected_date.month,
                    day=selected_date.day,
                    hour=hour,
                    limit=limit
                )

                if stats:
                    st.success("Data imported successfully!")

                    # Display import statistics
                    col1, col2, col3 = st.columns(3)
                    with col1:
                        st.metric("Users Created", stats['users_created'])
                    with col2:
                        st.metric("Repos Created", stats['repos_created'])
                    with col3:
                        st.metric("Events Created", stats['events_created'])

                    if stats['errors'] > 0:
                        st.warning(f"Encountered {stats['errors']} errors during import")
                else:
                    st.error("Failed to import data")

            except Exception as e:
                st.error(f"Import failed: {e}")


def crud_operations_page():
    """CRUD operations page"""
    st.title("📝 CRUD Operations")

    if not st.session_state.neo4j_app:
        st.warning("Please connect to Neo4j database first")
        return

    app = st.session_state.neo4j_app

    # Tabs for different operations
    tab1, tab2, tab3, tab4 = st.tabs(["➕ Create", "📖 Read", "✏️ Update", "🗑️ Delete"])

    with tab1:
        st.subheader("Create New Records")

        operation = st.selectbox("Select type", ["User", "Repository", "Event"])

        if operation == "User":
            with st.form("create_user"):
                username = st.text_input("Username")
                user_id = st.number_input("User ID", min_value=1, step=1)
                email = st.text_input("Email (optional)")

                if st.form_submit_button("Create User"):
                    try:
                        app.create_user(username, user_id, email if email else None)
                        st.success(f"User '{username}' created!")
                    except Exception as e:
                        st.error(f"Error: {e}")

        elif operation == "Repository":
            with st.form("create_repo"):
                repo_name = st.text_input("Repository Name")
                repo_id = st.number_input("Repository ID", min_value=1, step=1)
                owner_id = st.number_input("Owner User ID", min_value=1, step=1)
                language = st.text_input("Programming Language (optional)")
                description = st.text_area("Description (optional)")

                if st.form_submit_button("Create Repository"):
                    try:
                        app.create_repository(
                            repo_name, repo_id, owner_id,
                            language if language else None,
                            description if description else None
                        )
                        st.success(f"Repository '{repo_name}' created!")
                    except Exception as e:
                        st.error(f"Error: {e}")

    with tab2:
        st.subheader("Read Records")

        read_type = st.selectbox("Select type", ["Users", "Repositories", "Single User", "Single Repository"])

        if read_type == "Users":
            limit = st.number_input("Limit", min_value=1, max_value=1000, value=10)
            if st.button("Get Users"):
                try:
                    users = app.read_all_users(limit)
                    if users:
                        df = pd.DataFrame(users)
                        st.dataframe(df, use_container_width=True)
                    else:
                        st.info("No users found")
                except Exception as e:
                    st.error(f"Error: {e}")

        elif read_type == "Repositories":
            limit = st.number_input("Limit", min_value=1, max_value=1000, value=10)
            if st.button("Get Repositories"):
                try:
                    repos = app.read_all_repositories(limit)
                    if repos:
                        df = pd.DataFrame(repos)
                        st.dataframe(df, use_container_width=True)
                    else:
                        st.info("No repositories found")
                except Exception as e:
                    st.error(f"Error: {e}")

        elif read_type == "Single User":
            username = st.text_input("Username")
            if st.button("Search User"):
                try:
                    user = app.read_user(username=username)
                    if user:
                        st.json(user)
                    else:
                        st.warning("User not found")
                except Exception as e:
                    st.error(f"Error: {e}")

    with tab3:
        st.subheader("Update Records")

        update_type = st.selectbox("Select type to update", ["User", "Repository"])

        if update_type == "User":
            with st.form("update_user"):
                user_id = st.number_input("User ID", min_value=1, step=1)
                new_username = st.text_input("New Username (optional)")
                new_email = st.text_input("New Email (optional)")

                if st.form_submit_button("Update User"):
                    try:
                        kwargs = {}
                        if new_username:
                            kwargs['username'] = new_username
                        if new_email:
                            kwargs['email'] = new_email

                        if kwargs:
                            app.update_user(user_id, **kwargs)
                            st.success(f"User {user_id} updated!")
                        else:
                            st.warning("No fields to update")
                    except Exception as e:
                        st.error(f"Error: {e}")

    with tab4:
        st.subheader("Delete Records")
        st.warning("⚠️ Deletion is permanent!")

        delete_type = st.selectbox("Select type to delete", ["User", "Repository", "Event"])

        if delete_type == "User":
            user_id = st.number_input("User ID to delete", min_value=1, step=1)
            if st.button("Delete User", type="secondary"):
                try:
                    app.delete_user(user_id)
                    st.success(f"User {user_id} deleted")
                except Exception as e:
                    st.error(f"Error: {e}")


def analytics_page():
    """Analytics and visualizations page"""
    st.title("📈 Analytics")

    if not st.session_state.neo4j_app:
        st.warning("Please connect to Neo4j database first")
        return

    app = st.session_state.neo4j_app

    # Feature selection
    feature = st.selectbox(
        "Select Analysis",
        [
            "User Collaboration Patterns",
            "Repository Similarity Analysis",
            "Event Timeline",
            "Language Statistics"
        ]
    )

    if feature == "User Collaboration Patterns":
        st.subheader("👥 User Collaboration Patterns")
        st.markdown("Find users who contributed to the same repositories")

        user_id = st.number_input("User ID", min_value=1, step=1, value=1)
        min_repos = st.slider("Minimum shared repositories", 1, 10, 1)

        if st.button("Find Collaborators"):
            try:
                collaborators = app.find_user_collaborators(user_id, min_repos)

                if collaborators:
                    df = pd.DataFrame(collaborators)
                    st.dataframe(df, use_container_width=True)

                    # Visualization
                    fig = px.bar(
                        df,
                        x='collaborator',
                        y='shared_repos',
                        title='Collaborators by Shared Repositories',
                        labels={'collaborator': 'Collaborator', 'shared_repos': 'Shared Repositories'}
                    )
                    st.plotly_chart(fig, use_container_width=True)
                else:
                    st.info("No collaborators found")
            except Exception as e:
                st.error(f"Error: {e}")

    elif feature == "Repository Similarity Analysis":
        st.subheader("📦 Repository Similarity Analysis")

        repo_id = st.number_input("Repository ID", min_value=1, step=1, value=101)
        metric = st.radio("Similarity Metric", ["contributors", "language"])

        if st.button("Find Similar Repositories"):
            try:
                similar = app.find_similar_repositories(repo_id, metric)

                if similar:
                    df = pd.DataFrame(similar)
                    st.dataframe(df, use_container_width=True)
                else:
                    st.info("No similar repositories found")
            except Exception as e:
                st.error(f"Error: {e}")

    elif feature == "Event Timeline":
        st.subheader("⚡ Event Timeline Analysis")

        col1, col2 = st.columns(2)

        with col1:
            filter_user = st.checkbox("Filter by User ID")
            user_id = st.number_input("User ID", min_value=1, step=1, value=1) if filter_user else None

        with col2:
            filter_repo = st.checkbox("Filter by Repository ID")
            repo_id = st.number_input("Repo ID", min_value=1, step=1, value=101) if filter_repo else None

        limit = st.slider("Number of events", 10, 200, 50)

        if st.button("Get Timeline"):
            try:
                events = app.get_event_timeline(
                    user_id=user_id if filter_user else None,
                    repo_id=repo_id if filter_repo else None,
                    limit=limit
                )

                if events:
                    df = pd.DataFrame(events)
                    st.dataframe(df, use_container_width=True)

                    # Event type distribution
                    event_counts = df['event_type'].value_counts()
                    fig = px.pie(
                        values=event_counts.values,
                        names=event_counts.index,
                        title='Event Type Distribution'
                    )
                    st.plotly_chart(fig, use_container_width=True)
                else:
                    st.info("No events found")
            except Exception as e:
                st.error(f"Error: {e}")

    elif feature == "Language Statistics":
        st.subheader("💻 Programming Language Statistics")

        try:
            lang_stats = app.get_language_statistics()

            if lang_stats:
                df = pd.DataFrame(lang_stats)

                col1, col2 = st.columns(2)

                with col1:
                    st.dataframe(df, use_container_width=True)

                with col2:
                    fig = px.pie(
                        df,
                        values='repo_count',
                        names='language',
                        title='Language Distribution'
                    )
                    st.plotly_chart(fig, use_container_width=True)
            else:
                st.info("No language data available")
        except Exception as e:
            st.error(f"Error: {e}")


def about_page():
    """About page"""
    st.title("ℹ️ About")

    st.markdown("""
    ### GitHub Archive Analytics Platform

    This application integrates GitHub Archive data with Neo4j graph database to provide
    powerful analytics and insights into GitHub activity patterns.

    #### Features:
    - 📥 **Data Import**: Download and import GitHub Archive data
    - 📝 **CRUD Operations**: Create, Read, Update, Delete users, repositories, and events
    - 📈 **Analytics**:
        - User collaboration pattern discovery
        - Repository similarity analysis
        - Event timeline visualization
        - Programming language statistics

    #### Technology Stack:
    - **Database**: Neo4j (Graph Database)
    - **Backend**: Python with neo4j-driver
    - **Frontend**: Streamlit
    - **Visualization**: Plotly
    - **Data Source**: GitHub Archive (gharchive.org)

    #### Database Connection:
    - URI: `neo4j://localhost:7687`
    - Default credentials: `neo4j / password1`

    #### Data Source:
    GitHub Archive provides hourly JSON files containing all public GitHub events.
    Each file is compressed and contains events like:
    - PushEvent (commits)
    - PullRequestEvent
    - IssuesEvent
    - WatchEvent (stars)
    - ForkEvent
    - And more...

    #### Project Structure:
    ```
    github_neo4j_app.py       # Core Neo4j operations
    github_archive_loader.py  # GitHub Archive data loader
    data_integration.py       # Integration layer
    streamlit_app.py          # This web application
    ```
    """)


def main():
    """Main application - Entry point"""
    # Initialize session state first
    initialize_session_state()

    # Get current page from sidebar navigation
    page = sidebar_navigation()

    # Route to appropriate page
    if page == "🏠 Dashboard":
        dashboard_page()
    elif page == "📥 Data Import":
        data_import_page()
    elif page == "📝 CRUD Operations":
        crud_operations_page()
    elif page == "📈 Analytics":
        analytics_page()
    elif page == "ℹ️ About":
        about_page()


if __name__ == "__main__":
    try:
        main()
    except Exception as e:
        st.error(f"Application error: {e}")
        st.exception(e)
