const API_URL = 'http://localhost:5000/api/books';

document.getElementById('bookForm').addEventListener('submit', async (e) => {
  e.preventDefault();
  
  const book = {
    book_id: document.getElementById('book_id').value,
    title: document.getElementById('title').value,
    author: document.getElementById('author').value,
    year: parseInt(document.getElementById('year').value)
  };
  
  try {
    const response = await fetch(API_URL, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(book)
    });
    
    if (response.ok) {
      alert('Book added successfully!');
      document.getElementById('bookForm').reset();
      loadBooks();
    } else {
      alert('Error adding book');
    }
  } catch (error) {
    console.error('Error:', error);
  }
});

document.getElementById('loadBooks').addEventListener('click', loadBooks);

async function loadBooks() {
  try {
    const response = await fetch(API_URL);
    const books = await response.json();
    
    const container = document.getElementById('booksContainer');
    container.innerHTML = '';
    
    books.forEach(book => {
      const bookDiv = document.createElement('div');
      bookDiv.className = 'book';
      bookDiv.innerHTML = `
        <h3>${book.title}</h3>
        <p><strong>ID:</strong> ${book.book_id}</p>
        <p><strong>Author:</strong> ${book.author}</p>
        <p><strong>Year:</strong> ${book.year}</p>
      `;
      container.appendChild(bookDiv);
    });
  } catch (error) {
    console.error('Error:', error);
  }
}

// Load books on page load
loadBooks();