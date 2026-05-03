document.addEventListener('DOMContentLoaded', () => {
    const registrationForm = document.getElementById('registrationForm');
    const studentsList = document.getElementById('studentsList');
    const formMessage = document.getElementById('formMessage');

    // Fetch and display students on load
    fetchStudents();

    // Handle form submission
    registrationForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const course = document.getElementById('course').value;

        // Reset message
        formMessage.textContent = 'Registering...';
        formMessage.className = '';

        try {
            const response = await fetch('/api/students', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ name, email, course })
            });

            const result = await response.json();

            if (response.ok) {
                formMessage.textContent = 'Registration successful!';
                formMessage.className = 'message-success';
                registrationForm.reset();
                // Refresh the list
                fetchStudents();
            } else {
                formMessage.textContent = `Error: ${result.error || 'Failed to register'}`;
                formMessage.className = 'message-error';
            }
        } catch (error) {
            console.error('Submission error:', error);
            formMessage.textContent = 'An error occurred while connecting to the server.';
            formMessage.className = 'message-error';
        }
    });

    // Function to fetch and display students
    async function fetchStudents() {
        try {
            const response = await fetch('/api/students');
            const students = await response.json();

            studentsList.innerHTML = '';

            if (students.length === 0) {
                studentsList.innerHTML = `<tr><td colspan="3" class="empty-state">No students registered yet.</td></tr>`;
                return;
            }

            students.forEach(student => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${escapeHTML(student.name)}</td>
                    <td>${escapeHTML(student.email)}</td>
                    <td>${escapeHTML(student.course)}</td>
                `;
                studentsList.appendChild(tr);
            });
        } catch (error) {
            console.error('Fetch error:', error);
            studentsList.innerHTML = `<tr><td colspan="3" class="empty-state message-error">Failed to load students.</td></tr>`;
        }
    }

    // Helper to prevent XSS
    function escapeHTML(str) {
        return str.replace(/[&<>'"]/g, 
            tag => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                "'": '&#39;',
                '"': '&quot;'
            }[tag])
        );
    }
});
