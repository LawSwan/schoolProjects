/**
 * Main.js - Application Coordinator
 * Initializes modules and sets up event listeners
 */

const App = {
    /**
     * Initialize the application
     */
    init: function() {
        console.log("App initializing...");
        
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.setupApp());
        } else {
            this.setupApp();
        }
    },

    /**
     * Set up the application components
     */
    setupApp: function() {
        console.log("Setting up app components...");
        
        // Initialize the tool suggestions module
        ToolSuggestionsModule.init();
        
        // Set up event listeners
        this.setupEventListeners();
        
        console.log("App setup complete!");
    },

    /**
     * Set up event listeners
     */
    setupEventListeners: function() {
        // Connect submit button to tool suggestions module
        const submitButton = document.getElementById("button");
        if (submitButton) {
            submitButton.addEventListener("click", () => {
                ToolSuggestionsModule.processInput();
            });
            console.log("Submit button connected");
        }

        // Optional: Add Enter key support
        const toolBox = document.getElementById("toolBox");
        if (toolBox) {
            toolBox.addEventListener("keypress", (event) => {
                if (event.key === 'Enter') {
                    ToolSuggestionsModule.processInput();
                }
            });
            console.log("Enter key support added");
        }
    }
};

// Start the application
App.init();
