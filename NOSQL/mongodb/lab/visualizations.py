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


def create_distribution_histogram(collection):
    """
    Create histogram showing watch count distribution

    Args:
        collection: MongoDB collection object

    Returns:
        plotly.graph_objects.Figure
    """
    try:
        all_data = list(collection.find({}, {'watch_count': 1}))

        if not all_data:
            return None

        watch_counts = [doc['watch_count'] for doc in all_data]

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


def create_comparison_chart(collection, repo_ids):
    """
    Create comparison chart for selected repositories

    Args:
        collection: MongoDB collection object
        repo_ids: List of repository IDs to compare

    Returns:
        plotly.graph_objects.Figure
    """
    try:
        repos = list(collection.find({'_id': {'$in': repo_ids}}))

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


def create_watch_range_distribution(collection):
    """
    Create chart showing distribution of repositories by watch count ranges

    Args:
        collection: MongoDB collection object

    Returns:
        plotly.graph_objects.Figure
    """
    try:
        # Define watch count ranges
        pipeline = [
            {
                '$bucket': {
                    'groupBy': '$watch_count',
                    'boundaries': [0, 1000, 5000, 10000, 50000, 100000],
                    'default': '100000+',
                    'output': {
                        'count': {'$sum': 1}
                    }
                }
            }
        ]

        results = list(collection.aggregate(pipeline))

        if not results:
            return None

        # Create labels for ranges
        labels = []
        counts = []
        for item in results:
            boundary = item['_id']
            if boundary == '100000+':
                labels.append('100K+')
            elif boundary == 0:
                labels.append('0-1K')
            elif boundary == 1000:
                labels.append('1K-5K')
            elif boundary == 5000:
                labels.append('5K-10K')
            elif boundary == 10000:
                labels.append('10K-50K')
            elif boundary == 50000:
                labels.append('50K-100K')
            else:
                labels.append(f"{boundary}+")

            counts.append(item['count'])

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

    st.dataframe(
        df[display_cols],
        use_container_width=True,
        height=height,
        hide_index=True
    )
