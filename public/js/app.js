

    let selectedTeacher = null;
    let isTyping = false;

    document.querySelectorAll('.teacher-item').forEach(item => {
        item.addEventListener('click', function() {
            const teacherId = this.dataset.teacher;
            const teacherName = this.dataset.name;
            const teacherImage = this.dataset.image;
            const teacherPosition = this.dataset.position;
            const teacherColor = this.dataset.color;

            document.querySelectorAll('.teacher-item').forEach(i => i.classList.remove('selected'));
            selectedTeacher = null;

            this.classList.add('selected');
            selectedTeacher = {
                id: teacherId,
                name: teacherName,
                image: teacherImage,
                position: teacherPosition,
                color: teacherColor
            };

            updateSelectedDisplay();
        });
    });

    function updateSelectedDisplay() {
        const selectedCount = document.getElementById('selectedCount');
        const activeDisplay = document.getElementById('activeTeachersDisplay');

        if (!selectedTeacher) {
            selectedCount.textContent = 'No professor selected yet';
            activeDisplay.innerHTML = '';
        } else {
            selectedCount.textContent = `Selected professor: ${selectedTeacher.name}`;
            activeDisplay.innerHTML = `<img src="${selectedTeacher.image}" alt="${selectedTeacher.name}" class="active-teacher-mini" title="${selectedTeacher.name}">`;
        }
    }

    const messageInput = document.getElementById('messageInput');
    const sendButton = document.getElementById('sendButton');

    if (messageInput) {
        messageInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 120) + 'px';
        });

        messageInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });
    }

    if (sendButton) {
        sendButton.addEventListener('click', sendMessage);
    }

    function sendMessage() {
        if (isTyping) return;

        const messageInput = document.getElementById('messageInput');
        const message = messageInput.value.trim();

        if (!message) {
            alert('Please write a message!');
            return;
        }

        if (!selectedTeacher) {
            alert('Please select a professor!');
            return;
        }

        const welcomeScreen = document.getElementById('welcomeScreen');
        if (welcomeScreen) {
            welcomeScreen.remove();
        }

        addUserMessage(message);

        messageInput.value = '';
        messageInput.style.height = 'auto';
        setInputState(false);

        showTypingIndicator();

        const formData = new FormData();
        formData.append('ajax', '1');
        formData.append('teacher', selectedTeacher.id);
        formData.append('question', message);

        console.log('Sent data:', {
            teacher: selectedTeacher.id,
            question: message
        });

        fetch('', {
            method: 'POST',
            body: formData
        })
            .then(response => {
                console.log('HTTP Status:', response.status);
                return response.text();
            })
            .then(text => {
                console.log('Raw response:', text);
                try {
                    const data = JSON.parse(text);
                    console.log('Parsed response:', JSON.stringify(data, null, 2));

                    hideTypingIndicator();

                    if (data.error) {
                        addErrorMessage(data.error);
                        setInputState(true);
                        return;
                    }

                    let responses = [];

                    if (data.responses && Array.isArray(data.responses)) {
                        responses = data.responses;
                    } else {
                        console.error('Unknown response format:', data);
                        addErrorMessage('Invalid API response format');
                        setInputState(true);
                        return;
                    }

                    if (responses.length !== 1) {
                        console.warn('Unexpected response count:', { expected: 1, received: responses.length });
                        addErrorMessage('Response could not be retrieved. Please try again.');
                    }

                    const response = responses[0];
                    if (selectedTeacher.id === response.professor_id) {
                        if (response.response.length > 500) {
                            response.response = response.response.substring(0, 500) + "...";
                        }

                        const sentences = response.response.split(/[.!?]+/).filter(s => s.trim().length > 0);
                        if (sentences.length > 4) {
                            response.response = sentences.slice(0, 4).join('. ') + '.';
                        }
                        addTeacherMessage(response, selectedTeacher);
                    } else {
                        console.warn(`Professor ID mismatch: ${response.professor_id}`);
                        addErrorMessage('Professor response could not be retrieved.');
                    }

                    setInputState(true);
                } catch (e) {
                    console.error('JSON parse error:', e);
                    hideTypingIndicator();
                    addErrorMessage('Error processing response: ' + text.substring(0, 100));
                    setInputState(true);
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                hideTypingIndicator();
                addErrorMessage('Connection error: ' + error.message);
                setInputState(true);
            });
    }

    function addUserMessage(message) {
        const chatMessages = document.getElementById('chatMessages');
        const messageDiv = document.createElement('div');
        messageDiv.className = 'message user-message';
        messageDiv.innerHTML = `
            <div class="user-bubble">
                ${escapeHtml(message)}
            </div>
        `;
        chatMessages.appendChild(messageDiv);
        scrollToBottom();
    }

    let messageCounter = 0;
    function addTeacherMessage(response, teacher) {
        const chatMessages = document.getElementById('chatMessages');
        const messageDiv = document.createElement('div');
        messageDiv.className = `message teacher-message ${teacher.position}`;

        const uniqueId = `typewriter-${teacher.id}-${messageCounter++}`;

        let cleanedResponse = response.response.replace(/^[^:\n]+:\s*/, '').trim();

        messageDiv.innerHTML = `
        <div class="teacher-content">
            <div class="teacher-info">
                <img src="${teacher.image}" alt="${teacher.name}" class="teacher-photo">
                
            </div>
            <div class="teacher-bubble">
                <div class="teacher-text typewriter" id="${uniqueId}"></div>
            </div>
        </div>
    `;

        chatMessages.appendChild(messageDiv);
        scrollToBottom();

        typewriterEffect(cleanedResponse, uniqueId);
    }

    function typewriterEffect(text, elementId) {
        const element = document.getElementById(elementId);
        if (!element) return;

        let index = 0;
        element.textContent = '';

        function type() {
            if (index < text.length && element) {
                element.textContent += text.charAt(index);
                index++;
                scrollToBottom();
                setTimeout(type, 10);
            }
        }

        type();
    }

    function addErrorMessage(error) {
        const chatMessages = document.getElementById('chatMessages');
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.innerHTML = `<strong>Error:</strong> ${escapeHtml(error)}`;
        chatMessages.appendChild(errorDiv);
        scrollToBottom();

        setTimeout(() => {
            if (errorDiv.parentNode) {
                errorDiv.remove();
            }
        }, 5000);
    }

    function showTypingIndicator() {
        const chatMessages = document.getElementById('chatMessages');
        const typingDiv = document.createElement('div');
        typingDiv.className = 'typing-indicator';
        typingDiv.id = 'typingIndicator';

        typingDiv.innerHTML = `
            <div class="typing-text">${selectedTeacher ? selectedTeacher.name : 'Professor'} is typing...</div>
            <div class="typing-dots">
                <div class="typing-dot"></div>
                <div class="typing-dot"></div>
                <div class="typing-dot"></div>
            </div>
        `;

        chatMessages.appendChild(typingDiv);
        scrollToBottom();
        isTyping = true;
    }

    function hideTypingIndicator() {
        const typingIndicator = document.getElementById('typingIndicator');
        if (typingIndicator) {
            typingIndicator.remove();
        }
        isTyping = false;
    }

    function setInputState(enabled) {
        const messageInput = document.getElementById('messageInput');
        const sendButton = document.getElementById('sendButton');

        messageInput.disabled = !enabled;
        sendButton.disabled = !enabled;

        if (enabled) {
            messageInput.focus();
        }
    }

    function scrollToBottom() {
        const chatMessages = document.getElementById('chatMessages');
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    if (typeof feather !== 'undefined') {
        feather.replace();
    }

    function addLearnItem() {
        var container = document.getElementById('learnItemsContainer');
        var html = '<div class="input-group input-group-sm mb-1 learn-item-row">' +
            '<input type="text" name="learn_items[]" class="form-control" placeholder="e.g. Network threat detection">' +
            '<div class="input-group-append">' +
            '<button type="button" class="btn btn-outline-danger" onclick="this.closest(\'.learn-item-row\').remove()">&times;</button>' +
            '</div></div>';
        container.insertAdjacentHTML('beforeend', html);
    }

    function addIncludesItem() {
        var container = document.getElementById('includesContainer');
        var html = '<div class="input-group input-group-sm mb-1 includes-row">' +
            '<input type="text" name="includes_info[]" class="form-control" placeholder="e.g. 5 articles">' +
            '<div class="input-group-append">' +
            '<button type="button" class="btn btn-outline-danger" onclick="this.closest(\'.includes-row\').remove()">&times;</button>' +
            '</div></div>';
        container.insertAdjacentHTML('beforeend', html);
    }

    var pendingDeleteForm = null;
    document.querySelectorAll('.delete-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            pendingDeleteForm = this.closest('.delete-form');
            var msgEl = document.getElementById('deleteModalMessage');
            if (msgEl) msgEl.textContent = this.dataset.message || 'Are you sure?';
            if (typeof $ !== 'undefined') {
                $('#deleteConfirmModal').modal('show');
            }
        });
    });
    
    var confirmBtn = document.getElementById('confirmDeleteBtn');
    if (confirmBtn) {
        confirmBtn.addEventListener('click', function() {
            if (pendingDeleteForm) {
                pendingDeleteForm.submit();
            }
        });
    }

    document.addEventListener("DOMContentLoaded", function(event) {
        var scrollpos = sessionStorage.getItem('scrollpos');
        if (scrollpos) {
            window.scrollTo(0, scrollpos);
            sessionStorage.removeItem('scrollpos');
        }
    });

    window.addEventListener("beforeunload", function(e) {
        sessionStorage.setItem('scrollpos', window.scrollY);
    });

    const buttons = document.querySelectorAll('.dropdown-item');
    buttons.forEach(button => {
        button.addEventListener('click', function () {
            buttons.forEach(b => b.classList.remove('active'));
            button.classList.add('active');
            const themeValue = button.getAttribute('data-bs-theme-value');
            if (themeValue === 'light') {
                document.body.setAttribute('data-bs-theme', 'light');
            } else if (themeValue === 'dark') {
                document.body.setAttribute('data-bs-theme', 'dark');
            } else {
                document.body.removeAttribute('data-bs-theme');
            }
        });
    });
