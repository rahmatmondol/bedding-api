<x-app-layout>
    <div class="messaging-container">
        <!-- Sidebar with recent messages -->
        <div class="recent-messages">
            <div class="sidebar-header">
                <h2>Messages</h2>
                <button class="new-chat-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 5v14m-7-7h14" />
                    </svg>
                </button>
            </div>
            <div class="search-bar">
                <input type="text" placeholder="Search messages...">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8" />
                    <path d="m21 21-4.3-4.3" />
                </svg>
            </div>
            <div class="message-list" id="message-list">
                <!-- Conversations will be dynamically added here -->
            </div>
        </div>

        <!-- Main chat area -->
        <div class="chat-area">
            <div class="chat-header">
                <div class="chat-user-info">
                    <div class="avatar">
                        <img src="/api/placeholder/45/45" alt="Avatar">
                        <span class="status online"></span>
                    </div>
                    <div>
                        <h2 id="chat-user-name">Alex Johnson</h2>
                        <p class="user-status">Online</p>
                    </div>
                </div>
            </div>
            <div class="chat-messages" id="chat-messages">
                <!-- Messages will be dynamically added here -->
            </div>
            <div class="message-input">
                <form id="message-form">
                    <input type="text" id="message-input" placeholder="Type a message...">
                    <button type="submit" class="send-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m22 2-7 20-4-9-9-4Z" />
                            <path d="M22 2 11 13" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Firebase SDK -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Firebase Configuration
        // Fetch and display conversations
        function loadConversations() {
            const messageList = $("#message-list");

            database.ref("conversations").on("value", (snapshot) => {
                const data = snapshot.val();
                messageList.empty(); // Clear existing list

                if (data) {
                    Object.entries(data).forEach(([key, value]) => {
                        const conversationItem = `
                <div class="message-item" data-conversation-id="${key}">
                  <div class="avatar">
                    <img src="/api/placeholder/45/45" alt="Avatar">
                    <span class="status"></span>
                  </div>
                  <div class="message-content">
                    <div class="message-header">
                      <h3>${value.participants.join(", ")}</h3>
                      <span class="time">${formatTimestamp(value.lastMessageTimestamp)}</span>
                    </div>
                    <p class="message-preview">${value.lastMessage}</p>
                  </div>
                </div>
              `;
                        messageList.append(conversationItem);
                    });
                }
            });
        }

        // Load messages for a conversation
        function loadMessages(conversationId) {
            const chatMessages = $("#chat-messages");
            chatMessages.empty(); // Clear existing messages

            database.ref(`conversations/${conversationId}/messages`).on("value", (snapshot) => {
                const data = snapshot.val();
                if (data) {
                    Object.entries(data).forEach(([key, value]) => {
                        const messageElement = `
                <div class="message ${value.senderId === "user1" ? "outgoing" : "incoming"}">
                  ${value.senderId !== "user1" ? `
                        <div class="avatar">
                          <img src="/api/placeholder/45/45" alt="Avatar">
                        </div>
                      ` : ""}
                  <div class="message-bubble">
                    <p>${value.text}</p>
                    <span class="message-time">${formatTimestamp(value.timestamp)}</span>
                  </div>
                </div>
              `;
                        chatMessages.append(messageElement);
                    });

                    // Scroll to the bottom of the chat
                    chatMessages.scrollTop(chatMessages[0].scrollHeight);
                }
            });
        }

        // Send a message
        $("#message-form").on("submit", (e) => {
            e.preventDefault();
            const messageInput = $("#message-input");
            const messageText = messageInput.val().trim();

            if (messageText) {
                const conversationId = $(".message-item.active").data("conversation-id");

                if (conversationId) {
                    const message = {
                        senderId: "user1", // Replace with a unique identifier for the sender
                        text: messageText,
                        timestamp: firebase.database.ServerValue.TIMESTAMP,
                    };

                    // Add message to Firebase Realtime Database
                    database.ref(`conversations/${conversationId}/messages`).push(message)
                        .then(() => {
                            messageInput.val(""); // Clear input
                        })
                        .catch((error) => {
                            console.error("Error sending message:", error);
                        });

                    // Update last message in the conversation
                    database.ref(`conversations/${conversationId}`).update({
                        lastMessage: messageText,
                        lastMessageTimestamp: firebase.database.ServerValue.TIMESTAMP,
                    });
                }
            }
        });

        // Add click event to conversation items
        $(document).on("click", ".message-item", function() {
            const conversationId = $(this).data("conversation-id");
            loadMessages(conversationId);

            // Set active conversation
            $(".message-item").removeClass("active");
            $(this).addClass("active");
        });

        // Helper function to format timestamp
        function formatTimestamp(timestamp) {
            if (!timestamp) return "";
            const date = new Date(timestamp);
            return date.toLocaleTimeString([], {
                hour: "2-digit",
                minute: "2-digit"
            });
        }

        // Initialize the app
        $(document).ready(() => {
            loadConversations();
        });
    </script>
</x-app-layout>
<style>
    /* Base styles */
    :root {
        --dark-bg: #121212;
        --darker-bg: #0a0a0a;
        --light-bg: #1e1e1e;
        --primary-color: #DDF247;
        --text-color: #e0e0e0;
        --text-light: #d2d2d2;
        --border-color: #2c2c2c;
        --active-item: #2d2d39;
        --message-sent: #DDF247;
        --message-received: #2d2d39;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
    }

    body {
        background-color: var(--darker-bg);
        color: var(--text-color);
    }

    .messaging-container {
        display: flex;
        height: 100vh;
        max-width: 1400px;
        margin: 0 auto;
        overflow: hidden;
    }

    /* Sidebar styles */
    .recent-messages {
        width: 320px;
        background-color: var(--dark-bg);
        border-right: 1px solid var(--border-color);
        display: flex;
        flex-direction: column;
    }

    .sidebar-header {
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid var(--border-color);
    }

    .sidebar-header h2 {
        font-size: 1.2rem;
        font-weight: 600;
    }

    .new-chat-btn {
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .new-chat-btn:hover {
        background-color: rgba(128, 101, 255, 0.8);
    }

    .search-bar {
        padding: 15px;
        position: relative;
    }

    .search-bar input {
        background-color: var(--light-bg);
        border: none;
        border-radius: 8px;
        padding: 10px 15px 10px 40px;
        color: var(--text-color);
        width: 100%;
        font-size: 0.9rem;
    }

    .search-bar input::placeholder {
        color: var(--text-light);
    }

    .search-bar svg {
        position: absolute;
        left: 30px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
    }

    .message-list {
        flex-grow: 1;
        overflow-y: auto;
    }

    .message-item {
        padding: 15px 20px;
        display: flex;
        align-items: center;
        border-bottom: 1px solid var(--border-color);
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .message-item:hover {
        background-color: rgba(46, 46, 46, 0.5);
    }

    .message-item.active {
        background-color: var(--active-item);
    }

    .avatar {
        position: relative;
        margin-right: 15px;
    }

    .avatar img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
    }

    .status {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        border: 2px solid var(--dark-bg);
        background-color: var(--text-light);
    }

    .status.online {
        background-color: #4CAF50;
    }

    .message-content {
        flex-grow: 1;
        min-width: 0;
        /* Prevents text overflow */
    }

    .message-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
    }

    .message-header h3 {
        font-size: 14px;
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .time {
        font-size: 0.75rem;
        color: var(--text-light);
        white-space: nowrap;
    }

    .message-preview {
        font-size: 0.85rem;
        color: var(--text-light);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .unread-badge {
        background-color: #3C3C3C;
        color: white;
        font-size: 0.7rem;
        min-width: 20px;
        height: 20px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-left: 10px;
        padding: 0 6px;
    }

    /* Chat area styles */
    .chat-area {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        background-color: var(--darker-bg);
    }

    .chat-header {
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid var(--border-color);
        background-color: var(--dark-bg);
    }

    .chat-user-info {
        display: flex;
        align-items: center;
    }

    .chat-user-info h2 {
        font-size: 1.1rem;
        font-weight: 500;
    }

    .user-status {
        font-size: 0.8rem;
        color: var(--text-light);
    }

    .action-btn {
        background-color: transparent;
        border: none;
        color: var(--text-light);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        transition: background-color 0.2s;
    }

    .action-btn:hover {
        background-color: var(--light-bg);
    }

    .chat-messages {
        flex-grow: 1;
        padding: 20px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
    }

    .message {
        margin-bottom: 15px;
        display: flex;
        align-items: flex-end;
        max-width: 75%;
    }

    .message.incoming {
        align-self: flex-start;
    }

    .message.outgoing {
        align-self: flex-end;
        flex-direction: row-reverse;
    }

    .message-bubble {
        padding: 10px 15px;
        border-radius: 18px;
        position: relative;
    }

    .message.incoming .message-bubble {
        background-color: var(--message-received);
        border-bottom-left-radius: 4px;
        margin-left: 10px;
    }

    .message.outgoing .message-bubble {
        background-color: #2d2d39;
        border-bottom-right-radius: 4px;
        margin-right: 10px;
    }

    .message-bubble p {
        margin-bottom: 4px;
        font-size: 13px;
        line-height: 1.4;
        color: #fff;
    }

    .message-time {
        font-size: 0.7rem;
        color: rgba(255, 255, 255, 0.7);
        display: block;
        text-align: right;
        font-weight: 600;
    }

    .message-input {
        padding: 15px 20px;
        background-color: var(--dark-bg);
        border-top: 1px solid var(--border-color);
        display: flex;
        align-items: center;
    }

    .attachment-btn {
        background-color: transparent;
        border: none;
        color: var(--text-light);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 8px;
        border-radius: 50%;
        margin-right: 10px;
        transition: background-color 0.2s;
    }

    .attachment-btn:hover {
        background-color: var(--light-bg);
    }

    .message-input form {
        display: flex;
        flex-grow: 1;
    }

    .message-input input {
        flex-grow: 1;
        background-color: var(--light-bg);
        border: none;
        border-radius: 20px;
        padding: 12px 15px;
        color: var(--text-color);
        font-size: 16px;
    }

    .message-input input::placeholder {
        color: var(--text-light);
    }

    .send-btn {
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        margin-left: 10px;
        transition: background-color 0.2s;
    }

    .send-btn:hover {
        background-color: rgba(128, 101, 255, 0.8);
    }
</style>
