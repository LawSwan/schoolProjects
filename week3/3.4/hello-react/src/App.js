import { useState } from 'react';
import './App.css';

function App() {
  const [displayText, setDisplayText] = useState('Hello World');
  const [input, setInput] = useState('');

  function handleDisplay() {
    if (input.trim()) {
      setDisplayText(input);
    }
  }

  return (
    <main className="card">
      <h2 className="display">{displayText}</h2>

      <label htmlFor="messageInput">Message to Display</label>
      <input
        id="messageInput"
        type="text"
        value={input}
        placeholder="type your message..."
        onChange={(e) => setInput(e.target.value)}
      />

      <button type="button" onClick={handleDisplay}>
        Display Message
      </button>
    </main>
  );
}

export default App;
