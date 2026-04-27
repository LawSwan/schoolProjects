/**
 * Tool Suggestions Module
 * Contains all functions for the tool suggestions functionality
 * Uses switch statement implementation as required
 */

const ToolSuggestionsModule = {
    // Module variables
    i: 1,
    toolSuggestions: [],

    /**
     * Initialize the module
     */
    init: function() {
        console.log("ToolSuggestions module initializing...");
        // Get all elements with class 'tool-suggestion'
        this.toolSuggestions = document.getElementsByClassName("tool-suggestion");
        console.log("Found", this.toolSuggestions.length, "tool suggestion elements");
    },

    /**
     * Process user input using switch statement (as required)
     */
    processInput: function() {
        // Debug: log that function was called
        console.log("processInput called, i =", this.i);
        
        /***** The code below uses an if statement
        if (this.i <= 5) {
        //set current list item to text in text box
        this.toolSuggestions[this.i-1].innerHTML = document.getElementById("toolBox").value;
        //set textbox to empty text
        document.getElementById("toolBox").value = "";
        //if i is 5, thank user
        if (this.i === 5){
        document.getElementById("resultsExpl").innerHTML = "Thanks for your suggestions.";
        }
        this.i++;
        }
        **********/
        
        // Implement the same conditional functionality using a switch
        switch(true){
            case (this.i <= 5):
                //set current list item to text in text box (i-1 because arrays are 0-based)
                this.toolSuggestions[this.i-1].innerHTML = document.getElementById("toolBox").value;
                //set textbox to empty text
                document.getElementById("toolBox").value = "";
                //if i is 5, thank user
                if (this.i === 5){
                    document.getElementById("resultsExpl").innerHTML = "Thanks for your suggestions.";
                }
                this.i++;
                break;
            default:
                // Do nothing if i > 5
                console.log("Maximum suggestions reached");
                break;
        }
    },

    /**
     * Reset function (bonus feature)
     */
    reset: function() {
        this.i = 1;
        // Clear all tool suggestions
        for(let j = 0; j < this.toolSuggestions.length; j++) {
            this.toolSuggestions[j].innerHTML = "";
        }
        // Clear results message
        document.getElementById("resultsExpl").innerHTML = "";
        // Clear input box
        document.getElementById("toolBox").value = "";
        console.log("Tool suggestions reset");
    }
};

// Make available globally
window.ToolSuggestionsModule = ToolSuggestionsModule;
