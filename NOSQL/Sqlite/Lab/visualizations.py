"""
Visualizations Module
Handles data visualization and analytics charts
"""

import plotly.express as px
import plotly.graph_objects as go
import pandas as pd
import streamlit as st


def create_top_repos_chart(top_repos_data):
    """
    Create horizontal bar chart for top repositories

    Args:
        top_repos_data: List of dictionaries with repo data

    Returns:
        plotly.graph_objects.Figure
    """
    if not top_repos_data:
        return None

    df = pd.DataFrame(top_repos_data)

    fig = px.bar(
        df,
        x='watch_count',
        y='repo_name',
        orientation='h',
        title="Top 10 Most Watched Repositories",
        labels={'watch_count': 'Watch Count', 'repo_name': 'Repository'},
        color='watch_count',
        color_continuous_scale='Viridis',
        text='watch_count'
    )

    fig.update_traces(texttemplate='%{text:,}', textposition='outside')
    fig.update_layout(
        height=500,
        showlegend=False,
        yaxis={'categoryorder': 'total ascending'}
    )

    return fig


def create_distribution_histogram(conn):
    """
    Create histogram showing watch count distribution

    Args:
        conn: SQLite connection object

    Returns:
        plotly.graph_objects.Figure
    """
    try:
        cursor = conn.cursor()
        cursor.execute('SELECT watch_count FROM repositories')

        watch_counts = [row[0] for row in cursor.fetchall()]

        if not watch_counts:
            return None

        fig = go.Figure(data=[go.Histogram(
            x=watch_counts,
            nbinsx=50,
            marker_color='rgb(55, 83, 109)'
        )])

        fig.update_layout(
            title="Distribution of Watch Counts",
            xaxis_title="Watch Count",
            yaxis_title="Number of Repositories",
            height=400,
            bargap=0.1
        )

        return fig
    except Exception as e:
        st.error(f"Error creating histogram: {e}")
        return None


def create_pie_chart_top_repos(top_repos_data, top_n=10):
    """
    Create pie chart showing top repositories by watch count

    Args:
        top_repos_data: List of dictionaries with repo data
        top_n: Number of top repos to show

    Returns:
        plotly.graph_objects.Figure
    """
    if not top_repos_data:
        return None

    df = pd.DataFrame(top_repos_data[:top_n])

    fig = px.pie(
        df,
        values='watch_count',
        names='repo_name',
        title=f"Top {top_n} Repositories - Watch Count Distribution",
        color_discrete_sequence=px.colors.sequential.RdBu
    )

    fig.update_traces(textposition='inside', textinfo='percent+label')
    fig.update_layout(height=500)

    return fig


def create_comparison_chart(conn, repo_ids):
    """
    Create comparison chart for selected repositories

    Args:
        conn: SQLite connection object
        repo_ids: List of repository IDs to compare

    Returns:
        plotly.graph_objects.Figure
    """
    try:
        cursor = conn.cursor()

        # Create placeholders for SQL IN clause
        placeholders = ','.join('?' * len(repo_ids))
        query = f'SELECT id, repo_name, watch_count FROM repositories WHERE id IN ({placeholders})'

        cursor.execute(query, repo_ids)

        repos = []
        for row in cursor.fetchall():
            repos.append({
                '_id': row[0],
                'repo_name': row[1],
                'watch_count': row[2]
            })

        if not repos:
            return None

        df = pd.DataFrame(repos)

        fig = px.bar(
            df,
            x='repo_name',
            y='watch_count',
            title="Repository Comparison",
            labels={'watch_count': 'Watch Count', 'repo_name': 'Repository'},
            color='watch_count',
            color_continuous_scale='Blues',
            text='watch_count'
        )

        fig.update_traces(texttemplate='%{text:,}', textposition='outside')
        fig.update_layout(height=400)

        return fig
    except Exception as e:
        st.error(f"Error creating comparison chart: {e}")
        return None


def create_stats_summary(stats_data):
    """
    Display summary statistics using Streamlit metrics

    Args:
        stats_data: Dictionary containing statistics
    """
    if not stats_data or 'stats' not in stats_data:
        st.warning("No statistics available")
        return

    stats = stats_data['stats']

    col1, col2, col3, col4 = st.columns(4)

    with col1:
        st.metric(
            "Total Repositories",
            f"{stats_data.get('total_repos', 0):,}"
        )

    with col2:
        avg = stats.get('avg_watches', 0)
        st.metric(
            "Avg Watch Count",
            f"{avg:,.0f}"
        )

    with col3:
        max_w = stats.get('max_watches', 0)
        st.metric(
            "Max Watches",
            f"{max_w:,}"
        )

    with col4:
        min_w = stats.get('min_watches', 0)
        st.metric(
            "Min Watches",
            f"{min_w:,}"
        )


def create_watch_range_distribution(conn):
    """
    Create chart showing distribution of repositories by watch count ranges

    Args:
        conn: SQLite connection object

    Returns:
        plotly.graph_objects.Figure
    """
    try:
        cursor = conn.cursor()

        # Define watch count ranges using CASE statement
        query = '''
            SELECT
                CASE
                    WHEN watch_count < 1000 THEN '0-1K'
                    WHEN watch_count < 5000 THEN '1K-5K'
                    WHEN watch_count < 10000 THEN '5K-10K'
                    WHEN watch_count < 50000 THEN '10K-50K'
                    WHEN watch_count < 100000 THEN '50K-100K'
                    ELSE '100K+'
                END as range_label,
                COUNT(*) as count
            FROM repositories
            GROUP BY range_label
            ORDER BY
                CASE range_label
                    WHEN '0-1K' THEN 1
                    WHEN '1K-5K' THEN 2
                    WHEN '5K-10K' THEN 3
                    WHEN '10K-50K' THEN 4
                    WHEN '50K-100K' THEN 5
                    WHEN '100K+' THEN 6
                END
        '''

        cursor.execute(query)
        results = cursor.fetchall()

        if not results:
            return None

        labels = [row[0] for row in results]
        counts = [row[1] for row in results]

        fig = go.Figure(data=[go.Bar(
            x=labels,
            y=counts,
            marker_color='rgb(26, 118, 255)',
            text=counts,
            textposition='auto'
        )])

        fig.update_layout(
            title="Repository Distribution by Watch Count Ranges",
            xaxis_title="Watch Count Range",
            yaxis_title="Number of Repositories",
            height=400
        )

        return fig
    except Exception as e:
        st.error(f"Error creating range distribution: {e}")
        return None


def display_data_table(df, height=400):
    """
    Display formatted data table with Streamlit

    Args:
        df: Pandas DataFrame
        height: Table height in pixels
    """
    if df.empty:
        st.info("No data to display")
        return

    # Select and reorder columns
    display_cols = ['_id', 'repo_name', 'watch_count']
    if 'created_at' in df.columns:
        display_cols.append('created_at')
    if 'updated_at' in df.columns and df['updated_at'].notna().any():
        display_cols.append('updated_at')

    # Only display columns that exist
    existing_cols = [col for col in display_cols if col in df.columns]

    st.dataframe(
        df[existing_cols],
        use_container_width=True,
        height=height,
        hide_index=True
    )
