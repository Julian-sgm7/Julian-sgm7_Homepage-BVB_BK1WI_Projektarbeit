// ai-chat.js - KI-Assistenten Chat-Widget Logik

class AIChatWidget {
    constructor() {
        this.isOpen = false;
        this.messages = [];
        this.isLoading = false;
        this.apiPath = this.getApiPath();
        this.init();
    }

    getApiPath() {
        const currentPath = window.location.pathname;
        if (currentPath.includes('/layouts/')) {
            return '../ai-chat.php';
        }
        return 'ai-chat.php';
    }

    init() {
        // HTML einfügen
        this.createChatWidget();
        this.attachEventListeners();
        this.loadChatHistory();
    }

    createChatWidget() {
        const widget = document.createElement('div');
        widget.className = 'ai-chat-widget';
        widget.id = 'ai-chat-widget';
        widget.innerHTML = `
            <!-- Toggle Button -->
            <button class="ai-chat-toggle minimized" id="ai-chat-toggle" title="KI-Assistent">
                🤖
            </button>

            <!-- Chat Window -->
            <div class="ai-chat-window" id="ai-chat-window">
                <!-- Header -->
                <div class="ai-chat-header">
                    <div>
                        <h3 class="ai-chat-title">BVB Assistent</h3>
                        <p class="ai-chat-subtitle">Powered by Claude AI</p>
                    </div>
                    <button class="ai-chat-close" id="ai-chat-close" title="Schließen">✕</button>
                </div>

                <!-- Messages -->
                <div class="ai-chat-messages" id="ai-chat-messages">
                    <div class="ai-message assistant">
                        <div class="ai-message-avatar">🤖</div>
                        <div class="ai-message-content">
                            Hallo! 👋 Ich bin dein BVB-Assistent. Stell mir gerne Fragen zu unseren Tickets, dem Shop, Teams oder der Website!
                        </div>
                    </div>
                </div>

                <!-- Input -->
                <div class="ai-chat-input-container">
                    <textarea 
                        class="ai-chat-input" 
                        id="ai-chat-input" 
                        placeholder="Deine Frage..."
                        rows="1"
                    ></textarea>
                    <button class="ai-chat-send" id="ai-chat-send">➤</button>
                </div>
            </div>
        `;

        document.body.appendChild(widget);
    }

    attachEventListeners() {
        const toggle = document.getElementById('ai-chat-toggle');
        const closeBtn = document.getElementById('ai-chat-close');
        const input = document.getElementById('ai-chat-input');
        const sendBtn = document.getElementById('ai-chat-send');
        const window = document.getElementById('ai-chat-window');

        // Toggle Chat
        toggle.addEventListener('click', () => this.toggleChat());

        // Close Chat
        closeBtn.addEventListener('click', () => this.closeChat());

        // Send Message
        sendBtn.addEventListener('click', () => this.sendMessage());

        // Enter zum Senden (Shift+Enter für Zeilenumbruch)
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                this.sendMessage();
            }
        });

        // Auto-resize textarea
        input.addEventListener('input', () => {
            input.style.height = 'auto';
            input.style.height = Math.min(input.scrollHeight, 60) + 'px';
        });

        // Close on escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.isOpen) {
                this.closeChat();
            }
        });
    }

    toggleChat() {
        if (this.isOpen) {
            this.closeChat();
        } else {
            this.openChat();
        }
    }

    openChat() {
        this.isOpen = true;
        const window = document.getElementById('ai-chat-window');
        const toggle = document.getElementById('ai-chat-toggle');
        const input = document.getElementById('ai-chat-input');

        window.classList.add('open');
        toggle.classList.add('maximized');
        toggle.classList.remove('minimized');

        input.focus();
        this.scrollToBottom();
    }

    closeChat() {
        this.isOpen = false;
        const window = document.getElementById('ai-chat-window');
        const toggle = document.getElementById('ai-chat-toggle');

        window.classList.remove('open');
        toggle.classList.remove('maximized');
        toggle.classList.add('minimized');
    }

    addMessage(text, role = 'user') {
        this.messages.push({ text, role });

        const messagesContainer = document.getElementById('ai-chat-messages');
        const messageDiv = document.createElement('div');
        messageDiv.className = `ai-message ${role}`;

        const avatar = role === 'user' ? '👤' : '🤖';
        messageDiv.innerHTML = `
            <div class="ai-message-avatar">${avatar}</div>
            <div class="ai-message-content">${this.escapeHtml(text)}</div>
        `;

        messagesContainer.appendChild(messageDiv);
        this.scrollToBottom();
        this.saveChatHistory();
    }

    addTypingIndicator() {
        const messagesContainer = document.getElementById('ai-chat-messages');
        const typingDiv = document.createElement('div');
        typingDiv.className = 'ai-message assistant';
        typingDiv.id = 'typing-indicator';
        typingDiv.innerHTML = `
            <div class="ai-message-avatar">🤖</div>
            <div class="ai-message-typing">
                <span></span>
                <span></span>
                <span></span>
            </div>
        `;
        messagesContainer.appendChild(typingDiv);
        this.scrollToBottom();
    }

    removeTypingIndicator() {
        const typing = document.getElementById('typing-indicator');
        if (typing) typing.remove();
    }

    async sendMessage() {
        const input = document.getElementById('ai-chat-input');
        const message = input.value.trim();

        if (!message || this.isLoading) return;

        // Clear input
        input.value = '';
        input.style.height = 'auto';

        // Add user message
        this.addMessage(message, 'user');
        this.isLoading = true;

        // Show typing indicator
        this.addTypingIndicator();

        try {
            const response = await fetch(this.apiPath, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ message })
            });

            if (!response.ok) {
                const error = await response.json();
                throw new Error(error.error || 'API-Fehler');
            }

            const data = await response.json();

            if (data.success) {
                this.removeTypingIndicator();
                this.addMessage(data.reply, 'assistant');
            } else {
                this.removeTypingIndicator();
                this.addErrorMessage(data.error || 'Fehler beim Abrufen der Antwort');
            }
        } catch (error) {
            console.error('Chat Error:', error);
            this.removeTypingIndicator();
            this.addErrorMessage(`Fehler: ${error.message}`);
        } finally {
            this.isLoading = false;
        }
    }

    addErrorMessage(text) {
        const messagesContainer = document.getElementById('ai-chat-messages');
        const messageDiv = document.createElement('div');
        messageDiv.className = 'ai-message error assistant';

        // Wenn Demo-Modus, zeige hilfreiche Anleitung
        const isDemo = text.includes('API-Key') || text.includes('console.anthropic.com');
        const helpText = isDemo ? '\n\n📋 Setup-Anleitung:\n1. https://console.anthropic.com/ besuchen\n2. API-Key erstellen\n3. In Projektarbeit/.env einfügen' : '';

        messageDiv.innerHTML = `
            <div class="ai-message-avatar">⚠️</div>
            <div class="ai-message-content">${this.escapeHtml(text)}${helpText ? '<br><br>' + this.escapeHtml(helpText) : ''}</div>
        `;

        messagesContainer.appendChild(messageDiv);
        this.scrollToBottom();
    }

    scrollToBottom() {
        const container = document.getElementById('ai-chat-messages');
        setTimeout(() => {
            container.scrollTop = container.scrollHeight;
        }, 0);
    }

    saveChatHistory() {
        localStorage.setItem('bvb_chat_history', JSON.stringify(this.messages));
    }

    loadChatHistory() {
        const saved = localStorage.getItem('bvb_chat_history');
        if (saved) {
            try {
                const messages = JSON.parse(saved);
                // Lade nur letzte 10 Nachrichten
                const recent = messages.slice(-10);
                const container = document.getElementById('ai-chat-messages');

                // Behalte Willkommensnachricht
                const welcomeMsg = container.querySelector('.ai-message');

                recent.forEach(msg => {
                    if (msg.text !== welcomeMsg?.textContent) {
                        this.addMessage(msg.text, msg.role);
                    }
                });
            } catch (e) {
                console.error('Chat History Load Error:', e);
            }
        }
    }

    escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, m => map[m]);
    }
}

// Initialisieren wenn DOM bereit ist
document.addEventListener('DOMContentLoaded', () => {
    new AIChatWidget();
});
