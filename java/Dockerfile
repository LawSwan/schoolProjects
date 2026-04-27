FROM eclipse-temurin:17-jdk-jammy

# Set working directory
WORKDIR /app

# Install essential tools (remove python3)
RUN apt-get update && apt-get install -y \
    vim \
    tree \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Copy project files
COPY . .

# Create bin directory for compiled Java files
RUN mkdir -p bin

# Set environment variables
ENV JAVA_HOME=/opt/java/openjdk
ENV PATH="$JAVA_HOME/bin:$PATH"

# Expose port
EXPOSE 8080

# Keep container running for debugging
CMD ["tail", "-f", "/dev/null"]